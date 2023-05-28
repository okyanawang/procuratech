@extends('pelaksana.pekerjaan.drawer')

@section('pekerjaan-content')
    <h1 class="text-4xl font-bold mb-10">Tasks</h1>
    <div class="overflow-x-auto mb-80">
        <table id="myTable" class="table table-zebra w-full">
            <!-- head -->
            <thead>
                <tr>
                    <th>No</th>
                    <th>Task Name</th>
                    <th>Job Description</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th style="text-align-last: center">Detail</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($pengukuran as $p) --}}
                    <tr>
                        <td>1</td>
                        <td>Hone</td>
                        <td>lorem ipsum dolor sit amet</td>
                        <td>27/01/23</td>
                        <td>29/01/23</td>
                        <td class="text-center">
                            <a href="{{ route('pekerjaan.tasks.detail', ['id']) }}">
                                <button class="btn btn-info font-semibold">Detail</button>
                            </a>
                        </td>
                    </tr>    
                {{-- @endforeach --}}
            </tbody>
        </table>
    </div>
@endsection
