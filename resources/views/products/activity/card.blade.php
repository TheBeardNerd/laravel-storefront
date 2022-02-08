<div class="mb-12">
    <h3 class="mb-1 text-sm tracking-widest text-gray-500 uppercase title-font">Activity</h3>
    <hr class="mb-3">
    <ul class="text-sm tracking-wide list-reset">
        @foreach ($product->activity as $activity)
            <li>
                @include("products.activity.{$activity->description}")
                <span class="text-xs text-gray-400">— {{ $activity->created_at->diffForHumans(null, true) }}</span>
            </li>
        @endforeach
    </ul>
</div>
