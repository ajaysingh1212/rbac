@extends('layouts.admin')

@section('title', 'Edit Gallery Image')

@section('content')
    <div class="adv-page-shell">
        <div class="adv-shell-card adv-hero mb-4">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end">
                <div class="adv-hero-copy pr-lg-4">
                    <span class="adv-chip mb-3">
                        <i class="fas fa-images"></i>
                        Gallery Uploader
                    </span>
                    <h2 class="mb-3">Update image #{{ $image->id }} for the public gallery.</h2>
                    <p class="adv-hero-subtitle">Swap the asset, adjust sort order, or hide the image while keeping the record ready for later use.</p>
                </div>

                <a href="{{ route('admin.gallery-images.index') }}" class="btn btn-outline-light mt-3 mt-lg-0">
                    <i class="fas fa-arrow-left mr-1"></i> Back to Gallery
                </a>
            </div>
        </div>

        @include('admin.gallery-images.partials.form', [
            'action' => route('admin.gallery-images.update', $image->id),
            'method' => 'PUT',
            'submitLabel' => 'Update Gallery Image',
        ])
    </div>
@endsection
