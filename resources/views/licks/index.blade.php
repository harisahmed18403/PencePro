@extends('layouts.app')

@section('content')
    <div class="flex flex-col h-full w-auto gap-2 overflow-x-auto">

        @foreach($licks as $lick)
            <div class="card w-96 bg-base-100 card-sm shadow-sm">
                <div class="card-body">
                    <h2 class="card-title">{{ $lick->name }} <x-profit :profit="$lick->profit()"></x-profit></h2>
                    <p class="text-error">&pound; {{ $lick->revenue }}</p>
                    @if($lick->spit)
                        <p class="text-success">{{ $lick->spit->revenue }}</p>
                    @else
                        <p>-</p>
                    @endif
                    <div class="justify-end card-actions">
                        <button class="btn btn-primary">View</button>
                        <button class="btn btn-primary">Spit !</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection