@props(['lick'])
<div class="carousel carousel-center bg-neutral rounded-box max-w-md space-x-4 p-4">
    @foreach ($lick->images as $index => $lickImage)
        <div class="carousel-item h-full w-auto">
            <img src="{{ asset('storage/' . $lickImage->image_path) }}" class="w-auto h-auto object-cover rounded" />
        </div>
    @endforeach
</div>