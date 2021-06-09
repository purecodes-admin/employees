@extends(auth()->user()->set_as ? 'layout/admin-master' : 'layout/master')

@section('address', 'Upload Profile')
@section('content')

    <h3 class="p-5 font-semibold text-lg underline text-blue-700  hover:text-blue-900" style="width: 88%; margin:auto;">
        <span class="fas fa-user"></span>
        <a>Update Image</a>
    </h3>


    {{-- code for success message --}}
    @if (Session::has('profile'))
        <div class="flex justify-between md:w-2/6 text-green-800 px-3 py-3 rounded-md font-bold  text-center mx-auto"
            style="background-color: #F2FAF7;">
            <p class="self-center">
                <span class="fas fa-check-circle" style="color: #32C48D;"></span> Success!
                {{ Session::get('profile') }}
            </p>
            <strong class="self-center text-2xl cursor-pointer alert-del" style="color: #32C48D;">
                &times;
            </strong>
        </div>
    @endif


    <div id="errors"></div>
    <div style="width: 88%; margin:auto;">
        <form method="Post" action="upload" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col md:w-1/2">
                <label for="image" class="leading-10 pl-2 ml-4">Image:</label>

                <img id="preimage" alt="" height="200px" width="200px"
                    class="rounded-3xl inline-block border-gray-300 ml-2 px-4 py-2 focus:border-gray-900"
                    src="{{ asset('images/avatar4.jpg') }}"><br>

                <input type="file" name="image"
                    class=" ml-2 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                    required onchange="loadfile(event)">

            </div>


            <div class="flex flex-col md:w-1/2 mt-2">
                <button class="bg-blue-700 hover:bg-blue-900 font-bold text-white ml-2 py-2 rounded" type="submit">Upload
                    Image</button><br>
            </div>
        </form>
    </div>




    {{-- code for close alert --}}
    <script>
        var alert_del = document.querySelectorAll('.alert-del');

        alert_del.forEach((x) => {
            x.addEventListener('click', () =>
                x.parentElement.classList.add('hidden')
            );
        });


        // code for pre image while uploading image

        function loadfile(event) {
            var output = document.getElementById('preimage');
            output.src = URL.createObjectURL(event.target.files[0]);
        }

    </script>

@endsection
