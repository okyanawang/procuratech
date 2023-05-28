@extends('layout')

@section('content')
    <div class="drawer drawer-mobile">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">
            <div class="p-3 lg:p-10 mt-16">
                @yield('petugasInventori-content')
            </div>
            <x-Footer class="sticky bottom-0" />
        </div>
        <div class="drawer-side">
            <label for="my-drawer-2" class="drawer-overlay"></label>
            <ul class="menu p-4 overflow-y-auto w-80 bg-base-200 text-base-content mt-16">
                <!-- Sidebar content here -->
                <li class="my-1"><a href="{{ route('inventori.dashboard') }}"
                        class="py-5 {{ Request::is('inventori/dashboard') ? 'active' : null }}"><i
                            class="fa-solid fa-house"></i>Dashboard</a></li>
                <li class="my-1"><a href="{{ route('inventori.item') }}"
                        class="py-5 {{ Request::is('inventori/item') ? 'active' : null }}"><i
                            class="fa-solid fa-puzzle-piece"></i>Items</a></li>
                <li class="mt-auto">
                    <form action="{{ route('logout') }}" method="POST" class="w-full bg-error text-accent-content p-0">
                        @csrf
                        <button type="submit" value="Logout" class="gap-x-3 w-full px-4 py-5">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>

        </div>
    </div>
@endsection
