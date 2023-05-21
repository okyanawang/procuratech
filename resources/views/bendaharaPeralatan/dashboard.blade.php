@extends('bendaharaPeralatan.drawer')

@section('bendaharaPeralatan-content')
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
                            <div class="stat-title font-bold uppercase">Total Proyek</div>
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

                </div>
            </div>
        </div>

    </div>
@endsection
