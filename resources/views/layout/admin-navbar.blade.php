<style>
    body {
        /* font-family: "Montserrat"; */
        font-size: 16px;
    }

    .menu {
        font-size: 14px;
        letter-spacing: 1px;
        font-weight: normal;

    }

    .dropdown:hover .dropdown-menu {
        display: block;
    }

    a.active {
        font-weight: bold;
        font-size: 14px;
        letter-spacing: 1px;
    }

    a:hover {
        font-weight: bold;
    }

</style>



<div id="app" class="py-8">
    <header>
        <div class="fixed inset-x-0 top-0 text-white bg-blue-700 px-10 md:flex md:items-center md:justify-between">

            {{-- mobile Menu is here --}}
            <div class="flex justify-between">

                <div id="myDiv" class="flex items-center justify-between">
                    <div class="-ml-2 md:ml-16">@include('layout.logo')</div>
                    <a href="/dashboard" class="mt-3 md:mx-3 text-gray-200 hover:text-white font-light text-xl">
                    </a>
                    <div class="md:hidden align-middle">
                        <i class="material-icons align-middle cursor-pointer" @click.prevent="toogle"></i>
                    </div>
                </div>

                {{-- mobile Menu is here --}}


                <div class="md:hidden mt-4">
                    <button class="moblie-menu-button" style="outline: none;">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>


            {{-- Desktop Menu Code Here --}}

            <div class="hidden md:block mobile-menu mr-16">
                <div :class="open ? 'block' : 'hidden'"
                    class="flex flex-col text-left md:block md:text-right mt-3 md:mt-0">
                    <a href="/admin" class="menu mt-3 md:mx-3   text-gray-200">Employees</a>
                    <a href="/admin/increments" class="menu mt-3 md:mx-3   text-gray-200">Increments History</a>
                    <a href="/admin/leaves" class="menu mt-3 md:mx-3   text-gray-200">Leaves</a>
                    {{-- <a href="/users/logout" class="menu mt-3 md:mx-3   text-gray-200">Logout</a> --}}
                    <div class=" dropdown relativemt-3 md:mx-3 hover:text-red-500 font-bold inline-block">
                        @if (Auth::user()->image == '')

                            <img src="/images/avatar4.jpg" height="30px" width="30px" class="rounded-3xl inline-block">

                        @else
                            <img src="{{ asset('images/' . Auth::user()->image) }}" height="30px" width="30px"
                                class="rounded-3xl inline-block">

                        @endif


                        <a class="inline-block">
                            <svg class="fill-current h-4 w-4 inline-block" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </a>



                        <ul class="dropdown-menu absolute hidden text-gray-200 bg-blue-700 rounded-xl"><br>

                            <li class=""><a class="block px-4 py-2 text-sm hover:bg-gray-400 font-normal"
                                    href="/users/set-password"> <span class="fas fa-exchange-alt"></span> Change
                                    Password</a></li>
                            <li class="">
                                <a class="block px-4 py-2 text-sm  hover:bg-gray-400 font-normal" href="/users/image">
                                    Upload
                                    Profile
                                </a>
                            </li>

                            <li class=""><a class="block px-4 py-2 text-sm hover:bg-gray-400 font-normal"
                                    href="/users/edit"><span class="fas fa-user-edit mr-1"></span>Edit
                                    Profile
                                </a>
                            </li>
                            <li class="">
                                <a class="block px-4 py-2 text-sm  hover:bg-gray-400 font-normal" href="/admin/logout">
                                    Logout
                                </a>
                            </li>
                            {{-- <li class="">
                            <a class="block px-4 py-2 text-sm hover:bg-gray-400 font-extrabold"
                                href="/users/set-password">Edit
                                Profile
                            </a>
                        </li> --}}

                            <!-- Authentication -->
                            {{-- <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a class="block px-4 py-2 text-sm font-extrabold  hover:bg-gray-400"
                                    href="route('logout')" onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                    {{ __('Logout') }}
                                </a>
                        </li> --}}


                            </form>
                        </ul>
                    </div>
                    {{-- Logout --}}

                </div>
            </div>
        </div>
    </header>
</div>


<script>
    // Add active class to the current menu (highlight it)
    // Get the container element
    var menuContainer = document.getElementById("myDiv");

    // Get all buttons with class="btn" inside the container
    var menu = menuContainer.getElementsByClassName("menu");

    // Loop through the buttons and add the active class to the current/clicked button
    for (var i = 0; i < menu.length; i++) {
        menu[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");

            // If there's no active class
            if (current.length > 0) {
                current[0].className = current[0].className.replace(" active", "");
            }

            // Add the active class to the current/clicked button
            this.className += " active";
        });
    }

</script>

<script>
    $('.myDiv').on('click', 'li', function() {
        $(this).addClass('active').siblings().removeClass('active');
    });




    $('.myDiv').on('click', 'li', function() {
        $(this).addClass('active').siblings().removeClass('active');
    });

    // grab everthing we need for mobile menu

    var btn = document.querySelector("button.moblie-menu-button");
    var menu = document.querySelector(".mobile-menu");

    // add event listener
    btn.addEventListener("click", () => {
        menu.classList.toggle("hidden");

    });




    // code for active menu 


    var currentLocation = location.href;
    var menuItem = document.querySelectorAll('a');
    var menuLength = menuItem.length
    for (let i = 0; i < menuLength; i++) {
        if (menuItem[i].href === currentLocation) {
            menuItem[i].className = "active"
        }
    }

</script>
