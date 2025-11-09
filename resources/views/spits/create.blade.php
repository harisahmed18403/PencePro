@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto mt-8">
        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <h2 class="card-title text-2xl">Add Spit to {{ $lick->name }}</h2>

                <form method="POST" action="{{ route('spits.store', $lick) }}" class="space-y-4 mt-4">
                    @csrf

                    <div class="form-control">
                        <label class="label" for="revenue">Spit Revenue (£)</label>
                        <input type="number" name="revenue" id="revenue" step="0.01" class="input input-bordered" required>
                        @error('revenue')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-control mt-6">
                        <button type="submit" class="btn btn-primary">Create Spit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection