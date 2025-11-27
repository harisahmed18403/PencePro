@extends('layouts.app')

@section('content')
    <x-image-modal></x-image-modal>
    <div class="flex flex-col h-full overflow-y-scroll gap-6 pb-[30vh]">

        {{-- Chart Filters --}}
        <div class="flex gap-4 w-full">
            <select id="rangeFilter" class="select select-info">
                @foreach($filters as $myfilter)
                    <option value="{{ $myfilter }}">
                        {{ $myfilter }}
                    </option>
                @endforeach
            </select>

            <select id="periodFilter" class="select select-info">
                @foreach($periods as $myPeriod)
                    <option value="{{ $myPeriod }}">
                        {{ $myPeriod }}
                    </option>
                @endforeach
            </select>

            <select id="graphTypeFilter" class="select select-info">
                @foreach($graphTypes as $myGraphType)
                    <option value="{{ $myGraphType }}">
                        {{ $myGraphType }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Profits Chart --}}
        <div class="flex flex-col min-h-[45vh] md:min-h-[60vh] bg-base-100 p-1 rounded-md items-center gap-4">


            <div id="dailyProfitGraph" style="width: 100%; height:100%;"></div>

            <script src="https://cdn.jsdelivr.net/npm/echarts@6.0.0/dist/echarts.min.js"></script>

            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const baseUrl = document.querySelector('meta[name="app-base-url"]').content;
                    const token = document.querySelector('meta[name="csrf-token"]').content;

                    var chartDom = document.getElementById('dailyProfitGraph');
                    var dailyProfitGraph = echarts.init(chartDom);

                    function loadGraph() {
                        const filter = document.getElementById('rangeFilter').value;
                        const period = document.getElementById('periodFilter').value;
                        const graphType = document.getElementById('graphTypeFilter').value;

                        dailyProfitGraph.showLoading();
                        fetch(`${baseUrl}/licks/stats/graph`, {
                            method: 'POST',
                            credentials: 'include',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            body: JSON.stringify({
                                filter: filter,
                                period: period,
                                graphType: graphType
                            })
                        })
                            .then(r => r.json())
                            .then(response => {
                                if (response.success) {
                                    const graphData = response.graphData;

                                    dailyProfitGraph.setOption({
                                        tooltip: { trigger: 'axis' },
                                        animation: false,
                                        grid: {
                                            left: '5%',
                                            right: '5%',
                                            top: '5%',
                                            bottom: '5%'
                                        },
                                        xAxis: {
                                            type: 'category',
                                            data: graphData.labels
                                        },
                                        yAxis: {
                                            type: 'value'
                                        },
                                        series: [{ type: 'bar', data: graphData.series }]
                                    });
                                }
                                dailyProfitGraph.hideLoading();
                            });
                    }

                    loadGraph();

                    document.getElementById('rangeFilter').addEventListener('change', loadGraph);
                    document.getElementById('periodFilter').addEventListener('change', loadGraph);
                    document.getElementById('graphTypeFilter').addEventListener('change', loadGraph);
                });
            </script>
        </div>

        <div class="divider"></div>

        {{-- Filters Form --}}
        <form method="get" class="flex gap-4">
            <select class="select select-info" name="filter" onchange="this.form.submit()">
                <option disabled selected>Limit</option>
                @for($i = 10; $i <= 50; $i += 10)
                    <option value="{{ $i }}" {{ $limit == $i ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                @endfor
            </select>
            <select class="select select-info" name="filter" onchange="this.form.submit()">
                @foreach($filters as $myfilter)
                    <option value="{{ $myfilter }}" {{ $filter == $myfilter ? 'selected' : '' }}>
                        {{ $myfilter }}
                    </option>
                @endforeach
            </select>
        </form>

        {{-- Most Profitable & Biggest Loss --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Most Profitable --}}
            <div class="card border border-base-100 shadow-md">
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
            <div class="card border border-base-100 shadow-md">
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