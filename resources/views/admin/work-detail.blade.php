@extends('admin.drawer')

@section('admin-content')
    <div class="flex flex-row mb-5">
        <a href="/admin/works" class="self-center">
            <i class="fa-solid fa-arrow-left fa-2xl"></i>
        </a>
        <h1 class="text-4xl font-bold ml-5"></h1>
    </div>

    <x-Alert />

    <h1 class="text-4xl font-bold mb-5">Work Detail</h1>

    <div class="container">
        <form action="{{ route('admin.work.register') }}" class="h-full px-0 md:px-14 mb-10" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col xl:flex-row gap-3">
                <div class="grid grid-cols-2 grid-rows-3 gap-2 items-center w-full md:w-full xl:w-1/2 mb-5">
                    <label for="name" class="font-semibold">Project Name :</label>
                    <input name="name" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        value="" required />
                    <label for="leader" class="mr-3 font-semibold">Project Leader :</label>
                    <input name="leader" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        value="" required />
                    <label for="status" class="font-semibold">Status :</label>
                    <input name="status" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        value="" required />
                </div>
                <div class="grid grid-cols-2 grid-rows-3 gap-2 items-center w-full md:w-full xl:w-1/2 mb-5">
                    <label for="regis-date" class="font-semibold">Registration Date :</label>
                    <input name="regis-date" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                        value="" required />

                    <label for="start-date" class="font-semibold">Start Date :</label>
                    <input name="start-date" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                        value="" required />

                    <label for="finish-date" class="font-semibold">Expectatio Finish Date :</label>
                    <input name="finish-date" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                        value="" required />
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

        <label for="new-user" class="btn btn-success mb-5 w-full modal-button"><i class="fa-solid fa-user-plus"></i>&nbsp;
            Add new Jobs</label>

        <!-- Put this part before </body> tag -->
        <input type="checkbox" id="new-user" class="modal-toggle" />
        <div class="modal modal-bottom lg:pl-80">
            <div class="modal-box w-11/12 max-w-5xl self-center rounded-lg">
                <h3 class="font-bold text-lg mb-10">Add new Job</h3>
                <form action="{{ route('admin.work.job.register') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col md:flex-row gap-3">
                        <div class="grid grid-cols-2 grid-rows-2 gap-2 items-center lg:w-2/3">
                            <label for="job" class="mr-3 font-semibold">Job name :</label>
                            <input name="job" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                                placeholder="full name" required />
                            <label for="status" class="mr-3 font-semibold">Status :</label>
                            <input name="status" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                                placeholder="username" required />
                        </div>
                        <div class="grid grid-cols-2 grid-rows-2 gap-2 items-center lg:w-2/3">
                            <label for="assign" class="mr-3 font-semibold">Assigned at :</label>
                            <input name="assign" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                                placeholder="password" required />
                            <label for="done" class="mr-3 font-semibold">Done at :</label>
                            <input name="done" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                                placeholder="password" required />
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
            {{-- <h1 class="text-2xl mb-5">Jobs Data Recap</h1> --}}
            <h1 class="text-2xl font-bold mb-5">Job List</h1>
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
                                <div class="badge">On Proccess</div>
                            </td>
                            <td>12/12/23</td>
                            <td>-</td>
                            <td>
                                <a href="{{ route('admin.work.job.detail', ['id' => 1]) }}">
                                    <button class="btn btn-info font-semibold">Detail</button>
                                </a>
                            </td>

                            <!-- Put this part before </body> tag -->
                            <input type="checkbox" id="new-user" class="modal-toggle" />
                            <div class="modal modal-bottom lg:pl-80">
                                <div class="modal-box w-11/12 max-w-5xl">
                                    <h3 class="font-bold text-lg mb-10">Job name</h3>
                                    <p>job desc</p>
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
