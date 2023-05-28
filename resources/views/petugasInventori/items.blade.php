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
            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col md:flex-row gap-3 ">
                    <div class="grid grid-cols-2 grid-rows-3 gap-2 items-center lg:w-2/3">
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
                    <div class="grid grid-cols-2 grid-rows-3 gap-2 items-center lg:w-2/3">

                        <label for="produsen" class="mr-3 font-semibold">Produsen :</label>
                        <input name="produsen" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="produsen" required />

                        <label for="amount" class="mr-3 font-semibold">Amount :</label>
                        <input name="amount" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="amount" required />

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
                    <th>Amount</th>
                    <th style="text-align-last: center">Detail</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($petugasInventori as $p) --}}
                <tr>
                    <td>1</td>
                    <td>Screwdriver</td>
                    <td>Otomotif</td>
                    <td>AHM</td>
                    <td>Toyota</td>
                    <td>10</td>
                    <td class="text-center">
                        <a href="{{ route('inventori.detail', ['id']) }}">
                            <button class="btn btn-info font-semibold">Detail</button>
                        </a>
                    </td>
                </tr>
                {{-- @endforeach --}}
            </tbody>
        </table>
    </div>
@endsection