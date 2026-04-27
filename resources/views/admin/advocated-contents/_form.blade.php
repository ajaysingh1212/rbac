@php
    $listDefaults = fn ($value) => count($value ?? []) ? $value : [''];
    $socialLinks = $content->social_links ?? [];
    $notes = $content->extra_attributes['notes'] ?? null;
    $faqQuestions = old('faqs.question', collect($content->faqs ?? [])->pluck('question')->all());
    $faqAnswers = old('faqs.answer', collect($content->faqs ?? [])->pluck('answer')->all());

    if (empty($faqQuestions) && empty($faqAnswers)) {
        $faqQuestions = [''];
        $faqAnswers = [''];
    }
@endphp

<form action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($formMethod !== 'POST')
        @method($formMethod)
    @endif

    <div class="row">
        <div class="col-xl-8">
            <div class="card border-0 mb-4">
                <div class="card-header">
                    <h3 class="card-title mb-0">Core Content</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 mb-4">
                            <label>Title</label>
                            <input type="text" name="title" class="form-control adv-slug-source" value="{{ old('title', $content->title) }}" placeholder="Example: Corporate Litigation Advisory">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label>Slug</label>
                            <input type="text" name="slug" class="form-control adv-slug-target" value="{{ old('slug', $content->slug) }}" placeholder="auto-generated-if-empty">
                        </div>

                        <div class="col-md-6 mb-4">
                            <label>Tagline</label>
                            <input type="text" name="tagline" class="form-control" value="{{ old('tagline', $content->tagline) }}" placeholder="Confident, strategic, courtroom-ready advocacy">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label>Subheading</label>
                            <input type="text" name="subheading" class="form-control" value="{{ old('subheading', $content->subheading) }}" placeholder="Use this to support the headline">
                        </div>

                        <div class="col-md-6 mb-4">
                            <label>Status</label>
                            <select name="status" class="custom-select">
                                @foreach($statuses as $statusKey => $statusLabel)
                                    <option value="{{ $statusKey }}" @selected(old('status', $content->status) === $statusKey)>
                                        {{ $statusLabel }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 mb-4">
                            <label>Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" min="0" value="{{ old('sort_order', $content->sort_order) }}">
                        </div>
                        <div class="col-md-3 mb-4">
                            <label>Reading Time</label>
                            <input type="number" name="reading_time" class="form-control" min="0" value="{{ old('reading_time', $content->reading_time) }}" placeholder="mins">
                        </div>

                        <div class="col-md-6 mb-4">
                            <label>Badge Text</label>
                            <input type="text" name="badge_text" class="form-control" value="{{ old('badge_text', $content->badge_text) }}" placeholder="Featured case study">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label>Badge Color</label>
                            <input type="text" name="badge_color" class="form-control" value="{{ old('badge_color', $content->badge_color ?: $sectionMeta['accent']) }}" placeholder="#38bdf8">
                        </div>

                        <div class="col-12 mb-4">
                            <label>Excerpt</label>
                            <textarea name="excerpt" rows="3" class="form-control" placeholder="Short intro used in cards and previews">{{ old('excerpt', $content->excerpt) }}</textarea>
                        </div>
                        <div class="col-12 mb-4">
                            <label>Summary</label>
                            <textarea name="summary" rows="4" class="form-control" placeholder="Add a concise but rich overview">{{ old('summary', $content->summary) }}</textarea>
                        </div>
                        <div class="col-12 mb-4">
                            <label>Description</label>
                            <textarea name="description" rows="6" class="form-control" placeholder="Primary body copy for this section">{{ old('description', $content->description) }}</textarea>
                        </div>
                        <div class="col-12">
                            <label>Detailed Content</label>
                            <textarea name="detailed_content" rows="8" class="form-control" placeholder="Long-form story, case details, team narrative, or policy breakdown">{{ old('detailed_content', $content->detailed_content) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 mb-4">
                <div class="card-header">
                    <h3 class="card-title mb-0">Advocated-Specific Metadata</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label>Author Name</label>
                            <input type="text" name="author_name" class="form-control" value="{{ old('author_name', $content->author_name) }}" placeholder="Lead author or spokesperson">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label>Author Designation</label>
                            <input type="text" name="author_designation" class="form-control" value="{{ old('author_designation', $content->author_designation) }}" placeholder="Managing Partner, Counsel, Associate">
                        </div>

                        <div class="col-md-4 mb-4">
                            <label>Team Role</label>
                            <input type="text" name="team_role" class="form-control" value="{{ old('team_role', $content->team_role) }}" placeholder="Dispute Resolution Lead">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label>Practice Area</label>
                            <input type="text" name="practice_area" class="form-control" value="{{ old('practice_area', $content->practice_area) }}" placeholder="Corporate Law, Arbitration, IP">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label>Experience (Years)</label>
                            <input type="number" name="experience_years" class="form-control" min="0" value="{{ old('experience_years', $content->experience_years) }}" placeholder="8">
                        </div>

                        <div class="col-md-6 mb-4">
                            <label>License / Enrollment Number</label>
                            <input type="text" name="license_number" class="form-control" value="{{ old('license_number', $content->license_number) }}" placeholder="Bar Council enrollment number">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label>Education</label>
                            <input type="text" name="education" class="form-control" value="{{ old('education', $content->education) }}" placeholder="LL.B, LL.M, Specialization, University">
                        </div>

                        <div class="col-md-4 mb-4">
                            <label>Consultation Fee</label>
                            <input type="number" step="0.01" min="0" name="consultation_fee" class="form-control" value="{{ old('consultation_fee', $content->consultation_fee) }}" placeholder="2500.00">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label>Currency</label>
                            <input type="text" name="currency" class="form-control" value="{{ old('currency', $content->currency) }}" placeholder="INR">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label>Schema Type</label>
                            <input type="text" name="schema_type" class="form-control" value="{{ old('schema_type', $content->schema_type) }}" placeholder="Article, LegalService, Person">
                        </div>

                        <div class="col-md-4 mb-4">
                            <label>Job Location</label>
                            <input type="text" name="job_location" class="form-control" value="{{ old('job_location', $content->job_location) }}" placeholder="New Delhi">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label>Job Type</label>
                            <input type="text" name="job_type" class="form-control" value="{{ old('job_type', $content->job_type) }}" placeholder="Full-time / Internship">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label>Salary Range</label>
                            <input type="text" name="salary_range" class="form-control" value="{{ old('salary_range', $content->salary_range) }}" placeholder="INR 8 LPA - INR 12 LPA">
                        </div>

                        <div class="col-md-6 mb-4">
                            <label>Application Deadline</label>
                            <input type="date" name="application_deadline" class="form-control" value="{{ old('application_deadline', optional($content->application_deadline)->format('Y-m-d')) }}">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label>Published At</label>
                            <input type="datetime-local" name="published_at" class="form-control" value="{{ old('published_at', optional($content->published_at)->format('Y-m-d\TH:i')) }}">
                        </div>

                        <div class="col-12">
                            <label>Quote / Pull Quote</label>
                            <textarea name="quote" rows="3" class="form-control" placeholder="Add a standout legal insight, leadership quote, or mission line">{{ old('quote', $content->quote) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 mb-4">
                <div class="card-header">
                    <h3 class="card-title mb-0">Contact, CTA & Visibility</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label>Contact Person</label>
                            <input type="text" name="contact_person" class="form-control" value="{{ old('contact_person', $content->contact_person) }}" placeholder="Recruitment Desk / Front Office / Partner">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label>Contact Email</label>
                            <input type="email" name="contact_email" class="form-control" value="{{ old('contact_email', $content->contact_email) }}" placeholder="contact@advocated.com">
                        </div>

                        <div class="col-md-4 mb-4">
                            <label>Contact Phone</label>
                            <input type="text" name="contact_phone" class="form-control" value="{{ old('contact_phone', $content->contact_phone) }}" placeholder="+91 98xxxxxx">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label>WhatsApp Number</label>
                            <input type="text" name="whatsapp_number" class="form-control" value="{{ old('whatsapp_number', $content->whatsapp_number) }}" placeholder="+91 98xxxxxx">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label>Opening Hours</label>
                            <input type="text" name="opening_hours" class="form-control" value="{{ old('opening_hours', $content->opening_hours) }}" placeholder="Mon-Sat, 10 AM - 7 PM">
                        </div>

                        <div class="col-md-6 mb-4">
                            <label>Office Location</label>
                            <input type="text" name="office_location" class="form-control" value="{{ old('office_location', $content->office_location) }}" placeholder="Supreme Court Wing, New Delhi">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label>Office Address</label>
                            <input type="text" name="office_address" class="form-control" value="{{ old('office_address', $content->office_address) }}" placeholder="Full office address">
                        </div>

                        <div class="col-md-6 mb-4">
                            <label>Map Embed URL</label>
                            <input type="url" name="map_embed_url" class="form-control" value="{{ old('map_embed_url', $content->map_embed_url) }}" placeholder="https://maps.google.com/...">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label>Video URL</label>
                            <input type="url" name="video_url" class="form-control" value="{{ old('video_url', $content->video_url) }}" placeholder="https://youtube.com/watch?v=...">
                        </div>

                        <div class="col-md-6 mb-4">
                            <label>Video Duration</label>
                            <input type="text" name="video_duration" class="form-control" value="{{ old('video_duration', $content->video_duration) }}" placeholder="08:35">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label>Primary CTA Text</label>
                            <input type="text" name="cta_text" class="form-control" value="{{ old('cta_text', $content->cta_text) }}" placeholder="Book a Consultation">
                        </div>

                        <div class="col-md-6 mb-4">
                            <label>Primary CTA Link</label>
                            <input type="url" name="cta_link" class="form-control" value="{{ old('cta_link', $content->cta_link) }}" placeholder="https://advocated.com/contact-us">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label>Secondary CTA Text</label>
                            <input type="text" name="secondary_cta_text" class="form-control" value="{{ old('secondary_cta_text', $content->secondary_cta_text) }}" placeholder="Download brochure">
                        </div>

                        <div class="col-md-6 mb-4">
                            <label>Secondary CTA Link</label>
                            <input type="url" name="secondary_cta_link" class="form-control" value="{{ old('secondary_cta_link', $content->secondary_cta_link) }}" placeholder="https://advocated.com/brochure.pdf">
                        </div>

                        <div class="col-md-6 mb-4">
                            <label>Social Links</label>
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <input type="url" name="linkedin_url" class="form-control" value="{{ old('linkedin_url', $socialLinks['linkedin'] ?? null) }}" placeholder="LinkedIn URL">
                                </div>
                                <div class="col-12 mb-2">
                                    <input type="url" name="facebook_url" class="form-control" value="{{ old('facebook_url', $socialLinks['facebook'] ?? null) }}" placeholder="Facebook URL">
                                </div>
                                <div class="col-12">
                                    <input type="url" name="twitter_url" class="form-control" value="{{ old('twitter_url', $socialLinks['twitter'] ?? null) }}" placeholder="Twitter / X URL">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="d-block">Additional Social</label>
                            <div class="row">
                                <div class="col-12 mb-2">
                                    <input type="url" name="instagram_url" class="form-control" value="{{ old('instagram_url', $socialLinks['instagram'] ?? null) }}" placeholder="Instagram URL">
                                </div>
                                <div class="col-12 mb-2">
                                    <input type="url" name="youtube_url" class="form-control" value="{{ old('youtube_url', $socialLinks['youtube'] ?? null) }}" placeholder="YouTube URL">
                                </div>
                                <div class="col-12">
                                    <textarea name="notes" rows="2" class="form-control" placeholder="Internal note for this record">{{ old('notes', $notes) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <input type="hidden" name="is_featured" value="0">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="is_featured" name="is_featured" value="1" @checked(old('is_featured', $content->is_featured))>
                                        <label class="custom-control-label" for="is_featured">Mark as featured</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <input type="hidden" name="show_on_homepage" value="0">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="show_on_homepage" name="show_on_homepage" value="1" @checked(old('show_on_homepage', $content->show_on_homepage))>
                                        <label class="custom-control-label" for="show_on_homepage">Show on homepage</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <input type="hidden" name="show_in_menu" value="0">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="show_in_menu" name="show_in_menu" value="1" @checked(old('show_in_menu', $content->show_in_menu))>
                                        <label class="custom-control-label" for="show_in_menu">Expose in menu</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 mb-4">
                <div class="card-header">
                    <h3 class="card-title mb-0">SEO & Search Signals</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label>Meta Title</label>
                            <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $content->meta_title) }}" placeholder="Optimized search title">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label>Canonical URL</label>
                            <input type="url" name="canonical_url" class="form-control" value="{{ old('canonical_url', $content->canonical_url) }}" placeholder="https://advocated.com/...">
                        </div>

                        <div class="col-12 mb-4">
                            <label>Meta Description</label>
                            <textarea name="meta_description" rows="4" class="form-control" placeholder="Search result description">{{ old('meta_description', $content->meta_description) }}</textarea>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label>Open Graph Title</label>
                            <input type="text" name="og_title" class="form-control" value="{{ old('og_title', $content->og_title) }}" placeholder="Social sharing title">
                        </div>
                        <div class="col-md-6 mb-4">
                            <label>Open Graph Image</label>
                            <input type="text" name="og_image" class="form-control" value="{{ old('og_image', $content->og_image) }}" placeholder="Image path or URL">
                        </div>

                        <div class="col-12 mb-4">
                            <label>Open Graph Description</label>
                            <textarea name="og_description" rows="4" class="form-control" placeholder="Social sharing description">{{ old('og_description', $content->og_description) }}</textarea>
                        </div>

                        <div class="col-12">
                            <label class="d-block mb-3">SEO Keywords</label>
                            <div class="adv-repeater" data-repeater="seo_keywords">
                                <div class="adv-repeater-items">
                                    @foreach($listDefaults(old('seo_keywords', $content->seo_keywords ?? [])) as $item)
                                        <div class="adv-repeater-row">
                                            <input type="text" name="seo_keywords[]" class="form-control" value="{{ $item }}" placeholder="legal advisory, litigation counsel, corporate law">
                                            <button type="button" class="btn btn-outline-danger btn-sm adv-remove-row">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-outline-light btn-sm adv-add-row mt-3">Add keyword</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card border-0 mb-4">
                <div class="card-header">
                    <h3 class="card-title mb-0">Structured Lists</h3>
                </div>
                <div class="card-body">
                    @foreach([
                        'highlights' => ['label' => 'Highlights', 'placeholder' => 'Strategic litigation planning'],
                        'key_points' => ['label' => 'Key Points', 'placeholder' => 'Client-first communication'],
                        'requirements' => ['label' => 'Requirements', 'placeholder' => '3+ years post-qualification'],
                        'responsibilities' => ['label' => 'Responsibilities', 'placeholder' => 'Attend court proceedings'],
                        'benefits' => ['label' => 'Benefits', 'placeholder' => 'Mentorship and growth track'],
                    ] as $field => $meta)
                        <div class="mb-4">
                            <label class="d-block mb-3">{{ $meta['label'] }}</label>
                            <div class="adv-repeater" data-repeater="{{ $field }}">
                                <div class="adv-repeater-items">
                                    @foreach($listDefaults(old($field, $content->{$field} ?? [])) as $item)
                                        <div class="adv-repeater-row">
                                            <input type="text" name="{{ $field }}[]" class="form-control" value="{{ $item }}" placeholder="{{ $meta['placeholder'] }}">
                                            <button type="button" class="btn btn-outline-danger btn-sm adv-remove-row">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-outline-light btn-sm adv-add-row mt-3">Add {{ strtolower($meta['label']) }}</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="card border-0 mb-4">
                <div class="card-header">
                    <h3 class="card-title mb-0">FAQs</h3>
                </div>
                <div class="card-body">
                    <div class="adv-faq-list">
                        @foreach($faqQuestions as $index => $question)
                            <div class="adv-faq-item">
                                <div class="form-group mb-3">
                                    <label class="small text-uppercase text-muted">Question</label>
                                    <input type="text" name="faqs[question][]" class="form-control" value="{{ $question }}" placeholder="What type of legal matters does Advocated handle?">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="small text-uppercase text-muted">Answer</label>
                                    <textarea name="faqs[answer][]" rows="3" class="form-control" placeholder="Answer the question clearly and professionally">{{ $faqAnswers[$index] ?? '' }}</textarea>
                                </div>
                                <button type="button" class="btn btn-outline-danger btn-sm adv-remove-faq">
                                    <i class="fas fa-trash mr-1"></i> Remove FAQ
                                </button>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" class="btn btn-outline-light btn-sm mt-3 adv-add-faq">
                        Add FAQ
                    </button>
                </div>
            </div>

            <div class="card border-0 mb-4">
                <div class="card-header">
                    <h3 class="card-title mb-0">Media Assets</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Featured Image</label>
                        <input type="file" name="featured_image" class="form-control p-2">
                        @if($content->featured_image)
                            <div class="mt-3">
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($content->featured_image) }}" class="img-fluid" style="border-radius: 18px; max-height: 180px; object-fit: cover;">
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Banner Image</label>
                        <input type="file" name="banner_image" class="form-control p-2">
                        @if($content->banner_image)
                            <div class="mt-3">
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($content->banner_image) }}" class="img-fluid" style="border-radius: 18px; max-height: 180px; object-fit: cover;">
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Thumbnail Image</label>
                        <input type="file" name="thumbnail_image" class="form-control p-2">
                        @if($content->thumbnail_image)
                            <div class="mt-3">
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($content->thumbnail_image) }}" class="img-fluid" style="border-radius: 18px; max-height: 180px; object-fit: cover;">
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label>Brochure / Attachment</label>
                        <input type="file" name="brochure_file" class="form-control p-2">
                        @if($content->brochure_file)
                            <div class="adv-file-preview mt-3">
                                <div>
                                    <small class="text-uppercase text-muted d-block mb-1">Current file</small>
                                    <a href="{{ \Illuminate\Support\Facades\Storage::url($content->brochure_file) }}" target="_blank" class="text-white">Open brochure</a>
                                </div>
                                <i class="fas fa-file-lines"></i>
                            </div>
                        @endif
                    </div>

                    <div class="form-group mb-0">
                        <label>Gallery Images</label>
                        <input type="file" name="gallery_uploads[]" class="form-control p-2" multiple>

                        @if(!empty($content->gallery_images))
                            <div class="row mt-3">
                                @foreach($content->gallery_images as $image)
                                    <div class="col-6 mb-3">
                                        <div class="adv-gallery-item">
                                            <img src="{{ \Illuminate\Support\Facades\Storage::url($image) }}" class="img-fluid">
                                            <label class="mt-2 small d-flex align-items-center">
                                                <input type="checkbox" name="remove_gallery_images[]" value="{{ $image }}" class="mr-2">
                                                Remove
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card border-0">
                <div class="card-body d-flex flex-column flex-sm-row justify-content-between align-items-sm-center">
                    <div class="mb-3 mb-sm-0">
                        <h4 class="mb-1">Ready to save?</h4>
                        <p class="text-muted mb-0">This record will be available inside the {{ $sectionMeta['label'] }} module.</p>
                    </div>

                    <button class="btn btn-primary">
                        <i class="fas fa-floppy-disk mr-1"></i> {{ $submitLabel }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

@push('styles')
    <style>
        .adv-repeater-row,
        .adv-faq-item,
        .adv-gallery-item{
            padding:0.9rem;
            border-radius:18px;
            background:rgba(255,255,255,0.03);
            border:1px solid rgba(148,163,184,0.12);
        }

        .adv-repeater-row{
            display:flex;
            align-items:center;
            gap:0.75rem;
        }

        .adv-repeater-row + .adv-repeater-row{
            margin-top:0.75rem;
        }

        .adv-repeater-row .form-control{
            flex:1;
        }

        .adv-faq-item + .adv-faq-item{
            margin-top:1rem;
        }

        .adv-gallery-item img{
            width:100%;
            height:120px;
            object-fit:cover;
            border-radius:14px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        (function () {
            const slugSource = document.querySelector('.adv-slug-source');
            const slugTarget = document.querySelector('.adv-slug-target');

            if (slugSource && slugTarget) {
                slugSource.addEventListener('input', function () {
                    if (slugTarget.dataset.editedManually === 'true') {
                        return;
                    }

                    slugTarget.value = this.value
                        .toLowerCase()
                        .trim()
                        .replace(/[^a-z0-9]+/g, '-')
                        .replace(/^-+|-+$/g, '');
                });

                slugTarget.addEventListener('input', function () {
                    this.dataset.editedManually = this.value.trim() !== '' ? 'true' : 'false';
                });
            }

            document.querySelectorAll('.adv-add-row').forEach(function (button) {
                button.addEventListener('click', function () {
                    const repeater = this.closest('.adv-repeater');
                    const items = repeater.querySelector('.adv-repeater-items');
                    const firstRow = items.querySelector('.adv-repeater-row');

                    if (!firstRow) {
                        return;
                    }

                    const clone = firstRow.cloneNode(true);
                    clone.querySelectorAll('input').forEach(function (input) {
                        input.value = '';
                    });

                    items.appendChild(clone);
                });
            });

            document.addEventListener('click', function (event) {
                if (event.target.closest('.adv-remove-row')) {
                    const row = event.target.closest('.adv-repeater-row');
                    const container = row.parentElement;

                    if (container.children.length > 1) {
                        row.remove();
                    } else {
                        row.querySelectorAll('input').forEach(function (input) {
                            input.value = '';
                        });
                    }
                }

                if (event.target.closest('.adv-add-faq')) {
                    const faqList = document.querySelector('.adv-faq-list');
                    const firstFaq = faqList.querySelector('.adv-faq-item');

                    if (!firstFaq) {
                        return;
                    }

                    const clone = firstFaq.cloneNode(true);
                    clone.querySelectorAll('input, textarea').forEach(function (input) {
                        input.value = '';
                    });

                    faqList.appendChild(clone);
                }

                if (event.target.closest('.adv-remove-faq')) {
                    const faqItem = event.target.closest('.adv-faq-item');
                    const faqList = faqItem.parentElement;

                    if (faqList.children.length > 1) {
                        faqItem.remove();
                    } else {
                        faqItem.querySelectorAll('input, textarea').forEach(function (input) {
                            input.value = '';
                        });
                    }
                }
            });
        })();
    </script>
@endpush
