@extends('supervisor.drawer')

@section('supervisor-content')
    <div class="flex flex-row mb-5 items-center">
        <a href="javascript:history.back()" class="self-center">
            <i class="fa-solid fa-arrow-left fa-2xl"></i>
        </a>
        <h1 class="text-4xl font-bold ml-5 mb-3">{{ $project->proj_name }}</h1>
        <p class="ml-5 text-slate-600">{{ $project->start_date }} - {{ $project->end_date }}</p>
    </div>
    <div class="container">
        <x-Alert />

        <h1 class="text-4xl font-bold mb-3">{{ $project->cat_name }}
            <span class="text-2xl">
                at {{ $project->loc_name }}
            </span>
        </h1>
        <!-- The button to open modal -->
        <label for="new-user" class="btn btn-primary mb-12 w-full modal-button"><i
                class="fa-solid fa-puzzle-piece"></i>&nbsp;
            Add new job</label>

        <!-- Put this part before </body> tag -->
        <input type="checkbox" id="new-user" class="modal-toggle" />
        <div class="modal modal-bottom lg:pl-80">
            <div class="modal-box w-11/12 max-w-5xl">
                <h3 class="font-bold text-lg mb-10">Add new job</h3>
                <form action="{{ route('supervisor.project.job.register.submit') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col md:flex-row ">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 items-center lg:w-2/3">
                            <label for="name" class="mr-3 font-semibold">Job name :</label>
                            <input name="name" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                                placeholder="full name" required />
                            <label for="type" class="mr-3 font-semibold">Type :</label>
                            <input name="type" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                                placeholder="Job type" required />
                            <label for="startdate" class="mr-3 font-semibold">Start date :</label>
                            <input name="startdate" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                                required />
                            <label for="startdate" class="mr-3 font-semibold">End date :</label>
                            <input name="enddate" type="date" class="input input-bordered w-full max-w-xs col-span-1"
                                required />
                            <label for="desc" class="mr-3 font-semibold">Description :</label>
                            <textarea name="desc" id="desc" cols="10" rows="5" class="textarea textarea-bordered" required></textarea>
                            <label for="photo" class="mr-3 font-semibold">Upload photo :</label>
                            <input type="file" class="file-input file-input-bordered file-input-info">
                            <input type="hidden" name="categories_id" value={{ $project->cat_id }}>
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
                        <th>Job Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th style="text-align-last: center">Type</th>
                        {{-- <th>Total Jobs</th> --}}
                        <th style="text-align-last: center">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $t)
                        <tr>
                            <td>{{ $t->id }}</td>
                            <td>{{ $t->name }}</td>
                            <td>{{ $t->start_date }}</td>
                            <td>{{ $t->end_date }}</td>
                            <td class="text-center">{{ $t->type }}</td>
                            <td class="text-center">
                                <a href="{{ route('supervisor.project.job.detail', ['id' => $t->id]) }}">
                                    <button class="btn btn-info font-semibold">Detail</button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
