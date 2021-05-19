@extends('layout/admin-master')
@section('title', 'Admin Dashboard')
@section('content')
    <div class="bg-white rounded-xl mt-4 px-2" style="width: 88%; margin:auto;">

        <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />

        <h1 class="text-4xl text-gray-700 font-bold m-4 pt-4">Increments History</h1>


        <div class="flex md:justify-end justify-start">

            <a href="/admin/register">

                {{-- <button class="mt-2 mr-2 bg-blue-700 hover:bg-blue-900 text-white font-bold  px-1 rounded">New <i
                        class="fas fa-plus"></i></button> --}}
            </a>

            {{-- <form action="increments">
                <input type="search" placeholder="Search.." name="search" value="{{ request('search') }}"
                    class="rounded border-none bg-gray-100">
            </form> --}}
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
                        Salary</th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Date & Time</th>

                </tr>
            </thead>
            @forelse ($data as $record)
                <tbody>
                    <tr id="demo">
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->id }}</td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $record->employee->name }}</td>

                        <td style="overflow-wrap:anywhere;" class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $record->salary }}</td>
                        <td style="overflow-wrap:anywhere;" class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $record->created_at->diffForHumans() }}</td>


                    </tr>
                </tbody>

            @empty
                <tr>
                    <td colspan="4" class="text-center py-4">No records found.</td>
                </tr>
            @endforelse
        </table>


        <span>
            {{ $data->links() }}
        </span>
    </div>
@endsection
