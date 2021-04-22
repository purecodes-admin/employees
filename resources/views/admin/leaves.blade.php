@extends('layout/master')
@section('title', 'Employees')
@section('content')

    <div class="bg-white rounded-xl mt-6  pt-1" style="width: 88%; margin:auto;">
        <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />


        <h1 class="text-4xl text-gray-700 font-bold pt-2 mt-4 ml-2 mb-2">
            <span class="fas fa-users"></span> Leaves Record
        </h1>

        {{-- code for success message --}}
        @if (Session::has('message'))
            <div class="flex justify-between md:w-2/6 text-green-800 px-3 py-3 rounded-md font-bold  text-center mx-auto"
                style="background-color: #F2FAF7;">
                <p class="self-center">
                    <span class="fas fa-check-circle" style="color: #32C48D;"></span> Success!
                    {{ Session::get('message') }}
                </p>
                <strong class="self-center text-2xl cursor-pointer alert-del" style="color: #32C48D;">
                    &times;
                </strong>
            </div>
        @endif

        {{-- code for error message --}}
        @if (Session::has('error'))
            <div class="flex justify-between md:w-2/6 text-red-800 px-3 py-3 rounded-md font-bold  text-center mx-auto"
                style="background-color: #FDF2F2;">
                <p class="self-center">
                    <span class="fas fa-check-circle" style="color: #F98A8A;"></span> Failed!
                    {{ Session::get('error') }}
                </p>
                <strong class="self-center text-2xl cursor-pointer alert-del" style="color: #F98A8A;">
                    &times;
                </strong>
            </div>
        @endif



        <div class="flex justify-start md:justify-end">
            <a href="/admin/leave">

                <button class="mt-2 mr-2 bg-blue-700 hover:bg-blue-900 text-white font-bold  px-1 rounded">New <i
                        class="fas fa-plus"></i></button>
            </a>
            <form action="/admin/leaves">
                <input type="search" placeholder="Search.." name="search" class="rounded border-none bg-gray-100 mr-10"
                    value="{{ request('search') }}">
            </form>
        </div>
        <table class="min-w-full table-fixed">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 border-b-2  text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        ID</th>
                    <th
                        class="px-5 py-3 border-b-2  text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Employee ID</th>
                    <th
                        class="px-5 py-3 border-b-2  text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Days</th>
                    <th
                        class="px-5 py-3 border-b-2  text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Leave From</th>
                    <th
                        class="px-5 py-3 border-b-2  text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Leave To</th>
                    <th
                        class="px-5 py-3 border-b-2  text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Has Approved</th>
                    <th
                        class="px-5 py-3 border-b-2  text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Date
                    </th>
                    <th
                        class="px-5 py-3 border-b-2  text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        actions
                    </th>
                </tr>
            </thead>
            @forelse ($data as $employee)
                <tbody>
                    <tr id="demo">
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">{{ $employee->id }}
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                            {{ $employee->employee_id }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                            {{ $employee->days }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                            {{ $employee->leave_from }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                            {{ $employee->leave_to }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                            {{ $employee->has_approved }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                            {{ $employee->created_at->diffForHumans() }}</td>

                        {{-- code fo dropdown Operations --}}

                        <td class="text-center px-5 py-5 border-b border-gray-200 bg-white text-sm">

                            <div class=" dropdown relativemt-3 md:mx-3 inline-block">
                                <div class="pb-1">
                                    <button class="bg-gray-200 rounded py-1 pl-2 pr-1" style="outline:none;"> Actions
                                        <a class=" inline-block">
                                            <svg class="fill-current h-4 w-4 inline-block"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path
                                                    d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                            </svg>
                                        </a>
                                    </button>
                                </div>



                                <ul class="leading-7 dropdown-menu absolute hidden bg-gray-200 rounded">

                                    <li class=""><a class="-ml-1 pr-20 hover:bg-white block px-2 rounded hover:underline"
                                            href="{{ '/admin/edit-leave/' . $employee['id'] }}">
                                            Edit</a>
                                    </li>
                                    <li class=""><a class="pr-20 hover:bg-white block px-2 rounded hover:underline"
                                            href="{{ '/admin/delete-leave/' . $employee['id'] }}">
                                            Delete</a>
                                    </li>

                                </ul>
                            </div>
                        </td>
                    </tr>
                </tbody>

            @empty
                <tr>
                    <td colspan="5" class="text-center py-4">No records found.</td>
                </tr>
            @endforelse
        </table>
        {{-- <span>
            {{ $data->links() }}
        </span> --}}
    </div>



    {{-- code for close alert --}}
    <script>
        var alert_del = document.querySelectorAll('.alert-del');

        alert_del.forEach((x) => {
            x.addEventListener('click', () =>
                x.parentElement.classList.add('hidden')
            );
        });

    </script>



@endsection
