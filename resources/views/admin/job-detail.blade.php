@extends('admin.drawer')

@section('admin-content')
    <div class="flex flex-row mb-5">
        <a href="javascript:history.back()" class="self-center">
            <i class="fa-solid fa-arrow-left fa-2xl"></i>
        </a>
        <h1 class="text-4xl font-bold ml-5"></h1>
    </div>

    <x-Alert />

    <h1 class="text-4xl font-bold mb-5">Job Detail</h1>

    <div class="container">

        <form action="" class="h-full px-0 md:px-14 mb-10" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col xl:flex-row gap-3">
                <div class="grid grid-cols-2 grid-rows-3 gap-2 items-center w-full md:w-full xl:w-1/2 mb-5">
                    <label for="job" class="font-semibold">Job Name :</label>
                    <input name="job" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        value="" required />
                    <label for="desc" class="mr-3 font-semibold">Description :</label>
                    <input name"desc" type="textarea" class="input input-bordered w-full max-w-xs col-span-1"
                        value="" required />
                    <label for="staff" class="font-semibold">Staff :</label>
                    <input name="staff" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        value="" required />
                </div>
                <div class="grid grid-cols-2 grid-rows-3 gap-2 items-center w-full md:w-full xl:w-1/2 mb-5">
                    <label for="regis-date" class="font-semibold">Registration Date :</label>
                    <input name="regis-date" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                        value="" required />

                    <label for="start-date" class="font-semibold">Start Date :</label>
                    <input name="start-date" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                        value="" required />

                    <label for="finish-date" class="font-semibold">Expectatio Finish Date :</label>
                    <input name="finish-date" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                        value="" required />
                </div>
            </div>

            <div class="flex justify-center gap-5">
                <!-- The button to open modal -->
                <label for="my-modal-delete-user" class="btn btn-error mt-5 w-50 modal-button text-white"><i
                        class="fa-solid fa-trash"></i>&nbsp; Delete Project</label>
                <!-- The button to open modal -->
                <label for="my-modal-6" class="btn btn-primary mt-5 w-50 modal-button"><i
                        class="fa-regular fa-pen-to-square"></i>&nbsp; Update data</label>

            </div>

            <!-- Put this part before </body> tag -->
            <input type="checkbox" id="my-modal-6" class="modal-toggle" />
            <div class="modal modal-bottom sm:modal-middle lg:pl-80">
                <div class="modal-box">
                    <h3 class="font-bold text-lg">Update data ?</h3>
                    <p class="py-4">Are you sure you want to update the staff data? Data changes can be done anytime</p>
                    <div class="modal-action">
                        <label for="my-modal-6" class="btn">cancel</label>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </div>
            </div>
        </form>


    </div>
@endsection
