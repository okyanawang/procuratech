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
            <div class="flex flex-col xl:flex-row ">
                <div class="grid grid-cols-2 gap-2 items-center w-full md:w-full xl:w-1/2 mb-5">
                    <label for="" class="mr-3 font-semibold">No Proyek :</label>
                    <input type="text" placeholder="Type here" class="input input-ghost w-full max-w-xs col-span-1"
                        value="PR001" name="nik" />
                    <label for="" class="mr-3 font-semibold">No Tugas Kerja :</label>
                    <input type="text" placeholder="Type here" class="input input-ghost w-full max-w-xs col-span-1"
                        value="TK001" name="name" />
                    <label for="" class="mr-3 font-semibold">Judul Pekerjaan :</label>
                    <input type="text" placeholder="Type here" class="input input-ghost w-full max-w-xs col-span-1"
                        value="Perbaikan Lampu Jalan" name="name" />
                    <label for="" class="mr-3 font-semibold">Nama Supervisor :</label>
                    <input type="text" placeholder="Type here" class="input input-ghost w-full max-w-xs col-span-1"
                        value="Jibi" name="name" />
                    <label for="" class="mr-3 font-semibold">Detail Pekerjaan :</label>
                    <input type="text" placeholder="Type here" class="input input-ghost w-full max-w-xs col-span-1"
                        value="Pekerjaan perbaikan lampu jalan untuk memperbaiki 24 lampu jalan yang berada di jalur utama" name="name" />
                    <label for="" class="mr-3 font-semibold">Lokasi Pekerjaan :</label>
                    <input type="text" placeholder="Type here" class="input input-ghost w-full max-w-xs col-span-1"
                        value="Jalur Utama" name="name" />
                    <label for="" class="mr-3 font-semibold">Deadline Alat Kerja :</label>
                    <input type="text" placeholder="Type here" class="input input-ghost w-full max-w-xs col-span-1"
                        value="29 Juni 2023" name="name" />
                    <label for="" class="mr-3 font-semibold">Deadline Suku Cadang :</label>
                    <input type="text" placeholder="Type here" class="input input-ghost w-full max-w-xs col-span-1"
                        value="29 Juni 2023" name="name" />
                    <label for="" class="mr-3 font-semibold">Deadline Material :</label>
                    <input type="text" placeholder="Type here" class="input input-ghost w-full max-w-xs col-span-1"
                        value="29 Juni 2023" name="name" />
                    <label for="" class="mr-3 font-semibold">Waktu Mulai :</label>
                    <input type="text" placeholder="Type here" class="input input-ghost w-full max-w-xs col-span-1"
                        value="1 Juli 2023" name="name" />
                </div>
            </div>
            <!-- The button to open modal -->
            <label for="my-modal-update-report" class="btn btn-primary mt-12 w-full modal-button"><i
                    class="fa-regular fa-pen-to-square"></i>&nbsp; Update data</label>

            <!-- The button to open modal -->
            <label for="my-modal-delete-report" class="btn btn-error mt-12 w-full modal-button text-white"><i
                    class="fa-solid fa-trash"></i>&nbsp; Delete Report</label>

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
