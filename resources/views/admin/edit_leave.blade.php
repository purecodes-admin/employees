@extends('layout/admin-master')
@section('address', 'Add Distributor')
@section('content')

    <h3 style="width: 88%; margin:auto;" class="p-5 font-semibold text-lg underline text-blue-700     hover:text-blue-900">
        <span class="fas fa-user"></span>
        <a>Add Leaves</a>
        <span class="ml-60 font-bold" id="success" style="color:green; display:none;">
            Record Updated Successfully...!!!
        </span>
        <span class="ml-60 font-bold" id="danger" style="color:red; display:none;">
            Record Not Updated...!!!
        </span>
    </h3>
    <div id="errors"></div>
    {{-- <span id="email" style="color:red; display:none;"> --}}
    {{-- The email has already been taken.!!! --}}
    {{-- </span> --}}

    <div style="width: 88%; margin:auto;">
        <form enctype="multipart/form-data" name="myForm" id="addForm">
            @csrf
            <input type="hidden" name="id" value="{{ $leave->id }}">
            <div class="flex flex-col md:w-1/2">
                <label for="days" class="leading-10 pl-2 ml-2">Days:</label>
                <input type="text" name="days" value="{{ old('days', $leave->days) }}"
                    class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600 "
                    placeholder="Days">

                <span class="ml-4 font-bold error" id="daysmsg" style="color:Red;display:none">Days must be
                    filled
                    out!</span>

                <span class="ml-4 error font-bold" id="daysmsg1" style="color:Red;display:none">Days
                    must be filled
                    out in digits only!</span>
            </div>


            <div class="flex flex-col md:w-1/2">
                <label for="leave_from" class="leading-10 pl-2 ml-2">Leave From</label>
                <input type="date" value="{{ old('leave_from', $leave->leave_from) }}" name="leave_from"
                    class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                    placeholder="">
                <span class="ml-4 font-bold error" id="leave_frommsg" style="color:Red;display:none">Must Select From Date!
                </span>
            </div>


            <div class="flex flex-col md:w-1/2">
                <label for="leave_to" class="leading-10 pl-2 ml-2">Leave To</label>
                <input type="date" value="{{ old('leave_to', $leave->leave_to) }}" name="leave_to"
                    class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                    placeholder="">

                <span class="ml-4 font-bold error" id="leave_tomsg" style="color:Red;display:none">Must Select To
                    Date!</span>
            </div>


            <div class="flex flex-col md:w-1/2 mt-2">
                <button class="disabled:opacity-50 bg-blue-700 hover:bg-blue-900 font-bold text-white ml-2 py-2 rounded"
                    type="submit" onclick="return validateForm(this)">Update</button><br>
            </div>
        </form>
    </div>





    <script>
        function validateForm(e) {
            window.setTimeout("document.getElementById('success').style.display='none';", 3000);
            window.setTimeout("document.getElementById('danger').style.display='none';", 3000);

            for (let el of document.querySelectorAll('.error')) el.style.display = 'none';

            var token = document.forms["myForm"]["_token"].value;
            var id = document.forms["myForm"]["id"].value;
            var days = document.forms["myForm"]["days"].value;
            if (days == "") {
                document.getElementById("daysmsg").style.display = ""
                return false;
            }

            var days = document.forms["myForm"]["days"].value;
            if (isNaN(days)) {
                document.getElementById("daysmsg1").style.display = ""
                return false;
            }


            var leave_from = document.forms["myForm"]["leave_from"].value;
            if (leave_from == "") {
                document.getElementById("leave_frommsg").style.display = ""
                return false;
            }

            var leave_to = document.forms["myForm"]["leave_to"].value;
            if (leave_to == "") {
                document.getElementById("leave_tomsg").style.display = ""
                return false;
            }


            $(e).prop('disabled', true);
            $.ajax({
                type: 'POST',
                url: '/admin/update-leave',
                data: {
                    days: days,
                    leave_from: leave_from,
                    leave_to: leave_to,
                    _token: token,
                    id: id
                },
                success: function(response) {
                    document.getElementById("success").style.display = ""
                    $("#addForm").trigger("reset");
                },
                error: function(res) {
                    document.getElementById("danger").style.display = ""
                },
                complete: function(res) {
                    $(e).prop('disabled', false);
                }
            });

            return false;

        }

    </script>
@endsection
