@extends('admin.drawer')

@section('admin-content')
    <div class="flex flex-row mb-5">
        <a href={{ route('admin.project.detail', ['id' => $project->id]) }} class="self-center">
            <i class="fa-solid fa-arrow-left fa-2xl"></i>
        </a>
        <h1 class="text-4xl font-bold ml-5"></h1>
    </div>

    <x-Alert />

    <h1 class="text-4xl font-bold mb-5">Project Detail</h1>

    <div class="container">
        <form action=" {{ route('admin.project.update', ['id' => $project->id]) }}" class="h-full px-0 md:px-14 mb-10"
            method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex flex-col xl:flex-row gap-3 place-content-center">
                <div class="avatar w-full lg:w-1/3">
                    <div class="w-full rounded-xl">
                        <img src="{{ asset('project/' . $project->image_path) }}" />
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 items-center w-full md:w-full xl:w-1/2 mb-5">
                    <label for="name" class="mr-3 font-semibold">Project Name :</label>
                    <input name="name" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="Project Name" required value="{{ $project->name }} " />
                    <label for="project-manager" class="mr-3 font-semibold">Project Manager :</label>
                    <input name="project-manager" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        required readonly value="{{ $name_pm }}" />
                    <label for="description" class="font-semibold">Description :</label>
                    <input name="description" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        value="{{ $project->description }}" required />
                    <label for="regis-date" class="font-semibold">Registration Date :</label>
                    <input name="regis-date" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                        value="{{ $project->registration_date }}" required readonly />
                    <label for="start_date" class="font-semibold">Start Date :</label>
                    <input name="start_date" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                        value="{{ $project->start_date->format('Y-m-d') }}" required />
                    <label for="end_date" class="font-semibold">Expectation Finish Date :</label>
                    <input name="end_date" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                        value="{{ $project->end_date->format('Y-m-d') }}" required />
                    <label for="status" class="mr-3 font-semibold">Status :</label>
                    <select name="status" id="" class="select select-bordered">
                        <option value="Pending" {{$project->status == "Pending" ? 'selected' : ''}} >Pending</option>
                        <option value="On Progress" {{$project->status == "On Progress" ? 'selected' : ''}}>On Progress</option>
                        <option value="Done" {{$project->status == "Done" ? 'selected' : ''}}>Done</option>
                    </select>
                    <label for="photo" class="font-semibold">Update Photo :</label>
                    <input name="image_path" type="file" class="file-input file-input-bordered file-input-info">
                </div>
            </div>
            <div class="flex justify-center gap-5">
                <!-- The button to open modal -->
                <label for="modal-delete-project" class="btn btn-error mt-5 w-50 modal-button text-white"><i
                        class="fa-solid fa-trash"></i>&nbsp; Delete Project</label>
                <!-- The button to open modal -->
                <label for="modal-update-project" class="btn btn-primary mt-5 w-50 modal-button"><i
                        class="fa-regular fa-pen-to-square"></i>&nbsp; Update Project</label>

            </div>

            <!-- Put this part before </body> tag -->
            <input type="checkbox" id="modal-update-project" class="modal-toggle" />
            <div class="modal modal-bottom sm:modal-middle lg:pl-80">
                <div class="modal-box">
                    <h3 class="font-bold text-lg">Update data ?</h3>
                    <p class="py-4">Are you sure you want to update the project data? Data changes can be done anytime</p>
                    <div class="modal-action">
                        <label for="modal-update-project" class="btn btn-info">cancel</label>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </div>
            </div>

        </form>
        <input type="checkbox" id="modal-delete-project" class="modal-toggle" />
        <div class="modal modal-bottom sm:modal-middle lg:pl-80">
            <div class="modal-box">
                <h3 class="font-bold text-lg">Delete data?</h3>
                <p class="py-4">Are you sure you want to delete the project? It will also delete all their relation to
                    location</p>
                <form action="{{ route('admin.project.delete', ['id' => $project->id]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="modal-action">
                        <label for="modal-delete-project" class="btn btn-info">cancel</label>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>

        <h2 class="text-2xl font-bold mb-5">Location Detail</h2>

        <div class="container">
            <form action="{{ route('admin.project.location.update', ['id' => $location->id]) }}" class="h-full px-0 md:px-14 mb-10"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="flex flex-col gap-3">
                    <div class="grid grid-cols-2 gap-2 items-center w-full mb-5">
                        <label for="name" class="font-semibold">Location Name :</label>
                        <input name="name" type="text" class="input input-bordered w-full col-span-1"
                            value="{{ $location->name }}" required />
                    </div>
                </div>

                <div class="flex justify-center gap-5">
                    <!-- The button to open modal -->
                    <label for="modal-delete-location" class="btn btn-error mt-5 w-50 modal-button text-white"><i
                            class="fa-solid fa-trash"></i>&nbsp; Delete Category</label>
                    <!-- The button to open modal -->
                    <label for="modal-update-location" class="btn btn-primary mt-5 w-50 modal-button"><i
                            class="fa-regular fa-pen-to-square"></i>&nbsp; Update data</label>

                </div>

                <!-- Put this part before </body> tag -->
                <input type="checkbox" id="modal-update-location" class="modal-toggle" />
                <div class="modal modal-bottom sm:modal-middle lg:pl-80">
                    <div class="modal-box">
                        <h3 class="font-bold text-lg">Update data ?</h3>
                        <p class="py-4">Are you sure you want to update the location data? Data changes can be done anytime
                        </p>
                        <div class="modal-action">
                            <label for="modal-update-location" class="btn">cancel</label>
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </div>
                </div>
            </form>
            <input type="checkbox" id="modal-delete-location" class="modal-toggle" />
            <div class="modal modal-bottom sm:modal-middle lg:pl-80">
                <div class="modal-box">
                    <h3 class="font-bold text-lg">Delete data?</h3>
                    <p class="py-4">Are you sure you want to delete the location? It will also delete all their relation
                        to
                        category</p>
                    <form action="{{ route('admin.project.location.delete', ['id' => $location->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <div class="modal-action">
                            <label for="modal-delete-location" class="btn btn-info">cancel</label>
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <label for="new-user" class="btn btn-success mb-5 w-full modal-button"><i
                class="fa-solid fa-user-plus"></i>&nbsp;
            Add new Category</label>

        <!-- Put this part before </body> tag -->
        <input type="checkbox" id="new-user" class="modal-toggle" />
        <div class="modal modal-bottom lg:pl-80">
            <div class="modal-box w-8/12 max-w-5xl self-center rounded-lg">
                <h3 class="font-bold text-lg mb-10">Add new Category</h3>
                <form action="{{ route('admin.project.category.register') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col  gap-3">
                        <div class="grid grid-cols-3 gap-2 items-center">
                            <label for="category_name" class="mr-3 font-semibold">Category name :</label>
                            <input name="category_name" type="text" class="input input-bordered w-full col-span-2"
                                placeholder="category name" required />
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
            <h1 class="text-2xl font-bold mb-5">Categories List</h1>
            <div class="overflow-x-auto">
                <table id="myTable" class="table table-zebra w-full">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Category name</th>
                            <th>Supervisor</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $category)
                            <tr>
                                <th>{{ $key + 1 }}</th>
                                <td>{{ $category->name }}</td>
                                <td>
                                    @php
                                        $supervisor = App\Models\User::find($category->users_id)->name;
                                    @endphp
                                    @if ($supervisor)
                                        {{ $supervisor }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.project.category.detail', ['id' => $category->id]) }}">
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
