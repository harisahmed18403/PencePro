@extends('layouts.app')

@section('content')
    <x-image-modal></x-image-modal>
    <div class="flex flex-col h-full overflow-y-scroll gap-6 pb-[30vh]">

        {{-- Filters Form --}}
        <form method="get" class="flex gap-4">
            <select class="select" name="filter" onchange="this.form.submit()">
                @foreach($filters as $myfilter)
                    <option value="{{ $myfilter }}" {{ $filter == $myfilter ? 'selected' : '' }}>
                        {{ $myfilter }}
                    </option>
                @endforeach
            </select>

            <select class="select" name="graphType" onchange="this.form.submit()">
                @foreach($graphTypes as $mygraphType)
                    <option value="{{ $mygraphType }}" {{ $graphType == $mygraphType ? 'selected' : '' }}>
                        {{ $mygraphType }}
                    </option>
                @endforeach
            </select>
        </form>

        {{-- Profits Chart --}}
        <div class="flex flex-col min-h-[30vh] md:min-h-[60vh] bg-base-100 p-1 rounded-md items-center gap-4">
            <p class="text-info text-lg md:text-2xl font-semibold">{{ $graphType }}</p>
            <x-line-chart :labels="$dailyProfits['labels']" :series="$dailyProfits['series']" title=""
                id="dailyProfitGraph">
            </x-line-chart>
        </div>

        {{-- Most Profitable & Biggest Loss --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Most Profitable --}}
            <div class="card bg-base-100 shadow-md">
                <div class="card-body">
                    <h2 class="text-success text-lg md:text-2xl font-semibold mb-4">Most Profitable</h2>
                    <div class="flex flex-col gap-3 max-h-[50vh] overflow-y-auto">
                        @foreach ($mostProfitable as $lick)
                            <x-lick-card :lick="$lick"></x-lick-card>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Biggest Loss --}}
            <div class="card bg-base-100 shadow-md">
                <div class="card-body">
                    <h2 class="text-error text-lg md:text-2xl font-semibold mb-4">Biggest Loss</h2>
                    <div class="flex flex-col gap-3 max-h-[50vh] overflow-y-auto">
                        @foreach ($biggestLoss as $lick)
                            <x-lick-card :lick="$lick"></x-lick-card>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection