@extends('pimpinanProject.drawer')

@section('pimpinanProject-content')
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
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 items-center w-full md:w-full xl:w-1/2 mb-5">
                    <label for="name" class="mr-3 font-semibold">Project name :</label>
                    <input name="name" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="full name" required value="{{ $project_detail->name }} "/>
                    <label for="startdate" class="mr-3 font-semibold">Start date :</label>
                    <input name="startdate" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                        required value="{{ \Carbon\Carbon::parse($project_detail->start_date)->format('m/d/Y') }}"/>
                    <label for="enddate" class="mr-3 font-semibold">End date :</label>
                    <input name="enddate" type="date" class="input input-bordered w-full max-w-xs col-span-1" required value="{{ $project_detail->end_date }} "/>
                    <label for="supervisor" class="mr-3 font-semibold">Supervisor :</label>
                    <select name="supervisor" class="js-example-basic-single select select-bordered" id="">
                        <option value="LA">lalala</option>
                        <option value="YE">yeyeye</option>
                        <option value="HA">hehehe</option>
                    </select>
                    <label for="desc" class="mr-3 font-semibold">Description:</label>
                    <textarea name="desc" id="desc" cols="10" rows="5" class="textarea textarea-bordered" required>{{ $project_detail->description }}</textarea>
                </div>
            </div>
            <!-- The button to open modal -->
            <label for="my-modal-6" class="btn btn-primary mt-12 w-full modal-button"><i
                    class="fa-regular fa-pen-to-square"></i>&nbsp; Update data</label>

            <!-- The button to open modal -->
            <label for="my-modal-delete-user" class="btn btn-error mt-12 w-full modal-button text-white"><i
                    class="fa-solid fa-trash"></i>&nbsp; Delete Project</label>

            <!-- Put this part before </body> tag -->
            <input type="checkbox" id="my-modal-6" class="modal-toggle" />
            <div class="modal modal-bottom sm:modal-middle lg:pl-80">
                <div class="modal-box">
                    <h3 class="font-bold text-lg">Update data ?</h3>
                    <p class="py-4">Are you sure you want to update the project data? Data changes can be done anytime</p>
                    <div class="modal-action">
                        <label for="my-modal-6" class="btn">cancel</label>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </div>
            </div>
        </form>

        <div class="my-14">
            <h1 class="text-2xl mb-5">Jobs</h1>
            <div class="overflow-x-auto">
                <table id="myTable" class="table table-zebra w-full">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>Job name</th>
                            <th>Status</th>
                            <th>Type</th>
                            <th>Start date</th>
                            <th>End date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks_in_project as $t)
                        <tr>
                            <th>{{ $t->name }}</th>
                            <td class="text-center">
                                <div class="badge badge-warning">{{$t->status }}</div>
                            </td>
                            <td>pengukuran</td>
                            <td>12/12/23</td>
                            <td>-</td>
                            <td class="">
                                <!-- The button to open modal -->
                                <label for="new-user" class="btn btn-primary w-full modal-button">
                                    Detail</label>
                            </td>

                            <!-- Put this part before </body> tag -->
                            <input type="checkbox" id="new-user" class="modal-toggle" />
                            <div class="modal modal-bottom lg:pl-80">
                                <div class="modal-box w-11/12 max-w-5xl">
                                    <div class="flex flex-row">
                                        <h1 class="font-bold text-2xl mb-3">Job name</h1>
                                        <p class="ml-3 mb-3 self-center"><span>12/12/23</span> - <span>-</span></p>
                                    </div>
                                    <div class="flex flex-row mb-5">
                                        <div class="badge badge-primary mr-1">on progress</div>
                                        <div class="badge badge-info mr-1">pengukuran</div>
                                    </div>
                                    <p>Job desc</p>
                                    <div class="mt-5">
                                        <div class="mb-3">
                                            <h4 class="font-bold">Project Manager</h4>
                                            <li>ikal - <span>0192739012</span></li>
                                        </div>
                                        <div class="mb-3">
                                            <h4 class="font-bold">Supervisor</h4>
                                            <li>ikal - <span>0192739012</span></li>
                                        </div>
                                        <div class="mb-3">
                                            <h4 class="font-bold">Woker</h4>
                                            <li>ikal <span>as measurer</span> - <span>0192739012</span></li>
                                        </div>
                                        <div class="mb-3">
                                            <h4 class="font-bold">Work Checker</h4>
                                            <li>ikal - <span>0192739012</span></li>
                                        </div>
                                    </div>
                                    <div class="modal-action">
                                        <label for="new-user" class="btn btn-error">close</label>
                                        {{-- <input type="submit" class="btn btn-primary" value="Submit"> --}}
                                    </div>
                                </div>
                            </div>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
