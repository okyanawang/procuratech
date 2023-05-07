@extends('admin.drawer')

@section('admin-content')
    <div class="flex flex-row mb-10">
        <a href="javascript:history.back()" class="self-center">
            <i class="fa-solid fa-arrow-left fa-2xl"></i>
        </a>
        <h1 class="text-4xl font-bold ml-5"></h1>
    </div>
    <div class="container">
        <form action="" class="h-full px-0 md:px-14 mb-40" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col xl:flex-row ">
                <div class="grid grid-cols-2 gap-2 items-center w-full md:w-full xl:w-1/2 mb-5">
                    <label for="" class="mr-3 font-semibold">NIK :</label>
                    <input type="text" placeholder="Type here" class="input input-ghost w-full max-w-xs col-span-1"
                        value="" name="nik" />
                    <label for="" class="mr-3 font-semibold">Full Name :</label>
                    <input type="text" placeholder="Type here" class="input input-ghost w-full max-w-xs col-span-1"
                        value="" name="name" />
                    <label for="role" class="mr-3 font-semibold">Role :</label>
                    <select class="select block mt-1 w-full" name="role" required>
                        <option value="0" hidden disabled selected>Choose Role</option>
                        <option value="1">Project Manager</option>
                        <option value="2">Supervisor</option>
                        <option value="3">Worker</option>
                        <option value="4">Work Checker</option>
                        <option value="5">Work Tools Treasurer</option>
                        <option value="6">Logistic Treasurer</option>
                    </select>
                    <label for="" class="mr-3 font-semibold">Phone Number :</label>
                    <input type="text" placeholder="Type here" class="input input-ghost w-full max-w-xs col-span-1"
                        value="" name="phone" />
                </div>
                <div class="w-full md:w-1/2 flex justify-center">
                    <div class="avatar flex-col">
                        <div class="mask mask-squircle items-center">
                            <img src="https://picsum.photos/200" alt="">
                        </div>
                        <input type="file" class="mt-3 w-fit" name="pict">
                    </div>
                </div>
            </div>
            <!-- The button to open modal -->
            <label for="my-modal-6" class="btn btn-primary mt-12 w-full modal-button"><i
                    class="fa-regular fa-pen-to-square"></i>&nbsp; Update data</label>

            <!-- The button to open modal -->
            <label for="my-modal-delete-user" class="btn btn-error mt-12 w-full modal-button text-white"><i
                    class="fa-solid fa-trash"></i>&nbsp; Delete User</label>

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
                                <label for="new-user" class="btn btn-primary mb-12 w-full modal-button">
                                    Detail</label>
                            </td>

                            <!-- Put this part before </body> tag -->
                            <input type="checkbox" id="new-user" class="modal-toggle" />
                            <div class="modal modal-bottom lg:pl-80">
                                <div class="modal-box w-11/12 max-w-5xl">
                                    <h3 class="font-bold text-lg mb-10">Job name</h3>
                                    <div class="modal-action">
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
