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
                <form method="POST" action="{{ route('user.destroy') }}">
                    @csrf
                    <x-form-body title="Delete Profile">

                        <x-form-input type="password" name="password"
                            label="Confirm Password to Delete Account"></x-form-input>
                        <button type="submit" class="btn btn-error w-full">Delete Account</button>
                    </x-form-body>
                </form>
            </div>
        </div>
    </div>

@endsection