@extends('petugasInventori.drawer')

@section('petugasInventori-content')
    <div class="flex flex-row mb-10">
        <a href="javascript:history.back()" class="self-center">
            <i class="fa-solid fa-arrow-left fa-2xl"></i>
        </a>
        <h1 class="text-4xl font-bold ml-5"></h1>
    </div>
    <div class="container">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col md:flex-row gap-3 ">
                <div class="grid grid-cols-2 grid-rows-2 gap-2 items-center w-full md:w-full xl:w-1/2 mb-5">
                    <label for="name" class="mr-3 font-semibold">Item name :</label>
                    <input name="name" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="item name" required />
                    <label for="role" class="mr-3 font-semibold">Type :</label>
                    <select class="select select-bordered block mt-1 w-full" name="role" required>
                        <option value="0" hidden disabled selected>Choose Type</option>
                        <option value="Admin IT">Admin IT</option>
                        <option value="Project Manager">Project Manager</option>
                        <option value="Supervisor">Supervisor</option>
                        <option value="Measurement Executor">Measurement Executor</option>
                        <option value="Analyst">Analystis</option>
                    </select>
                    <label for="brand" class="mr-3 font-semibold">Brand :</label>
                    <input name="brand" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="brand name" required />
                </div>
                <div class="grid grid-cols-2 grid-rows-3 gap-2 items-center w-full md:w-full xl:w-1/2 mb-5">

                    <label for="produsen" class="mr-3 font-semibold">Produsen :</label>
                    <input name="produsen" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="produsen" required />

                    <label for="amount" class="mr-3 font-semibold">Amount :</label>
                    <input name="amount" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="amount" required />

                </div>
            </div>
            <div class="flex justify-center gap-5">
                <!-- The button to open modal -->
                <label for="my-modal-delete-items" class="btn btn-error mt-5 w-50 modal-button text-white"><i
                        class="fa-solid fa-trash"></i>&nbsp; Delete Items</label>
                <!-- The button to open modal -->
                <label for="my-modal-6" class="btn btn-primary mt-5 w-50 modal-button"><i
                        class="fa-regular fa-pen-to-square"></i>&nbsp; Update Items</label>

            </div>
            <!-- Put this part before </body> tag -->
            <input type="checkbox" id="my-modal-6" class="modal-toggle" />
            <div class="modal modal-bottom sm:modal-middle lg:pl-80">
                <div class="modal-box">
                    <h3 class="font-bold text-lg">Update Items ?</h3>
                    <p class="py-4">Are you sure you want to update the Items data ? Data changes can be done anytime</p>
                    <div class="modal-action">
                        <label for="my-modal-6" class="btn">cancel</label>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </div>
            </div>
            <input type="checkbox" id="my-modal-delete-items" class="modal-toggle" />
            <div class="modal modal-bottom sm:modal-middle lg:pl-80">
                <div class="modal-box">
                    <h3 class="font-bold text-lg">Delete Items ?</h3>
                    <p class="py-4">Are you sure you want to Delete the Items ?</p>
                    <div class="modal-action">
                        <label for="my-modal-delete-items" class="btn">cancel</label>
                        <input type="submit" class="btn btn-primary" value="Delete">
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection
