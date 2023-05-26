@extends('supervisor.drawer')

@section('supervisor-content')
    <h1 class="text-4xl font-bold mb-10">Project</h1>

    <x-Alert />

    <div class="overflow-x-auto mb-80">
        <table id="myTable" class="table table-zebra w-full">
            <!-- head -->
            <thead>
                <tr>
                    <th>No</th>
                    <th>Category</th>
                    <th>Location</th>
                    <th>Project Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    {{-- <th style="text-align-last: center">Total task</th> --}}
                    {{-- <th>Total Jobs</th> --}}
                    <th style="text-align-last: center">Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $p)
                    <tr>
                        <td>{{ $p->cat_id }}</td>
                        <td>{{ $p->cat_name }}</td>
                        <td>{{ $p->loc_name }}</td>
                        <td>{{ $p->proj_name }}</td>
                        <td>{{ $p->start_date }}</td>
                        <td>{{ $p->end_date }}</td>
                        <td class="text-center">
                            <a href="{{ route('supervisor.project.detail', ['id' => $p->cat_id]) }}">
                                <button class="btn btn-info font-semibold">Detail</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
