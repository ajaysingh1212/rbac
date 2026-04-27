<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <div class="row">
        <div class="col-xl-8">
            <div class="card border-0">
                <div class="card-header">
                    <h3 class="card-title mb-0">Image Settings</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 mb-4">
                            <label>Gallery Image</label>
                            <input type="file" name="image" class="form-control p-2" {{ $method === 'POST' ? 'required' : '' }}>
                            <small class="text-muted d-block mt-2">Use a clean, high-quality visual that matches the Advocated brand tone.</small>
                        </div>

                        <div class="col-md-4 mb-4">
                            <label>Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" min="0" value="{{ old('sort_order', $image->sort_order ?? 0) }}">
                        </div>

                        <div class="col-12 mb-4">
                            <input type="hidden" name="is_active" value="0">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" @checked(old('is_active', $image->is_active ?? true))>
                                <label class="custom-control-label" for="is_active">Show this image on the public gallery page</label>
                            </div>
                        </div>

                        @if(!empty($image->image_path))
                            <div class="col-12">
                                <label>Current Preview</label>
                                <img
                                    src="{{ \Illuminate\Support\Facades\Storage::url($image->image_path) }}"
                                    alt="Current Gallery Image"
                                    class="img-fluid"
                                    style="max-height: 340px; width: 100%; object-fit: cover; border-radius: 18px;"
                                >
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card border-0">
                <div class="card-body d-flex flex-column justify-content-between h-100">
                    <div>
                        <h4 class="mb-2">Keep the gallery sharp</h4>
                        <p class="text-muted">
                            This gallery module is image-first by design, so it stays fast and easy for the content team.
                        </p>
                    </div>

                    <button class="btn btn-primary mt-3">
                        <i class="fas fa-floppy-disk mr-1"></i> {{ $submitLabel }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
