@extends('layouts.app')

@section('content')
    <div class="max-w-4xl w-full mx-auto p-6 bg-base-200 rounded-xl shadow">
        <form method="POST" action="{{ route('licks.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="flex flex-col gap-6" x-data="{ hasSpit: false }">
                <p class="text-2xl font-semibold">New Lick</p>

                <div class="flex flex-col gap-4">
                    <div class="form-control">
                        <label for="name" class="label">
                            <span class="label-text">Name:</span>
                        </label>
                        <input name="name" id="name" maxlength="255" class="input input-bordered w-full" required />
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        @error('name')
                            <p class="text-error text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-control">
                        <label for="cost" class="label">
                            <span class="label-text">Cost (£):</span>
                        </label>
                        <input name="cost" id="cost" type="number" step="0.1" class="input input-bordered w-full"
                            required />
                        @error('cost')
                            <p class="text-error text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-control">
                        <label for="hasSpit" class="label">
                            <span class="label-text">Spat ?</span>
                        </label>
                        <input type="checkbox" id="hasSpit" name="hasSpit" class="toggle" x-model="hasSpit" />
                    </div>

                    <div class="form-control" x-show="hasSpit">
                        <label for="spit_revenue" class="label">
                            <span class="label-text">Spit Revenue (£):</span>
                        </label>
                        <input type="number" name="spit_revenue" id="spit_revenue" class="input input-bordered w-full" />
                    </div>

                    <div class="form-control">
                        <label for="spit_revenue" class="label">
                            <span class="label-text">Images:</span>
                        </label>
                        <input type="file" name="images[]" id="images" class="file-input input-bordered w-full" multiple />
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection