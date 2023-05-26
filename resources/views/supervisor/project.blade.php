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
<<<<<<< HEAD
                    <th>Category</th>
                    <th>Location</th>
                    <th>Project Name</th>
=======
                    <th>Name</th>
                    <th>Location</th>
                    <th>Project</th>
>>>>>>> deeeaa2 (fix something)
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
<<<<<<< HEAD
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->cname }}</td>
                        <td>{{ $p->lname }}</td>
                        <td>{{ $p->pname }}</td>
=======
                        <td>{{ $p->cat_id }}</td>
                        <td>{{ $p->cat_name }}</td>
                        <td>{{ $p->loc_name }}</td>
                        <td>{{ $p->proj_name }}</td>
>>>>>>> deeeaa2 (fix something)
                        <td>{{ $p->start_date }}</td>
                        <td>{{ $p->end_date }}</td>
                        <td class="text-center">
<<<<<<< HEAD
                            <a href="{{ route('supervisor.project.detail', ['id' => $p->id]) }}">
=======
                            <a href="{{ route('supervisor.detail', ['id' => $p->proj_id]) }}">
>>>>>>> deeeaa2 (fix something)
                                <button class="btn btn-info font-semibold">Detail</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
