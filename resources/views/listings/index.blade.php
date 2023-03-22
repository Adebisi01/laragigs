<x-layout>
    
@include('partials.__hero')
@include('partials.__search')
<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

    @if(count($listings) == 0)
    <p>NO Listing found</p>
    @endif
    @foreach($listings as $listing)
<x-listing-card :listing="$listing" />

    @endforeach
</div>
<div class="mt-10 p-4">{{$listings->links()}}</div>

</x-layout>