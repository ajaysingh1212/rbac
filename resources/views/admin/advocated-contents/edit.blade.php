@extends('layouts.admin')

@section('title', 'Edit '.$sectionMeta['singular'])

@section('content')
    <div class="adv-page-shell">
        <div class="adv-shell-card adv-hero">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-start">
                <div class="adv-hero-copy pr-lg-4">
                    <span class="adv-chip mb-3">
                        <i class="{{ $sectionMeta['icon'] }}"></i>
                        {{ $sectionMeta['label'] }} Studio
                    </span>
                    <h2 class="mb-3">Refine "{{ $content->title }}" with complete Advocated details.</h2>
                    <p class="adv-hero-subtitle">
                        Update the content strategy, legal metadata, media assets, and structured sections without leaving this workspace.
                    </p>
                </div>

                <div class="mt-3 mt-lg-0 d-flex flex-wrap">
                    <a href="{{ route('admin.advocated-content.show', ['section' => $section, 'advocatedContent' => $content->id]) }}" class="btn btn-outline-light mr-2 mb-2">
                        <i class="fas fa-eye mr-1"></i> Preview
                    </a>
                    <a href="{{ route('admin.advocated-content.index', ['section' => $section]) }}" class="btn btn-outline-light mb-2">
                        <i class="fas fa-arrow-left mr-1"></i> Back
                    </a>
                </div>
            </div>
        </div>

        @include('admin.advocated-contents._form', [
            'formAction' => route('admin.advocated-content.update', ['section' => $section, 'advocatedContent' => $content->id]),
            'formMethod' => 'PUT',
            'submitLabel' => 'Update '.$sectionMeta['singular'],
        ])
    </div>
@endsection
