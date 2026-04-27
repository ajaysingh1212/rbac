@php
    $headline = 'Meet the Advocated team behind the strategy, drafting, advocacy, and client trust.';
    $description = 'Our team combines legal depth, practical judgment, and responsive communication across every matter we handle.';
    $metrics = [
        ['label' => 'Profiles', 'value' => $items->count()],
        ['label' => 'Featured Leaders', 'value' => $items->where('is_featured', true)->count()],
        ['label' => 'Practice Areas', 'value' => $items->pluck('practice_area')->unique()->count()],
        ['label' => 'Client Access', 'value' => 'Open'],
    ];
    $actions = [
        ['label' => 'Book Consultation', 'href' => route('contact.index'), 'class' => 'btn-primary'],
        ['label' => 'View Services', 'href' => route('services.index'), 'class' => 'btn-secondary'],
    ];
    $routeName = 'team.show';
    $buttonLabel = 'Meet Member';
    $collectionCopy = 'Every profile highlights the people, experience, and focus areas that shape the Advocated standard of preparation and service.';
@endphp

@extends('frontend.layouts.app')

@section('title', $sectionMeta['label'].' | Advocated')

@section('content')
    @include('frontend.partials.content-index')
@endsection
