@extends('layout/master2')
@section('address', 'Add Distributor')
@section('content')
    <div class="md:ml-60 login">
        <div class="flex justify-between">
            <h3 class="p-5 font-semibold text-lg underline text-blue-700     hover:text-blue-900">
                <span class="fas fa-user"></span>
                <a>Admin Login</a>
            </h3>
        </div>
        @if ($errors->any())
            <div class="text-red-700 ml-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="admin-login" method="POST" name="myForm" id="addForm">
            @csrf
            <div class="flex flex-col md:w-1/2">
                <label for="email" class="leading-10 pl-2">Email:</label>
                <input type="email" value="{{ old('email') }}" name="email"
                    class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                    placeholder="Email" required>
            </div>

            <div class="flex flex-col md:w-1/2">
                <label for="password" class="leading-10 pl-2">Password:</label>
                <input type="password" value="{{ old('password') }}" name="password"
                    class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                    placeholder="Password" required>

            </div>


            <div class="flex flex-col md:w-1/2 mt-2">
                <button class="bg-blue-700 hover:bg-blue-900 font-bold text-white -mr-2 ml-2 py-2 rounded"
                    type="submit">Login</button><br>
            </div>
        </form>
    </div>
@endsection
