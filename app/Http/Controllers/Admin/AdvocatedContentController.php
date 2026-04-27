<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdvocatedContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdvocatedContentController extends Controller
{
    public function index(Request $request, string $section): View
    {
        $sectionMeta = $this->authorizeSection($section, 'list');

        $query = AdvocatedContent::query()
            ->with(['creator', 'updater'])
            ->forSection($section);

        if ($search = trim((string) $request->input('search'))) {
            $query->where(function ($builder) use ($search) {
                $builder
                    ->where('title', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('author_name', 'like', "%{$search}%")
                    ->orWhere('contact_person', 'like', "%{$search}%");
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($request->filled('featured')) {
            $query->where('is_featured', (bool) $request->boolean('featured'));
        }

        $contents = $query
            ->orderBy('sort_order')
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(12)
            ->withQueryString();

        $statsBase = AdvocatedContent::query()->forSection($section);

        $stats = [
            'total' => (clone $statsBase)->count(),
            'published' => (clone $statsBase)->where('status', 'published')->count(),
            'featured' => (clone $statsBase)->where('is_featured', true)->count(),
            'homepage' => (clone $statsBase)->where('show_on_homepage', true)->count(),
        ];

        return view('admin.advocated-contents.index', [
            'contents' => $contents,
            'section' => $section,
            'sectionMeta' => $sectionMeta,
            'statuses' => AdvocatedContent::statuses(),
            'stats' => $stats,
        ]);
    }

    public function create(string $section): View
    {
        $sectionMeta = $this->authorizeSection($section, 'create');

        return view('admin.advocated-contents.create', [
            'section' => $section,
            'sectionMeta' => $sectionMeta,
            'statuses' => AdvocatedContent::statuses(),
            'content' => new AdvocatedContent([
                'section' => $section,
                'status' => 'draft',
                'badge_color' => $sectionMeta['accent'] ?? '#1d4ed8',
                'currency' => 'INR',
            ]),
        ]);
    }

    public function store(Request $request, string $section): RedirectResponse
    {
        $sectionMeta = $this->authorizeSection($section, 'create');
        $data = $this->validatedData($request, $section);
        $data['section'] = $section;
        $data['created_by'] = auth()->id();
        $data['updated_by'] = auth()->id();

        $content = new AdvocatedContent($data);
        $this->fillUploads($request, $content, $section);
        $content->save();

        return redirect()
            ->route('admin.advocated-content.index', ['section' => $section])
            ->with('success', $sectionMeta['singular'].' created successfully.');
    }

    public function show(string $section, AdvocatedContent $advocatedContent): View
    {
        $sectionMeta = $this->authorizeSection($section, 'list');
        $content = $this->ensureSectionMatch($section, $advocatedContent->load(['creator', 'updater']));

        return view('admin.advocated-contents.show', [
            'section' => $section,
            'sectionMeta' => $sectionMeta,
            'content' => $content,
        ]);
    }

    public function edit(string $section, AdvocatedContent $advocatedContent): View
    {
        $sectionMeta = $this->authorizeSection($section, 'edit');
        $content = $this->ensureSectionMatch($section, $advocatedContent);

        return view('admin.advocated-contents.edit', [
            'section' => $section,
            'sectionMeta' => $sectionMeta,
            'statuses' => AdvocatedContent::statuses(),
            'content' => $content,
        ]);
    }

    public function update(Request $request, string $section, AdvocatedContent $advocatedContent): RedirectResponse
    {
        $sectionMeta = $this->authorizeSection($section, 'edit');
        $content = $this->ensureSectionMatch($section, $advocatedContent);
        $data = $this->validatedData($request, $section, $content);
        $data['section'] = $section;
        $data['updated_by'] = auth()->id();

        $content->fill($data);
        $this->fillUploads($request, $content, $section);
        $content->save();

        return redirect()
            ->route('admin.advocated-content.index', ['section' => $section])
            ->with('success', $sectionMeta['singular'].' updated successfully.');
    }

    public function destroy(string $section, AdvocatedContent $advocatedContent): RedirectResponse
    {
        $sectionMeta = $this->authorizeSection($section, 'delete');
        $content = $this->ensureSectionMatch($section, $advocatedContent);

        $this->purgeManagedFiles($content);
        $content->delete();

        return back()->with('success', $sectionMeta['singular'].' deleted successfully.');
    }

    protected function authorizeSection(string $section, string $action): array
    {
        $sectionMeta = AdvocatedContent::sectionMeta($section);

        abort_if(empty($sectionMeta), 404);

        Gate::authorize($sectionMeta['permission_prefix'].'-'.$action);

        return $sectionMeta;
    }

    protected function ensureSectionMatch(string $section, AdvocatedContent $content): AdvocatedContent
    {
        abort_if($content->section !== $section, 404);

        return $content;
    }

    protected function validatedData(
        Request $request,
        string $section,
        ?AdvocatedContent $content = null
    ): array {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('advocated_contents', 'slug')
                    ->ignore($content?->id)
                    ->where(fn ($query) => $query->where('section', $section)),
            ],
            'tagline' => ['nullable', 'string', 'max:255'],
            'subheading' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'summary' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'detailed_content' => ['nullable', 'string'],
            'quote' => ['nullable', 'string'],
            'author_name' => ['nullable', 'string', 'max:255'],
            'author_designation' => ['nullable', 'string', 'max:255'],
            'team_role' => ['nullable', 'string', 'max:255'],
            'practice_area' => ['nullable', 'string', 'max:255'],
            'experience_years' => ['nullable', 'integer', 'min:0', 'max:80'],
            'license_number' => ['nullable', 'string', 'max:255'],
            'education' => ['nullable', 'string', 'max:255'],
            'job_location' => ['nullable', 'string', 'max:255'],
            'job_type' => ['nullable', 'string', 'max:255'],
            'salary_range' => ['nullable', 'string', 'max:255'],
            'application_deadline' => ['nullable', 'date'],
            'contact_person' => ['nullable', 'string', 'max:255'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
            'whatsapp_number' => ['nullable', 'string', 'max:50'],
            'office_location' => ['nullable', 'string', 'max:255'],
            'office_address' => ['nullable', 'string', 'max:255'],
            'opening_hours' => ['nullable', 'string', 'max:255'],
            'map_embed_url' => ['nullable', 'url', 'max:2048'],
            'video_url' => ['nullable', 'url', 'max:2048'],
            'video_duration' => ['nullable', 'string', 'max:255'],
            'cta_text' => ['nullable', 'string', 'max:255'],
            'cta_link' => ['nullable', 'url', 'max:2048'],
            'secondary_cta_text' => ['nullable', 'string', 'max:255'],
            'secondary_cta_link' => ['nullable', 'url', 'max:2048'],
            'badge_text' => ['nullable', 'string', 'max:255'],
            'badge_color' => ['nullable', 'string', 'max:50'],
            'consultation_fee' => ['nullable', 'numeric', 'min:0'],
            'currency' => ['nullable', 'string', 'max:10'],
            'status' => ['required', Rule::in(array_keys(AdvocatedContent::statuses()))],
            'is_featured' => ['nullable', 'boolean'],
            'show_on_homepage' => ['nullable', 'boolean'],
            'show_in_menu' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'reading_time' => ['nullable', 'integer', 'min:0'],
            'published_at' => ['nullable', 'date'],
            'schema_type' => ['nullable', 'string', 'max:255'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'canonical_url' => ['nullable', 'url', 'max:2048'],
            'og_title' => ['nullable', 'string', 'max:255'],
            'og_description' => ['nullable', 'string'],
            'og_image' => ['nullable', 'string', 'max:255'],
            'featured_image' => ['nullable', 'image', 'max:5120'],
            'banner_image' => ['nullable', 'image', 'max:5120'],
            'thumbnail_image' => ['nullable', 'image', 'max:5120'],
            'brochure_file' => ['nullable', 'file', 'max:10240', 'mimes:pdf,doc,docx,ppt,pptx'],
            'gallery_uploads' => ['nullable', 'array'],
            'gallery_uploads.*' => ['image', 'max:5120'],
            'remove_gallery_images' => ['nullable', 'array'],
            'remove_gallery_images.*' => ['string'],
            'highlights' => ['nullable', 'array'],
            'highlights.*' => ['nullable', 'string', 'max:255'],
            'key_points' => ['nullable', 'array'],
            'key_points.*' => ['nullable', 'string', 'max:255'],
            'requirements' => ['nullable', 'array'],
            'requirements.*' => ['nullable', 'string', 'max:255'],
            'responsibilities' => ['nullable', 'array'],
            'responsibilities.*' => ['nullable', 'string', 'max:255'],
            'benefits' => ['nullable', 'array'],
            'benefits.*' => ['nullable', 'string', 'max:255'],
            'seo_keywords' => ['nullable', 'array'],
            'seo_keywords.*' => ['nullable', 'string', 'max:255'],
            'faqs' => ['nullable', 'array'],
            'faqs.question' => ['nullable', 'array'],
            'faqs.question.*' => ['nullable', 'string', 'max:255'],
            'faqs.answer' => ['nullable', 'array'],
            'faqs.answer.*' => ['nullable', 'string'],
            'linkedin_url' => ['nullable', 'url', 'max:2048'],
            'facebook_url' => ['nullable', 'url', 'max:2048'],
            'twitter_url' => ['nullable', 'url', 'max:2048'],
            'instagram_url' => ['nullable', 'url', 'max:2048'],
            'youtube_url' => ['nullable', 'url', 'max:2048'],
            'notes' => ['nullable', 'string'],
        ]);

        $validated['slug'] = Str::slug($validated['slug'] ?: $validated['title']);
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['show_on_homepage'] = $request->boolean('show_on_homepage');
        $validated['show_in_menu'] = $request->boolean('show_in_menu');
        $validated['sort_order'] = (int) ($validated['sort_order'] ?? 0);
        $validated['highlights'] = $this->cleanList($validated['highlights'] ?? []);
        $validated['key_points'] = $this->cleanList($validated['key_points'] ?? []);
        $validated['requirements'] = $this->cleanList($validated['requirements'] ?? []);
        $validated['responsibilities'] = $this->cleanList($validated['responsibilities'] ?? []);
        $validated['benefits'] = $this->cleanList($validated['benefits'] ?? []);
        $validated['seo_keywords'] = $this->cleanList($validated['seo_keywords'] ?? []);
        $validated['faqs'] = $this->cleanFaqs($request->input('faqs', []));
        $validated['social_links'] = $this->cleanAssoc([
            'linkedin' => $request->input('linkedin_url'),
            'facebook' => $request->input('facebook_url'),
            'twitter' => $request->input('twitter_url'),
            'instagram' => $request->input('instagram_url'),
            'youtube' => $request->input('youtube_url'),
        ]);
        $validated['extra_attributes'] = $this->cleanAssoc([
            'notes' => $request->input('notes'),
        ]);

        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        unset(
            $validated['gallery_uploads'],
            $validated['remove_gallery_images'],
            $validated['faqs.question'],
            $validated['faqs.answer'],
            $validated['faqs'],
            $validated['linkedin_url'],
            $validated['facebook_url'],
            $validated['twitter_url'],
            $validated['instagram_url'],
            $validated['youtube_url'],
            $validated['notes']
        );

        $validated['faqs'] = $this->cleanFaqs($request->input('faqs', []));

        return $validated;
    }

    protected function fillUploads(Request $request, AdvocatedContent $content, string $section): void
    {
        foreach (['featured_image', 'banner_image', 'thumbnail_image', 'brochure_file'] as $field) {
            if ($request->hasFile($field)) {
                $this->deleteIfStored($content->getOriginal($field));
                $content->{$field} = $request->file($field)->store("advocated/{$section}", 'public');
            }
        }

        $galleryImages = $content->gallery_images ?? [];

        foreach ((array) $request->input('remove_gallery_images', []) as $removedImage) {
            $galleryImages = array_values(array_filter(
                $galleryImages,
                fn ($image) => $image !== $removedImage
            ));
            $this->deleteIfStored($removedImage);
        }

        if ($request->hasFile('gallery_uploads')) {
            foreach ($request->file('gallery_uploads') as $image) {
                $galleryImages[] = $image->store("advocated/{$section}/gallery", 'public');
            }
        }

        $content->gallery_images = array_values(array_unique(array_filter($galleryImages)));
    }

    protected function purgeManagedFiles(AdvocatedContent $content): void
    {
        foreach (['featured_image', 'banner_image', 'thumbnail_image', 'brochure_file'] as $field) {
            $this->deleteIfStored($content->{$field});
        }

        foreach ($content->gallery_images ?? [] as $image) {
            $this->deleteIfStored($image);
        }
    }

    protected function deleteIfStored(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    protected function cleanList(array $items): array
    {
        return array_values(array_filter(array_map(
            fn ($value) => trim((string) $value),
            $items
        )));
    }

    protected function cleanFaqs(array $faqInput): array
    {
        $questions = $faqInput['question'] ?? [];
        $answers = $faqInput['answer'] ?? [];
        $faqs = [];

        foreach ($questions as $index => $question) {
            $question = trim((string) $question);
            $answer = trim((string) ($answers[$index] ?? ''));

            if ($question === '' && $answer === '') {
                continue;
            }

            $faqs[] = [
                'question' => $question,
                'answer' => $answer,
            ];
        }

        return $faqs;
    }

    protected function cleanAssoc(array $items): array
    {
        return array_filter($items, fn ($value) => filled($value));
    }
}
