@extends('layout')

@section('container')
<div class="flex justify-center">
    <h1 class="text-3xl font-bold mb-8">Register for an account</h1>
</div>

<div class="flex justify-center">
    <div class="w-1/2 bg-white">
        <div class="p-8">
            <form action="/register" method="POST" enctype="multipart/form-data">
                @csrf

                <label class="mt-2">Email</label><br>
                @error('email')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <input type="text" name="email" placeholder="Your email" value="{{ old('email') }}"
                    class="mt-2 mb-2 outline outline-gray-200 outline-1 focus:outline-none rounded-lg p-2 focus:ring focus:ring-blue-700 w-full">

                <label class="mt-2">Full name</label><br>
                @error('fullname')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <input type="text" name="fullname" placeholder="Your full name" value="{{ old('fullname') }}"
                    class="mt-2 mb-2 outline outline-gray-200 outline-1 focus:outline-none rounded-lg p-2 focus:ring focus:ring-blue-700 w-full">

                <label class="mt-2">Country</label><br>
                @error('country_code')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <select name="country_code" class="mt-2 mb-2 border rounded-lg p-2 w-full">
                    <option value="ID">Indonesia</option>
                </select>

                <label class="mt-2">Province</label><br>
                @error('province')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <select name="province" class="mt-2 mb-2 border rounded-lg p-2 w-full">
                    <option value="Jawa Timur">Jawa Timur</option>
                </select>

                <label class="mt-2">City</label><br>
                @error('city')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <select name="city" class="mt-2 mb-2 border rounded-lg p-2 w-full">
                    <option value="Surabaya">Surabaya</option>
                    <option value="Surabaya">Pasuruan</option>
                    <option value="Surabaya">Probolinggo</option>
                    <option value="Banyuwangi">Banyuwangi</option>
                    <option value="Banyuwangi">Malang</option>
                </select>

                <label class="mt-2">Password (min. 6 characters)</label><br>
                @error('password')
                    <span class="text-red-400">{{ $message }}</span>
                @enderror
                <input type="password" name="password" placeholder="Your password"
                    class="mt-2 mb-2 outline outline-gray-200 outline-1 focus:outline-none rounded-lg p-2 focus:ring focus:ring-blue-700 w-full">

                <button class="mt-6 bg-blue-700 text-white font-medium px-6 py-2 rounded-lg" type="submit">Sign
                    Up</button>
            </form>
        </div>
    </div>
</div>
@endsection
