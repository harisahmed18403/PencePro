@extends('layouts.app')

@section('content')
    <div class="flex justify-center mt-10">
        <div class="card w-full max-w-md shadow-lg bg-base-100">
            <div class="card-body">
                <h2 class="text-2xl font-bold mb-4 text-center">Edit Profile</h2>

                <form method="POST" action="{{ route('user.update') }}">
                    @csrf

                    <div class="form-control mb-4">
                        <label class="label" for="name">
                            <span class="label-text">Name</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                            class="input input-bordered w-full" required />
                    </div>

                    <div class="form-control mb-4">
                        <label class="label" for="email">
                            <span class="label-text">Email</span>
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                            class="input input-bordered w-full" required />
                    </div>

                    <div class="form-control mb-4">
                        <label class="label" for="password">
                            <span class="label-text">New Password (leave blank to keep current)</span>
                        </label>
                        <input type="password" name="password" id="password" class="input input-bordered w-full" />
                    </div>

                    <div class="form-control mb-4">
                        <label class="label" for="password_confirmation">
                            <span class="label-text">Confirm New Password</span>
                        </label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="input input-bordered w-full" />
                    </div>

                    <div class="form-control">
                        <button type="submit" class="btn btn-primary w-full">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection