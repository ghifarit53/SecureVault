@extends('layout')

@section('container')
    <div class="flex justify-center">
        <h1 class="text-3xl font-bold mb-8">Log In</h1>
    </div>

    @if (session()->has('signupSuccess'))
        <div class="text-green-500 font-medium text-xl flex justify-center">
            {{ session('signupSuccess') }}
        </div>
    @endif

    @if (session()->has('loginFailed'))
        <div class="text-red-500 font-medium text-xl flex justify-center">
            {{ session('loginFailed') }}
        </div>
    @endif

    <div class="flex justify-center">
        <div class="w-1/2 bg-white">
            <div class="p-8">
                <form action="/login" method="POST" enctype="multipart/form-data">
                    @csrf

                    <label class="mt-2">Email</label><br>
                    <input type="text" name="email" placeholder="Your email" value="{{ old('email') }}"
                        class="mt-2 mb-2 outline outline-gray-200 outline-1 focus:outline-none rounded-lg p-2 focus:ring focus:ring-blue-700 w-full">

                    <label class="mt-2">Password</label><br>
                    <input type="password" name="password" placeholder="Your password"
                        class="mt-2 mb-2 outline outline-gray-200 outline-1 focus:outline-none rounded-lg p-2 focus:ring focus:ring-blue-700 w-full">

                    <button class="mt-6 bg-blue-700 text-white font-medium px-6 py-2 rounded-lg" type="submit">Log
                        In</button>
                </form>
            </div>
        </div>
    </div>
@endsection
