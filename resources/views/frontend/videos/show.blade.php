@extends('frontend.layouts.app')

@section('title', $item->title.' | Advocated Videos')

@section('content')
    @include('frontend.partials.page-header', [
        'eyebrow' => 'Videos',
        'title' => $item->title,
        'description' => $item->summary ?: $item->excerpt ?: $item->tagline,
        'metrics' => [
            ['label' => 'Duration', 'value' => $item->video_duration ?: 'Short'],
            ['label' => 'Category', 'value' => $item->practice_area ?: 'Legal Brief'],
            ['label' => 'Published', 'value' => $item->published_at?->format('d M Y') ?: 'Live'],
            ['label' => 'Format', 'value' => 'Video'],
        ],
        'actions' => [
            ['label' => 'Back to Videos', 'href' => route('videos.index'), 'class' => 'btn-ghost'],
            ['label' => $item->cta_text ?: 'Contact Advocated', 'href' => $item->cta_link ?: route('contact.index'), 'class' => 'btn-primary'],
        ],
    ])

    <section class="detail-shell">
        <div class="detail-card">
            <div class="detail-visual" style="margin-bottom:22px; min-height: 420px;">
                <iframe
                    src="{{ $item->video_url }}"
                    title="{{ $item->title }}"
                    class="video-frame"
                    allowfullscreen
                ></iframe>
            </div>

            <h2 class="detail-title">{{ $item->tagline ?: $item->title }}</h2>
            <p class="detail-copy">{{ $item->description }}</p>
            <div class="detail-rich">{{ $item->detailed_content }}</div>
        </div>

        <aside class="detail-card">
            <h3 class="listing-title">Video Snapshot</h3>
            <ul class="bullet-list">
                <li>Host: {{ $item->author_name ?: 'Advocated Media Desk' }}</li>
                <li>Duration: {{ $item->video_duration ?: 'Short form' }}</li>
                <li>CTA: {{ $item->cta_text ?: 'Contact Advocated' }}</li>
                <li>Published on: {{ $item->published_at?->format('d M Y') ?: 'Live' }}</li>
            </ul>

            @if(!empty($item->key_points))
                <div class="content-panel" style="padding:24px; margin-top:20px;">
                    <h3 class="listing-title">Key Takeaways</h3>
                    <ul class="bullet-list">
                        @foreach($item->key_points as $point)
                            <li>{{ $point }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </aside>
    </section>

    @if($relatedItems->count())
        <section class="section-block">
            <div class="section-head">
                <div>
                    <h2 class="section-title">More Videos</h2>
                    <p class="section-copy">Keep exploring the Advocated video library.</p>
                </div>
            </div>
            <div class="grid grid-3">
                @foreach($relatedItems as $relatedItem)
                    @include('frontend.partials.content-card', ['item' => $relatedItem, 'routeName' => 'videos.show', 'buttonLabel' => 'Watch Video'])
                @endforeach
            </div>
        </section>
    @endif
@endsection
