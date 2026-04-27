@extends('layouts.admin')

@section('title', 'Gallery Images')

@section('content')
    <div class="adv-page-shell">
        <div class="adv-shell-card adv-hero mb-4">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end">
                <div class="adv-hero-copy pr-lg-4">
                    <span class="adv-chip mb-3">
                        <i class="fas fa-images"></i>
                        Gallery Visual Library
                    </span>
                    <h2 class="mb-3">Dedicated image-only gallery manager for Advocated.</h2>
                    <p class="adv-hero-subtitle">
                        Upload, reorder, and activate visual moments for the public gallery without mixing them into the other website content modules.
                    </p>
                </div>

                @can('gallery-create')
                    <a href="{{ route('admin.gallery-images.create') }}" class="btn btn-primary mt-3 mt-lg-0">
                        <i class="fas fa-plus mr-1"></i> Add Gallery Image
                    </a>
                @endcan
            </div>
        </div>

        <div class="card border-0">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">Gallery Collection</h3>
                <span class="adv-pill">{{ $images->total() }} images</span>
            </div>

            <div class="card-body">
                @if($images->count())
                    <div class="row">
                        @foreach($images as $image)
                            <div class="col-md-6 col-xl-4 mb-4">
                                <div class="adv-file-preview d-block">
                                    <img
                                        src="{{ \Illuminate\Support\Facades\Storage::url($image->image_path) }}"
                                        alt="Gallery Image"
                                        class="img-fluid mb-3"
                                        style="height: 240px; width: 100%; object-fit: cover; border-radius: 16px;"
                                    >

                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <div class="text-white font-weight-bold">Image #{{ $image->id }}</div>
                                            <div class="text-muted small">Sort order: {{ $image->sort_order }}</div>
                                        </div>

                                        <span class="badge {{ $image->is_active ? 'badge-success' : 'badge-secondary' }}">
                                            {{ $image->is_active ? 'Active' : 'Hidden' }}
                                        </span>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        @can('gallery-edit')
                                            <a href="{{ route('admin.gallery-images.edit', $image->id) }}" class="btn btn-sm btn-warning mr-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan

                                        @can('gallery-delete')
                                            <form action="{{ route('admin.gallery-images.destroy', $image->id) }}" method="POST" class="delete-gallery-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger deleteGalleryBtn">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if($images->hasPages())
                        <div class="mt-4">
                            {{ $images->links() }}
                        </div>
                    @endif
                @else
                    <div class="text-center py-5">
                        <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:74px;height:74px;border-radius:24px;background:rgba(255,255,255,0.05);">
                            <i class="fas fa-images fa-2x"></i>
                        </div>
                        <h4 class="mb-2">No gallery images uploaded yet.</h4>
                        <p class="text-muted mb-4">Create the visual story of Advocated with strong, professional imagery.</p>
                        @can('gallery-create')
                            <a href="{{ route('admin.gallery-images.create') }}" class="btn btn-primary">Upload first image</a>
                        @endcan
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).on('click', '.deleteGalleryBtn', function () {
            const form = $(this).closest('form');

            Swal.fire({
                title: 'Delete this image?',
                text: 'This gallery image will be removed permanently.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Delete image'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
