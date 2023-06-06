@extends('admin.drawer')

@section('admin-content')
    <div class="flex flex-row mb-10">
        <a href="/admin/component" class="self-center">
            <i class="fa-solid fa-arrow-left fa-2xl"></i>
        </a>
        <h1 class="text-4xl font-bold ml-5"></h1>
    </div>

    <x-Alert />

    <h1 class="text-4xl font-bold mb-5">Component Detail</h1>
    <div class="container">
        <form action=" {{ route('admin.component.update', ['id' => $item->id]) }}" class="h-full px-0 md:px-14 mb-10"
            method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex flex-col xl:flex-row gap-3 place-content-center">
                <div class="avatar w-full lg:w-1/3">
                    <div class="w-full rounded-xl">
                        <img src="{{ asset('item/' . $item->image_path) }}" />
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 items-center w-full md:w-full xl:w-1/2 mb-5">
                    <label for="name" class="mr-3 font-semibold">Component Name :</label>
                    <input name="name" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="Component Name" required value="{{ $item->name }} " />
                    <label for="sku" class="mr-3 font-semibold">SKU :</label>
                    <input name="sku" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="sku" value="{{ $item->sku }}" required />
                    <label for="type" class="mr-3 font-semibold">Type :</label>
                    <select name="type" id="" class="select select-bordered">
                        <option value="Parts" {{ $item->type == 'Parts' ? 'selected' : '' }}>Parts</option>
                        <option value="Material" {{ $item->type == 'Material' ? 'selected' : '' }}>Material</option>
                        <option value="Tool" {{ $item->type == 'Tool' ? 'selected' : '' }}>Tool</option>
                    </select>
                    {{-- <input name="type" type="text" class="input input-bordered w-full max-w-xs col-span-1" required
                        value="{{ $item->type }}" /> --}}
                    <label for="brand" class="font-semibold">Brand :</label>
                    <input name="brand" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        value="{{ $item->brand }}" required />
                    <label for="produsen" class="font-semibold">Produsen :</label>
                    <input name="produsen" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        value="{{ $item->produsen }}" required />
                    <label for="stock" class="font-semibold">Stock :</label>
                    <input name="stock" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        value="{{ $item->stock }}" required />
                    <label for="unit" class="font-semibold">Unit stock :</label>
                    <input name="unit" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        value="{{ $item->unit }}" required />
                    <label for="unit" class="font-semibold">Update photo :</label>
                    <input name="image_path" type="file" class="file-input file-input-bordered file-input-info">
                </div>
                {{-- <div class="grid grid-cols-2 grid-rows-3 gap-2 items-center w-full md:w-full xl:w-1/2 mb-5">
                </div> --}}
            </div>
            <div class="flex justify-center gap-1">
                <!-- The button to open modal -->
                <label for="modal-delete" class="btn btn-error mt-5 w-50 modal-button text-white"><i
                        class="fa-solid fa-trash"></i>&nbsp; Delete Component</label>
                <!-- The button to open modal -->
                <label for="modal-update" class="btn btn-primary mt-5 w-50 modal-button"><i
                        class="fa-regular fa-pen-to-square"></i>&nbsp; Update Component</label>

            </div>

            <!-- Put this part before </body> tag -->
            <input type="checkbox" id="modal-update" class="modal-toggle" />
            <div class="modal modal-bottom sm:modal-middle lg:pl-80">
                <div class="modal-box">
                    <h3 class="font-bold text-lg">Update data ?</h3>
                    <p class="py-4">Are you sure you want to update the Component data? Data changes can be done anytime
                    </p>
                    <div class="modal-action">
                        <label for="modal-update" class="btn btn-info">cancel</label>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </div>
            </div>

        </form>
        <input type="checkbox" id="modal-delete" class="modal-toggle" />
        <div class="modal modal-bottom sm:modal-middle lg:pl-80">
            <div class="modal-box">
                <h3 class="font-bold text-lg">Delete data?</h3>
                <p class="py-4">Are you sure you want to delete the component? It will also delete all their relation to
                    location</p>
                <form action="{{ route('admin.component.delete', ['id' => $item->id]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="modal-action">
                        <label for="modal-delete" class="btn btn-info">cancel</label>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>

        <div class="">
            <h1 class="text-2xl font-bold mb-5">Task List</h1>
            <div class="overflow-x-auto">
                <table id="myTable" class="table table-zebra w-full">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Task name</th>
                            <th>Description</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $key => $task)
                            <tr>
                                <th>{{ $key + 1 }}</th>
                                <td>{{ $task->name }}</td>
                                <td>{{ $task->description }}</td>
                                <td>{{ $task->start_date }}</td>
                                <td>{{ $task->end_date }}</td>
                                <td>
                                    <a href="{{ route('admin.project.task.detail', ['id' => $task->id]) }}">
                                        <button class="btn btn-info font-semibold">Detail</button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>
@endsection
