@extends('frontend.layouts.app')

@section('title', $career->title.' | Careers at Advocated')

@section('content')
    @include('frontend.partials.page-header', [
        'eyebrow' => 'Careers',
        'title' => $career->title,
        'description' => $career->summary ?: $career->excerpt ?: $career->tagline,
        'metrics' => [
            ['label' => 'Location', 'value' => $career->job_location ?: 'India'],
            ['label' => 'Job Type', 'value' => $career->job_type ?: 'Open'],
            ['label' => 'Deadline', 'value' => optional($career->application_deadline)->format('d M Y') ?: 'Open now'],
            ['label' => 'Salary', 'value' => $career->salary_range ?: 'Competitive'],
        ],
        'actions' => [
            ['label' => 'Back to Careers', 'href' => route('careers.index'), 'class' => 'btn-ghost'],
            ['label' => 'Jump to Apply', 'href' => '#apply-now', 'class' => 'btn-primary'],
        ],
    ])

    <section class="detail-shell">
        <div class="detail-card">
            @if($career->banner_image || $career->featured_image)
                <div class="detail-visual" style="margin-bottom:22px;">
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($career->banner_image ?: $career->featured_image) }}" alt="{{ $career->title }}">
                </div>
            @endif

            <h2 class="detail-title">{{ $career->tagline }}</h2>
            <p class="detail-copy">{{ $career->description }}</p>
            <div class="detail-rich">{{ $career->detailed_content }}</div>

            @foreach([
                'Requirements' => $career->requirements,
                'Responsibilities' => $career->responsibilities,
                'Benefits' => $career->benefits,
            ] as $label => $items)
                @if(!empty($items))
                    <div class="content-panel" style="padding:24px; margin-top:24px;">
                        <h3 class="listing-title">{{ $label }}</h3>
                        <ul class="bullet-list">
                            @foreach($items as $entry)
                                <li>{{ $entry }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            @endforeach
        </div>

        <aside class="detail-card" id="apply-now">
            <h3 class="listing-title">Apply for this Role</h3>
            <p class="detail-copy">Share your background below and the Advocated hiring team will review your application with care and confidentiality.</p>

            @if($errors->any())
                <div class="flash" style="background:rgba(185,49,49,0.08); border-color:rgba(185,49,49,0.15); color:#8f2b2b;">
                    Please review the application details below and correct the required fields.
                </div>
                <ul class="error-list">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form action="{{ route('careers.apply', $career->slug) }}" method="POST" enctype="multipart/form-data" style="margin-top:18px;">
                @csrf
                <div class="form-grid">
                    <div class="field-group">
                        <label class="field-label" for="full_name">Full Name</label>
                        <input id="full_name" type="text" name="full_name" class="field" value="{{ old('full_name') }}" placeholder="Your full name" required>
                    </div>
                    <div class="field-group">
                        <label class="field-label" for="email">Email Address</label>
                        <input id="email" type="email" name="email" class="field" value="{{ old('email') }}" placeholder="you@example.com" required>
                    </div>
                    <div class="field-group">
                        <label class="field-label" for="phone">Phone Number</label>
                        <input id="phone" type="text" name="phone" class="field" value="{{ old('phone') }}" placeholder="+91 ..." required>
                    </div>
                    <div class="field-group">
                        <label class="field-label" for="current_location">Current Location</label>
                        <input id="current_location" type="text" name="current_location" class="field" value="{{ old('current_location') }}" placeholder="City, State">
                    </div>
                    <div class="field-group">
                        <label class="field-label" for="years_experience">Years of Experience</label>
                        <input id="years_experience" type="number" name="years_experience" class="field" min="0" value="{{ old('years_experience') }}" placeholder="0">
                    </div>
                    <div class="field-group">
                        <label class="field-label" for="linkedin_url">LinkedIn Profile</label>
                        <input id="linkedin_url" type="url" name="linkedin_url" class="field" value="{{ old('linkedin_url') }}" placeholder="https://linkedin.com/in/...">
                    </div>
                    <div class="field-group" style="grid-column:1 / -1;">
                        <label class="field-label" for="resume">Resume</label>
                        <input id="resume" type="file" name="resume" class="field">
                        <div class="field-note">Accepted formats: PDF, DOC, DOCX up to 10 MB.</div>
                    </div>
                </div>

                <div class="field-group" style="margin-top:16px;">
                    <label class="field-label" for="cover_letter">Cover Letter</label>
                    <textarea id="cover_letter" name="cover_letter" class="textarea" placeholder="Share why this role fits your experience, strengths, and goals.">{{ old('cover_letter') }}</textarea>
                    <div class="inline-note">A thoughtful note on your fit, writing style, and legal interests is always helpful.</div>
                </div>

                <button class="btn btn-primary" style="margin-top:16px;">Submit Application</button>
            </form>
        </aside>
    </section>

    @if($relatedCareers->count())
        <section class="section-block">
            <div class="section-head">
                <div>
                    <h2 class="section-title">Other Open Roles</h2>
                    <p class="section-copy">More published career postings ready for application.</p>
                </div>
            </div>

            <div class="grid grid-3">
                @foreach($relatedCareers as $item)
                    @include('frontend.partials.content-card', ['item' => $item, 'routeName' => 'careers.show', 'buttonLabel' => 'View Role'])
                @endforeach
            </div>
        </section>
    @endif
@endsection
