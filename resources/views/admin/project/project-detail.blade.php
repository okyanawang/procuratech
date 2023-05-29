@extends('admin.drawer')

@section('admin-content')
    <div class="flex flex-row mb-10">
        <a href="javascript:history.back()" class="self-center">
            <i class="fa-solid fa-arrow-left fa-2xl"></i>
        </a>
        <h1 class="text-4xl font-bold ml-5"></h1>
    </div>

    <x-Alert />

    <h1 class="text-4xl font-bold mb-5">Project Detail</h1>

<<<<<<< HEAD
    <div class="container">
        <form action=" {{ route('admin.project.update', ['id' => $project->id]) }}" class="h-full px-0 md:px-14 mb-40" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex flex-col xl:flex-row gap-3 place-content-center">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 items-center w-full md:w-full xl:w-1/2 mb-5">
                    <label for="name" class="mr-3 font-semibold">Project Name :</label>
                    <input name="name" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="Project Name" required value="{{ $project->name }} " />
                    <label for="project-manager" class="mr-3 font-semibold">Project Manager :</label>
                    <input name="project-manager" type="text" class="input input-bordered w-full max-w-xs col-span-1" value="{{ $name_pm }}" required readonly />
                    <label for="description" class="font-semibold">Description :</label>
                    <input name="description" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        value="{{ $project->description }}" required />
                </div>
                <div class="grid grid-cols-2 grid-rows-3 gap-2 items-center w-full md:w-full xl:w-1/2 mb-5">
                    <label for="regis-date" class="font-semibold">Registration Date :</label>
                    <input name="regis-date" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                        value="{{ $project->registration_date }}" required readonly />
                    <label for="start_date" class="font-semibold">Start Date :</label>
                    <input name="start_date" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                        value="{{ $project->start_date->format('Y-m-d') }}" required />
                    <label for="end_date" class="font-semibold">Expectation Finish Date :</label>
                    <input name="end_date" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                        value="{{ $project->end_date->format('Y-m-d') }}" required />
                </div>
            </div>
            <div class="flex justify-center gap-5">
                <!-- The button to open modal -->
                <label for="modal-delete" class="btn btn-error mt-5 w-50 modal-button text-white"><i
                        class="fa-solid fa-trash"></i>&nbsp; Delete Project</label>
                <!-- The button to open modal -->
                <label for="modal-update" class="btn btn-primary mt-5 w-50 modal-button"><i
                        class="fa-regular fa-pen-to-square"></i>&nbsp; Update Project</label>

            </div>

            <!-- Put this part before </body> tag -->
            <input type="checkbox" id="modal-update" class="modal-toggle" />
            <div class="modal modal-bottom sm:modal-middle lg:pl-80">
                <div class="modal-box">
                    <h3 class="font-bold text-lg">Update data ?</h3>
                    <p class="py-4">Are you sure you want to update the project data? Data changes can be done anytime</p>
                    <div class="modal-action">
                        <label for="modal-update" class="btn btn-info">cancel</label>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </div>
            </div>

        </form>
        <input type="checkbox" id="modal-delete" class="modal-toggle" />
        <div class="modal modal-bottom sm:modal-middle lg:pl-80">
            <div class="modal-box">
                <h3 class="font-bold text-lg">Delete data?</h3>
                <p class="py-4">Are you sure you want to delete the project? It will also delete all their relation to location</p>
                <form action="{{ route('admin.project.delete', ['id' => $project->id]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="modal-action">
                        <label for="modal-delete" class="btn btn-info">cancel</label>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
        <label for="new-user" class="btn btn-success mb-5 w-full modal-button"><i class="fa-solid fa-user-plus"></i>&nbsp;
            Add new Locations</label>

        <!-- Put this part before </body> tag -->
        <input type="checkbox" id="new-user" class="modal-toggle" />
        <div class="modal modal-bottom lg:pl-80">
            <div class="modal-box w-8/12 max-w-5xl self-center rounded-lg">
                <h3 class="font-bold text-lg mb-10">Add new Location</h3>
                <form action="{{ route('admin.project.location.register') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col  gap-3">
                        <div class="grid grid-cols-3 gap-2 items-center">
                            <label for="location_name" class="mr-3 font-semibold">Location name :</label>
                            <input name="location_name" type="text" class="input input-bordered w-full col-span-2"
                                placeholder="location name" required />
                        </div>
                    </div>
                    <div class="modal-action flex justify-center gap-5">
                        <label for="new-user" class="btn btn-error">cancel</label>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>

        <div class="">
            {{-- <h1 class="text-2xl mb-5">Locations Data Recap</h1> --}}
            <h1 class="text-2xl font-bold mb-5">Locations List</h1>
            <div class="overflow-x-auto">
                <table id="myTable" class="table table-zebra w-full">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Locations name</th>
                            <th>Total Categories</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($locations as $key => $location)
                        <tr>
                            <th>{{ $key + 1}}</th>
                            <td>{{ $location->name }}</td>
                            <td>
                                {{ DB::table('categories')
                                    ->where('locations_id', '=', $location->id)
                                    ->count('categories.id') }}
                            </td>
                            <td>
                                <a href="{{ route('admin.project.location.detail', ['id' => $location->id]) }}">
                                    <button class="btn btn-info font-semibold">Detail</button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
