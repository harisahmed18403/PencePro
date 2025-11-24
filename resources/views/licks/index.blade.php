@extends('layouts.app')

@section('content')
    <div class="flex flex-col h-full w-full gap-2 overflow-hidden">

        <div class="flex flex-col md:flex-row h-full w-full gap-2">
            <div class="flex md:flex-col overflow-x-auto h-full min-h-1/16 md:min-w-1/4 gap-2 ">
                <a href="{{ route('licks.create') }}" class="btn btn-success">New +</a>

                <div class="card card-xs text-nowrap px-4 md:py-4 md:card-md bg-base-100">
                    <span class="text-sm font-semibold text-secondary">Total</span>
                    <x-profit :profit="$totalRevenue" class="text-sm md:text-lg font-bold" />
                </div>

                <div class="card card-xs text-nowrap px-4 md:py-4 md:card-md bg-base-100">
                    <span class="text-sm font-semibold text-secondary">Licked</span>
                    <x-profit :profit="$lickRevenue" class="text-sm md:text-lg font-bold" />
                </div>

                <div class="card card-xs text-nowrap px-4 md:py-4 md:card-md bg-base-100">
                    <span class="text-sm font-semibold text-secondary">Spat</span>
                    <x-profit :profit="$spitRevenue" class="text-sm md:text-lg font-bold" />
                </div>
            </div>

            <div class="flex flex-col h-full w-full gap-2">
                {{-- Filters --}}
                <form method="get"
                    class="flex w-full gap-2 items-center sticky top-0 left-0 z-50 pb-1 border-b border-base-300 md:pb-0 md:border-none">
                    @csrf
                    <select name="filter" class="select select-sm md:select-md w-full" onchange="this.form.submit()">
                        <option {{ is_null($filter) ? 'selected' : '' }}>No Filter</option>
                        <option value="noSpits" {{ $filter == 'noSpits' ? 'selected' : '' }}>No Spits</option>
                        <option value="hasSpits" {{ $filter == 'hasSpits' ? 'selected' : '' }}>Has Spits</option>
                        <option value="profit" {{ $filter == 'profit' ? 'selected' : '' }}>Profit</option>
                        <option value="loss" {{ $filter == 'loss' ? 'selected' : '' }}>Loss</option>
                    </select>
                    <input name="search" class="input input-sm md:input-md input-bordered w-full" value="{{ $search }}"
                        placeholder="Search ..." />
                    <button class="btn btn-sm md:btn-md btn-info" type="submit">Go</button>
                </form>

                {{-- Licks --}}
                <div class="flex flex-col max-h-full w-full gap-2 pb-[30vh] overflow-y-auto overflow-x-hidden">
                    @if(count($licks) === 0)
                        <p class="text">No results</p>
                    @endif
                    @foreach($licks as $lick)
                        <x-lick-card :lick="$lick"></x-lick-card>
                    @endforeach
                </div>

                {{-- Pagination buttons --}}
                <div class="sticky w-full bottom-0">
                    {{ $licks->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection