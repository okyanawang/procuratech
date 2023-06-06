@extends('pelaksana.pemeriksa.drawer')

@section('pemeriksa-content')
    <h1 class="text-4xl font-bold mb-10">Tasks</h1>
    <div class="overflow-x-auto mb-80">
        <table id="myTable" class="table table-zebra w-full">
            <!-- head -->
            <thead>
                <tr>
                    <th>No</th>
                    <th>Task Name</th>
                    <th>Task Number</th>
                    <th class="!text-center">Status</th>
                    <th>Job Description</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th style="text-align-last: center">Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $key => $t)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $t->task_name }}</td>
                        <td>{{ $t->task_number }}</td>
                        <td class="text-center">
                            <div class="badge mr-1">{{ $t->task_status }}</div>
                        </td>
                        <td>
                            <p class="truncate w-52">
                                {{ $t->task_description }}
                            </p>
                        </td>
                        <td>{{ $t->task_start }}</td>
                        <td>{{ $t->task_end }}</td>
                        <td class="text-center">
                            <a href="{{ route('pemeriksa.tasks.detail', ['id' => $t->id]) }}">
                                <button class="btn btn-info font-semibold">Detail</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
