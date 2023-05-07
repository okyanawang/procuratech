@extends('admin.drawer')

@section('admin-content')
    <h1 class="text-4xl font-bold mb-10">Staffs</h1>
    <!-- The button to open modal -->
    <label for="new-user" class="btn btn-primary mb-12 w-full modal-button"><i class="fa-solid fa-user-plus"></i>&nbsp;
        Add new staff</label>

    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="new-user" class="modal-toggle" />
    <div class="modal modal-bottom lg:pl-80">
        <div class="modal-box w-11/12 max-w-5xl">
            <h3 class="font-bold text-lg mb-10">Add new staff</h3>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col md:flex-row ">
                    <div class="grid grid-cols-2 gap-2 items-center lg:w-2/3">
                        <label for="nik" class="mr-3 font-semibold">NIK :</label>
                        <input name="nik" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="NIK" required />
                        <label for="name" class="mr-3 font-semibold">Full name :</label>
                        <input name="name" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="full name" required />
                        <label for="role" class="mr-3 font-semibold">Role :</label>
                        <select class="select select-bordered block mt-1 w-full" name="role" required>
                            <option value="0" hidden disabled selected>Choose Role</option>
                            <option value="1">Project Manager</option>
                            <option value="2">Supervisor</option>
                            <option value="3">Worker</option>
                            <option value="4">Work Checker</option>
                            <option value="5">Work Tools Treasurer</option>
                            <option value="6">Logistic Treasurer</option>
                        </select>
                        <label for="phone" class="mr-3 font-semibold">Phone Number :</label>
                        <input name="phone" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="No. HP user" required />
                        <label for="pict" class="mr-3 font-semibold">Upload Photo :</label>
                        <input name="pict" type="file" required />
                    </div>
                </div>

                <div class="modal-action">
                    <label for="new-user" class="btn btn-error">cancel</label>
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
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>No. HP</th>
                    <th style="text-align-last: center">Status</th>
                    <th style="text-align-last: center">Detail</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($users as $user) --}}
                <tr>
                    {{-- <th>{{ $user->id - 1 }}</th> --}}
                    <th>1</th>
                    <td>123897129381203</td>
                    <td>lalala</td>
                    <td>018237182312</td>
                    <td class="text-center">
                        <div class="badge badge-success p-4">Admin</div>
                    </td>
                    <td class="text-center">
                        <a href="">
                            <button class="btn btn-info font-semibold">Detail</button>
                        </a>
                    </td>
                </tr>
                {{-- @endforeach --}}
            </tbody>
        </table>
    </div>
@endsection
