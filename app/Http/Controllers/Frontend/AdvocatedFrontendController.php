<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AdvocatedContent;
use App\Models\CareerApplication;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdvocatedFrontendController extends Controller
{
    public function home(): View
    {
        $site = config('advocated_site');

        return view('frontend.home', [
            'site' => $site,
            'featuredServices' => $this->homepageSection('services', 6),
            'featuredBlogs' => $this->homepageSection('blogs', 3),
            'featuredTeam' => $this->homepageSection('team', 4),
            'featuredCareers' => $this->homepageSection('careers', 4),
            'featuredProBono' => $this->homepageSection('pro-bono', 3),
            'featuredVideos' => $this->homepageSection('videos', 3),
            'galleryImages' => GalleryImage::query()->where('is_active', true)->orderBy('sort_order')->take(8)->get(),
            'stats' => [
                'services' => AdvocatedContent::forSection('services')->where('status', 'published')->count(),
                'blogs' => AdvocatedContent::forSection('blogs')->where('status', 'published')->count(),
                'team' => AdvocatedContent::forSection('team')->where('status', 'published')->count(),
                'careers' => AdvocatedContent::forSection('careers')->where('status', 'published')->count(),
            ],
        ]);
    }

    public function about(): View
    {
        return view('frontend.about.story', [
            'site' => config('advocated_site'),
            'featuredTeam' => $this->publishedSection('team', 4),
        ]);
    }

    public function services(): View
    {
        return $this->sectionIndex('services', 'frontend.services.index');
    }

    public function service(string $slug): View
    {
        return $this->sectionShow('services', $slug, 'frontend.services.show');
    }

    public function blogs(): View
    {
        return $this->sectionIndex('blogs', 'frontend.blogs.index');
    }

    public function blog(string $slug): View
    {
        return $this->sectionShow('blogs', $slug, 'frontend.blogs.show');
    }

    public function team(): View
    {
        return $this->sectionIndex('team', 'frontend.team.index');
    }

    public function teamMember(string $slug): View
    {
        return $this->sectionShow('team', $slug, 'frontend.team.show');
    }

    public function careers(): View
    {
        return $this->sectionIndex('careers', 'frontend.careers.index');
    }

    public function career(string $slug): View
    {
        $career = $this->findContent('careers', $slug);

        return view('frontend.careers.show', [
            'career' => $career,
            'sectionMeta' => AdvocatedContent::sectionMeta('careers'),
            'relatedCareers' => $this->relatedContent('careers', $career->id, 3),
        ]);
    }

    public function applyCareer(Request $request, string $slug): RedirectResponse
    {
        $career = $this->findContent('careers', $slug);

        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'current_location' => ['nullable', 'string', 'max:255'],
            'years_experience' => ['nullable', 'integer', 'min:0', 'max:60'],
            'linkedin_url' => ['nullable', 'url', 'max:2048'],
            'resume' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:10240'],
            'cover_letter' => ['nullable', 'string'],
        ]);

        CareerApplication::create([
            'advocated_content_id' => $career->id,
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'current_location' => $validated['current_location'] ?? null,
            'years_experience' => $validated['years_experience'] ?? null,
            'linkedin_url' => $validated['linkedin_url'] ?? null,
            'resume_path' => $request->hasFile('resume')
                ? $request->file('resume')->store('career-applications', 'local')
                : null,
            'cover_letter' => $validated['cover_letter'] ?? null,
            'status' => 'new',
        ]);

        return back()->with('success', 'Your application has been submitted successfully.');
    }

    public function proBono(): View
    {
        return $this->sectionIndex('pro-bono', 'frontend.pro-bono.index');
    }

    public function proBonoStory(string $slug): View
    {
        return $this->sectionShow('pro-bono', $slug, 'frontend.pro-bono.show');
    }

    public function videos(): View
    {
        return $this->sectionIndex('videos', 'frontend.videos.index');
    }

    public function video(string $slug): View
    {
        return $this->sectionShow('videos', $slug, 'frontend.videos.show');
    }

    public function gallery(): View
    {
        return view('frontend.gallery.index', [
            'images' => GalleryImage::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->limit(10)
                ->get(),
        ]);
    }

    public function contact(): View
    {
        return view('frontend.contact.index', [
            'site' => config('advocated_site'),
            'featuredServices' => $this->publishedSection('services', 4),
        ]);
    }

    protected function sectionIndex(string $section, string $view): View
    {
        return view($view, [
            'items' => $this->publishedSection($section, 10),
            'sectionMeta' => AdvocatedContent::sectionMeta($section),
        ]);
    }

    protected function sectionShow(string $section, string $slug, string $view): View
    {
        $item = $this->findContent($section, $slug);

        return view($view, [
            'item' => $item,
            'sectionMeta' => AdvocatedContent::sectionMeta($section),
            'relatedItems' => $this->relatedContent($section, $item->id, 3),
        ]);
    }

    protected function publishedSection(string $section, int $limit)
    {
        return AdvocatedContent::query()
            ->forSection($section)
            ->where('status', 'published')
            ->orderBy('sort_order')
            ->orderByDesc('published_at')
            ->limit($limit)
            ->get();
    }

    protected function relatedContent(string $section, int $ignoreId, int $limit)
    {
        return AdvocatedContent::query()
            ->forSection($section)
            ->where('status', 'published')
            ->where('id', '!=', $ignoreId)
            ->orderBy('sort_order')
            ->orderByDesc('published_at')
            ->limit($limit)
            ->get();
    }

    protected function homepageSection(string $section, int $limit)
    {
        $query = AdvocatedContent::query()
            ->forSection($section)
            ->where('status', 'published')
            ->where('show_on_homepage', true)
            ->orderBy('sort_order')
            ->orderByDesc('published_at');

        $items = $query->limit($limit)->get();

        if ($items->isNotEmpty()) {
            return $items;
        }

        return $this->publishedSection($section, $limit);
    }

    protected function findContent(string $section, string $slug): AdvocatedContent
    {
        return AdvocatedContent::query()
            ->forSection($section)
            ->where('status', 'published')
            ->where('slug', $slug)
            ->firstOrFail();
    }
}
