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
                <div class="flex flex-col md:flex-row gap-3">
                    <div class="grid grid-cols-2 grid-rows-5 gap-2 items-center lg:w-2/3">
                        <label for="no_proyek" class="mr-3 font-semibold">No Proyek :</label>
                        <input name="no_proyek" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="no proyek" required />
                        <label for="judul_pekerjaan" class="mr-3 font-semibold">Judul Pekerjaan :</label>
                        <input name="judul_pekerjaan" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="judul pekerjaan" required />
                        <label for="role" class="mr-3 font-semibold">Nama Supervisor :</label>
                        <select class="select select-bordered block mt-1 w-full" name="role" required>
                            <option value="0" hidden disabled selected>Choose Role</option>
                            <option value="Supervisor 1">Supervisor 1</option>
                            <option value="Supervisor 2">Supervisor 2</option>
                            <option value="Supervisor 3">Supervisor 3</option>
                            <option value="Supervisor 4">Supervisor 4</option>
                            <option value="Supervisor 5">Supervisor 5</option>
                        </select>
                        <label for="deadline_alat_kerja" class="mr-3 font-semibold">Deadline Alat Kerja :</label>
                        <input name="deadline_alat_kerja" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="deadline alat kerja" required />
                        <label for="deadline_suku_cadang" class="mr-3 font-semibold">Deadline Suku Cadang :</label>
                        <input name="deadline_suku_cadang" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="deadline suku cadang" required />
                    </div>
                    <div class="grid grid-cols-2 grid-rows-5 gap-2 items-center lg:w-2/3">

                        <label for="no_tugas_kerja" class="mr-3 font-semibold">No Tugas Kerja :</label>
                        <input name="no_tugas_kerja" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="no tugas kerja" required />
                        <label for="detail_pekerjaan" class="mr-3 font-semibold">Detail Pekerjaan :</label>
                        <input name="detail_pekerjaan" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="detail pekerjaan" required />
                        <label for="lokasi_pekerjaan" class="mr-3 font-semibold">Lokasi Pekerjaan :</label>
                        <input name="lokasi_pekerjaan" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="lokasi pekerjaan" required />
                        <label for="deadline_material" class="mr-3 font-semibold">Deadline Material :</label>
                        <input name="deadline_material" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="deadline material" required />
                        <label for="waktu_mulai" class="mr-3 font-semibold">Waktu Mulai :</label>
                        <input name="waktu_mulai" type="time" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="waktu mulai" required />
                    </div>
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
                    <th style="text-align-last: center">Jenis</th>
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
                    <td>Supervisor 1</td>
                    <td class="text-center">
                        <div class="badge badge-warning p-4">Permintaan Alat Kerja</div>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.report_detail') }}">
                            <button class="btn btn-info font-semibold">Detail</button>
                        </a>
                    </td>
                </tr>
                <tr>
                    {{-- <th>{{ $user->id - 1 }}</th> --}}
                    <th>2</th>
                    <td>PR001</td>
                    <td>TK002</td>
                    <td>Perbaikan Lampu Jalan</td>
                    <td>Supervisor 2</td>
                    <td class="text-center">
                        <div class="badge badge-success p-4">Permintaan Suku Cadang/Komponen</div>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.report_detail') }}">
                            <button class="btn btn-info font-semibold">Detail</button>
                        </a>
                    </td>
                </tr>
                <tr>
                    {{-- <th>{{ $user->id - 1 }}</th> --}}
                    <th>3</th>
                    <td>PR001</td>
                    <td>TK003</td>
                    <td>Perbaikan Lampu Jalan</td>
                    <td>Supervisor 3</td>
                    <td class="text-center">
                        <div class="badge badge-info p-4">Pengadaan Material</div>
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
