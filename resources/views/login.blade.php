@extends('layout')

@section('container')
@if(session()->has('registerSuccess'))
<div class="bg-green-600 text-white py-2 px-4 rounded-md">
    {{ session('registerSuccess') }}
</div>
@endif

@if(session()->has('loginError'))
<div class="bg-red-500 text-white py-2 px-4 rounded-md">
    {{ session('loginError') }}
</div>
@endif

<div class="flex flex-col items-center">
    <h1 class="text-3xl font-bold mb-8">Login to SecureVault</h1>

    <form action="/login" method="POST" class="mb-6">
        @csrf
        <div class="mb-4">
            <label class="mr-4">Username</label>
            @error('username')
                <span class="text-red-500">{{ $message }}</span>
            @enderror

            <input type="text" maxlength="16" name="username" class="px-2 py-1 bg-gray-100 rounded-md w-full" placeholder="Enter your username" value="{{ old('username') }}">
        </div>

        <div class="mb-4">
            <label class="mr-4">Password</label>
            @error('password')
                <span class="text-red-500">{{ $message }}</span>
            @enderror

            <input type="password" name="password" class="px-2 py-1 bg-gray-100 rounded-md w-full" placeholder="Enter your password" value="{{ old('password') }}">
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-800 text-white rounded-md">Login</button>
    </form>
    <p>Haven't registered yet? <a href="/register" class="text-blue-800 hover:underline">Click here</a> to register</p>
</div>
@endsection