@extends('layouts.app')

@section('content')
    <form method="post" action="{{ route('licks.store') }}">
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

                {{-- Revenue --}}
                <div class="flex flex-col">
                    <label for="revenue" class="font-medium">Revenue (£):</label>
                    <input name="revenue" id="revenue" type="number" step="2" placeholder="e.g. 9.99" class="input w-full"
                        required />
                    @error('revenue')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Has Spit Toggle --}}
                <div class="flex items-center gap-2">
                    <label for="hasSpit" class="font-medium">Has Spit</label>
                    <input type="checkbox" class="toggle" name="hasSpit" id="hasSpit" @change="showSpit = !showSpit" />
                </div>

                {{-- Spit Revenue (conditionally visible) --}}
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