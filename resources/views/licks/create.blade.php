@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto p-6 bg-base-200 rounded-xl shadow">
        <form method="POST" action="{{ route('licks.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf


            <x-form-body title="New Lick">

                {{-- Name --}}
                <x-form-input name="name" label="name"></x-form-input>

                {{-- Cost --}}
                <x-form-input name="cost" label="cost (£)" type="number" additionalAttributes="step='0.1'"></x-form-input>

                {{-- Date --}}
                <x-form-input name="date" label="date" type="date" value="{{ date('Y-m-d') }}"></x-form-input>

                {{-- Spit Revenue --}}
                <div class="flex flex-col gap-4" x-data="{hasSpit:false}">
                    <div class="form-control">
                        <label for="hasSpit" class="label">
                            <span class="label-text">Spat ?</span>
                        </label>
                        <input type="checkbox" id="hasSpit" name="hasSpit" class="toggle" x-model="hasSpit" />
                    </div>

                    <div class="form-control" x-show="hasSpit">
                        {{-- Spit Revenue --}}
                        <x-form-input name="spit_revenue" label="Spit Revenue (£)" type="number"
                            additionalAttributes="step='0.1'" :required="false"></x-form-input>
                    </div>

                    <div class="form-control" x-show="hasSpit">
                        {{-- Date --}}
                        <x-form-input name="spit_date" label="Spit Date" type="date"
                            value="{{ date('Y-m-d') }}"></x-form-input>
                    </div>

                </div>

                {{-- Images --}}
                <x-form-input name="images[]" id="images" label="Add Images" type="file" additionalAttributes="multiple"
                    :required="false"></x-form-input>

                {{-- Notes --}}
                <x-form-input name="notes" label="Add Notes" type="textarea" :required="false"></x-form-input>

                <div class="flex justify-end">
                    <button type="submit" class="btn btn-success">Create</button>
                </div>
            </x-form-body>

        </form>
    </div>
@endsection