@extends('admin.drawer')

@section('admin-content')
    <h1 class="text-4xl font-bold mb-10">Works</h1>

    <x-Alert />
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
