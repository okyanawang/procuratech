@extends('layout')

@section('content')
    <div class="drawer drawer-mobile">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">
            <div class="p-3 lg:p-10 mt-16">
                @yield('admin-content')
            </div>
            <x-Footer class="sticky bottom-0" />
        </div>
        <div class="drawer-side">
            <label for="my-drawer-2" class="drawer-overlay"></label>
            <ul class="menu p-4 overflow-y-auto w-80 bg-base-200 text-base-content mt-16">
                <!-- Sidebar content here -->
                {{-- <li><a href=""><i class="fa-solid fa-house"></i>Dashboard</a></li> --}}
                <li class="my-1"><a href="{{ route('admin.dashboard') }}"
                        class="py-5 {{ Request::is('admin/dashboard') ? 'active' : null }}"><i
                            class="fa-solid fa-house"></i>Dashboard</a></li>
                <li class="my-1"><a href="{{ route('admin.component') }}"
                        class="py-5 {{ Request::is('admin/component') ? 'active' : null }}"><i
                            class="fa-solid fa-puzzle-piece"></i>Components</a></li>
                <li class="my-1"><a href="{{ route('admin.work') }}"
                        class="py-5 {{ Request::is('admin/work') ? 'active' : null }}"><i
                            class="fa-solid fa-briefcase"></i>Works</a></li>
                <li class="my-1"><a href="{{ route('admin.staf') }}"
                        class="py-5 {{ Request::is('admin/staf') ? 'active' : null }}"><i
                            class="fa-solid fa-people-group"></i>Stafs</a></li>
                <li class="mt-auto">
                    <form {{-- action="{{ route('logout') }}" --}} method="POST" class="w-full bg-error text-accent-content p-0">
                        @csrf
                        <button type="submit" value="Logout" class="gap-x-3 w-full px-4 py-5">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </button>
                    </form>
                </li>
                {{-- <li class="my-1"><a href="{{ route('admin.books') }}"
                        class="py-5 {{ Request::is('admin/books') ? 'active' : null }} {{ Request::is('admin/books/*') ? 'active' : null }}"><i
                            class="fa-solid fa-book"></i>Kelola Buku</a></li>
                <li class="my-1"><a href="{{ route('admin.users') }}"
                        class=" py-5 {{ Request::is('admin/users') ? 'active' : null }} {{ Request::is('admin/users/*') ? 'active' : null }}"><i
                            class="fa-solid fa-users"></i>Kelola User</a></li>
                <li class="my-1"><a href="{{ route('admin.borrowings') }}"
                        class=" py-5 {{ Request::is('admin/borrowings') ? 'active' : null }}"><i
                            class="fa-brands fa-leanpub"></i>Kelola Peminjaman</a></li>
                <li class="my-1"><a href="{{ route('admin.news') }}"
                        class=" py-5 {{ Request::is('admin/news') ? 'active' : null }}"><i
                            class="fa-solid fa-newspaper"></i>Kelola Berita</a></li>
                <li class="my-1"><a href="{{ route('admin.settings') }}"
                        class=" py-5 {{ Request::is('admin/settings') ? 'active' : null }}"><i
                            class="fa-solid fa-gear"></i>Pengaturan</a></li>
                <li class="mt-auto">
                    <form action="{{ route('logout') }}" method="POST" class="w-full bg-error text-accent-content p-0">
                        @csrf
                        <button type="submit" value="Logout" class="gap-x-3 w-full px-4 py-5">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </button>
                    </form>
                </li> --}}
            </ul>

        </div>
    </div>

    {{-- <script src="{{ asset('logic/autoreload.js') }}"></script> --}}
@endsection
