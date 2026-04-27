@extends('layouts.admin')

@section('title', 'Create Gallery Image')

@section('content')
    <div class="adv-page-shell">
        <div class="adv-shell-card adv-hero mb-4">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end">
                <div class="adv-hero-copy pr-lg-4">
                    <span class="adv-chip mb-3">
                        <i class="fas fa-images"></i>
                        Gallery Uploader
                    </span>
                    <h2 class="mb-3">Add a fresh visual to the Advocated gallery.</h2>
                    <p class="adv-hero-subtitle">This module is intentionally simple: upload the image, set sort order, and decide whether it should appear publicly.</p>
                </div>

                <a href="{{ route('admin.gallery-images.index') }}" class="btn btn-outline-light mt-3 mt-lg-0">
                    <i class="fas fa-arrow-left mr-1"></i> Back to Gallery
                </a>
            </div>
        </div>

        @include('admin.gallery-images.partials.form', [
            'action' => route('admin.gallery-images.store'),
            'method' => 'POST',
            'submitLabel' => 'Create Gallery Image',
        ])
    </div>
@endsection
