@extends('layouts.app')

@section('content')
    <div class="flex justify-between gap-2 max-h-1/3">
        <div class="flex flex-col w-full">
            <div class="flex items-center justify-between w-full pb-1 md:pr-4">
                <span class="text-success md:text-2xl">Most Profitable</span>
                <form method="get">
                    <select class="select select-xs md:select-md" name="limit" onchange="this.form.submit()">
                        @for($i = 10; $i <= 50; $i += 10)
                            <option value="{{ $i }}" {{ $i == $limit ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </form>
            </div>
            <div class="flex flex-col overflow-y-scroll gap-2">
                @foreach ($mostProfitable as $lick)
                    <x-lick-card :lick="$lick"></x-lick-card>
                @endforeach
            </div>
        </div>

        <div class="flex flex-col w-full">
            <div class="flex items-center justify-between w-full pb-1">
                <form method="get">
                    <select class="select select-xs md:select-md" name="filter" onchange="this.form.submit()">
                        @foreach($filters as $myfilter)
                            <option value="{{ $myfilter }}" {{ $filter == $myfilter ? 'selected' : '' }}>{{ $myfilter }}</option>
                        @endforeach
                    </select>
                </form>
                <span class="text-error md:text-2xl">Biggest Loss</span>
            </div>
            <div class="flex flex-col overflow-y-scroll gap-2">
                @foreach ($biggestLoss as $lick)
                    <x-lick-card :lick="$lick"></x-lick-card>
                @endforeach
            </div>
        </div>

    </div>
    <div class="flex h-full max-h-1/2">
        <x-line-chart :labels="$dailyProfits['labels']" :series="$dailyProfits['series']" title="Daily Profits"
            id="dailyProfitGraph"></x-line-chart>
    </div>
@endsection