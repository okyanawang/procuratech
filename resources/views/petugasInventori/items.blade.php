@extends('petugasInventori.drawer')

@section('petugasInventori-content')
    <h1 class="text-4xl font-bold mb-10">Items</h1>

    <x-Alert />

    <label for="new-user" class="btn btn-primary mb-12 w-full modal-button"><i class="fa-solid fa-puzzle-piece"></i>&nbsp;
        Add new Items</label>

    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="new-user" class="modal-toggle" />
    <div class="modal modal-bottom lg:pl-80">
        <div class="modal-box w-11/12 max-w-5xl rounded-lg self-center">
            <h3 class="font-bold text-lg mb-10">Add new Items</h3>
            <form action="{{ route('inventori.register.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col md:flex-row gap-3 ">
                    <div class="grid grid-cols-2 grid-rows-3 gap-2 items-center lg:w-2/3">
                        <label for="name" class="mr-3 font-semibold">Item name :</label>
                        <input name="name" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="item name" required />
                        <label for="sku" class="mr-3 font-semibold">SKU :</label>
                        <input name="sku" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="sku" required />
                        <label for="type" class="mr-3 font-semibold">Type :</label>
                        <select class="select select-bordered block mt-1 w-full" name="type" required>
                            <option value="0" hidden disabled selected>Choose Type</option>
                            <option value="Material">Material</option>
                            <option value="Parts">Parts</option>
                            <option value="Tool">Tool</option>
                        </select>
                        <label for="brand" class="mr-3 font-semibold">Brand :</label>
                        <input name="brand" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="brand name" required />
                    </div>
                    <div class="grid grid-cols-2 grid-rows-3 gap-2 items-center lg:w-2/3">

                        <label for="produsen" class="mr-3 font-semibold">Produsen :</label>
                        <input name="produsen" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="produsen" required />

                        <label for="stock" class="mr-3 font-semibold">Stock :</label>
                        <input name="stock" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="stock" required />
                        <label for="unit" class="mr-3 font-semibold">Unit :</label>
                        <input name="unit" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="unit" required />
                        <label for="image_path" class="mr-3 font-semibold">Upload photo :</label>
                        <input name="image_path" type="file" class="file-input file-input-bordered file-input-info">

                    </div>
                </div>

                <div class="modal-action flex justify-center gap-5">
                    <label for="new-user" class="btn btn-error">cancel</label>
                    {{-- <a href="{{ route('admin.register') }}" class="btn btn-primary mb-3">Register Staff</a> --}}

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
                    <th>Name</th>
                    <th>Type</th>
                    <th>Brand</th>
                    <th>Produsen</th>
                    <th>Stock</th>
                    <th style="text-align-last: center">Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($nitems as $key => $i)
                    @if ($i->stock > 0)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $i->name }}</td>
                            <td>{{ $i->type }}</td>
                            <td>{{ $i->brand }}</td>
                            <td>{{ $i->produsen }}</td>
                            <td>{{ $i->stock }}</td>
                            <td class="text-center">
                                <a href="{{ route('inventori.detail', ['id' => $i->id]) }}">
                                    <button class="btn btn-info font-semibold">Detail</button>
                                </a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
