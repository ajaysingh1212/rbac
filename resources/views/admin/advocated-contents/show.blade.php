@extends('layouts.admin')

@section('title', $content->title)

@section('content')
    @php
        $socialLinks = $content->social_links ?? [];
        $galleryImages = $content->gallery_images ?? [];
        $accent = $sectionMeta['accent'] ?? '#38bdf8';
    @endphp

    <div class="adv-page-shell">
        <div class="adv-shell-card adv-hero mb-4">
            <div class="d-flex flex-column flex-xl-row justify-content-between">
                <div class="adv-hero-copy pr-xl-4">
                    <span class="adv-chip mb-3" style="background: rgba(255,255,255,0.08); border-color: rgba(255,255,255,0.14);">
                        <i class="{{ $sectionMeta['icon'] }}"></i>
                        {{ $sectionMeta['label'] }}
                    </span>
                    <h2 class="mb-3">{{ $content->title }}</h2>
                    <p class="adv-hero-subtitle">
                        {{ $content->excerpt ?: $content->summary ?: $sectionMeta['description'] }}
                    </p>

                    <div class="d-flex flex-wrap mt-4">
                        <span class="adv-pill mr-2 mb-2"><i class="fas fa-signal"></i> {{ $content->status_label }}</span>
                        @if($content->is_featured)
                            <span class="adv-pill mr-2 mb-2"><i class="fas fa-star"></i> Featured</span>
                        @endif
                        @if($content->show_on_homepage)
                            <span class="adv-pill mr-2 mb-2"><i class="fas fa-house"></i> Homepage</span>
                        @endif
                        @if($content->show_in_menu)
                            <span class="adv-pill mr-2 mb-2"><i class="fas fa-bars"></i> Menu Item</span>
                        @endif
                    </div>
                </div>

                <div class="mt-3 mt-xl-0 d-flex flex-wrap align-content-start">
                    <a href="{{ route('admin.advocated-content.index', ['section' => $section]) }}" class="btn btn-outline-light mr-2 mb-2">
                        <i class="fas fa-arrow-left mr-1"></i> Back
                    </a>
                    @can($sectionMeta['permission_prefix'].'-edit')
                        <a href="{{ route('admin.advocated-content.edit', ['section' => $section, 'advocatedContent' => $content->id]) }}" class="btn btn-primary mb-2">
                            <i class="fas fa-pen mr-1"></i> Edit
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8">
                <div class="card border-0 mb-4">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Content Overview</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <small class="text-uppercase text-muted d-block mb-2">Tagline</small>
                                <div>{{ $content->tagline ?: 'Not provided' }}</div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <small class="text-uppercase text-muted d-block mb-2">Slug</small>
                                <div>{{ $content->slug }}</div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <small class="text-uppercase text-muted d-block mb-2">Practice Area</small>
                                <div>{{ $content->practice_area ?: 'Not provided' }}</div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <small class="text-uppercase text-muted d-block mb-2">Published At</small>
                                <div>{{ $content->published_at?->format('d M Y h:i A') ?: 'Not scheduled' }}</div>
                            </div>
                            <div class="col-12 mb-4">
                                <small class="text-uppercase text-muted d-block mb-2">Summary</small>
                                <div>{{ $content->summary ?: 'Not provided' }}</div>
                            </div>
                            <div class="col-12 mb-4">
                                <small class="text-uppercase text-muted d-block mb-2">Description</small>
                                <div style="white-space: pre-line;">{{ $content->description ?: 'Not provided' }}</div>
                            </div>
                            <div class="col-12">
                                <small class="text-uppercase text-muted d-block mb-2">Detailed Content</small>
                                <div style="white-space: pre-line;">{{ $content->detailed_content ?: 'Not provided' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 mb-4">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Structured Blocks</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach([
                                'Highlights' => $content->highlights,
                                'Key Points' => $content->key_points,
                                'Requirements' => $content->requirements,
                                'Responsibilities' => $content->responsibilities,
                                'Benefits' => $content->benefits,
                            ] as $heading => $items)
                                <div class="col-md-6 mb-4">
                                    <div class="adv-file-preview h-100 align-items-start flex-column">
                                        <small class="text-uppercase text-muted d-block">{{ $heading }}</small>
                                        @if(!empty($items))
                                            <ul class="adv-list-reset w-100 mt-2">
                                                @foreach($items as $item)
                                                    <li>
                                                        <span class="adv-pill" style="background: rgba(255,255,255,0.04);">{{ $item }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <span class="text-muted">No items added.</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-3">
                            <small class="text-uppercase text-muted d-block mb-3">FAQs</small>
                            @if(!empty($content->faqs))
                                @foreach($content->faqs as $faq)
                                    <div class="adv-file-preview mb-3 align-items-start flex-column">
                                        <strong class="text-white">{{ $faq['question'] ?? 'Question' }}</strong>
                                        <span class="text-muted mt-2">{{ $faq['answer'] ?? 'No answer added.' }}</span>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-muted">No FAQs added.</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card border-0 mb-4">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Quick Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="adv-file-preview mb-3">
                            <div>
                                <small class="text-uppercase text-muted d-block mb-1">Author / Contact</small>
                                <strong>{{ $content->author_name ?: $content->contact_person ?: 'Not provided' }}</strong>
                            </div>
                            <i class="fas fa-user-circle fa-lg" style="color: {{ $accent }}"></i>
                        </div>

                        <div class="adv-file-preview mb-3">
                            <div>
                                <small class="text-uppercase text-muted d-block mb-1">Phone / WhatsApp</small>
                                <strong>{{ $content->contact_phone ?: 'N/A' }}</strong>
                                <div class="text-muted small">{{ $content->whatsapp_number ?: 'WhatsApp not added' }}</div>
                            </div>
                            <i class="fas fa-phone-volume fa-lg" style="color: {{ $accent }}"></i>
                        </div>

                        <div class="adv-file-preview mb-3">
                            <div>
                                <small class="text-uppercase text-muted d-block mb-1">Email</small>
                                <strong>{{ $content->contact_email ?: 'Not provided' }}</strong>
                            </div>
                            <i class="fas fa-envelope fa-lg" style="color: {{ $accent }}"></i>
                        </div>

                        <div class="adv-file-preview mb-3">
                            <div>
                                <small class="text-uppercase text-muted d-block mb-1">Office</small>
                                <strong>{{ $content->office_location ?: 'Not provided' }}</strong>
                                <div class="text-muted small">{{ $content->office_address ?: 'Address missing' }}</div>
                            </div>
                            <i class="fas fa-location-dot fa-lg" style="color: {{ $accent }}"></i>
                        </div>

                        @if(!empty($socialLinks))
                            <div class="mt-4">
                                <small class="text-uppercase text-muted d-block mb-2">Social Links</small>
                                <div class="d-flex flex-wrap">
                                    @foreach($socialLinks as $platform => $link)
                                        <a href="{{ $link }}" target="_blank" class="adv-pill mr-2 mb-2">
                                            <i class="fab fa-{{ $platform }}"></i> {{ ucfirst($platform) }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card border-0 mb-4">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Media & SEO</h3>
                    </div>
                    <div class="card-body">
                        @foreach([
                            'Featured Image' => $content->featured_image,
                            'Banner Image' => $content->banner_image,
                            'Thumbnail Image' => $content->thumbnail_image,
                            'Brochure' => $content->brochure_file,
                        ] as $label => $path)
                            <div class="adv-file-preview mb-3">
                                <div>
                                    <small class="text-uppercase text-muted d-block mb-1">{{ $label }}</small>
                                    @if($path)
                                        <a href="{{ \Illuminate\Support\Facades\Storage::url($path) }}" target="_blank" class="text-white">
                                            View asset
                                        </a>
                                    @else
                                        <span class="text-muted">Not uploaded</span>
                                    @endif
                                </div>
                                <i class="fas fa-link fa-lg" style="color: {{ $accent }}"></i>
                            </div>
                        @endforeach

                        <div class="mt-4">
                            <small class="text-uppercase text-muted d-block mb-2">SEO Keywords</small>
                            @if(!empty($content->seo_keywords))
                                <div class="d-flex flex-wrap">
                                    @foreach($content->seo_keywords as $keyword)
                                        <span class="adv-pill mr-2 mb-2">{{ $keyword }}</span>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-muted">No keywords added.</div>
                            @endif
                        </div>
                    </div>
                </div>

                @if(!empty($galleryImages))
                    <div class="card border-0">
                        <div class="card-header">
                            <h3 class="card-title mb-0">Gallery</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($galleryImages as $image)
                                    <div class="col-6 mb-3">
                                        <a href="{{ \Illuminate\Support\Facades\Storage::url($image) }}" target="_blank">
                                            <img
                                                src="{{ \Illuminate\Support\Facades\Storage::url($image) }}"
                                                alt="Gallery image"
                                                class="img-fluid"
                                                style="border-radius: 18px; height: 150px; width: 100%; object-fit: cover;"
                                            >
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
