@php
    $timelineLabel = $item->application_deadline ? 'Deadline' : 'Published';
    $timelineValue = $item->application_deadline?->format('d M Y')
        ?: ($item->published_at?->format('d M Y') ?: 'Live');

    if ($item->experience_years) {
        $focusLabel = 'Experience';
        $focusValue = $item->experience_years.' Years';
    } elseif ($item->job_type) {
        $focusLabel = 'Job Type';
        $focusValue = $item->job_type;
    } elseif ($item->video_duration) {
        $focusLabel = 'Duration';
        $focusValue = $item->video_duration;
    } elseif ($item->consultation_fee) {
        $focusLabel = 'Consultation';
        $focusValue = trim(($item->currency ?: 'INR').' '.number_format((float) $item->consultation_fee, 0));
    } elseif ($item->office_location || $item->job_location) {
        $focusLabel = 'Location';
        $focusValue = $item->office_location ?: $item->job_location;
    } else {
        $focusLabel = 'Reading Time';
        $focusValue = ($item->reading_time ?: 5).' mins';
    }
@endphp

@include('frontend.partials.page-header', [
    'eyebrow' => $sectionMeta['label'],
    'title' => $item->title,
    'description' => $item->summary ?: $item->excerpt ?: $item->tagline,
    'metrics' => [
        ['label' => 'Status', 'value' => $item->status_label],
        ['label' => 'Practice', 'value' => $item->practice_area ?: $sectionMeta['label']],
        ['label' => $timelineLabel, 'value' => $timelineValue],
        ['label' => $focusLabel, 'value' => $focusValue],
    ],
    'actions' => [
        ['label' => 'Back to '.$sectionMeta['label'], 'href' => route($indexRouteName), 'class' => 'btn-ghost'],
        ['label' => $item->cta_text ?: 'Contact Advocated', 'href' => $item->cta_link ?: route('contact.index'), 'class' => 'btn-primary'],
    ],
])

<section class="detail-shell">
    <div class="detail-card">
        @if($item->banner_image || $item->featured_image)
            <div class="detail-visual" style="margin-bottom:22px;">
                <img src="{{ \Illuminate\Support\Facades\Storage::url($item->banner_image ?: $item->featured_image) }}" alt="{{ $item->title }}">
            </div>
        @endif

        <h2 class="detail-title">{{ $item->tagline ?: $item->title }}</h2>
        <p class="detail-copy">{{ $item->description ?: $item->summary }}</p>

        @if($item->quote)
            <div class="content-panel" style="padding:24px; margin-top:24px;">
                <h3 class="listing-title">A Chamber Perspective</h3>
                <p class="detail-rich">"{{ $item->quote }}"</p>
            </div>
        @endif

        @if($item->detailed_content)
            <div class="detail-rich">{{ $item->detailed_content }}</div>
        @endif

        @if(!empty($item->key_points))
            <div class="content-panel" style="padding:24px; margin-top:24px;">
                <h3 class="listing-title">Key Takeaways</h3>
                <ul class="bullet-list">
                    @foreach($item->key_points as $point)
                        <li>{{ $point }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(!empty($item->faqs))
            <div class="content-panel" style="padding:24px; margin-top:24px;">
                <h3 class="listing-title">Frequently Asked Questions</h3>
                <ul class="bullet-list">
                    @foreach($item->faqs as $faq)
                        <li>
                            <strong>{{ $faq['question'] ?? 'Question' }}</strong>
                            <div style="margin-top:8px;">{{ $faq['answer'] ?? '' }}</div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <aside class="detail-card">
        <h3 class="listing-title">Quick Snapshot</h3>
        <ul class="bullet-list">
            @foreach(array_filter([
                'Lead: '.($item->author_name ?: $item->contact_person ?: 'Advocated Team'),
                'Role: '.($item->team_role ?: $item->author_designation ?: 'Client Advisory'),
                'Location: '.($item->office_location ?: $item->job_location ?: 'India'),
                'Email: '.($item->contact_email ?: config('advocated_site.brand.email')),
                'Phone: '.($item->contact_phone ?: config('advocated_site.brand.phone')),
            ]) as $line)
                <li>{{ $line }}</li>
            @endforeach
        </ul>

        @if(!empty($item->highlights))
            <div class="content-panel" style="padding:24px; margin-top:20px;">
                <h3 class="listing-title">Highlights</h3>
                <ul class="bullet-list">
                    @foreach($item->highlights as $highlight)
                        <li>{{ $highlight }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($item->secondary_cta_text && $item->secondary_cta_link)
            <div class="hero-actions" style="margin-top:20px;">
                <a href="{{ $item->secondary_cta_link }}" class="btn btn-soft">{{ $item->secondary_cta_text }}</a>
                <a href="{{ route('contact.index') }}" class="btn btn-secondary">Speak With Advocated</a>
            </div>
        @endif
    </aside>
</section>

@if($relatedItems->count())
    <section class="section-block">
        <div class="section-head">
            <div>
                <h2 class="section-title">Related {{ $sectionMeta['label'] }}</h2>
                <p class="section-copy">Continue exploring adjacent matters, ideas, and updates from the same Advocated desk.</p>
            </div>
        </div>

        <div class="grid grid-3">
            @foreach($relatedItems as $relatedItem)
                @include('frontend.partials.content-card', [
                    'item' => $relatedItem,
                    'routeName' => $showRouteName,
                    'buttonLabel' => 'View Detail',
                ])
            @endforeach
        </div>
    </section>
@endif
