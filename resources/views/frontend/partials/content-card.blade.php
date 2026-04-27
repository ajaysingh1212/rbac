@php
    $image = $item->featured_image ? \Illuminate\Support\Facades\Storage::url($item->featured_image) : null;
    $metaPrimary = $item->author_name ?: $item->team_role ?: $item->contact_person ?: $item->job_location ?: $item->office_location ?: 'Advocated';
    $metaSecondary = $item->application_deadline?->format('d M Y')
        ?: $item->published_at?->format('d M Y')
        ?: $item->job_type
        ?: 'By appointment';
    $copy = $item->excerpt ?: $item->summary ?: $item->tagline ?: $item->description;
@endphp

<article class="listing-card">
    <div class="listing-media">
        @if($image)
            <img src="{{ $image }}" alt="{{ $item->title }}">
        @else
            <div class="listing-media__fallback">
                <span>{{ $item->badge_text ?: ($item->section_details['singular'] ?? 'Advocated') }}</span>
                <strong>{{ $item->title }}</strong>
            </div>
        @endif
    </div>

    <div class="listing-body">
        <div class="tag-row">
            @if($item->badge_text)
                <span class="tag">{{ $item->badge_text }}</span>
            @endif
            @if($item->practice_area)
                <span class="tag">{{ $item->practice_area }}</span>
            @endif
            @if($item->job_type)
                <span class="tag">{{ $item->job_type }}</span>
            @endif
        </div>

        <h3 class="listing-title">{{ $item->title }}</h3>
        <p class="listing-copy">{{ \Illuminate\Support\Str::limit($copy, 170) }}</p>

        <div class="listing-meta">
            <span>{{ $metaPrimary }}</span>
            <span>{{ $metaSecondary }}</span>
        </div>

        <a class="btn btn-ghost" href="{{ route($routeName, $item->slug) }}">{{ $buttonLabel ?? 'Explore More' }}</a>
    </div>
</article>
