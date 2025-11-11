@extends('layouts.app')

@section('content')
    <div class="flex h-full w-full gap-4 md:gap-8 justify-between">
        <div class="flex flex-col h-full min-w-1/3 md:min-w-2/5 gap-2 overflow-x-auto pr-2 border-r">
            <a href="{{ route('licks.create') }}" class="btn btn-success">New +</a>

            <div class="flex flex-col">
                <div class="card">
                    <span class="text-sm font-thin">Total:</span>
                    <x-profit :profit="$totalRevenue" class="text-sm md:text-2xl"></x-profit>
                </div>

                <span class="text-xs">Licked:</span>
                <x-profit :profit="$lickRevenue" class="text-sm md:text-lg"></x-profit>

                <span class="text-xs">Spat:</span>
                <x-profit :profit="$spitRevenue" class="text-sm md:text-lg"></x-profit>
            </div>
        </div>

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
                    <div class="card w-full bg-base-100 card-xs md:card-md shadow-lg">
                        <div class="card-body">
                            <div class="flex justify-between">
                                <h2 class="card-title">{{ $lick->name }} </h2>
                                <x-profit class="card-title" :profit="$lick->profit()"></x-profit>
                            </div>
                            <p><span class="text-error">&pound; {{ $lick->revenue }}</span> licked</p>
                            @if($lick->spit)
                                <p><span class="text-success">&pound; {{ $lick->spit->revenue }}</span> spat</p>

                            @endif
                            <div class="flex justify-between card-actions">
                                <div>
                                    @if(!$lick->spit)
                                        <div class="badge badge-soft badge-warning badge-sm">Not Spat</div>
                                    @else
                                        @if($lick->profit() > 0)
                                            <div class="badge badge-soft badge-success badge-sm">Profit</div>
                                        @else
                                            <div class="badge badge-soft badge-error badge-sm">Loss</div>
                                        @endif
                                    @endif
                                </div>
                                <div>
                                    @if(!$lick->spit)
                                        <a class="btn btn-secondary" href="{{ route('spits.create', ['lick' => $lick]) }}">Spit !</a>
                                    @endif
                                    <a href="{{ route('licks.show', ['lick' => $lick]) }}" class="btn btn-primary">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="join grid grid-cols-3 mt-4">
                <a href="{{ route('licks.index', ['page' => $page - 1]) }}"
                    class="join-item btn btn-soft {{ $page <= 1 ? 'disabled' : '' }}">«</a>
                <button class="join-item btn btn-soft">Page {{ $page }} of {{ $totalPages }}</button>
                <a href="{{ route('licks.index', ['page' => $page + 1]) }}"
                    class="join-item btn btn-soft  {{ $page >= $totalPages ? 'disabled' : '' }}">»</a>
            </div>
        </div>
    </div>
@endsection