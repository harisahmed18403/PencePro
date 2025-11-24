@props(['lick', 'checkbox' => false])

<div class="carousel carousel-center bg-neutral rounded-box w-auto h-64 space-x-4 p-4" x-data="{
        imgs: [
            @foreach ($lick->images as $img)
                '{{ asset('storage/' . $img->image_path) }}',
            @endforeach
        ]
     }">

    @foreach ($lick->images as $i => $lickImage)
        <div class="carousel-item relative h-full">
            <img src="{{ asset('storage/' . $lickImage->image_path) }}"
                class="h-full w-auto object-contain rounded cursor-pointer"
                x-on:click="$dispatch('open-fullscreen', { images: imgs, index: {{ $i }} })">

            @if ($checkbox)
                <label class="absolute top-2 right-2 bg-black/80 px-2 py-1 rounded text-white text-sm flex items-center gap-2">
                    Delete
                    <input type="checkbox" name="deleteImages[]" value="{{ $lickImage->id }}" class="checkbox checkbox-error" />
                </label>
            @endif
        </div>
    @endforeach
</div>