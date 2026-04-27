@extends('frontend.layouts.app')

@section('title', 'Gallery | Advocated')

@section('content')
    @include('frontend.partials.page-header', [
        'eyebrow' => 'Gallery',
        'title' => 'A visual glimpse into the chamber, its people, and the moments that shape its public presence.',
        'description' => 'Browse a curated gallery of chamber highlights, team moments, and professional snapshots presented in a clean editorial grid.',
        'metrics' => [
            ['label' => 'Images', 'value' => $images->count()],
            ['label' => 'Format', 'value' => 'Image First'],
            ['label' => 'Mood', 'value' => 'Editorial'],
            ['label' => 'Status', 'value' => 'Updated'],
        ],
        'actions' => [
            ['label' => 'Contact Advocated', 'href' => route('contact.index'), 'class' => 'btn-primary'],
        ],
    ])

    <section class="section-block">
        @if($images->isNotEmpty())
            <div class="gallery-grid">
                @foreach($images as $image)
                    <div class="gallery-card">
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($image->image_path) }}" alt="Advocated Gallery Image {{ $loop->iteration }}">
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                Gallery moments will appear here soon. Please check back shortly for fresh chamber imagery.
            </div>
        @endif
    </section>
@endsection
