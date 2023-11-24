@extends('layout')

@section('container')
<div class="flex flex-col items-center">
    <h1 class="text-3xl font-bold mb-8">Register for a new account</h1>

    <form method="POST" class="mb-6">
        @csrf

        <div class="mb-4">
            <label class="mr-4">Username (max. 16 characters)</label>
            @error('username')
                <span class="text-red-500">{{ $message }}</span>
            @enderror

            <input type="text" maxlength="16" name="username" class="px-2 py-1 bg-gray-100 rounded-md w-full" placeholder="Enter your username" value="{{ old('username') }}">
        </div>

        <div class="mb-4">
            <label class="mr-4">Full name (max. 50 characters)</label>
            @error('fullname')
                <span class="text-red-500">{{ $message }}</span>
            @enderror

            <input type="text" maxlength="50" name="fullname" class="px-2 py-1 bg-gray-100 rounded-md w-full" placeholder="Enter your full name" value="{{ old('fullname') }}">
        </div>

        <div class="mb-4">
            <label class="mr-4">NIK (max. 16 digits)</label>
            @error('nik')
                <span class="text-red-500">{{ $message }}</span>
            @enderror

            <input type="text" maxlength="16" name="nik" class="px-2 py-1 bg-gray-100 rounded-md w-full" placeholder="Enter your NIK" value="{{ old('nik') }}">
        </div>

        <div class="mb-4">
            <label class="mr-4">Encryption Key</label>
            @error('key')
                <span class="text-red-500">{{ $message }}</span>
            @enderror

            <input type="text" maxlength="16" name="key" class="px-2 py-1 bg-gray-100 rounded-md w-full" placeholder="Enter your key" value="{{ old('key') }}">
        </div>

        <div class="mb-4">
            <label class="mr-4">Password</label>
            @error('password')
                <span class="text-red-500">{{ $message }}</span>
            @enderror

            <input type="password" name="password" class="px-2 py-1 bg-gray-100 rounded-md w-full" placeholder="Enter your password"}}">
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-800 text-white rounded-md">
            Register
        </button>
    </form>

    <p>Already have an account? <a href="/login" class="text-blue-800 hover:underline">Click here</a> to login</p>
</div>
@endsection