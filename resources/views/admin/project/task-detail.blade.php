@extends('admin.drawer')

@section('admin-content')
    <div class="flex flex-row mb-5">
        <a href="{{ route('admin.project.category.detail', ['id' => $category->id]) }}" class="self-center">
            <i class="fa-solid fa-arrow-left fa-2xl"></i>
        </a>
        <h1 class="text-4xl font-bold ml-5"></h1>
    </div>

    <x-Alert />

    <h1 class="text-4xl font-bold mb-5">Project Detail</h1>

    <div class="container">
        <form action="{{ route('admin.project.register') }}" class="h-full px-0 md:px-14 mb-10" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col xl:flex-row gap-3">
                <div class="avatar w-full lg:w-1/2 h-60">
                    <div class="w-full rounded-xl">
                        <img src="{{ asset('project/' . $project->image_path) }}" />
                    </div>
                </div>
                <div class="grid grid-cols-2 grid-rows-3 gap-2 items-center w-full md:w-full xl:w-1/2 mb-5">
                    <label for="name" class="font-semibold">Project Name :</label>
                    <input name="name" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        value="{{ $project->name }}" required />
                    <label for="project-manager" class="mr-3 font-semibold">Project Manager :</label>
                    <input name="project-manager" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        value="{{ $name_pm }}" required />
                    <label for="description" class="font-semibold">Description :</label>
                    <input name="description" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        value="{{ $project->description }}" required />
                    <label for="regis-date" class="font-semibold">Registration Date :</label>
                    <input name="regis-date" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                        value="{{ $project->registration_date }}" required readonly />
                    <label for="start-date" class="font-semibold">Start Date :</label>
                    <input name="start-date" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                        value="{{ $project->start_date->format('Y-m-d') }}" required />

                    <label for="finish-date" class="font-semibold">Expectation Finish Date :</label>
                    <input name="finish-date" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                        value="{{ $project->end_date->format('Y-m-d') }}" required />
                    <label for="photo" class="font-semibold">Update Photo :</label>
                    <input type="file" class="file-input file-input-bordered file-input-info">
                </div>
                {{-- <div class="grid grid-cols-2 grid-rows-3 gap-2 items-center w-full md:w-full xl:w-1/2 mb-5">
            </div> --}}
            </div>

            <div class="flex justify-center gap-5">
                <!-- The button to open modal -->
                <label for="my-modal-delete-user" class="btn btn-error mt-5 w-50 modal-button text-white"><i
                        class="fa-solid fa-trash"></i>&nbsp; Delete Project</label>
                <!-- The button to open modal -->
                <label for="my-modal-6" class="btn btn-primary mt-5 w-50 modal-button"><i
                        class="fa-regular fa-pen-to-square"></i>&nbsp; Update data</label>

            </div>

            <!-- Put this part before </body> tag -->
            <input type="checkbox" id="my-modal-6" class="modal-toggle" />
            <div class="modal modal-bottom sm:modal-middle lg:pl-80">
                <div class="modal-box">
                    <h3 class="font-bold text-lg">Update data ?</h3>
                    <p class="py-4">Are you sure you want to update the staff data? Data changes can be done anytime</p>
                    <div class="modal-action">
                        <label for="my-modal-6" class="btn">cancel</label>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </div>
            </div>
        </form>

        <h2 class="text-2xl font-bold mb-5">Location Detail</h2>

        <div class="container">
            <form action="{{ route('admin.project.location.register') }}" class="h-full px-0 md:px-14 mb-10" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col gap-3">
                    <div class="grid grid-cols-2 gap-2 items-center w-full mb-5">
                        <label for="name" class="font-semibold">Location Name :</label>
                        <input name="name" type="text" class="input input-bordered w-full col-span-1"
                            value="{{ $location->name }}" required />
                    </div>
                </div>

                <div class="flex justify-center gap-5">
                    <!-- The button to open modal -->
                    <label for="my-modal-delete-user" class="btn btn-error mt-5 w-50 modal-button text-white"><i
                            class="fa-solid fa-trash"></i>&nbsp; Delete Category</label>
                    <!-- The button to open modal -->
                    <label for="my-modal-6" class="btn btn-primary mt-5 w-50 modal-button"><i
                            class="fa-regular fa-pen-to-square"></i>&nbsp; Update data</label>

                </div>

                <!-- Put this part before </body> tag -->
                <input type="checkbox" id="my-modal-6" class="modal-toggle" />
                <div class="modal modal-bottom sm:modal-middle lg:pl-80">
                    <div class="modal-box">
                        <h3 class="font-bold text-lg">Update data ?</h3>
                        <p class="py-4">Are you sure you want to update the staff data? Data changes can be done anytime
                        </p>
                        <div class="modal-action">
                            <label for="my-modal-6" class="btn">cancel</label>
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <h2 class="text-2xl font-bold mb-5">Category Detail</h2>

        <div class="container">
            <form action="{{ route('admin.project.category.register') }}" class="h-full px-0 md:px-14 mb-10"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col gap-3">
                    <div class="grid grid-cols-2 gap-2 items-center w-full mb-5">
                        <label for="name" class="font-semibold">Category Name :</label>
                        <input name="name" type="text" class="input input-bordered w-full col-span-1"
                            value="{{ $category->name }}" required />
                    </div>
                </div>

                <div class="flex justify-center gap-5">
                    <!-- The button to open modal -->
                    <label for="my-modal-delete-user" class="btn btn-error mt-5 w-50 modal-button text-white"><i
                            class="fa-solid fa-trash"></i>&nbsp; Delete Category</label>
                    <!-- The button to open modal -->
                    <label for="my-modal-6" class="btn btn-primary mt-5 w-50 modal-button"><i
                            class="fa-regular fa-pen-to-square"></i>&nbsp; Update data</label>

                </div>

                <!-- Put this part before </body> tag -->
                <input type="checkbox" id="my-modal-6" class="modal-toggle" />
                <div class="modal modal-bottom sm:modal-middle lg:pl-80">
                    <div class="modal-box">
                        <h3 class="font-bold text-lg">Update data ?</h3>
                        <p class="py-4">Are you sure you want to update the staff data? Data changes can be done anytime
                        </p>
                        <div class="modal-action">
                            <label for="my-modal-6" class="btn">cancel</label>
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </div>
                </div>
            </form>
        </div>


        <h2 class="text-2xl font-bold mb-5">Task Detail</h2>

        <div class="container">
            <form action="{{ route('admin.project.task.register') }}" class="h-full px-0 md:px-14 mb-10" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col xl:flex-row gap-3">
                    <div class="avatar w-full lg:w-1/2 h-60">
                        <div class="w-full rounded-xl">
                            <img src="{{ asset('task/' . $task->image_path) }}" />
                        </div>
                    </div>
                    <div class="grid grid-cols-2 grid-rows-2 gap-2 items-center w-full md:w-full xl:w-1/2 mb-5">
                        <label for="name" class="font-semibold">Task Name :</label>
                        <input name="name" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                            value="{{ $task->name }}" required />
                        <label for="description" class="font-semibold">Description :</label>
                        <input name="description" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                            value="{{ $task->description }}" required />
                        <label for="start-date" class="font-semibold">Start Date :</label>
                        <input name="start-date" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                            value="{{ $task->start_date->format('Y-m-d') }}" required />

                        <label for="end-date" class="font-semibold">End Date :</label>
                        <input name="end-date" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                            value="{{ $task->end_date->format('Y-m-d') }}" required />
                        <label for="photo" class="font-semibold">Update Photo :</label>
                        <input type="file" class="file-input file-input-bordered file-input-info">
                    </div>
                    {{-- <div class="grid grid-cols-2 grid-rows-2 gap-2 items-center w-full md:w-full xl:w-1/2 mb-5">
                    </div> --}}
                </div>

                <div class="flex justify-center gap-5">
                    <!-- The button to open modal -->
                    <label for="my-modal-delete-user" class="btn btn-error mt-5 w-50 modal-button text-white"><i
                            class="fa-solid fa-trash"></i>&nbsp; Delete Task</label>
                    <!-- The button to open modal -->
                    <label for="my-modal-6" class="btn btn-primary mt-5 w-50 modal-button"><i
                            class="fa-regular fa-pen-to-square"></i>&nbsp; Update data</label>

                </div>

                <!-- Put this part before </body> tag -->
                <input type="checkbox" id="my-modal-6" class="modal-toggle" />
                <div class="modal modal-bottom sm:modal-middle lg:pl-80">
                    <div class="modal-box">
                        <h3 class="font-bold text-lg">Update data ?</h3>
                        <p class="py-4">Are you sure you want to update the staff data? Data changes can be done anytime
                        </p>
                        <div class="modal-action">
                            <label for="my-modal-6" class="btn">cancel</label>
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <label for="new-user" class="btn btn-success mb-5 w-full modal-button"><i
                class="fa-solid fa-user-plus"></i>&nbsp;
            Add new Task</label>

        <!-- Put this part before </body> tag -->
        <input type="checkbox" id="new-user" class="modal-toggle" />
        <div class="modal modal-bottom lg:pl-80">
            <div class="modal-box w-8/12 max-w-5xl self-center rounded-lg">
                <h3 class="font-bold text-lg mb-10">Add new Task</h3>
                <form action="{{ route('admin.project.category.register') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col  gap-3">
                        <div class="grid grid-cols-3 gap-2 items-center">
                            <label for="task_name" class="mr-3 font-semibold">Task name :</label>
                            <input name="task_name" type="text" class="input input-bordered w-full col-span-2"
                                placeholder="task name" required />
                        </div>
                        <div class="grid grid-cols-3 gap-2 items-center">
                            <label for="description" class="mr-3 font-semibold">Description :</label>
                            <input name="description" type="text" class="input input-bordered w-full col-span-2"
                                placeholder="description" required />
                        </div>
                    </div>

                    <div class="modal-action flex justify-center gap-5">
                        <label for="new-user" class="btn btn-error">cancel</label>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>


    </div>
    <div class="mb-10">
        <h1 class="text-2xl font-bold mb-5">Workers List</h1>
        <div class="overflow-x-auto">
            <table id="myTable" class="table table-zebra w-full">
                <!-- head -->
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($workers as $key => $worker)
                        <tr>
                            <th>{{ $key + 1 }}</th>
                            <td>{{ $worker->name }}</td>
                            <td>{{ $worker->role }}</td>
                            <td>
                                <a href="{{ route('admin.staff.detail', ['id' => $worker->id]) }}">
                                    <button class="btn btn-info font-semibold">Detail</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="mb-5">
        <h1 class="text-2xl font-bold mb-5">Items List</h1>
        <div class="overflow-x-auto">
            <table id="myTable2" class="table table-zebra w-full">
                <!-- head -->
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Item name</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $key => $item)
                        <tr>
                            <th>{{ $key + 1 }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->amount }}</td>
                            <td>
                                <a href="{{ route('admin.component.detail', ['id' => $item->id]) }}">
                                    <button class="btn btn-info font-semibold">Detail</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
