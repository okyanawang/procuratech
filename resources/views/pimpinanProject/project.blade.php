@extends('pimpinanProject.drawer')

@section('pimpinanProject-content')
    <h1 class="text-4xl font-bold mb-10">Projects</h1>

    <x-Alert />

    <!-- The button to open modal -->
    <label for="new-user" class="btn btn-primary mb-12 w-full modal-button"><i class="fa-solid fa-puzzle-piece"></i>&nbsp;
        Add new Project</label>

    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="new-user" class="modal-toggle" />
    <div class="modal modal-bottom lg:pl-80">
        <div class="modal-box w-11/12 max-w-5xl">
            <h3 class="font-bold text-lg mb-10">Add new project</h3>
            <form action="{{ route('admin.register.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col md:flex-row ">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 items-center lg:w-2/3">
                        <label for="name" class="mr-3 font-semibold">Project name :</label>
                        <input name="name" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="full name" required />
                        <label for="startdate" class="mr-3 font-semibold">Start date :</label>
                        <input name="startdate" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                            required />
                        <label for="startdate" class="mr-3 font-semibold">End date :</label>
                        <input name="enddate" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                            required />
                        <label for="supervisor" class="mr-3 font-semibold">Supervisor :</label>
                        <select name="supervisor" class="js-example-basic-single select select-bordered" id="">
                            <option value="LA">lalala</option>
                            <option value="YE">yeyeye</option>
                            <option value="HA">hehehe</option>
                        </select>
                        <label for="desc" class="mr-3 font-semibold">description :</label>
                        <textarea name="desc" id="desc" cols="10" rows="5" class="textarea textarea-bordered"></textarea>
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
                    <th>Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th style="text-align-last: center">Total Jobs</th>
                    {{-- <th>Total Jobs</th> --}}
                    <th style="text-align-last: center">Detail</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Project sementara</td>
                    <td>27/01/23</td>
                    <td>29/01/23</td>
                    <td class="text-center">3</td>
                    <td class="text-center">
                        <a {{-- href="{{ route('admin.detail', ['id' => $staff->id]) }}" --}}>
                            <button class="btn btn-info font-semibold">Detail</button>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
