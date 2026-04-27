@extends('frontend.layouts.app')

@section('title', 'Contact Us | Advocated')

@section('content')
    @include('frontend.partials.page-header', [
        'eyebrow' => 'Contact',
        'title' => $site['contact']['headline'],
        'description' => $site['contact']['copy'],
        'metrics' => [
            ['label' => 'Response Window', 'value' => 'Prompt'],
            ['label' => 'Service Links', 'value' => $featuredServices->count()],
            ['label' => 'Response Mode', 'value' => 'Email and Call'],
            ['label' => 'Availability', 'value' => 'Mon-Sat'],
        ],
        'actions' => [
            ['label' => 'Consult Here', 'href' => route('consult.index'), 'class' => 'btn-primary'],
        ],
    ])

    <section class="section-block">
        <div class="office-grid">
            <div class="contact-card">
                <span class="eyebrow">Visit Us</span>
                <h3>{{ $site['brand']['name'] }}</h3>
                <p>{{ $site['brand']['address'] }}</p>
                <p><strong>Phone:</strong> {{ $site['brand']['phone'] }}</p>
                <p><strong>Email:</strong> {{ $site['brand']['email'] }}</p>
                <p><strong>Hours:</strong> {{ $site['brand']['hours'] }}</p>
                <div class="hero-actions">
                    <a href="tel:{{ preg_replace('/\s+/', '', $site['brand']['phone']) }}" class="btn btn-primary">Call Now</a>
                    <a href="mailto:{{ $site['brand']['email'] }}" class="btn btn-soft">Email Us</a>
                </div>
            </div>

            <div class="content-shell">
                <span class="eyebrow">How Consultation Works</span>
                <h2 class="section-title">A clear path from first contact to legal action.</h2>
                <div class="step-list">
                    @foreach($site['contact']['consult_steps'] as $step)
                        <div class="step-item">
                            <div class="list-copy">{{ $step }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="section-block">
        <div class="section-head">
            <div>
                <h2 class="section-title">Popular Service Routes</h2>
                <p class="section-copy">If you already know the type of support you need, these service routes can help you reach the right legal desk more quickly.</p>
            </div>
        </div>
        <div class="grid grid-2">
            @foreach($featuredServices as $item)
                @include('frontend.partials.content-card', ['item' => $item, 'routeName' => 'services.show', 'buttonLabel' => 'View Service'])
            @endforeach
        </div>
    </section>
@endsection
