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
                    <th>Project Leader</th>
                    <th>Status</th>
                    <th>Registration at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        1
                    </td>
                    <td>
                        Proyek Pembangunan Jalan
                    </td>
                    <td>
                        Budi
                    </td>
                    <td>
                        <div class="badge badge-success p-4">Active</div>
                    </td>
                    <td>
                        2021-10-10
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.work.detail', ['id' => 1]) }}">
                            <button class="btn btn-info font-semibold">Detail</button>
                        </a>
                </tr>
            </tbody>
        </table>
    </div>

@endsection
