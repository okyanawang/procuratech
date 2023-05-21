@extends('admin.drawer')

@section('admin-content')
    <h1 class="text-4xl font-bold mb-10">Staffs</h1>

    <x-Alert />

    <!-- The button to open modal -->
    <label for="new-user" class="btn btn-primary mb-12 w-full modal-button"><i class="fa-solid fa-user-plus"></i>&nbsp;
        Add new staff</label>

    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="new-user" class="modal-toggle" />
    <div class="modal modal-bottom lg:pl-80">
        <div class="modal-box w-11/12 max-w-5xl self-center rounded-lg">
            <h3 class="font-bold text-lg mb-10">Add new staff</h3>
            <form action="{{ route('admin.register.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col md:flex-row gap-3">
                    <div class="grid grid-cols-2 grid-rows-5 gap-2 items-center lg:w-2/3">
                        <label for="name" class="mr-3 font-semibold">Full name :</label>
                        <input name="name" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="full name" required />
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
                        <label for="username" class="mr-3 font-semibold">Username :</label>
                        <input name="username" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="username" required />
                        <label for="email" class="mr-3 font-semibold">Email :</label>
                        <input name="email" type="email" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="email" required />
                        <label for="phone_number" class="mr-3 font-semibold">Phone Number :</label>
                        <input name="phone_number" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="phone number" required />
                    </div>
                    <div class="grid grid-cols-2 grid-rows-5 gap-2 items-center lg:w-2/3">

                        <label for="address" class="mr-3 font-semibold">Address :</label>
                        <input name="address" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="address" required />
                        <label for="status_kepegawaian" class="mr-3 font-semibold">Status Kepegawaian :</label>
                        <select class="select select-bordered block mt-1 w-full" name="status_kepegawaian" required>
                            <option value="0" hidden disabled selected>Choose Status</option>
                            <option value="Out-Sourcing">Out-Sourcing</option>
                            <option value="Contract">Contract</option>
                            <option value="Intern">Intern</option>
                            <option value="Full Time">Full Time</option>
                        </select>
                        <label for="availability_status" class="mr-3 font-semibold">Availibility Status :</label>
                        <select class="select select-bordered block mt-1 w-full" name="availability_status" required>
                            <option value="0" hidden disabled selected>Choose Status</option>
                            <option value="on duty">On Duty</option>
                            <option value="on leave">On Leave</option>
                        </select>
                        <label for="password" class="mr-3 font-semibold">Password :</label>
                        <input name="password" type="password" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="password" required />
                    </div>
                </div>

                <div class="modal-action flex justify-center gap-5">
                    <label for="new-user" class="btn btn-error">cancel</label>
                    {{-- <a href="{{ route('admin.register') }}" class="btn btn-primary mb-3">Register Staff</a> --}}

                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </form>
        </div>
    </div>

    <div class="overflow-x-auto mb-80">
        <table id="myTable" class="table table-zebra w-full">
            <!-- head -->
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th style="text-align-last: center">Role</th>
                    <th>Username</th>
                    <th>Status</th>
                    <th style="text-align-last: center">Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($staffs as $staff)
                    <tr>
                        <td>{{ $staff->id }}</td>
                        <td>{{ $staff->name }}</td>
                        <td class="text-center">
                            <div class="badge badge-success p-4">{{ $staff->role }}</div>
                        </td>
                        <td>{{ $staff->username }}</td>
                        <td>
                            @if ($staff->availability_status == 'on duty')
                                <div class="badge badge-success p-4">{{ $staff->availability_status }}</div>
                            @else
                                <div class="badge badge-error p-4">{{ $staff->availability_status }}</div>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.detail', ['id' => $staff->id]) }}">
                                <button class="btn btn-info font-semibold">Detail</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
