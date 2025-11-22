@props(['lick', 'checkbox' => false])
<div class="carousel carousel-center bg-neutral rounded-box w-auto h-64 space-x-4 p-4">
    @foreach ($lick->images as $lickImage)
        <div class="carousel-item relative h-full">
            <img src="{{ asset('storage/' . $lickImage->image_path) }}" class="h-full w-auto object-contain rounded" />

            @if ($checkbox)
                <label class="absolute top-2 right-2 bg-black/80 px-2 py-1 rounded text-white text-sm flex items-center gap-2">
                    Delete
                    <input type="checkbox" name="deleteImages[]" value="{{ $lickImage->id }}" class="checkbox checkbox-error" />
                </label>
            @endif
        </div>
    @endforeach
</div>