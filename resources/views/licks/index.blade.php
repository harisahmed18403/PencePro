@extends('layouts.app')

@section('content')
    <div class="flex h-full w-full gap-4 md:gap-8 justify-between">
        <div class="flex flex-col h-full w-1/2 md:w-2/5 gap-2 overflow-x-auto">
            <p class="text-xl md:text-2xl">Licks</p>
            <a href="{{ route('licks.create') }}" class="btn btn-success">New +</a>
        </div>

        <div class="flex flex-col gap-2 h-full w-full">
            <div>
                {{ $licks->links() }}
            </div>
            <div class="flex flex-col h-full w-full p-2 gap-2 overflow-y-auto overflow-x-hidden">
                @foreach($licks as $lick)
                    <div class="card w-auto bg-base-100 card-xs md:card-md shadow-lg">
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
                                <a href="{{ route('licks.show', ['lick' => $lick]) }}" class="btn btn-primary">View</a>
                                <a class="btn btn-secondary">Spit !</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection