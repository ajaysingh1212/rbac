@extends('layouts.admin')

@section('title', $sectionMeta['label'].' Management')

@section('content')
    <div class="adv-page-shell">
        <div class="adv-shell-card adv-hero mb-4">
            <div class="d-flex flex-column flex-xl-row justify-content-between align-items-xl-end">
                <div class="adv-hero-copy pr-xl-4">
                    <span class="adv-chip mb-3" style="background: rgba(255,255,255,0.08); border-color: rgba(255,255,255,0.14);">
                        <i class="{{ $sectionMeta['icon'] }}"></i>
                        Advocated {{ $sectionMeta['label'] }}
                    </span>
                    <h2 class="mb-3">{{ $sectionMeta['label'] }} content workspace</h2>
                    <p class="adv-hero-subtitle">{{ $sectionMeta['description'] }}</p>
                </div>

                @can($sectionMeta['permission_prefix'].'-create')
                    <a href="{{ route('admin.advocated-content.create', ['section' => $section]) }}" class="btn btn-primary mt-3 mt-xl-0">
                        <i class="fas fa-plus mr-1"></i> Add {{ $sectionMeta['singular'] }}
                    </a>
                @endcan
            </div>

            <div class="row mt-4">
                <div class="col-md-6 col-xl-3 mb-3">
                    <div class="adv-metric">
                        <small>Total Records</small>
                        <strong>{{ $stats['total'] }}</strong>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-3">
                    <div class="adv-metric">
                        <small>Published</small>
                        <strong>{{ $stats['published'] }}</strong>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-3">
                    <div class="adv-metric">
                        <small>Featured</small>
                        <strong>{{ $stats['featured'] }}</strong>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 mb-3">
                    <div class="adv-metric">
                        <small>Homepage Ready</small>
                        <strong>{{ $stats['homepage'] }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <form method="GET" class="row">
                    <div class="col-lg-4 mb-3">
                        <label>Search</label>
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            value="{{ request('search') }}"
                            placeholder="Search by title, slug, author, or contact person"
                        >
                    </div>

                    <div class="col-lg-3 mb-3">
                        <label>Status</label>
                        <select name="status" class="custom-select">
                            <option value="">All statuses</option>
                            @foreach($statuses as $statusKey => $statusLabel)
                                <option value="{{ $statusKey }}" @selected(request('status') === $statusKey)>
                                    {{ $statusLabel }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-3 mb-3">
                        <label>Featured</label>
                        <select name="featured" class="custom-select">
                            <option value="">Any</option>
                            <option value="1" @selected(request('featured') === '1')>Featured only</option>
                            <option value="0" @selected(request('featured') === '0')>Non-featured only</option>
                        </select>
                    </div>

                    <div class="col-lg-2 mb-3 d-flex align-items-end">
                        <button class="btn btn-primary btn-block">
                            <i class="fas fa-filter mr-1"></i> Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">
                    <i class="{{ $sectionMeta['icon'] }} mr-2"></i>{{ $sectionMeta['label'] }} Library
                </h3>
                <span class="adv-pill">{{ $contents->total() }} records</span>
            </div>

            <div class="card-body p-0">
                @if($contents->count())
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th style="min-width: 260px;">Title</th>
                                    <th>Status</th>
                                    <th>Visibility</th>
                                    <th>Owner</th>
                                    <th>Updated</th>
                                    <th class="text-right" width="220">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contents as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-start">
                                                <div
                                                    class="mr-3 d-flex align-items-center justify-content-center"
                                                    style="width:44px;height:44px;border-radius:14px;background:rgba(255,255,255,0.06);"
                                                >
                                                    <i class="{{ $sectionMeta['icon'] }}"></i>
                                                </div>
                                                <div>
                                                    <div class="font-weight-bold text-white">{{ $item->title }}</div>
                                                    <div class="text-muted small">{{ $item->slug }}</div>
                                                    @if($item->tagline)
                                                        <div class="small mt-1 text-light">{{ \Illuminate\Support\Str::limit($item->tagline, 65) }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge {{ $item->status === 'published' ? 'badge-success' : ($item->status === 'archived' ? 'badge-secondary' : 'badge-warning') }}">
                                                {{ $item->status_label }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-wrap">
                                                @if($item->is_featured)
                                                    <span class="adv-pill mr-2 mb-2"><i class="fas fa-star"></i> Featured</span>
                                                @endif
                                                @if($item->show_on_homepage)
                                                    <span class="adv-pill mr-2 mb-2"><i class="fas fa-house"></i> Homepage</span>
                                                @endif
                                                @if($item->show_in_menu)
                                                    <span class="adv-pill mb-2"><i class="fas fa-bars"></i> Menu</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="small text-white">{{ $item->author_name ?: $item->contact_person ?: optional($item->creator)->name ?: 'Not assigned' }}</div>
                                            <div class="text-muted small">{{ optional($item->updater)->name ?: 'No updater yet' }}</div>
                                        </td>
                                        <td>
                                            <div class="small text-white">{{ $item->updated_at?->format('d M Y') }}</div>
                                            <div class="text-muted small">{{ $item->updated_at?->format('h:i A') }}</div>
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ route('admin.advocated-content.show', ['section' => $section, 'advocatedContent' => $item->id]) }}" class="btn btn-sm btn-info mb-1">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            @can($sectionMeta['permission_prefix'].'-edit')
                                                <a href="{{ route('admin.advocated-content.edit', ['section' => $section, 'advocatedContent' => $item->id]) }}" class="btn btn-sm btn-warning mb-1">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endcan

                                            @can($sectionMeta['permission_prefix'].'-delete')
                                                <form action="{{ route('admin.advocated-content.destroy', ['section' => $section, 'advocatedContent' => $item->id]) }}" method="POST" class="d-inline-block delete-content-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-sm btn-danger mb-1 deleteContentBtn">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-5 text-center">
                        <div class="mx-auto mb-3 d-flex align-items-center justify-content-center" style="width:74px;height:74px;border-radius:24px;background:rgba(255,255,255,0.05);">
                            <i class="{{ $sectionMeta['icon'] }} fa-2x"></i>
                        </div>
                        <h4 class="mb-2">No {{ strtolower($sectionMeta['label']) }} records yet.</h4>
                        <p class="text-muted mb-4">Start building this website section with structured data, visuals, and SEO details.</p>
                        @can($sectionMeta['permission_prefix'].'-create')
                            <a href="{{ route('admin.advocated-content.create', ['section' => $section]) }}" class="btn btn-primary">
                                <i class="fas fa-plus mr-1"></i> Create first {{ strtolower($sectionMeta['singular']) }}
                            </a>
                        @endcan
                    </div>
                @endif
            </div>

            @if($contents->hasPages())
                <div class="card-footer bg-transparent">
                    {{ $contents->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).on('click', '.deleteContentBtn', function () {
            let form = $(this).closest('form');

            Swal.fire({
                title: 'Delete this record?',
                text: 'The selected Advocated content record will be removed permanently.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Yes, delete it'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
