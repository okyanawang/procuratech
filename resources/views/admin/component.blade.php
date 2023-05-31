@extends('admin.drawer')

@section('admin-content')
    <h1 class="text-4xl font-bold mb-10">Components</h1>

    <x-Alert />

    <!-- The button to open modal -->
    <label for="new-user" class="btn btn-primary mb-12 w-full modal-button"><i class="fa-solid fa-user-plus"></i>&nbsp;
        Add New Component</label>

    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="new-user" class="modal-toggle" />
    <div class="modal modal-bottom lg:pl-80">
        <div class="modal-box w-11/12 max-w-5xl self-center rounded-lg">
            <h3 class="font-bold text-lg mb-10">Add New Component</h3>
            <form action="{{ route('admin.component.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col md:flex-row gap-3 mb-2">
                    <div class="grid grid-cols-2 grid-rows-2 gap-2 items-center lg:w-2/3">
                        <label for="name" class="mr-3 font-semibold">Component Name :</label>
                        <input name="name" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="name" required />
                        <label for="type" class="mr-3 font-semibold">Type :</label>
                        <select class="select select-bordered block mt-1 w-full" name="type" required>
                            <option value="" disabled selected>Choose Type</option>
                            <option value="Material">Material</option>
                            <option value="Parts">Parts</option>
                        </select>
                        <label for="brand" class="mr-3 font-semibold">Brand :</label>
                        <input name="brand" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="brand" required />
                        <label for="photo" class="font-semibold">Update Photo :</label>
                        <input type="file" class="file-input file-input-bordered file-input-info">
                    </div>
                    <div class="grid grid-cols-2 grid-rows-2 gap-2 items-center lg:w-2/3">
                        <label for="produsen" class="mr-3 font-semibold">Produsen :</label>
                        <input name="produsen" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="produsen" required />
                        <label for="stock" class="mr-3 font-semibold">Stock :</label>
                        <input name="stock" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="stock" required />
                        <label for="unit" class="mr-3 font-semibold">Unit :</label>
                        <input name="unit" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="unit" required />
                    </div>
                </div>


                <div class="modal-action flex justify-center gap-5">
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
                    <th>Component Name</th>
                    <th>Stock</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->stock }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.component.detail', $item->id) }}">
                                <button class="btn btn-info font-semibold">Detail</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
