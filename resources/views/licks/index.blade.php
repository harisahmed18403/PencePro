@extends('layouts.app')

@section('content')
    <div class="flex h-full w-full gap-2 md:gap-8 justify-between">
        <div class="flex flex-col h-full min-w-1/3 md:min-w-2/5 gap-2 overflow-x-auto">
            <a href="{{ route('licks.create') }}" class="btn btn-success">New +</a>

            <div class="flex flex-col gap-4 w-full md:px-2 md:py-4">
                <div class="card bg-base-100 shadow-sm p-4">
                    <div class="text-sm font-semibold text-secondary">Total</div>
                    <x-profit :profit="$totalRevenue" class="text-sm md:text-lg font-bold" />
                </div>

                <div class="card bg-base-100 shadow-sm p-4">
                    <div class="text-sm font-semibold text-secondary">Licked</div>
                    <x-profit :profit="$lickRevenue" class="text-sm md:text-lg font-bold" />
                </div>

                <div class="card bg-base-100 shadow-sm p-4">
                    <div class="text-sm font-semibold text-secondary">Spat</div>
                    <x-profit :profit="$spitRevenue" class="text-sm md:text-lg font-bold" />
                </div>
            </div>
        </div>
        <div class="divider divider-vertical h-full"></div>
        <div class="flex flex-col gap-1 md:gap-2 h-full w-full">
            <form method="get">
                @csrf
                <div class="flex gap-2 items-center justify-end">
                    <select name="filter" class="select md:w-1/4" onchange="this.form.submit()">
                        <option {{ is_null($filter) ? 'selected' : '' }}>No Filter</option>
                        <option value="noSpits" {{ $filter == 'noSpits' ? 'selected' : '' }}>No Spits</option>
                        <option value="hasSpits" {{ $filter == 'hasSpits' ? 'selected' : '' }}>Has Spits</option>
                        <option value="profit" {{ $filter == 'profit' ? 'selected' : '' }}>Profit</option>
                        <option value="loss" {{ $filter == 'loss' ? 'selected' : '' }}>Loss</option>
                    </select>
                    <input name="search" class="input" value="{{ $search }}" />
                    <button class="btn btn-info" type="submit">Search</button>
                </div>
            </form>
            <div class="flex flex-col items-center h-full w-full gap-2 overflow-y-auto overflow-x-hidden">
                @if(count($licks) === 0)
                    <p class="text">No results</p>
                @endif
                @foreach($licks as $lick)
                    <x-lick-card :lick="$lick"></x-lick-card>
                @endforeach
            </div>
            <div class="pr-4">
                {{ $licks->links() }}
            </div>
        </div>
    </div>
@endsection