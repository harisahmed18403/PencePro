@extends('layouts.app')

@section('content')
    <div class="max-w-md h-full w-full mx-auto p-6 bg-base-200 rounded-xl shadow">
        <form method="post" action="{{ route('licks.update', $lick->id) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <x-form-body title="Edit Lick">

                {{-- Name --}}
                <x-form-input name="name" :value="old('name', $lick->name)" label="name"></x-form-input>

                {{-- Cost --}}
                <x-form-input name="cost" :value="old('cost', $lick->cost)" label="cost (£)" type="number"
                    additionalAttributes="step='0.1'"></x-form-input>

                {{-- Date --}}
                <x-form-input name="date" label="date" type="date" value="{{ old('date', $lick->date) }}"></x-form-input>

                @if ($lick->spit)
                    {{-- Spit Revenue --}}
                    <x-form-input name="spit_revenue" :value="old('spit_revenue', $lick->spit->revenue)"
                        label="Spit Revenue (£)" type="number" additionalAttributes="step='0.1'"></x-form-input>

                    {{-- Spit Date --}}
                    <x-form-input name="spit_date" label="Spat Date" type="date"
                        value="{{old('spit_date', $lick->spit->date) }}"></x-form-input>
                @endif

                {{-- Additional Images --}}
                <x-form-input name="images[]" id="images" label="Add Images" type="file" additionalAttributes="multiple"
                    :required="false"></x-form-input>


                {{-- Existing Images --}}
                @if ($lick->images->isNotEmpty())
                    <div class="form-control flex w-full justify-center">
                        <x-image-carousel :lick="$lick" :checkbox="true"></x-image-carousel>
                    </div>
                @endif

                {{-- Notes --}}
                <x-form-input name="notes" label="Edit Notes" type="textarea" value="{{ old('notes', $lick->notes) }}"
                    :required="false"></x-form-input>

                <div class="flex justify-end">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </x-form-body>
        </form>
    </div>
@endsection