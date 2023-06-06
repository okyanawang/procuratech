@extends('petugasInventori.drawer')

@section('petugasInventori-content')
    <div class="flex flex-row mb-10">
        <a href="/inventori/item" class="self-center">
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
                    <label for="sku" class="mr-3 font-semibold">SKU :</label>
                    <input name="sku" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="sku" value="{{ $item->sku }}" required />
                    <label for="role" class="mr-3 font-semibold">Type :</label>
                    <select class="select select-bordered block mt-1 w-full max-w-xs" name="type" required>
                        <option value="Material" @if ($item->type == 'Material') selected @endif>Material</option>
                        <option value="Parts" @if ($item->type == 'Parts') selected @endif>Parts</option>
                        <option value="Tool" @if ($item->type == 'Tool') selected @endif>Tool</option>
                    </select>
                    <label for="brand" class="mr-3 font-semibold">Brand :</label>
                    <input name="brand" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="brand name" required value="{{ $item->brand }}" />

                    <label for="produsen" class="mr-3 font-semibold">Produsen :</label>
                    <input name="produsen" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="produsen" required value="{{ $item->produsen }}" />

                    <label for="stock" class="mr-3 font-semibold">Stock :</label>
                    <input name="stock" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        placeholder="stock" disabled required value="{{ $item->stock }}" />
                    <label for="unit" class="font-semibold">Unit stock :</label>
                    <input name="unit" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                        value="{{ $item->unit }}" required />
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
                <form action="{{ route('inventori.delete.item', ['id' => $item->id]) }}" method="POST"
                    class="flex flex-col">
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


        <div class="flex flex-row">
            <h1 class="text-3xl font-bold">Item Log</h1>
            <label for="add_item" class="ml-5 btn btn-primary">+</label>
            <input type="checkbox" id="add_item" class="modal-toggle" />
            <div class="modal modal-bottom lg:pl-96 lg:pr-20 pt-24">
                <div class="modal-box">
                    <form action="{{ route('inventori.item.update.stock', ['id' => $item->id, 'is_rm' => 0]) }}"
                        method="POST" class="flex flex-col">
                        @csrf
                        <h3 class="font-bold text-lg mb-5">Add Item</h3>
                        <label for="stock" class="mt-3 mb-2">Amount of Item</label>
                        <input type="number" name="stock" class="input input-bordered mb-3" required>

                        <div class="modal-action">
                            <label for="add_item" class="btn btn-error">Cancel</label>
                            <input type="submit" class="btn btn-success" value="Update">
                        </div>
                    </form>
                </div>
            </div>
            <label for="rm_item" class="ml-5 btn btn-error text-white">-</label>
            <input type="checkbox" id="rm_item" class="modal-toggle" />
            <div class="modal modal-bottom lg:pl-96 lg:pr-20 pt-24">
                <div class="modal-box">
                    <form action="{{ route('inventori.item.update.stock', ['id' => $item->id, 'is_rm' => 1]) }}"
                        method="POST" class="flex flex-col">
                        @csrf
                        <h3 class="font-bold text-lg mb-5">Remove Item</h3>
                        <label for="stock" class="mt-3 mb-2">Amount of Item</label>
                        <input type="number" name="stock" class="input input-bordered mb-3" required>

                        <div class="modal-action">
                            <label for="rm_item" class="btn btn-error">Cancel</label>
                            <input type="submit" class="btn btn-success" value="Update">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto mb-10">
            <table id="myTable" class="table table-zebra w-full">
                <!-- head -->
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Task</th>
                        <th>Project Name</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>date</th>
                        {{-- <th style="text-align-last: center">Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($itemLogs_all as $key => $i)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $i->taskName }}</td>
                            <td>{{ $i->projectName }}</td>
                            <td>{{ $i->itemName }}</td>
                            <td>{{ $i->stock }}</td>
                            <td>{{ $i->status }}</td>
                            <td>{{ $i->created_at }}</td>
                            {{-- <td>{{ $i->id }}</td> --}}
                            {{-- <td>{{ App\Models\ItemLog::where('taskName', $i->name)->where('itemName', $item->name)->first()->taskName }}
                            </td>
                            <td>{{ App\Models\ItemLog::where('taskName', $i->name)->where('itemName', $item->name)->first()->itemName }}
                            </td>
                            <td>{{ App\Models\ItemLog::where('taskName', $i->name)->where('itemName', $item->name)->first()->stock }}
                            </td>
                            <td>{{ App\Models\ItemLog::where('taskName', $i->name)->where('itemName', $item->name)->first()->status }}
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
                                <td>
                                    <p class="truncate w-52">
                                        {{ $task->description }}
                                    </p>
                                </td>
                                <td>{{ $task->start_date }}</td>
                                <td>{{ $task->end_date }}</td>
                                <td>
                                    <a
                                        href="{{ route('inventori.task.recap', ['id' => $task->id, 'item_id' => $item->id]) }}">
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
