@php
    $headline = 'Legal services shaped for complex decisions, strong preparation, and confident next steps.';
    $description = 'Explore the Advocated service portfolio across litigation, advisory, documentation, compliance, and sensitive client matters.';
    $metrics = [
        ['label' => 'Practice Desks', 'value' => $items->count()],
        ['label' => 'Featured', 'value' => $items->where('is_featured', true)->count()],
        ['label' => 'Consult Windows', 'value' => 'Open'],
        ['label' => 'Response Style', 'value' => 'Partner-Led'],
    ];
    $actions = [
        ['label' => 'Contact Advocated', 'href' => route('contact.index'), 'class' => 'btn-primary'],
        ['label' => 'Meet the Team', 'href' => route('team.index'), 'class' => 'btn-secondary'],
    ];
    $routeName = 'services.show';
    $buttonLabel = 'View Service';
    $collectionCopy = 'Each service page is designed to explain the chamber approach, the likely risk landscape, and the most useful next step for the client.';
@endphp

@extends('frontend.layouts.app')

@section('title', $sectionMeta['label'].' | Advocated')

@section('content')
    @include('frontend.partials.content-index')
@endsection
