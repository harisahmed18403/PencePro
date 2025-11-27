@extends('layouts.app')

@section('content')
    <x-image-modal></x-image-modal>
    <div class="max-w-md w-full mx-auto p-6 bg-base-200 rounded-xl shadow">

        <form method="POST" action="{{ route('spits.store', ['id' => $lick->id]) }}" class="space-y-4 mt-4">
            @csrf

            <x-form-body title="Add Spit to {{ $lick->name }}" submitText="Spit">
                @if (!$lick->images->isEmpty())
                    <x-image-carousel :lick="$lick"></x-image-carousel>
                @endif

                <x-form-input type="number" name="revenue" label="Spit Revenue (£)"
                    additionalAttributes="step='0.01'"></x-form-input>

                <x-form-input type="date" name="date" label="Spit Date" value="{{ date('Y-m-d') }}"></x-form-input>

            </x-form-body>
        </form>
    </div>
@endsection