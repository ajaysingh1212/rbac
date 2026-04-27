<section class="hero-panel">
    <div class="hero-grid">
        <div>
            <span class="eyebrow">{{ $eyebrow }}</span>
            <h1 class="hero-title">{{ $title }}</h1>
            <p class="hero-copy">{{ $description }}</p>

            @if(!empty($actions))
                <div class="hero-actions">
                    @foreach($actions as $action)
                        <a href="{{ $action['href'] }}" class="btn {{ $action['class'] ?? 'btn-primary' }}">{{ $action['label'] }}</a>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="hero-metrics">
            @foreach($metrics as $metric)
                <div class="metric-card">
                    <span>{{ $metric['label'] }}</span>
                    <strong>{{ $metric['value'] }}</strong>
                </div>
            @endforeach
        </div>
    </div>
</section>
