@php
    $headline = 'Video explainers that make legal complexity easier to absorb, discuss, and act on.';
    $description = 'Watch concise visual briefings built for clients and teams who prefer clear guidance in a fast format.';
    $metrics = [
        ['label' => 'Videos', 'value' => $items->count()],
        ['label' => 'Featured', 'value' => $items->where('is_featured', true)->count()],
        ['label' => 'Formats', 'value' => 'Explainer'],
        ['label' => 'Playable', 'value' => 'Yes'],
    ];
    $actions = [
        ['label' => 'Read Blogs', 'href' => route('blogs.index'), 'class' => 'btn-primary'],
        ['label' => 'Book Consultation', 'href' => route('consult.index'), 'class' => 'btn-secondary'],
    ];
    $routeName = 'videos.show';
    $buttonLabel = 'Watch Video';
    $collectionCopy = 'Each video is designed to translate legal complexity into a shorter, calmer, and more actionable viewing experience.';
@endphp

@extends('frontend.layouts.app')

@section('title', $sectionMeta['label'].' | Advocated')

@section('content')
    @include('frontend.partials.content-index')
@endsection
