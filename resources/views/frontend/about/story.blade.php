@extends('frontend.layouts.app')

@section('title', 'Our Story | Advocated')

@section('content')
    @include('frontend.partials.page-header', [
        'eyebrow' => 'About Us',
        'title' => 'A legal chamber built around principled advocacy and dependable execution.',
        'description' => $site['about']['intro'],
        'metrics' => [
            ['label' => 'Founded', 'value' => $site['brand']['founded']],
            ['label' => 'Primary Base', 'value' => 'Patna'],
            ['label' => 'Core Promise', 'value' => 'Clarity'],
            ['label' => 'Approach', 'value' => 'Client-First'],
        ],
        'actions' => [
            ['label' => 'Meet The Team', 'href' => route('team.index'), 'class' => 'btn-primary'],
            ['label' => 'Consult Here', 'href' => route('consult.index'), 'class' => 'btn-secondary'],
        ],
    ])

    <section class="section-block">
        <div class="content-shell">
            <div class="section-head">
                <div>
                    <span class="eyebrow">Our Story</span>
                    <h2 class="section-title">A chamber built to combine legal rigor, responsive communication, and long-term client trust.</h2>
                    <p class="section-copy">Our story is grounded in the belief that legal representation should feel both highly capable and deeply understandable.</p>
                </div>
            </div>

            <div class="timeline">
                @foreach($site['about']['story_blocks'] as $block)
                    <div class="timeline-item">
                        <h3>{{ $block['title'] }}</h3>
                        <p class="list-copy">{{ $block['content'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-block">
        <div class="section-head">
            <div>
                <span class="eyebrow">Featured Team</span>
                <h2 class="section-title">The professionals shaping the Advocated standard.</h2>
                <p class="section-copy">These are some of the people clients rely on for disciplined preparation, strategic advice, and steady representation.</p>
            </div>
        </div>

        <div class="grid grid-2">
            @foreach($featuredTeam as $item)
                @include('frontend.partials.content-card', ['item' => $item, 'routeName' => 'team.show', 'buttonLabel' => 'View Profile'])
            @endforeach
        </div>
    </section>
@endsection
