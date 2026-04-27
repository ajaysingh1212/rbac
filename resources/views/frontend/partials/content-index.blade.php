@include('frontend.partials.page-header', [
    'eyebrow' => $sectionMeta['label'],
    'title' => $headline,
    'description' => $description,
    'metrics' => $metrics,
    'actions' => $actions ?? [],
])

<section class="section-block">
    <div class="section-head">
        <div>
            <h2 class="section-title">{{ $sectionMeta['label'] }} Collection</h2>
            <p class="section-copy">
                {{ $collectionCopy ?? 'Explore a thoughtfully presented collection of published updates, profiles, and resources from the Advocated chambers.' }}
            </p>
        </div>
    </div>

    @if($items->isNotEmpty())
        <div class="grid grid-2">
            @foreach($items as $item)
                @include('frontend.partials.content-card', [
                    'item' => $item,
                    'routeName' => $routeName,
                    'buttonLabel' => $buttonLabel ?? 'Explore More',
                ])
            @endforeach
        </div>
    @else
        <div class="empty-state">
            Fresh updates for this section will appear here soon. Please check back shortly or contact the Advocated team for direct assistance.
        </div>
    @endif
</section>
