@extends('layout')

@section('content')
<x-card class="max-w-lg mx-auto mt-24 p-10">
    <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">
            Login
        </h2>
        <p class="mb-4">Create an account to post gigs</p>
    </header>

    <form action="/users/authenticate" method="POST">
        @csrf
        <div class="mb-6">
            <label for="email" class="inline-block text-lg mb-2">Email</label>
            <input type="email" class="border border-gray-200 rounded p-2 w-full" name="email"
                value="{{old('email')}}" />
            <!-- Error Example -->
            @error('email')
            <p class="text-red-500 text-xs mt-1">
                {{$message}}
            </p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password" class="inline-block text-lg mb-2">
                Password
            </label>
            <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password"
                value="{{old('password')}}" />
        </div>
        @error('password')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror

        <div class="mb-6">
            <button type="submit" class="bg-red-600 text-white rounded py-2 px-4 hover:bg-black">
                Login
            </button>
        </div>

        <div class="mt-8">
            <p>
                Don't have an account?
                <a href="/register" class="text-red-600">Register</a>
            </p>
        </div>
    </form>
</x-card>

@endsection