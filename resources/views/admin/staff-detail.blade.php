@extends('admin.drawer')

@section('admin-content')
    <div class="flex flex-row mb-10">
        <a href="javascript:history.back()" class="self-center">
            <i class="fa-solid fa-arrow-left fa-2xl"></i>
        </a>
        <h1 class="text-4xl font-bold ml-5"></h1>
    </div>

    <x-Alert />

    <h1 class="text-4xl font-bold mb-5">Staff Detail</h1>

    <div class="container">
        <form action=" {{ route('admin.update', ['id' => $user->id]) }}" class="h-full px-0 md:px-14 mb-40" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex flex-col xl:flex-row gap-3 place-content-center">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 items-center w-full md:w-full xl:w-1/2 mb-5">
                    <label for="name" class="mr-3 font-semibold">Full Name :</label>
                    <input name="name" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="Full Name" required value="{{ $user->name }} " />
                    <label for="role" class="mr-3 font-semibold">Role :</label>
                    <select class="select select-bordered block mt-1 w-full" name="role" required>
                        <option value="0" hidden disabled selected>Choose Role</option>
                            <option value="Admin IT">Admin IT</option>
                            <option value="Project Manager">Project Manager</option>
                            <option value="Supervisor">Supervisor</option>
                            <option value="Measurement Executor">Measurement Executor</option>
                            <option value="Analyst">Analystis</option>
                            <option value="Job Executor">Job Executor</option>
                            <option value="Job Inspector">Job Inspector</option>
                            <option value="Inventory Treasurer">Inventory Treasurer</option>
                            <option value="Inventory Officer">Inventory Officer</option>
                    </select>
                    <label for="availability_status" class="mr-3 font-semibold">Availibility Status :</label>
                        <select class="select select-bordered block mt-1 w-full" name="availability_status" required>
                            <option value="0" hidden disabled selected>Choose Status</option>
                            <option value="on duty">On Duty</option>
                            <option value="on leave">On Leave</option>
                        </select>
                </div>
                <div class="grid grid-cols-2 grid-rows-3 gap-2 items-center w-full md:w-full xl:w-1/2 mb-5">
                    <label for="username" class="mr-3 font-semibold">Username :</label>
                    <input name="username" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="username" value="{{ $user->username }}" required />
                    <label for="password" class="mr-3 font-semibold">New Password :</label>
                    <input name="password" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="password" />
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
                <p class="py-4">Are you sure you want to update the project data? Data changes can't be undone</p>
                <form action="{{ route('admin.delete', ['id' => $user->id]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="modal-action">
                        <label for="modal-delete" class="btn btn-info">cancel</label>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>

        {{-- <form action="" class="h-full px-0 md:px-14 mb-10" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col xl:flex-row gap-3">
                <div class="grid grid-cols-2 grid-rows-3 gap-2 items-center w-full md:w-full xl:w-1/2 mb-5">
                    <label for="name" class="mr-3 font-semibold">Full name :</label>
                    <input name="name" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        value="{{ $user->name }}" required />
                    <label for="role" class="mr-3 font-semibold">Role :</label>
                    <select class="select select-bordered block mt-1 w-full" name="role" required>
                        <option value="0" hidden disabled selected>Choose Role</option>
                        <option value="1" @if ($user->role == 'Admin IT') selected @endif>Admin IT</option>
                        <option value="2" @if ($user->role == 'Project Manager') selected @endif>Project Manager</option>
                        <option value="3" @if ($user->role == 'Supervisor') selected @endif>Supervisor</option>
                        <option value="4" @if ($user->role == 'Measurement Executor') selected @endif>Measurement Executor</option>
                        <option value="5" @if ($user->role == 'Analyst') selected @endif>Analysist</option>
                        <option value="6" @if ($user->role == 'Job Executor') selected @endif>Job Executor</option>
                        <option value="7" @if ($user->role == 'Job Inspector') selected @endif>Job Inspector</option>
                        <option value="8" @if ($user->role == 'Inventory Treasurer') selected @endif>Inventory Treasurer
                        </option>
                        <option value="9" @if ($user->role == 'Inventory Officer') selected @endif>Inventory Officer</option>
                    </select>
                    <label for="role" class="mr-3 font-semibold">ActiveOnDuty :</label>
                    <select class="select select-bordered block mt-1 w-full" name="role" required>
                        <option value="-1" hidden disabled selected>Choose Status</option>
                        <option value="0" @if ($user->ActiveOnDuty == 0) selected @endif>Not Active</option>
                        <option value="1" @if ($user->ActiveOnDuty == 1) selected @endif>Active</option>
                    </select>
                </div>
                <div class="grid grid-cols-2 grid-rows-3 gap-2 items-center w-full md:w-full xl:w-1/2 mb-5">
                    <label for="username" class="mr-3 font-semibold">Username :</label>
                    <input name="username" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="username" value="{{ $user->username }}" required />
                    <label for="password" class="mr-3 font-semibold">New Password :</label>
                    <input name="new password" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="password" />
                </div>
            </div>
            <div class="flex justify-center gap-5">
                <!-- The button to open modal -->
                <label for="my-modal-delete-user" class="btn btn-error mt-5 w-50 modal-button text-white"><i
                        class="fa-solid fa-trash"></i>&nbsp; Delete User</label>
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
        </form> --}}

        <div class="my-14">
            <h1 class="text-2xl mb-5">Jobs Data Recap</h1>
            <div class="overflow-x-auto">
                <table id="myTable" class="table table-zebra w-full">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>Job name</th>
                            <th>Status</th>
                            <th>Assigned at</th>
                            <th>Done at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($books as $book) --}}
                        <tr>
                            <th>lalala</th>
                            <td class="text-center">
                                <div class="badge badge-warning">On Proccess</div>
                            </td>
                            <td>12/12/23</td>
                            <td>-</td>
                            <td class="">
                                <!-- The button to open modal -->
                                <label for="new-user" class="btn btn-info font-semibold">
                                    Detail</label>
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
                        {{-- @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
