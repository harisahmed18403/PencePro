@extends('layouts.app')

@section('content')
    <form method="post" action="{{ route('licks.update', $lick->id) }}">
        @csrf
        @method('PUT')

        <div class="flex flex-col gap-6" x-data="{ showSpit: false }">
            <p class="text-lg md:text-2xl">New Lick</p>
            <div class="flex flex-col gap-4">
                {{-- Name --}}
                <div class="flex flex-col">
                    <label for="name" class="font-medium">Name:</label>
                    <input name="name" id="name" value="{{ $lick->name }}" class="input w-full" maxlength="255" required />
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Cost --}}
                <div class="flex flex-col">
                    <label for="cost" class="font-medium">Cost (£):</label>
                    <input name="cost" id="cost" type="number" step="0.1" value="{{ $lick->cost }}" class="input w-full"
                        required />
                    @error('cost')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                @if ($lick->spit)
                    {{-- Spit --}}
                    <div class="flex flex-col">
                        <label for="spit_revenue" class="font-medium">Spit Revenue (£):</label>
                        <input type="number" name="spit_revenue" id="spit_revenue" value="{{ $lick->spit->revenue }}"
                            class="input w-full" />
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-success self-end">Update</button>
        </div>
    </form>
@endsection