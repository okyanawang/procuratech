@extends('pimpinanProject.drawer')

@section('pimpinanProject-content')
    <div class="flex flex-row mb-10">
        <a href="/pimpinan/project" class="self-center">
            <i class="fa-solid fa-arrow-left fa-2xl"></i>
        </a>
        <h1 class="text-4xl font-bold ml-5"></h1>
    </div>
    <h1 class="text-2xl font-bold mb-5">Projects Detail</h1>
    <x-Alert />

    <div class="container">
        <form action="{{ route('pimpinan.project.update', ['id' => $project_detail->id]) }}"
            class="h-full px-0 md:px-14 mb-10" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex flex-col xl:flex-row gap-3 place-content-center justify-between">
                <div class="grid grid-cols-1 mr-3 gap-2 items-center w-full md:w-full xl:w-1/3 mb-5">
                    <div class="avatar">
                        <div class="w-full rounded-xl">
                            <img src="{{ asset('project/' . $project_detail->image_path) }}" />
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 items-center w-full md:w-full xl:w-1/2 mb-5 self-center">
                    <label for="name" class="mr-3 font-semibold">Project name :</label>
                    <input name="name" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="Project Name" required value="{{ $project_detail->name }} " />
                    <label for="project_number" class="mr-3 font-semibold">Project Number :</label>
                    <input name="project_number" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="Project Number" required readonly value="{{ $project_detail->project_number }} " />
                    <label for="description" class="mr-3 font-semibold">Description:</label>
                    <textarea name="description" id="desc" cols="10" rows="5" class="textarea textarea-bordered" required>{{ $project_detail->description }}</textarea>
                    <label for="start_date" class="mr-3 font-semibold">Start date :</label>
                    <input name="start_date" type="date" class="input input-bordered w-full max-w-xs col-span-1" required
                        value="{{ \Carbon\Carbon::parse($project_detail->start_date)->format('Y-m-d') }}" />
                    <label for="end_date" class="mr-3 font-semibold">End date :</label>
                    <input name="end_date" type="date" class="input input-bordered w-full max-w-xs col-span-1" required
                        value="{{ \Carbon\Carbon::parse($project_detail->end_date)->format('Y-m-d') }}" />
                    <label for="image_path" class="mr-3 font-semibold">Upload photo :</label>
                    <input name="image_path" type="file" class="file-input file-input-bordered file-input-info">
                </div>
            </div>
            <div class="flex justify-center gap-5">
                <!-- The button to open modal -->
                <label for="modal-delete" class="btn btn-error mt-5 w-50 modal-button text-white"><i
                        class="fa-solid fa-trash"></i>&nbsp; Delete Project</label>
                <!-- The button to open modal -->
                <label for="modal-update" class="btn btn-primary mt-5 w-50 modal-button"><i
                        class="fa-regular fa-pen-to-square"></i>&nbsp; Update data</label>

            </div>
            <!-- Put this part before </body> tag -->
            <input type="checkbox" id="modal-update" class="modal-toggle" />
            <div class="modal modal-bottom sm:modal-middle lg:pl-80">
                <div class="modal-box">
                    <h3 class="font-bold text-lg">Update data ?</h3>
                    <p class="py-4">Are you sure you want to update the project data? Data changes can be done anytime</p>
                    {{-- <form action="" method="POST"> --}}
                    <div class="modal-action">
                        <label for="modal-update" class="btn btn-info">cancel</label>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                    {{-- </form> --}}
                </div>
            </div>
        </form>

        <!-- Put this part before </body> tag -->
        <input type="checkbox" id="modal-delete" class="modal-toggle" />
        <div class="modal modal-bottom sm:modal-middle lg:pl-80">
            <div class="modal-box">
                <h3 class="font-bold text-lg">Delete data ?</h3>
                <p class="py-4">Are you sure you want to update the project data? Data changes can't be undone</p>
                <form action="{{ route('pimpinan.project.delete', ['id' => $project_detail->id]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="modal-action">
                        <label for="modal-delete" class="btn btn-info">cancel</label>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>

        <div class="my-14">
            <h1 class="text-2xl mb-5">Locations</h1>
            <!-- The button to open modal -->
            <label for="new-user" class="btn btn-primary mb-12 w-full modal-button"><i
                    class="fa-solid fa-puzzle-piece"></i>&nbsp;
                Add new Location</label>

            <!-- Put this part before </body> tag -->
            <input type="checkbox" id="new-user" class="modal-toggle" />
            <div class="modal modal-bottom lg:pl-80">
                <div class="modal-box w-11/12 max-w-5xl rounded-lg self-center">
                    <h3 class="font-bold text-lg mb-10">Add new location</h3>
                    <form action="{{ route('pimpinan.project.location.register.submit') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="flex flex-col md:flex-row ">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 items-center lg:w-2/3">
                                <label for="name" class="mr-3 font-semibold">Location name :</label>
                                <input name="name" type="text"
                                    class="input input-bordered w-full max-w-xs col-span-1" placeholder="location name"
                                    required />
                                <input type="hidden" name="pid" value={{ $project_detail->id }}>
                            </div>
                        </div>

                        <div class="modal-action">
                            <label for="new-user" class="btn btn-error">cancel</label>
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table id="myTable" class="table table-zebra w-full">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>Location name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($locations as $t)
                            <tr>
                                <th>{{ $t->name }}</th>
                                <td class="">
                                    <a href="{{ route('pimpinan.project.location.detail', ['id' => $t->id]) }}">
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
