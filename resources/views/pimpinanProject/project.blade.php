@extends('pimpinanProject.drawer')

@section('pimpinanProject-content')
    <h1 class="text-4xl font-bold mb-10">Projects</h1>

    <x-Alert />

    <!-- The button to open modal -->
    <label for="new-user" class="btn btn-primary mb-12 w-full modal-button"><i class="fa-solid fa-puzzle-piece"></i>&nbsp;
        Add new Project</label>

    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="new-user" class="modal-toggle" />
    <div class="modal modal-bottom lg:pl-80">
        <div class="modal-box w-11/12 max-w-5xl">
            <h3 class="font-bold text-lg mb-10">Add new project</h3>
            <form action="{{ route('pimpinan.project.register.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col md:flex-row ">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 items-center lg:w-2/3">
                        <label for="name" class="mr-3 font-semibold">Project name :</label>
                        <input name="name" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                            placeholder="full name" required />
                        <label for="start_date" class="mr-3 font-semibold">Start date :</label>
                        <input name="start_date" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                            required />
                        <label for="end_date" class="mr-3 font-semibold">End date :</label>
                        <input name="end_date" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                            required />
                        {{-- <label for="supervisor" class="mr-3 font-semibold">Supervisor :</label>
                        <select name="supervisor" class="js-example-basic-single select select-bordered" id="">
                            @foreach ($sv as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select> --}}
                        <label for="status" class="mr-3 font-semibold">Status :</label>
                        <select class="select select-bordered" name="status" id="status">
                            <option value="Pending">Pending</option>
                            <option value="On Progress">On Progress</option>
                            <option value="Done">Done</option>
                        </select>
                        <label for="description" class="mr-3 font-semibold">description :</label>
                        <textarea name="description" id="desc" cols="10" rows="5" class="textarea textarea-bordered"></textarea>
                    </div>
                </div>

                <div class="modal-action">
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
                    <th>Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th style="text-align-last: center">Total Location(s)</th>
                    {{-- <th>Total Jobs</th> --}}
                    <th style="text-align-last: center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $p)
                    <tr>
                        <td>{{ $p->id }}</td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->start_date }}</td>
                        <td>{{ $p->end_date }}</td>
                        <td class="text-center">3</td>
                        <td class="text-center">
                            <a href="{{ route('pimpinan.project.detail', ['id' => $p->id]) }}">
                                <button class="btn btn-info font-semibold">Detail</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
