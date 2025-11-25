@extends('layouts.app')

@section('content')
    <div class="card w-full mx-auto max-w-sm shadow-lg bg-base-100">
        <div class="card-body">
            <h1 class="text-2xl font-bold mb-4 text-center">Register</h1>

            @if($errors->any())
                <div class="alert alert-error mb-4">
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-control mb-4">
                    <label class="label" for="name">
                        <span class="label-text">Name</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="input input-bordered w-full" />
                </div>

                <div class="form-control mb-4">
                    <label class="label" for="email">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="input input-bordered w-full" />
                </div>

                <div class="form-control mb-4">
                    <label class="label" for="password">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" name="password" id="password" required class="input input-bordered w-full" />
                </div>

                <div class="form-control mb-4">
                    <label class="label" for="password_confirmation">
                        <span class="label-text">Confirm Password</span>
                    </label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="input input-bordered w-full" />
                </div>

                <div class="form-control">
                    <button type="submit" class="btn btn-primary w-full">Register</button>
                </div>
            </form>

            <p class="mt-4 text-center text-sm">
                Already have an account? <a href="{{ route('login') }}" class="link link-primary">Login</a>
            </p>

        </div>
    </div>
@endsection