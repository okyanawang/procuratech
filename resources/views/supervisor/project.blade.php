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
