@extends('admin.drawer')

@section('admin-content')
<h1 class="text-4xl font-bold mb-10">Works</h1>

<x-Alert />

<!-- The button to open modal -->
<label for="new-user" class="btn btn-primary mb-12 w-full modal-button"><i class="fa-solid fa-user-plus"></i>&nbsp;
    Add New Work</label>

<!-- Put this part before </body> tag -->
<input type="checkbox" id="new-user" class="modal-toggle" />
<div class="modal modal-bottom lg:pl-80">
    <div class="modal-box w-11/12 max-w-5xl self-center rounded-lg">
        <h3 class="font-bold text-lg mb-10">Add New Work</h3>
        <form action="{{ route('admin.work.register') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col md:flex-row gap-3 mb-2">
                <div class="grid grid-cols-2 grid-rows-2 gap-2 items-center lg:w-2/3">
                    <label for="project_name" class="mr-3 font-semibold">Project Name :</label>
                    <input name="project_name" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="project name" required />
                    <label for="start_date" class="mr-3 font-semibold">Start Date :</label>
                    <input name="start_date" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                        required />
                </div>
                <div class="grid grid-cols-2 grid-rows-2 gap-2 items-center lg:w-2/3">
                    <label for="description" class="mr-3 font-semibold">Description :</label>
                    <input name="description" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="description" required />
                    <label for="end_date" class="mr-3 font-semibold">End Date :</label>
                    <input name="end_date" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                        required />
                </div>
            </div>


            <div class="modal-action flex justify-center gap-5">
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
                <th>Project Name</th>
                <th>Project Manager</th>
                <th>Status</th>
                <th>Registration Date</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $key => $project)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $project->name }}</td>
                <td>
                    @php
                    $projectManager = App\Models\User::find($project->project_manager_id);
                    @endphp
                    @if($projectManager)
                    {{ $projectManager->name }}
                    @endif
                </td>
                <td>
                    <div class="badge badge-success p-4">Active</div>
                </td>
                <td>{{ $project->registration_date }}</td>
                <td>{{ $project->start_date }}</td>
                <td>{{ $project->end_date }}</td>
                <td class="text-center">
                    <a href="{{ route('admin.work.detail', ['id' => $project->id]) }}">
                        <button class="btn btn-info font-semibold">Detail</button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection