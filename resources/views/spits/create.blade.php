@extends('layouts.app')

@section('content')
    <div class="max-w-4xl w-full mx-auto p-6 bg-base-200 rounded-xl shadow">

        <form method="POST" action="{{ route('spits.store', ['id' => $lick->id]) }}" class="space-y-4 mt-4">
            @csrf

            <x-form-body title="Add Spit to {{ $lick->name }}">

                <x-form-input type="number" name="revenue" label="Spit Revenue (£)"
                    additionalAttributes="step='0.01'"></x-form-input>

                <x-form-input type="date" name="date" label="Spit Date" value="{{ date('Y-m-d') }}"></x-form-input>

            </x-form-body>

            <div class="form-control mt-6">
                <button type="submit" class="btn btn-primary">Create Spit</button>
            </div>
        </form>
    </div>
@endsection