@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center justify-center mt-10 gap-4">
        <div class="card w-full max-w-md shadow-lg bg-base-100">
            <div class="card-body">
                <h2 class="text-2xl font-bold mb-4 text-center">My Profile</h2>

                @if(session('success'))
                    <div class="alert alert-success mb-4">{{ session('success') }}</div>
                @endif

                <div class="mb-2"><strong>Name:</strong> {{ $user->name }}</div>
                <div class="mb-2"><strong>Email:</strong> {{ $user->email }}</div>

                <div class="mt-4">
                    <a href="{{ route('user.edit') }}" class="btn btn-primary w-full">Edit Profile</a>
                </div>
            </div>
        </div>
        <div class="card w-full max-w-md shadow-lg bg-base-100">
            <div class="card-body">
                <h2 class="text-2xl font-bold mb-4 text-center">Delete Profile</h2>

                <form method="POST" action="{{ route('user.destroy') }}">
                    @csrf
                    <label class="label">
                        <span class="label-text">Confirm Password to Delete Account</span>
                    </label>
                    <input type="password" name="password" class="input input-bordered w-full mb-2" required>
                    <button type="submit" class="btn btn-error w-full">Delete Account</button>
                </form>
            </div>
        </div>
    </div>

@endsection