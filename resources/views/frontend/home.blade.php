@extends('frontend.layouts.app')

@section('title', 'Advocated | Premium Legal Experience')

@section('content')
    @include('frontend.partials.page-header', [
        'eyebrow' => 'MantaramLegal',
        'title' => $site['hero']['heading'],
        'description' => $site['hero']['subheading'],
        'metrics' => [
            ['label' => 'Published Services', 'value' => $stats['services']],
            ['label' => 'Legal Insights', 'value' => $stats['blogs']],
            ['label' => 'Team Profiles', 'value' => $stats['team']],
            ['label' => 'Open Careers', 'value' => $stats['careers']],
        ],
        'actions' => [
            ['label' => 'Explore Services', 'href' => route('services.index'), 'class' => 'btn-primary'],
            ['label' => 'Learn About Us', 'href' => route('about.story'), 'class' => 'btn-secondary'],
        ],
    ])

    <section class="section-block">
        <div class="grid grid-2">
            @foreach($site['hero']['highlights'] as $index => $highlight)
                <div class="feature-card">
                    <div class="feature-card__media {{ $index === 1 ? 'feature-card__media--warm' : '' }}"></div>
                    <h3>{{ $highlight['title'] }}</h3>
                    <p class="list-copy">{{ $highlight['description'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section class="section-block">
        <div class="content-shell">
            <div class="section-head">
                <div>
                    <span class="eyebrow">About The Chamber</span>
                    <h2 class="section-title">A people-first legal practice with a serious standard of preparation.</h2>
                    <p class="section-copy">
                        {{ $site['about']['intro'] }}
                    </p>
                </div>
                <a href="{{ route('about.story') }}" class="btn btn-soft">Learn More About Us</a>
            </div>

            <div class="grid grid-3">
                @foreach($site['values'] as $value)
                    <div class="timeline-item">
                        <h3>{{ $value['title'] }}</h3>
                        <p class="list-copy">{{ $value['description'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-block">
        <div class="section-head">
            <div>
                <span class="eyebrow">Our Expertise</span>
                <h2 class="section-title">Core practice areas presented in a client-friendly way.</h2>
                <p class="section-copy">Our chamber supports clients across litigation, advisory, compliance, and rights-based matters with a strong emphasis on preparation and honest guidance.</p>
            </div>
        </div>
        <div class="grid grid-3">
            @foreach($site['practice_areas'] as $practice)
                <div class="story-card">
                    <h3>{{ $practice['title'] }}</h3>
                    <p class="list-copy">{{ $practice['description'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section class="section-block">
        <div class="section-head">
            <div>
                <span class="eyebrow">Services</span>
                <h2 class="section-title">Featured Services</h2>
                <p class="section-copy">Browse some of the ways Advocated supports individuals, families, founders, and institutions through complex legal decisions.</p>
            </div>
            <a href="{{ route('services.index') }}" class="btn btn-soft">See all services</a>
        </div>
        <div class="grid grid-3">
            @foreach($featuredServices as $item)
                @include('frontend.partials.content-card', ['item' => $item, 'routeName' => 'services.show', 'buttonLabel' => 'View Service'])
            @endforeach
        </div>
    </section>

    <section class="section-block">
        <div class="grid grid-2">
            <div class="content-shell">
                <div class="section-head">
                    <div>
                        <span class="eyebrow">Journal</span>
                        <h2 class="section-title">Latest Blogs</h2>
                        <p class="section-copy">Timely insight on disputes, drafting, compliance, employment, and legal risk for modern decision-makers.</p>
                    </div>
                </div>
                <div class="grid">
                    @foreach($featuredBlogs as $item)
                        @include('frontend.partials.content-card', ['item' => $item, 'routeName' => 'blogs.show', 'buttonLabel' => 'Read Article'])
                    @endforeach
                </div>
            </div>

            <div class="content-shell">
                <div class="section-head">
                    <div>
                        <span class="eyebrow">Team</span>
                        <h2 class="section-title">Core Team</h2>
                        <p class="section-copy">Meet the advocates, researchers, and client-focused professionals who shape the chamber standard.</p>
                    </div>
                </div>
                <div class="grid">
                    @foreach($featuredTeam as $item)
                        @include('frontend.partials.content-card', ['item' => $item, 'routeName' => 'team.show', 'buttonLabel' => 'Meet Member'])
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="section-block">
        <div class="section-head">
            <div>
                <span class="eyebrow">Careers and Impact</span>
                <h2 class="section-title">Careers and Pro Bono</h2>
                <p class="section-copy">From hiring exceptional legal talent to supporting community-facing impact work, these pages reflect the broader life of the chamber.</p>
            </div>
        </div>
        <div class="grid grid-2">
            <div class="content-shell">
                <div class="grid">
                    @foreach($featuredCareers as $item)
                        @include('frontend.partials.content-card', ['item' => $item, 'routeName' => 'careers.show', 'buttonLabel' => 'Apply Now'])
                    @endforeach
                </div>
            </div>
            <div class="content-shell">
                <div class="grid">
                    @foreach($featuredProBono as $item)
                        @include('frontend.partials.content-card', ['item' => $item, 'routeName' => 'pro-bono.show', 'buttonLabel' => 'View Story'])
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="section-block">
        <div class="section-head">
            <div>
                <span class="eyebrow">Media and Moments</span>
                <h2 class="section-title">Videos and Gallery</h2>
                <p class="section-copy">Explore explainers, chamber moments, and visual highlights from the Advocated public-facing presence.</p>
            </div>
        </div>
        <div class="grid grid-2">
            <div class="content-shell">
                <div class="grid">
                    @foreach($featuredVideos as $item)
                        @include('frontend.partials.content-card', ['item' => $item, 'routeName' => 'videos.show', 'buttonLabel' => 'Watch Video'])
                    @endforeach
                </div>
            </div>
            <div class="gallery-grid">
                @foreach($galleryImages as $image)
                    <div class="gallery-card">
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($image->image_path) }}" alt="Advocated Gallery Image">
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-block">
        <div class="section-head">
            <div>
                <span class="eyebrow">What Clients Say</span>
                <h2 class="section-title">Trust is built through clarity, responsiveness, and preparation.</h2>
                <p class="section-copy">We aim to make every client interaction feel informed, steady, and genuinely supported from the first conversation onward.</p>
            </div>
            <a href="{{ route('contact.index') }}" class="btn btn-primary">Contact Us</a>
        </div>
        <div class="grid grid-3">
            @foreach($site['testimonials'] as $testimonial)
                <div class="testimonial-card">
                    <h3>{{ $testimonial['label'] }}</h3>
                    <p class="testimonial-quote">"{{ $testimonial['quote'] }}"</p>
                    <div class="testimonial-meta">{{ $testimonial['author'] }}</div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="section-block">
        <div class="content-shell">
            <div class="section-head">
                <div>
                    <span class="eyebrow">Ready To Consult</span>
                    <h2 class="section-title">Discuss your legal needs with a chamber that values precision and calm communication.</h2>
                    <p class="section-copy">{{ $site['contact']['copy'] }}</p>
                </div>
                <a href="{{ route('consult.index') }}" class="btn btn-secondary">Consult Here</a>
            </div>
        </div>
    </section>
@endsection
