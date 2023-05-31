@extends('petugasInventori.drawer')

@section('petugasInventori-content')
    <div class="flex flex-row mb-10">
        <a href="javascript:history.back()" class="self-center">
            <i class="fa-solid fa-arrow-left fa-2xl"></i>
        </a>
        <h1 class="text-4xl font-bold ml-5">Detail Items</h1>
    </div>
    <div class="container">
        <form action="{{ route('inventori.item.update', ['id' => $item->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex flex-col md:flex-row gap-3 ">
                <div class="avatar w-full lg:w-1/3 p-5">
                    <div class="w-full rounded-xl">
                        <img src="{{ asset('item/' . $item->image_path) }}" />
                    </div>
                </div>
                {{-- <div class="grid grid-cols-2 grid-rows-2 gap-2 items-center w-full md:w-full xl:w-1/2 mb-5">
                </div> --}}
                <div class="grid grid-cols-2 gap-2 items-center w-full lg:w-1/2 mb-5">
                    <label for="name" class="mr-3 font-semibold">Item name :</label>
                    <input name="name" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="item name" required value="{{ $item->name }}" />
                    <label for="role" class="mr-3 font-semibold">Type :</label>
                    <select class="select select-bordered block mt-1 w-full max-w-xs" name="type" required>
                        <option value="Material" @if ($item->type == 'Material') selected @endif>Material</option>
                        <option value="Parts" @if ($item->type == 'Parts') selected @endif>Parts</option>
                    </select>
                    <label for="brand" class="mr-3 font-semibold">Brand :</label>
                    <input name="brand" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="brand name" required value="{{ $item->brand }}" />

                    <label for="produsen" class="mr-3 font-semibold">Produsen :</label>
                    <input name="produsen" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="produsen" required value="{{ $item->produsen }}" />

                    <label for="stock" class="mr-3 font-semibold">Stock :</label>
                    <input name="stock" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="stock" required value="{{ $item->stock }}" />
                    <label for="image_path" class="mr-3 font-semibold">Upload Photo :</label>
                    <input name="image_path" type="file" class="file-input file-input-bordered file-input-info">

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
                    <p class="py-4">Are you sure you want to update the Items data ? </p>
                    <div class="modal-action">
                        <label for="my-modal-6" class="btn">cancel</label>
                        <input type="submit" class="btn btn-primary" value="Update">
                    </div>
                </div>
            </div>
        </form>
        <input type="checkbox" id="my-modal-delete-items" class="modal-toggle" />
        <div class="modal modal-bottom sm:modal-middle lg:pl-80">
            <div class="modal-box">
                <form action="{{ route('inventori.delete.item', ['id' => $item->id]) }}" method="POST" class="flex flex-col">
                    {{-- @method('DELETE') --}}
                    @csrf
                    @method('PUT')
                    <h3 class="font-bold text-lg mb-5">Delete Item</h3>
                    <p>Are you sure you want to delete this item? This action can't be undone</p>
                    <div class="modal-action">
                        <label for="modal-delete" class="btn btn-error">Cancel</label>
                        <input type="submit" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>


    </div>
@endsection
