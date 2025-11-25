@extends('layouts.html')

@section('body')
    <div class="flex flex-col w-full items-center mx-auto mt-16 gap-4">
        <x-logo></x-logo>
        <div class="card w-full m-auto max-w-sm shadow-lg bg-base-100">
            <div class="card-body">

                @if($errors->any())
                    <div class="alert alert-error mb-4">
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif


                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <x-form-body title="Register">

                        <x-form-input type="text" name="name" label="Name" value="{{ old('name') }}"></x-form-input>

                        <x-form-input type="email" name="email" label="Email" value="{{ old('email') }}"></x-form-input>

                        <x-form-input type="password" name="password" label="Password"></x-form-input>

                        <x-form-input type="password" name="password_confirmation" label="Confirm Password"></x-form-input>

                        <div class="form-control mt-2">
                            <button type="submit" class="btn btn-primary w-full">Register</button>
                        </div>
                    </x-form-body>
                </form>

                <p class="mt-4 text-center text-sm">
                    Already have an account? <a href="{{ route('login') }}" class="link link-primary">Login</a>
                </p>

            </div>
        </div>
    </div>
@endsection