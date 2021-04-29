@extends('layout/admin-master')
@section('title', 'Admin Dashboard')
@section('content')
    <div class="bg-white rounded-xl mt-4 px-2" style="width: 88%; margin:auto;">

        <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />

        <h1 class="text-4xl text-gray-700 font-bold m-4 pt-4">Employees List</h1>

        <div class="flex md:justify-end justify-start">

            <a href="/admin/register">

                <button class="mt-2 mr-2 bg-blue-700 hover:bg-blue-900 text-white font-bold  px-1 rounded">New <i
                        class="fas fa-plus"></i></button>
            </a>

            <form action="admin">
                <input type="search" placeholder="Search.." name="search" value="{{ request('search') }}"
                    class="rounded border-none bg-gray-100">
            </form>
        </div>

        <span class="ml-60 font-bold" id="success" style="color:green; display:none;">
            Employee Record Deleted Successfully...!!!
        </span>
        <span class="ml-60 font-bold" id="danger" style="color:red; display:none;">
            Employee Record Not Deleted...!!!
        </span>

        <table class="table-fixed w-full">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        ID</th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Name</th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Email</th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Salary</th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Leaves</th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Image</th>
                    <th
                        class=" hidden md:table-cell px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Joining Date</th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            @forelse ($data as $record)
                <tbody>
                    <tr id="demo">
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->id }}</td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->name }}</td>

                        <td style="overflow-wrap:anywhere;" class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $record->email }}</td>
                        <td style="overflow-wrap:anywhere;" class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $record->salary }}</td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->leaves }}</td>


                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">

                            @if ($record->image == '')

                                <img src="/images/avatar4.jpg" height="100px" width="100px"
                                    class="rounded-3xl inline-block">

                            @else
                                <img src="{{ asset('images/' . $record->image) }}" alt="image" height="100px"
                                    width="100px">

                            @endif
                        </td>

                        <td title="{{ $record->joining_date }}" style="overflow-wrap:anywhere;"
                            class="hidden md:table-cell  px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $record->created_at->diffForHumans() }}
                        </td>


                        {{-- code fo dropdown Operations --}}

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">

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
                                    <li class=""><a class="pr-20 hover:bg-white block px-2 rounded hover:underline"
                                            href="{{ '/admin/edit-user/' . $record->id }}">
                                            Edit</a>
                                    </li>
                                    <li class=""><button style="outline:none;"
                                            class="pr-20 hover:bg-white px-2 rounded hover:underline"
                                            onclick="DeleteEmployee({{ $record->id }})">
                                            Delete</button>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tbody>

            @empty
                <tr>
                    <td colspan="7" class="text-center py-4">No records found.</td>
                </tr>
            @endforelse
        </table>

        <script>
            function DeleteEmployee(id) {
                var token = document.getElementById('csrf-token').value;

                if (confirm("Do you Really Want to Delete Employee?")) {
                    $.ajax({
                        type: 'get',
                        url: '/admin/delete-employee/' + id,
                        data: {
                            _token: token
                        },
                        success: function(response) {
                            document.getElementById("success").style.display = ""
                            $('#demo_' + id).remove();
                        },
                        error: function(res) {
                            document.getElementById("danger").style.display = ""
                        }
                    });

                }

            }

        </script>
        <span>
            {{ $data->links() }}
        </span>
    </div>
@endsection
