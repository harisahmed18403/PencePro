<div class="form-control gap-2">
    <label for="{{ $id }}" class="label">
        <span class="label-text">{{ ucfirst($label) }}:</span>
    </label>
    <{{ $tag }} type="{{ $type }}" class="{{ $class }}" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}" @if ($additionalAttributes !== false) {{ $additionalAttributes }} @endif @if ($required) required
    @endif>@if($tag == 'textarea'){{ $value }}@endif</{{ $tag }}>
    @error($name)
        <p class="text-error text-sm mt-1">{{ $message }}</p>
    @enderror
</div>