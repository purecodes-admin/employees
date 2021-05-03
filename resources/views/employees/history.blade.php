@extends('layout/master')
@section('title', 'Employee Dashboard')
@section('content')

    {{-- code for Remaining leaves --}}

    {{-- <h1 class="text-4xl text-gray-700 font-bold m-4">Payment Pending</h1> --}}
    <div class="overflow-y-scroll  mt-4 px-1 bg-white rounded-xl md:mr-20 h-96">
        <h1 class="text-2xl text-gray-700 font-bold m-4">Salary History</h1>
        <table class="w-auto leading-normal">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        ID</th>
                    <th
                        class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Employee Name</th>
                    <th
                        class="px-5 py-3 border-b-2  text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                        Salary</th>
                </tr>
            </thead>
            @foreach ($data as $salary)
                <tbody>
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $salary->id }}</td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $salary->name }}
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            {{ $salary->salary }}</td>
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>


@endsection
