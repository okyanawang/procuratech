<div class="navbar bg-base-100 fixed top-0 z-50">
    <div class="navbar-start flex-1">
        @if (Request::is('admin/*'))
            <label for="my-drawer-2" class="btn btn-circle btn-primary swap swap-rotate drawer-button lg:hidden">
                <!-- this hidden checkbox controls the state -->
                <input type="checkbox" class="hidden" />

                <!-- hamburger icon -->
                <svg class="swap-off fill-current" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                    viewBox="0 0 512 512">
                    <path d="M64,384H448V341.33H64Zm0-106.67H448V234.67H64ZM64,128v42.67H448V128Z" />
                </svg>

                <!-- close icon -->
                <svg class="swap-on fill-current" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                    viewBox="0 0 512 512">
                    <polygon
                        points="400 145.49 366.51 112 256 222.51 145.49 112 112 145.49 222.51 256 112 366.51 145.49 400 256 289.49 366.51 400 400 366.51 289.49 256 400 145.49" />
                </svg>

            </label>
        @endif
        <a href="/" class="btn btn-ghost normal-case text-xl">Procuratech</a>
    </div>
    <div class="navbar-end flex-none">
        <div class="flex flex-col text-right mx-5">
            <p class="font-bold capitalize mb-0">username</p>
            <p>role</p>
        </div>
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                <div class="w-10 rounded-full">
                    <img src="https://picsum.photos/200" />
                </div>
            </label>
            <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                <li>
                    <a class="justify-between">
                        Dashboard
                    </a>
                </li>
                <div class="divider my-0"></div>
                <li><a class="bg-red-500 text-white">Logout</a></li>
            </ul>
        </div>
    </div>
</div>
