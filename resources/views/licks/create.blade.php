@extends('layouts.app')

@section('content')
    <form method="post" action="{{ route('licks.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="flex flex-col gap-6" x-data="{ showSpit: false }">
            <p class="text-lg md:text-2xl">New Lick</p>
            <div class="flex flex-col gap-4">
                {{-- Name --}}
                <div class="flex flex-col">
                    <label for="name" class="font-medium">Name:</label>
                    <input name="name" id="name" placeholder="e.g. iPhone 13" class="input w-full" maxlength="255"
                        required />
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Cost --}}
                <div class="flex flex-col">
                    <label for="cost" class="font-medium">Cost (£):</label>
                    <input name="cost" id="cost" type="number" step="0.1" placeholder="e.g. 9.99" class="input w-full"
                        required />
                    @error('cost')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Images --}}
                <div class="flex flex-col">
                    <label for="images" class="font-medium">Images:</label>
                    <input type="file" id="images" class="file-input file-input-xs" name="images[]" multiple>
                </div>

                {{-- Spit toggle --}}
                <div class="flex items-center gap-2">
                    <label for="hasSpit" class="font-medium">Has Spit</label>
                    <input type="checkbox" class="toggle" name="hasSpit" id="hasSpit" @change="showSpit = !showSpit" />
                </div>

                {{-- Spit --}}
                <div class="flex flex-col" x-show="showSpit" x-cloak>
                    <label for="spit_revenue" class="font-medium">Spit Revenue (£):</label>
                    <input type="number" name="spit_revenue" id="spit_revenue" placeholder="Spit revenue"
                        class="input w-full" />
                </div>
            </div>
            <button type="submit" class="btn btn-success self-end">Create</button>
        </div>
    </form>
@endsection