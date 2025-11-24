<div class="form-control">
    <label for="{{ $id }}" class="label">
        <span class="label-text">{{ ucfirst($label) }}:</span>
    </label>
    <input type="{{ $type }}" @if ($type == 'text' || $type == 'number' || $type == 'date')
    class="input input-bordered w-full" @elseif ($type == 'checkbox') class="toggle input-bordered w-full" @elseif ($type == 'file') class="file-input file-input-bordered w-full" @elseif ($type == 'date')
        class="input input-bordered" @endif name="{{ $name }}" id="{{ $id }}" value="{{ $value }}" @if ($additionalAttributes !== false) {{ $additionalAttributes }} @endif @if ($required) required @endif />
    @error($name)
        <p class="text-error text-sm mt-1">{{ $message }}</p>
    @enderror
</div>