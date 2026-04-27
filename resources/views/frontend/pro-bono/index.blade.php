@php
    $headline = 'Purpose-led legal work that widens access, dignity, and meaningful community support.';
    $description = 'Read about initiatives through which the chamber contributes time, strategy, and legal effort beyond commercial mandates.';
    $metrics = [
        ['label' => 'Impact Stories', 'value' => $items->count()],
        ['label' => 'Featured', 'value' => $items->where('is_featured', true)->count()],
        ['label' => 'Community Themes', 'value' => $items->pluck('practice_area')->filter()->unique()->count()],
        ['label' => 'Purpose-led', 'value' => 'Yes'],
    ];
    $actions = [
        ['label' => 'Partner With Advocated', 'href' => route('contact.index'), 'class' => 'btn-primary'],
        ['label' => 'Meet the Team', 'href' => route('team.index'), 'class' => 'btn-secondary'],
    ];
    $routeName = 'pro-bono.show';
    $buttonLabel = 'View Story';
    $collectionCopy = 'These stories reflect how legal skill, empathy, and public-minded action can work together in real settings.';
@endphp

@extends('frontend.layouts.app')

@section('title', $sectionMeta['label'].' | Advocated')

@section('content')
    @include('frontend.partials.content-index')
@endsection
