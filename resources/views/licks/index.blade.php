@extends('layouts.app')

@section('content')
    <div class="flex h-full w-full gap-2 md:gap-8 justify-between">
        <div class="flex flex-col h-full w-auto gap-2 overflow-x-auto">
            <p class="text-xl md:text-2xl">Licks</p>
            <a href="{{ route('licks.create') }}" class="btn btn-success">New +</a>
        </div>

        <div class="flex flex-col h-full w-full gap-2 overflow-y-auto overflow-x-hidden">
            @foreach($licks as $lick)
                <div class="card w-auto bg-base-100 card-xs md:card-md shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title">{{ $lick->name }} <x-profit :profit="$lick->profit()"></x-profit></h2>
                        <p><span class="text-error">&pound; {{ $lick->revenue }}</span> licked</p>
                        @if($lick->spit)
                            <p><span class="text-success">&pound; {{ $lick->spit->revenue }}</span> spat</p>
                        @else
                            <p>Not spat</p>
                        @endif
                        <div class="justify-end card-actions">
                            <button class="btn btn-primary">View</button>
                            <button class="btn btn-primary">Spit !</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection