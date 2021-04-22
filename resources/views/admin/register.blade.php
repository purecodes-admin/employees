@extends('layout/admin-master')
@section('address', 'Add Distributor')
@section('content')

    {{-- code for breadcrumbs --}}
    <style>
        ul.breadcrumbs li+li :before {
            padding: 8px;
            color: black;
            content: "/\00a0";
        }

    </style>
    <div style="width: 88%; margin:auto;">
        <ul class="flex p-3 bg-gray-200 breadcrumbs">
            <li class="mr-2 text-gray-700 hover:text-gray-900">
                <a href="../admin" class="hover:underline">Employees</a>
            </li>
            <li class="text-blue-700 hover:text-blue-900">
                <a href="">Register Employees</a>
            </li>
        </ul>
    </div>

    <h3 style="width: 88%; margin:auto;" class="p-5 font-semibold text-lg underline text-blue-700     hover:text-blue-900">
        <span class="fas fa-user"></span>
        <a>Register Employees</a>
    </h3>
    <div id="errors"></div>
    {{-- <span id="email" style="color:red; display:none;"> --}}
    {{-- The email has already been taken.!!! --}}
    {{-- </span> --}}

    <div style="width: 88%; margin:auto;">
        <form action="register" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex">
                <div class="flex flex-col md:w-1/2">
                    <label for="name" class="leading-10 pl-2 ml-2">Name:</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 "
                        placeholder="Name" required>
                </div>


                <div class="flex flex-col md:w-1/2">
                    <label for="email" class="leading-10 pl-2 ml-4">Email:</label>
                    <input type="email" value="{{ old('email') }}" name="email"
                        class=" ml-4 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                        placeholder="Email" required>
                    @error('email')
                        <span class="text-red-600 ml-4 font-bold text-sm">** {{ $message }}</span>
                    @enderror
                </div>
            </div>


            <div class="flex">
                <div class="flex flex-col md:w-1/2">
                    <label for="password" class="leading-10 pl-2 ml-2">Password:</label>
                    <input type="password" value="{{ old('password') }}" name="password"
                        class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                        placeholder="Password" required>
                    @error('password')
                        <span class="text-red-600 ml-4 font-bold text-sm">** {{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col md:w-1/2">
                    <label for="password_confirmation" class="leading-10 pl-2 ml-4">Confirm Password:</label>
                    <input type="password" value="{{ old('password_confirmation') }}" name="password_confirmation"
                        class=" ml-4 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                        placeholder="Confirm Password" required>
                    @error('password')
                        <span class="text-red-600 ml-4 font-bold text-sm">** {{ $message }}</span>
                    @enderror
                </div>
            </div>


            <div class="flex">
                <div class="flex flex-col md:w-1/2">
                    <label for="contact" class="leading-10 pl-2 ml-2">Contact No:</label>
                    <input type="text" value="{{ old('contact') }}" name="contact"
                        class="ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                        placeholder="Contact" required>
                    @error('contact')
                        <span class="text-red-600 ml-4 font-bold text-sm">** {{ $message }}</span>
                    @enderror

                </div>
                <div class="flex flex-col md:w-1/2">
                    <label for="image" class="leading-10 pl-2 ml-4">Image:</label>
                    <input type="file" name="image"
                        class=" ml-4 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                        required>

                </div>
            </div>


            <div class="flex flex-col md:w-1/2 mt-2">
                <button class="bg-blue-700 hover:bg-blue-900 font-bold text-white ml-2 py-2 rounded"
                    type="submit">Add</button><br>
            </div>
        </form>
    </div>
@endsection
