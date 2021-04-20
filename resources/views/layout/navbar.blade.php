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

                <div class="flex items-center justify-between">
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
                <div :class="open ? 'block' : 'hidden'" class="flex flex-col text-left md:block md:text-right md:mt-0">
                    <a href="/items/home" class=" menu mt-3 md:mx-3  text-gray-200">Home

                    </a>
                    <a href="/customers" class=" menu mt-3 md:mx-3   text-gray-200">Customers</a>
                    <a href="/items" class="menu mt-3 md:mx-3   text-gray-200">Items</a>
                    <a href="/inventories" class=" menu mt-3 md:mx-3  text-gray-200">Inventory</a>
                    <a href="/users/my-invoices" class=" menu mt-3 md:mx-3  text-gray-200">Invoices</a>
                    <a href="/users/Userbilling" class=" menu mt-3 md:mx-3  text-gray-200">Billings</a>

                    <div class=" dropdown relativemt-3 md:mx-3 hover:text-red-500 font-bold inline-block">

                        @if (Auth::user()->image == '')

                            <img src="/images/avatar4.jpg" height="30px" width="30px" class="rounded-3xl inline-block">

                        @else

                            <img src="{{ asset('images/' . Auth::user()->image) }}" alt="" height="30px" width="30px"
                                class="rounded-3xl inline-block">

                        @endif


                        <a class="inline-block">
                            <svg class="fill-current h-4 w-4 inline-block" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </a>



                        <ul class="dropdown-menu absolute hidden text-gray-200 bg-blue-700 rounded-b-xl"><br>

                            <li class=""><a class="block px-4 py-2 text-sm hover:bg-gray-400 font-normal"
                                    href="/users/set-password"> <span class="fas fa-exchange-alt"></span> Change
                                    Password</a></li>
                            <li class="">
                                <a class="block px-4 py-2 text-sm  hover:bg-gray-400 font-normal" href="/users/image">
                                    <span class="	fas fa-cloud-upload-alt"></span>
                                    Upload
                                    Profile
                                </a>
                            </li>
                            <li class=""><a class="block px-4 py-2 text-sm hover:bg-gray-400 font-normal"
                                    href="/users/edit"><span class="fas fa-user-edit mr-1"></span>Edit
                                    Profile
                                </a>
                            </li>

                            <li class=""><a class="block px-4 py-2 text-sm hover:bg-gray-400 font-normal"
                                    href="/users/expenses"><span class="	fas fa-dollar-sign mr-1"></span>
                                    Expenses
                                </a>
                            </li>

                            <li class=""><a class="block px-4 py-2 text-sm hover:bg-gray-400 font-normal"
                                    href="/users/distributors-tags"><span class="fas fa-file-invoice mr-1"></span>
                                    Tags
                                </a>
                            </li>

                            <!-- Authentication -->
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <a class="block px-4 py-2 text-sm font-normal  hover:bg-gray-400"
                                        href="route('logout')" onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                        <span class="fas fa-sign-out-alt mr-1"></span>{{ __('Logout') }}
                                    </a>
                            </li>

                        </ul>
                        </form>
                    </div>
                    {{-- Logout --}}



                </div>
            </div>
        </div>
    </header>
</div>

{{-- code for active menu --}}

<script>
    var currentLocation = location.href;
    var menuItem = document.querySelectorAll('a');
    var menuLength = menuItem.length
    for (let i = 0; i < menuLength; i++) {
        if (menuItem[i].href === currentLocation) {
            menuItem[i].className = "active"
        }
    }

</script>

<script>
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

</script>
