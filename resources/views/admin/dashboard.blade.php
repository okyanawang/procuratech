@extends('admin.drawer')

@section('admin-content')
    <h1 class="text-4xl font-bold mb-10">Dashboard</h1>
    <div class="grid grid-cols-2 gap-5 mb-40">
        <div class="card shadow-2xl col-span-2 bg-primary">
            <div class="card-body">
                <h1 class="text-2xl font-bold mb-3 text-white">Halo, Username!</h1>
                <p class="text-primary-content">Have a good day!</p>
            </div>
        </div>
        <div class="card shadow-2xl lg:col-span-2 col-span-2 ">
            <div class="card-body justify-start lg:gap-0">
                <h1 class="text-2xl font-bold mb-5 text-neutral-content">Statistic</h1>
                <div class="stats stats-vertical md:stats-horizontal shadow">

                    <a class="hover:bg-base-300">
                        <div class="stat w-full">
                            <div class="stat-figure text-primary ">
                                <i class="fa-solid fa-users fa-2xl"></i>
                            </div>
                            <div class="stat-title font-bold uppercase">Total Staffs</div>
                            <div class="stat-value text-primary pb-2">30</div>
                            <div class="stat-desc">click for more details</div>

                        </div>
                    </a>

                    <a class="hover:bg-base-300">
                        <div class="stat w-full">
                            <div class="stat-figure text-primary">
                                <i class="fa-solid fa-puzzle-piece fa-2xl"></i>
                            </div>
                            <div class="stat-title font-bold uppercase">Total Components</div>
                            <div class="stat-value text-primary pb-2">20</div>
                            <div class="stat-desc">click for more details</div>
                        </div>
                    </a>

                </div>
                <div class="stats stats-vertical mt-3 md:stats-horizontal shadow">

                    <a class="hover:bg-base-300">
                        <div class="stat w-full">
                            <div class="stat-figure text-primary">
                                <i class="fa-solid fa-briefcase fa-2xl"></i>
                            </div>
                            <div class="stat-title font-bold uppercase">Total Works</div>
                            <div class="stat-value text-primary pb-2">30</div>
                            <div class="stat-desc">click for more details</div>

                        </div>
                    </a>

                    {{-- <a class="hover:bg-base-300">
                        <div class="stat w-0">
                            <div class="stat-figure text-primary">
                                <i class="fa-solid fa-newspaper fa-2xl"></i>
                            </div>
                            <div class="stat-title font-bold uppercase">Total Components</div>
                            <div class="stat-value text-primary pb-2">20</div>
                            <div class="stat-desc">click for more details</div>
                        </div>
                    </a> --}}

                </div>
            </div>
        </div>
        {{-- <div class="card shadow-2xl lg:col-span-1 col-span-2">
            <div class="card-body justify-between gap-0">
                <h1 class="text-2xl font-bold mb-5 text-neutral">Notification</h1>
                <div class="grid md:grid-cols-2 grid-cols-1 gap-10 h-72">
                    <div class="indicator w-full lg:h-full">
                        <span
                            class="indicator-item badge badge-secondary px-3 py-4 border-4 border-base-100 font-bold text-lg">123</span>
                        <a class="w-full">
                            <button class="btn btn-neutral w-full h-full"><i
                                    class="fa-solid fa-users-slash fa-2xl mt-3"></i>&nbsp; User
                                Haven't done the work</button>
                        </a>
                    </div>
                    <div class="indicator w-full lg:h-full">
                        <span
                            class="indicator-item badge badge-secondary px-3 py-4 border-4  border-base-100 font-bold text-lg">123</span>
                        <a class="w-full">
                            <button class="btn btn-neutral w-full h-full"><i class="fa-solid fa-book fa-2xl mt-3"></i>&nbsp;
                                total buku
                                belum dikembalikan</button>
                        </a>
                    </div>
                </div>
            </div>

        </div> --}}
    </div>
@endsection
