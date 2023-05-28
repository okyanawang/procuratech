@extends('admin.drawer')

@section('admin-content')
<div class="flex flex-row mb-5">
    <a href="javascript:history.back()" class="self-center">
        <i class="fa-solid fa-arrow-left fa-2xl"></i>
    </a>
    <h1 class="text-4xl font-bold ml-5"></h1>
</div>

<x-Alert />

<h1 class="text-4xl font-bold mb-5">Component Detail</h1>

<div class="container">
    <form action="{{ route('admin.component.register') }}" class="h-full px-0 md:px-14 mb-10" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col xl:flex-row gap-3">
            <div class="grid grid-cols-2 grid-rows-2 gap-2 items-center lg:w-2/3">
                <label for="component_name" class="mr-3 font-semibold">Component Name :</label>
                <input name="component_name" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                    placeholder="component name" value="{{ $item->name }}" required />
                <label for="type" class="mr-3 font-semibold">Type :</label>
                <select class="select select-bordered block mt-1 w-full" name="type" required>
                    <option value="{{ $item->type }}" hidden disabled selected>{{ $item->type }}</option>
                    <option value="Material">Material</option>
                    <option value="Tool">Tool</option>
                </select>
                <label for="brand" class="mr-3 font-semibold">Brand :</label>
                <input name="brand" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                    placeholder="brand" value="{{ $item->brand }}" required />
            </div>
            <div class="grid grid-cols-2 grid-rows-2 gap-2 items-center lg:w-2/3">
                <label for="produsen" class="mr-3 font-semibold">Produsen :</label>
                <input name="produsen" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                    placeholder="produsen" value="{{ $item->produsen }}"required />
                <label for="stock" class="mr-3 font-semibold">Stock :</label>
                <input name="stock" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                    placeholder="stock" value="{{ $item->stock }}"required />
                <label for="unit" class="mr-3 font-semibold">Unit :</label>
                <input name="unit" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                    placeholder="unit" value="{{ $item->unit }}"required />
            </div>
        </div>

        <div class="flex justify-center gap-5">
            <!-- The button to open modal -->
            <label for="my-modal-delete-user" class="btn btn-error mt-5 w-50 modal-button text-white"><i
                    class="fa-solid fa-trash"></i>&nbsp; Delete Component</label>
            <!-- The button to open modal -->
            <label for="my-modal-6" class="btn btn-primary mt-5 w-50 modal-button"><i
                    class="fa-regular fa-pen-to-square"></i>&nbsp; Update data</label>

        </div>

    </form>

</div>
@endsection