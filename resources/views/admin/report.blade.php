@extends('admin.drawer')

@section('admin-content')
    <h1 class="text-4xl font-bold mb-10">Reports</h1>
    <!-- The button to open modal -->
    <label for="new-user" class="btn btn-primary mb-12 w-full modal-button"><i class="fa-solid fa-user-plus"></i>&nbsp;
        Add new report</label>

    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="new-user" class="modal-toggle" />
    <div class="modal modal-bottom lg:pl-80">
        <div class="modal-box w-11/12 max-w-5xl">
            <h3 class="font-bold text-lg mb-10">Add new report</h3>
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col md:flex-row ">
                    <div class="grid grid-cols-2 gap-2 items-center lg:w-2/3">
                        
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
                    <th>No Proyek</th>
                    <th>No Tugas Kerja</th>
                    <th>Judul Pekerjaan</th>
                    <th>Nama Supervisor</th>
                    <!-- <th>Detail Pekerjaan</th>
                    <th>Lokasi Pekerjaan</th>
                    <th>Deadline Alat Kerja</th>
                    <th>Deadline Suku Cadang</th>
                    <th>Deadline Material</th>
                    <th>Waktu Mulai</th> -->
                    <th style="text-align-last: center">Status</th>
                    <th style="text-align-last: center">Detail</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($users as $user) --}}
                <tr>
                    {{-- <th>{{ $user->id - 1 }}</th> --}}
                    <th>1</th>
                    <td>PR001</td>
                    <td>TK001</td>
                    <td>Perbaikan Lampu Jalan</td>
                    <td>Jibi</td>
                    <td class="text-center">
                        <div class="badge badge-success p-4">Persiapan Alat</div>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.report_detail') }}">
                            <button class="btn btn-info font-semibold">Detail</button>
                        </a>
                    </td>
                </tr>
                {{-- @endforeach --}}
            </tbody>
        </table>
    </div>
@endsection
