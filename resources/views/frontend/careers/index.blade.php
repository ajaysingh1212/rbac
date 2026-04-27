@php
    $headline = 'Build your next chapter inside a chamber that values craft, ownership, and client care.';
    $description = 'Explore open roles for advocates, researchers, operators, and emerging professionals who want meaningful legal work.';
    $metrics = [
        ['label' => 'Open Jobs', 'value' => $items->count()],
        ['label' => 'Urgent Hiring', 'value' => $items->where('is_featured', true)->count()],
        ['label' => 'Cities', 'value' => $items->pluck('job_location')->unique()->count()],
        ['label' => 'Apply Flow', 'value' => 'Enabled'],
    ];
    $actions = [
        ['label' => 'See Contact Desk', 'href' => route('contact.index'), 'class' => 'btn-primary'],
        ['label' => 'Learn Our Story', 'href' => route('about.story'), 'class' => 'btn-secondary'],
    ];
    $routeName = 'careers.show';
    $buttonLabel = 'Open Role';
    $collectionCopy = 'We look for thoughtful professionals who combine legal discipline with communication, ownership, and a service mindset.';
@endphp

@extends('frontend.layouts.app')

@section('title', $sectionMeta['label'].' | Advocated')

@section('content')
@include('frontend.partials.content-index')
@endsection
