@extends('layouts.app')

@section('content')
                <div class="flex h-full w-full gap-4 md:gap-8 justify-between">
                    <div class="flex flex-col h-full min-w-1/3 md:min-w-2/5 gap-2 overflow-x-auto pr-2 border-r">
                        <a href="{{ route('licks.create') }}" class="btn btn-success">New +</a>

                        <div class="flex flex-col">
                            <span class="text-sm">Total</span>
                            <div class="flex justify-end">
                                <x-profit :profit="$totalRevenue" class="text-xl md:text-2xl"></x-profit>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs">Licked</span>
                            <div class="flex justify-end">
                                <x-profit :profit="$lickRevenue" class="text-base md:text-lg"></x-profit>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs">Spat</span>
                            <div class="flex justify-end">
                                <x-profit :profit="$spitRevenue" class="text-base md:text-lg"></x-profit>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-2 h-full w-full">
                        <form method="get">
                            @csrf
                            <div class="flex gap-2 items-center justify-end">
                                @php
    $filter = request('filter')
                                @endphp
                                <select name="filter" class="select" onchange="this.form.submit()">
                                    <option {{ is_null($filter) ? 'selected' : '' }}>No Filter</option>
                                    <option value="noSpits" {{ $filter == 'noSpits' ? 'selected' : '' }}>No Spits</option>
                                    <option value="hasSpits" {{ $filter == 'hasSpits' ? 'selected' : '' }}>Has Spits</option>
                                </select>
                                <input name="search" class="input" value="{{ request('search') }}" />
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
                                        @else
                                            <p>Not spat</p>
                                        @endif
                                        <div class="justify-end card-actions">
                                            @if(!$lick->spit)
                                                <a class="btn btn-secondary" href="{{ route('spits.create', ['lick' => $lick]) }}">Spit !</a>
                                            @endif
                                            <a href="{{ route('licks.show', ['lick' => $lick]) }}" class="btn btn-primary">View</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{ $licks->links('vendor.pagination.simple-tailwind') }}
                    </div>
                </div>
@endsection