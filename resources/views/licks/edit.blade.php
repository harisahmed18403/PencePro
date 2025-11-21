@extends('layouts.app')

@section('content')
    <div class="max-w-4xl w-full mx-auto p-6 bg-base-200 rounded-xl shadow">
        <form method="post" action="{{ route('licks.update', $lick->id) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="flex flex-col gap-6">
                <p class="text-2xl font-semibold">Edit Lick</p>

                <div class="flex flex-col gap-4">
                    <div class="form-control">
                        <label for="name" class="label">
                            <span class="label-text">Name:</span>
                        </label>
                        <input name="name" id="name" value="{{ $lick->name }}" maxlength="255"
                            class="input input-bordered w-full" required />
                        @error('name')
                            <p class="text-error text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-control">
                        <label for="cost" class="label">
                            <span class="label-text">Cost (£):</span>
                        </label>
                        <input name="cost" id="cost" type="number" step="0.1" value="{{ $lick->cost }}"
                            class="input input-bordered w-full" required />
                        @error('cost')
                            <p class="text-error text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    @if ($lick->spit)
                        <div class="form-control">
                            <label for="spit_revenue" class="label">
                                <span class="label-text">Spit Revenue (£):</span>
                            </label>
                            <input type="number" name="spit_revenue" id="spit_revenue" value="{{ $lick->spit->revenue }}"
                                class="input input-bordered w-full" />
                        </div>
                    @endif

                    <div class="form-control">
                        <label for="images" class="label">Add Images</label>
                        <input type="file" id="images" class="file-input file-input-bordered w-full" name="images[]"
                            multiple>
                    </div>

                    @if ($lick->images->isNotEmpty())
                        <div class="form-control">
                            <x-image-carousel :lick="$lick" :checkbox="true"></x-image-carousel>
                        </div>
                    @endif
                </div>


                <div class="flex justify-end">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection