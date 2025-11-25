<div class="form-control gap-2">
    <label for="{{ $id }}" class="label">
        <span class="label-text">{{ ucfirst($label) }}:</span>
    </label>
    <input type="{{ $type }}" class="{{ $class }}" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}" @if ($additionalAttributes !== false) {{ $additionalAttributes }} @endif @if ($required) required @endif />
    @error($name)
        <p class="text-error text-sm mt-1">{{ $message }}</p>
    @enderror
</div>