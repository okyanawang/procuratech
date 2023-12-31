@extends('admin.drawer')

@section('admin-content')
    <div class="flex flex-row mb-10">
        <a href="/admin/staff" class="self-center">
            <i class="fa-solid fa-arrow-left fa-2xl"></i>
        </a>
        <h1 class="text-4xl font-bold ml-5"></h1>
    </div>

    <x-Alert />

    <h1 class="text-4xl font-bold mb-5">Staff Detail</h1>

    <div class="container">
        <form action=" {{ route('admin.staff.update', ['id' => $user->id]) }}" class="h-full px-0 md:px-14 mb-40"
            method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex flex-col xl:flex-row gap-5 place-content-center">
                <div class="avatar w-full lg:w-1/2">
                    <div class="w-full rounded-xl">
                        <img src="{{ asset('staff/' . $user->image_path) }}" />
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 items-center w-full md:w-full xl:w-1/2 mb-5">
                    <label for="name" class="mr-3 font-semibold">Full Name :</label>
                    <input name="name" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="Full Name" required value="{{ $user->name }} " />
                    <label for="registration_number" class="mr-3 font-semibold">Registration number :</label>
                    <input name="registration_number" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="registration_number" value="{{ $user->registration_number }}" readonly required />
                    <label for="role" class="mr-3 font-semibold">Role :</label>
                    <select class="select select-bordered block mt-1 w-full" name="role" required>
                        <option value="Admin IT" {{$user->role == "Admin IT" ? 'selected' : ''}}>Admin IT</option>
                        <option value="Project Manager" {{$user->role == "Project Manager" ? 'selected' : ''}}>Project Manager</option>
                        <option value="Supervisor" {{$user->role == "Supervisor" ? 'selected' : ''}}>Supervisor</option>
                        <option value="Measurement Executor" {{$user->role == "Measurement Executor" ? 'selected' : ''}}>Measurement Executor</option>
                        <option value="Analyst" {{$user->role == "Analyst" ? 'selected' : ''}}>Analyst</option>
                        <option value="Job Executor" {{$user->role == "Job Executor" ? 'selected' : ''}}>Job Executor</option>
                        <option value="Job Inspector" {{$user->role == "Job Inspector" ? 'selected' : ''}}>Job Inspector</option>
                        <option value="Inventory Treasurer" {{$user->role == "Inventory Treasure" ? 'selected' : ''}}>Inventory Treasurer</option>
                        <option value="Inventory Officer" {{$user->role == "Inventory Officer" ? 'selected' : ''}}>Inventory Officer</option>
                    </select>
                    <label for="availability_status" class="mr-3 font-semibold">Availibility Status :</label>
                    <select class="select select-bordered block mt-1 w-full" name="availability_status" required>
                        <option value="on duty" {{$user->availability_status == "on duty" ? 'selected' : ''}}>on duty</option>
                        <option value="on leave" {{$user->availability_status == "on leave" ? 'selected' : ''}}>on leave</option>
                    </select>
                    <label for="employement_status" class="mr-3 font-semibold">Employment Status :</label>
                    <select class="select select-bordered block mt-1 w-full" name="employement_status" required>
                        <option value="Contract" {{$user->employement_status == "Contract" ? 'selected' : ''}}>Contract</option>
                        <option value="Out-sourcing" {{$user->employement_status == "Out-sourcing" ? 'selected' : ''}}>Out-sourcing</option>
                        <option value="Intern" {{$user->employement_status == "Intern" ? 'selected' : ''}}>Intern</option>
                        <option value="Full Time" {{$user->employement_status == "Full Time" ? 'selected' : ''}}>Full Time</option>
                    </select>
                    <label for="phone_number" class="mr-3 font-semibold">Phone number :</label>
                    <input name="phone_number" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="phone_number" value="{{ $user->phone_number }}" required />
                    <label for="address" class="mr-3 font-semibold">Address :</label>
                    <input name="address" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="address" value="{{ $user->address }}" required />
                    <label for="username" class="mr-3 font-semibold">Username :</label>
                    <input name="username" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="username" value="{{ $user->username }}" required />
                    <label for="email" class="mr-3 font-semibold">Email :</label>
                    <input name="email" type="email" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="email" value="{{ $user->email }}" required />
                    <label for="password" class="mr-3 font-semibold">New Password :</label>
                    <input name="password" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="password" />
                    <label for="photo" class="font-semibold">Update Photo :</label>
                    <input name="image_path" type="file" class="file-input file-input-bordered file-input-info">
                </div>
                {{-- <div class="grid grid-cols-2 grid-rows-3 gap-2 items-center w-full md:w-full xl:w-1/2 mb-5">
                </div> --}}
            </div>
            <div class="flex justify-center gap-5">
                <!-- The button to open modal -->
                <label for="modal-delete" class="btn btn-error mt-5 w-50 modal-button text-white"><i
                        class="fa-solid fa-trash"></i>&nbsp; Delete User</label>
                <!-- The button to open modal -->
                <label for="modal-update" class="btn btn-primary mt-5 w-50 modal-button"><i
                        class="fa-regular fa-pen-to-square"></i>&nbsp; Update User</label>

            </div>

            <!-- Put this part before </body> tag -->
            <input type="checkbox" id="modal-update" class="modal-toggle" />
            <div class="modal modal-bottom sm:modal-middle lg:pl-80">
                <div class="modal-box">
                    <h3 class="font-bold text-lg">Update data ?</h3>
                    <p class="py-4">Are you sure you want to update the user data? Data changes can be done anytime</p>
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
                <h3 class="font-bold text-lg">Delete data ?</h3>
                <p class="py-4">Are you sure you want to delete the user data? It will also delete all their relation to
                    tasks</p>
                <form action="{{ route('admin.staff.delete', ['id' => $user->id]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="modal-action">
                        <label for="modal-delete" class="btn btn-info">cancel</label>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
        @if ($user->role == 'Project Manager')
            <div class="my-14">
                <h1 class="text-2xl mb-5">Projects Recap</h1>
                <div class="overflow-x-auto">
                    <table id="myTable" class="table table-zebra w-full">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th class="text-center">Project name</th>
                                <th class="text-center">Project number</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Start Date</th>
                                <th class="text-center">End Date</th>
                                {{-- <th class="text-center">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pm_recap as $tu)
                                <tr>
                                    <th>{{ $tu->name }}</th>
                                    <th>{{ $tu->project_number }}</th>
                                    <td class="text-center">
                                        <div class="badge">{{ $tu->status }}</div>
                                    </td>
                                    <td>{{ $tu->start_date }}</td>
                                    <td>{{ $tu->end_date }}</td>
                                    {{-- <td class="">
                                        <a
                                            href="{{ route('admin.project.task.recap', ['id' => $tu->id, 'user_id' => $user->id]) }}">
                                            <button class="btn btn-primary">Detail</button>
                                        </a>

                                    </td> --}}

                                    <!-- Put this part before </body> tag -->
                                    <input type="checkbox" id="new-user" class="modal-toggle" />
                                    <div class="modal modal-bottom lg:pl-80">
                                        <div class="modal-box w-11/12 max-w-5xl self-center">
                                            <h3 class="font-bold text-lg mb-10">Job name</h3>
                                            <p>job desc</p>
                                            <div class="modal-action justify-center gap-5">
                                                <label for="new-user" class="btn btn-error">cancel</label>
                                                <input type="submit" class="btn btn-primary" value="Submit">
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="my-14">
                <h1 class="text-2xl mb-5">Jobs Data Recap</h1>
                <div class="overflow-x-auto">
                    <table id="myTable" class="table table-zebra w-full">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th class="text-center">Job name</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Start Date</th>
                                <th class="text-center">End Date</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $tu)
                                <tr>
                                    <th>{{ $tu->name }}</th>
                                    <td class="text-center">
                                        <div class="badge">{{ $tu->status }}</div>
                                    </td>
                                    <td>{{ $tu->start_date }}</td>
                                    <td>{{ $tu->end_date }}</td>
                                    <td class="">
                                        <!-- The button to open modal -->
                                        {{-- <label for="new-user" class="btn btn-info font-semibold">
                                        Detail</label> --}}
                                        <a
                                            href="{{ route('admin.project.task.recap', ['id' => $tu->id, 'user_id' => $user->id]) }}">
                                            <button class="btn btn-primary">Detail</button>
                                        </a>

                                    </td>

                                    <!-- Put this part before </body> tag -->
                                    <input type="checkbox" id="new-user" class="modal-toggle" />
                                    <div class="modal modal-bottom lg:pl-80">
                                        <div class="modal-box w-11/12 max-w-5xl self-center">
                                            <h3 class="font-bold text-lg mb-10">Job name</h3>
                                            <p>job desc</p>
                                            <div class="modal-action justify-center gap-5">
                                                <label for="new-user" class="btn btn-error">cancel</label>
                                                <input type="submit" class="btn btn-primary" value="Submit">
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

    </div>
@endsection
