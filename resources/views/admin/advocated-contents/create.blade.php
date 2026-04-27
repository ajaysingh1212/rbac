@extends('layouts.admin')

@section('title', 'Create '.$sectionMeta['singular'])

@section('content')
    <div class="adv-page-shell">
        <div class="adv-shell-card adv-hero">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-start">
                <div class="adv-hero-copy pr-lg-4">
                    <span class="adv-chip mb-3">
                        <i class="{{ $sectionMeta['icon'] }}"></i>
                        {{ $sectionMeta['label'] }} Studio
                    </span>
                    <h2 class="mb-3">Create a polished {{ strtolower($sectionMeta['singular']) }} for Advocated.</h2>
                    <p class="adv-hero-subtitle">
                        Capture content, legal context, contact hooks, media, SEO, and structured highlights in one professional workflow.
                    </p>
                </div>

                <div class="mt-3 mt-lg-0">
                    <a href="{{ route('admin.advocated-content.index', ['section' => $section]) }}" class="btn btn-outline-light">
                        <i class="fas fa-arrow-left mr-1"></i> Back to {{ $sectionMeta['label'] }}
                    </a>
                </div>
            </div>
        </div>

        @include('admin.advocated-contents._form', [
            'formAction' => route('admin.advocated-content.store', ['section' => $section]),
            'formMethod' => 'POST',
            'submitLabel' => 'Create '.$sectionMeta['singular'],
        ])
    </div>
@endsection
