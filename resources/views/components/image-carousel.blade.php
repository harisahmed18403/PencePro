@props(['lick', 'checkbox' => false])
<div class="carousel carousel-center bg-neutral rounded-box max-w-md h-64 space-x-4 p-4">
    @foreach ($lick->images as $index => $lickImage)
        <div class="carousel-item flex-col h-full">
            <img src="{{ asset('storage/' . $lickImage->image_path) }}" class="h-full w-auto object-contain rounded" />
            @if ($checkbox)
                <div class="flex items-center mt-2 gap-4">
                    <label for="deleteImages" class="label">Delete</label>
                    <input type="checkbox" id="deleteImages" name="deleteImages[]" value="{{ $lickImage->id }}"
                        class="checkbox" />
                </div>
            @endif
        </div>
    @endforeach
</div>