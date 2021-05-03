@extends('layout/admin-master')
@section('address', 'Add Distributor')
@section('content')

    <h3 style="width: 88%; margin:auto;" class="p-5 font-semibold text-lg underline text-blue-700     hover:text-blue-900">
        <span class="fas fa-user"></span>
        <a>Add Employees</a>
        <span class="ml-60 font-bold" id="success" style="color:green; display:none;">
            Employee Added Successfully...!!!
        </span>
        <span class="ml-60 font-bold" id="danger" style="color:red; display:none;">
            Employee Submittion Failed...!!!
        </span>
    </h3>
    <div id="errors"></div>
    {{-- <span id="email" style="color:red; display:none;"> --}}
    {{-- The email has already been taken.!!! --}}
    {{-- </span> --}}

    <div style="width: 88%; margin:auto;">
        <form enctype="multipart/form-data" name="myForm" id="addForm">
            @csrf
            <div class="flex">


                <span class="ml-4 font-bold error" id="salarymsg" style="color:Red;display:none">Salary must be
                    filled
                    out!</span>

                <span class="ml-4 error font-bold" id="salarymsg1" style="color:Red;display:none">Salary
                    must be filled
                    out in digits only!</span>
            </div>



    </div>


    <div class="flex">
        <div class="flex flex-col md:w-1/2">
            <label for="leaves" class="leading-10 pl-2 ml-2">Leaves</label>
            <input type="text" value="{{ old('leaves') }}" name="leaves"
                class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                placeholder="Leaves">

            <span class="ml-4 font-bold error" id="leavesmsg" style="color:Red;display:none">Leaves must be
                filled
                out!</span>

            <span class="ml-4 error font-bold" id="leavesmsg1" style="color:Red;display:none">Leaves
                must be filled
                out in digits only!</span>
        </div>
        <div class="flex flex-col md:w-1/2">
            <label for="remaining_leaves" class="leading-10 pl-2 ml-4">Remaining Leaves</label>
            <input type="text" value="{{ old('remaining_leaves') }}" name="remaining_leaves"
                class="ml-4 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                placeholder="Remaining Leaves">

            <span class="ml-4 font-bold error" id="remaining_leavesmsg" style="color:Red;display:none">Remaining
                Leaves must
                be
                filled
                out!</span>

            <span class="ml-4 error font-bold" id="remaining_leavesmsg1" style="color:Red;display:none">Remaining
                Leaves
                must be filled
                out in digits only!</span>

        </div>
    </div>


    <div class="flex flex-col md:w-1/2 mt-2">
        <button class="disabled:opacity-50 bg-blue-700 hover:bg-blue-900 font-bold text-white ml-2 py-2 rounded"
            type="submit" onclick="return validateForm(this)">Add</button><br>
    </div>
    </form>
    </div>





    <script>
        function validateForm(e) {
            window.setTimeout("document.getElementById('success').style.display='none';", 3000);
            window.setTimeout("document.getElementById('danger').style.display='none';", 3000);

            for (let el of document.querySelectorAll('.error')) el.style.display = 'none';

            var token = document.forms["myForm"]["_token"].value;
            var salary = document.forms["myForm"]["salary"].value;
            if (salary == "") {
                document.getElementById("salarymsg").style.display = ""
                return false;
            }

            var salary = document.forms["myForm"]["salary"].value;
            if (isNaN(salary)) {
                document.getElementById("salarymsg1").style.display = ""
                return false;
            }


            var joining = document.forms["myForm"]["joining"].value;
            if (joining == "") {
                document.getElementById("joiningmsg").style.display = ""
                return false;
            }

            var leaves = document.forms["myForm"]["leaves"].value;
            if (leaves == "") {
                document.getElementById("leavesmsg").style.display = ""
                return false;
            }

            var leaves = document.forms["myForm"]["leaves"].value;
            if (isNaN(leaves)) {
                document.getElementById("leavesmsg1").style.display = ""
                return false;
            }

            var remaining_leaves = document.forms["myForm"]["remaining_leaves"].value;
            if (remaining_leaves == "") {
                document.getElementById("remaining_leavesmsg").style.display = ""
                return false;
            }

            var remaining_leaves = document.forms["myForm"]["remaining_leaves"].value;
            if (isNaN(remaining_leaves)) {
                document.getElementById("remaining_leavesmsg1").style.display = ""
                return false;
            }




            $(e).prop('disabled', true);
            $.ajax({
                type: 'POST',
                url: 'add',
                data: {
                    salary: salary,
                    joining: joining,
                    leaves: leaves,
                    remaining_leaves: remaining_leaves,
                    _token: token
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
