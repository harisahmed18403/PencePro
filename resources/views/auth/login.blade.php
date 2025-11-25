@extends('layouts.app')

@section('content')
    <div class="card w-full mx-auto max-w-sm shadow-lg bg-base-100">
        <div class="card-body">
            <h1 class="text-2xl font-bold mb-4 text-center">Login</h1>

            @if($errors->any())
                <div class="alert alert-error mb-4">
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-control mb-4">
                    <label class="label" for="email">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                        class="input input-bordered w-full" />
                </div>

                <div class="form-control mb-4">
                    <label class="label" for="password">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" name="password" id="password" required class="input input-bordered w-full" />
                </div>

                <div class="form-control mb-4">
                    <label class="cursor-pointer label">
                        <input type="checkbox" name="remember" class="checkbox checkbox-primary mr-2" />
                        <span class="label-text">Remember me</span>
                    </label>
                </div>

                <div class="form-control">
                    <button type="submit" class="btn btn-primary w-full">Login</button>
                </div>
            </form>
            <p class="mt-4 text-center text-sm">
                Don't have an account? <a href="{{ route('register') }}" class="link link-primary">Register</a>
            </p>

        </div>
    </div>
@endsection