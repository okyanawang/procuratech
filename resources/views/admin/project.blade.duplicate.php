@extends('admin.drawer')

@section('admin-content')
<h1 class="text-4xl font-bold mb-10">Reports</h1>
<!-- The button to open modal -->
<label for="new-user" class="btn btn-primary mb-12 w-full modal-button"><i class="fa-solid fa-user-plus"></i>&nbsp;
    Add new report</label>

<!-- Put this part before </body> tag -->
<input type="checkbox" id="new-user" class="modal-toggle" />
<div class="modal modal-bottom lg:pl-80">
    <div class="modal-box w-11/12 max-w-5xl self-center rounded-lg">
        <h3 class="font-bold text-lg mb-10">Add new report</h3>
        <form action="{{ route('admin.register.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col md:flex-row gap-3 mb-2">
                <div class="grid grid-cols-2 grid-rows-2 gap-2 items-center lg:w-2/3">
                    <label for="nama_proyek" class="mr-3 font-semibold">Nama Proyek :</label>
                    <input name="nama_proyek" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="nama proyek" required />
                    <label for="start_date" class="mr-3 font-semibold">Start Date :</label>
                    <input name="start_date" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                        required />
                </div>
                <div class="grid grid-cols-2 grid-rows-2 gap-2 items-center lg:w-2/3">
                    <label for="deskripsi" class="mr-3 font-semibold">Deskripsi :</label>
                    <input name="deskripsi" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="deskripsi" required />
                    <label for="end_date" class="mr-3 font-semibold">End Date :</label>
                    <input name="end_date" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                        required />
                </div>
            </div>
            <div id="location-container">
                <div class="location-group">
                    <div class="flex flex-col md:flex-row gap-3 mb-2">
                        <div class="grid grid-cols-1 grid-rows-1 gap-2 items-center lg:w-2/3">
                            <label class="mr-3 font-semibold">Location :</label>
                        </div>
                        <div class="grid grid-cols-1 grid-rows-1 gap-2 items-center lg:w-2/3">
                            <label class="mr-3 font-semibold">Category :</label>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row gap-3 mb-2">
                        <div class="grid grid-cols-10 grid-rows-1 gap-2 items-center lg:w-2/3">
                            <input name="location[]" type="text" class="input input-bordered w-full col-span-9"
                            placeholder="location" required />
                        </div>
                        <div class="category-group grid grid-cols-1 grid-rows-1 gap-2 items-center lg:w-2/3">
                                <div class="flex flex-col gap-3">
                                    <div class="category-item grid grid-cols-10 grid-rows-1 gap-2 items-center">
                                        <input name="category[1][]" type="text" class="input input-bordered w-full col-span-9"
                                        placeholder="category" required />
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button id="add-location" type="button" class="px-4 py-2 text-white bg-indigo-500 rounded-md">Add
                    Location</button>
                <button id="add-category" type="button" class="px-4 py-2 text-white bg-indigo-500 rounded-md">Add
                    Category</button>
            </div>

            <div class="modal-action flex justify-center gap-5">
                <label for="new-user" class="btn btn-error">cancel</label>
                {{-- <a href="{{ route('admin.register') }}" class="btn btn-primary mb-3">Register Report</a> --}}

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
                <th>Nama Proyek</th>
                <th>Registration Date</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th style="text-align-last: center">Status</th>
                <th style="text-align-last: center">Detail</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($projects as $project) --}}
            <tr>
                {{-- <th>{{ $project->id - 1 }}</th> --}}
                <th>1</th>
                <td>Kapal 1</td>
                <td>2 Mei 2023</td>
                <td>30 Mei 2023</td>
                <td>30 Mei 2023</td>
                <td class="text-center">
                    <div class="badge badge-success p-4">Persiapan Alat</div>
                </td>
                <td class="text-center">
                    <a href="{{ route('admin.project_detail') }}">
                        <button class="btn btn-info font-semibold">Detail</button>
                    </a>
                </td>
            </tr>
            {{-- @endforeach --}}
        </tbody>
    </table>
</div>
@endsection