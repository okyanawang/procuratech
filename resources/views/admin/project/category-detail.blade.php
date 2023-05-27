@extends('admin.drawer')

@section('admin-content')
<div class="flex flex-row mb-5">
    <a href="javascript:history.back()" class="self-center">
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
            </div>
            <div class="grid grid-cols-2 grid-rows-3 gap-2 items-center w-full md:w-full xl:w-1/2 mb-5">
                <label for="regis-date" class="font-semibold">Registration Date :</label>
                <input name="regis-date" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                    value="{{ $project->registration_date }}" required readonly />
                <label for="start-date" class="font-semibold">Start Date :</label>
                <input name="start-date" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                    value="{{ $project->start_date->format('Y-m-d') }}" required />

                <label for="finish-date" class="font-semibold">Expectation Finish Date :</label>
                <input name="finish-date" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                    value="{{ $project->end_date->format('Y-m-d') }}" required />
            </div>
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
                    <p class="py-4">Are you sure you want to update the staff data? Data changes can be done anytime</p>
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
        <form action="{{ route('admin.project.category.register') }}" class="h-full px-0 md:px-14 mb-10" method="POST"
            enctype="multipart/form-data">
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
                    <p class="py-4">Are you sure you want to update the staff data? Data changes can be done anytime</p>
                    <div class="modal-action">
                        <label for="my-modal-6" class="btn">cancel</label>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </div>
            </div>
        </form>
    </div>

    <label for="new-user" class="btn btn-success mb-5 w-full modal-button"><i class="fa-solid fa-user-plus"></i>&nbsp;
        Add new Task</label>

    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="new-user" class="modal-toggle" />
    <div class="modal modal-bottom lg:pl-80">
        <div class="modal-box w-8/12 max-w-5xl self-center rounded-lg">
            <h3 class="font-bold text-lg mb-10">Add new Task</h3>
            <form action="{{ route('admin.project.category.register') }}" method="POST" enctype="multipart/form-data">
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

    <div class="">
        <h1 class="text-2xl font-bold mb-5">Tasks List</h1>
        <div class="overflow-x-auto">
            <table id="myTable" class="table table-zebra w-full">
                <!-- head -->
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Task name</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $key => $task)
                    <tr>
                        <th>{{ $key + 1}}</th>
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->start_date->format('d-m-Y') }}</td>
                        <td>{{ $task->end_date->format('d-m-Y') }}</td>
                        <td>
                            <a href="{{ route('admin.project.task.detail', ['id' => 1]) }}">
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