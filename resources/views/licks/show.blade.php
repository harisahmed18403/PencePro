@extends('layouts.app')

@section('content')
    <x-image-modal></x-image-modal>

    <a href="{{ route('licks.index', ['page' => session()->get('licks_index_page')]) }}"
        class="btn btn-xs btn-soft">Back</a>
    <div class="max-w-2xl mx-auto mt-8">
        <div class="card bg-base-100 shadow-md">
            <div class="card-body">
                <h2 class="card-title text-3xl font-bold">{{ $lick->name }}</h2>

                <div class="mt-4 space-y-2">
                    <div class="flex justify-between">
                        <span class="font-medium">Cost (£):</span>
                        <span>{{ number_format($lick->cost, 2) }}</span>
                    </div>

                    @if ($lick->spit)
                        <div class="flex justify-between">
                            <span class="font-medium">Spit Revenue (£):</span>
                            <span>{{ number_format($lick->spit->revenue, 2) }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span class="font-medium">Profit (£):</span>
                            <x-profit :profit="$lick->profit"></x-profit>
                        </div>
                    @endif

                    @if(!$lick->images->isEmpty())
                        <div class="divider"></div>

                        <div class="flex w-full">
                            <x-image-carousel :lick="$lick"></x-image-carousel>
                        </div>
                    @endif

                    <div class="divider"></div>

                    <div class="flex justify-between text-sm text-gray-500">
                        <span>Licked at:</span>
                        <span>{{ $lick->date }}</span>
                    </div>
                    @if ($lick->spit)
                        <div class="flex justify-between text-sm text-gray-500">
                            <span>Spat at:</span>
                            <span>{{ $lick->spit->date }}</span>
                        </div>
                    @endif
                    <div class="flex justify-between text-sm text-gray-500">
                        <span>Last Updated:</span>
                        <span>{{ $lick->updated_at->format('F j, Y g:i A') }}</span>
                    </div>
                </div>

                <div class="card-actions justify-end mt-6">
                    <a href="{{ route('licks.edit', $lick) }}" class="btn btn-primary">Edit</a>
                    <form method="POST" action="{{ route('licks.destroy', $lick) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-error">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection