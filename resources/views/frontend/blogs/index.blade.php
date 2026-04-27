@php
    $headline = 'Readable legal insight for founders, operators, families, and serious decision-makers.';
    $description = 'Explore concise legal commentary and practical explainers written to make important decisions clearer.';
    $metrics = [
        ['label' => 'Articles', 'value' => $items->count()],
        ['label' => 'Trending Reads', 'value' => $items->where('is_featured', true)->count()],
        ['label' => 'Authors', 'value' => $items->pluck('author_name')->filter()->unique()->count()],
        ['label' => 'Tone', 'value' => 'Practical'],
    ];
    $actions = [
        ['label' => 'Explore Services', 'href' => route('services.index'), 'class' => 'btn-primary'],
        ['label' => 'Consult Here', 'href' => route('consult.index'), 'class' => 'btn-secondary'],
    ];
    $routeName = 'blogs.show';
    $buttonLabel = 'Read Article';
    $collectionCopy = 'These articles are written to help readers understand risk, timing, documentation, and decision-making with far less noise.';
@endphp

@extends('frontend.layouts.app')

@section('title', $sectionMeta['label'].' | Advocated')

@section('content')
    @include('frontend.partials.content-index')
@endsection
