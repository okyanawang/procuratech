@extends('admin.drawer')

@section('admin-content')
    <div class="flex flex-row mb-10">
        <a href="javascript:history.back()" class="self-center">
            <i class="fa-solid fa-arrow-left fa-2xl"></i>
        </a>
        <h1 class="text-4xl font-bold ml-5"></h1>
    </div>
    <div class="container">
        <form action="" class="h-full px-0 md:px-14 mb-40" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="justify-center flex-col md:flex-row">
                <div class="grid grid-cols-1 grid-rows-1 gap-1 items-center mb-2">
                    <!-- <h3 class="font-bold text-lg mb-10">Permintaan Alat Kerja</h3> -->
                    <!-- <label for="type" class="mr-3 font-semibold">Tipe :</label> -->
                    <select class="select select-bordered block mt-1 w-full" name="type" required>
                        <option value="0" hidden disabled selected>Choose Type</option>
                        <option value="Supervisor 1" selected>Permintaan Alat Kerja</option>
                        <option value="Supervisor 2">Permintaan Suku Cadang/Komponen</option>
                        <option value="Supervisor 3">Pengadaan Material</option>
                    </select>
                        
                </div>
            </div>
            <div class="flex flex-col md:flex-row gap-3">
                
                <div class="grid grid-cols-2 grid-rows-5 gap-2 items-center lg:w-2/3">
                    <label for="no_proyek" class="mr-3 font-semibold">No Proyek :</label>
                    <input name="no_proyek" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="no proyek" value="PR001" required />
                    <label for="judul_pekerjaan" class="mr-3 font-semibold">Judul Pekerjaan :</label>
                    <input name="judul_pekerjaan" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="judul pekerjaan" value="Perbaikan Lampu Jalan" required />
                    <label for="role" class="mr-3 font-semibold">Nama Supervisor :</label>
                    <select class="select select-bordered block mt-1 w-full" name="role" required>
                        <option value="0" hidden disabled selected>Choose Role</option>
                        <option value="Supervisor 1">Supervisor 1</option>
                        <option value="Supervisor 2" selected>Supervisor 2</option>
                        <option value="Supervisor 3">Supervisor 3</option>
                        <option value="Supervisor 4">Supervisor 4</option>
                        <option value="Supervisor 5">Supervisor 5</option>
                    </select>
                    <label for="deadline_alat_kerja" class="mr-3 font-semibold">Deadline Alat Kerja :</label>
                    <input name="deadline_alat_kerja" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="deadline alat kerja" value="2023-05-28" required />
                    <!-- <label for="deadline_suku_cadang" class="mr-3 font-semibold">Deadline Suku Cadang :</label>
                    <input name="deadline_suku_cadang" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="deadline suku cadang" value="2023-05-28" required /> -->
                </div>
                <div class="grid grid-cols-2 grid-rows-5 gap-2 items-center lg:w-2/3">

                    <label for="no_tugas_kerja" class="mr-3 font-semibold">No Tugas Kerja :</label>
                    <input name="no_tugas_kerja" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="no tugas kerja" value="TK001" required />
                    <label for="detail_pekerjaan" class="mr-3 font-semibold">Detail Pekerjaan :</label>
                    <input name="detail_pekerjaan" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="detail pekerjaan" value="Pekerjaan perbaikan lampu jalan untuk memperbaiki 24 lampu jalan yang berada di jalur utama" required />
                    <label for="lokasi_pekerjaan" class="mr-3 font-semibold">Lokasi Pekerjaan :</label>
                    <input name="lokasi_pekerjaan" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="lokasi pekerjaan" value="Jalur Utama" required />
                    <!-- <label for="deadline_material" class="mr-3 font-semibold">Deadline Material :</label>
                    <input name="deadline_material" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="deadline material" value="2023-05-28" required /> -->
                    <label for="waktu_mulai" class="mr-3 font-semibold">Waktu Mulai :</label>
                    <input name="waktu_mulai" type="time" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="waktu mulai" value="15:00" required />
                </div>
            </div>
            <div class="flex justify-center gap-5">
                <!-- The button to open modal -->
                <label for="my-modal-delete-user" class="btn btn-error mt-5 w-50 modal-button text-white"><i
                        class="fa-solid fa-trash"></i>&nbsp; Delete User</label>
                <!-- The button to open modal -->
                <label for="my-modal-6" class="btn btn-primary mt-5 w-50 modal-button"><i
                        class="fa-regular fa-pen-to-square"></i>&nbsp; Update data</label>
    
            </div>
            <!-- Put this part before </body> tag -->
            <input type="checkbox" id="my-modal-update-report" class="modal-toggle" />
            <div class="modal modal-bottom sm:modal-middle lg:pl-80">
                <div class="modal-box">
                    <h3 class="font-bold text-lg">Update data ?</h3>
                    <p class="py-4">Are you sure you want to update the report data? Data changes can be done anytime</p>
                    <div class="modal-action">
                        <label for="my-modal-update-report" class="btn">cancel</label>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </div>
            </div>

            <!-- Put this part before </body> tag -->
            <input type="checkbox" id="my-modal-delete-report" class="modal-toggle" />
            <div class="modal modal-bottom sm:modal-middle lg:pl-80">
                <div class="modal-box">
                    <h3 class="font-bold text-lg">Delete data ?</h3>
                    <p class="py-4">Are you sure you want to delete the report data? Data deleted can't be returned</p>
                    <div class="modal-action">
                        <label for="my-modal-delete-report" class="btn">cancel</label>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection
