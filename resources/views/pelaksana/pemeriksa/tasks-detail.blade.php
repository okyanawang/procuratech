@extends('pelaksana.pemeriksa.drawer')

@section('pemeriksa-content')
    <div class="flex flex-row mb-5 items-center bg-slate-200 p-0 lg:p-5 rounded-xl">
        <a href="javascript:history.back()" class="self-center hidden md:block">
            <i class="fa-solid fa-arrow-left fa-2xl"></i>
        </a>
        <div class="flex flex-col mx-5 self-center w-full">
            <h1 class="text-xl lg:text-4xl font-bold">{{ $project->project_name }}</h1>
            <p>{{ $project->project_description }}</p>
        </div>
        <div class="avatar w-full justify-end">
            <div class="w-40 h-w-40 rounded-xl">
                <img src="https://picsum.photos/200" />
            </div>
        </div>
    </div>
    <div class="container">
        <div class="my-14">

            <div class="flex flex-row">
                <h1 class="font-bold text-2xl mb-3">{{ $task->name }} ({{ $category->name }}) <span class="text-xl">at
                        {{ $location->name }}</span></h1>
                <p class="ml-3 mb-3 self-center"><span style="color: green;">{{ $task->start_date->format('Y-m-d') }}</span>
                    -
                    <span style="color: red;">{{ $task->end_date->format('Y-m-d') }}</span>
                </p>
            </div>

            <div class="flex flex-col lg:flex-row mb-5 gap-5">
                <div class="avatar w-full lg:w-1/3">
                    <div class="w-full rounded-xl">
                        <img src="https://picsum.photos/200" />
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <div class="flex flex-row">
                        <div class="badge badge-primary mr-1">{{ $task->status }}</div>
                        <div class="badge badge-info mr-1">{{ $task->type }}</div>
                    </div>
                    <div class="mt-5">
                        <div class="mb-5">
                            <h4 class="font-bold">Job Description</h4>
                            <p>{{ $task->description }}</p>
                        </div>
                        <div class="grid gripd-cols-1 lg:grid-cols-2 gap-10 items-center">
                            <div class="mb-3">
                                <h4 class="font-bold">Project Manager</h4>
                                <p>
                                    @foreach ($pm_ass as $pm)
                                        {{ $pm->name }}
                                        <span> - {{ $pm->phone_number }}</span>
                                    @endforeach
                                </p>
                            </div>
                            <div class="mb-3">
                                <h4 class="font-bold">Supervisor</h4>
                                <p>
                                    @foreach ($spv_ass as $spv)
                                        {{ $spv->name }}
                                        <span> - {{ $spv->phone_number }}</span>
                                    @endforeach
                                </p>
                            </div>
                            <div class="mb-3">
                                <h4 class="font-bold">Teams</h4>
                                @if ($teams->isNotEmpty())
                                    <p>
                                        @foreach ($teams as $t)
                                            {{ $t->name }}
                                            <span> - {{ $t->phone_number }}</span>
                                            <span> - {{ $t->role }} <br></span>
                                        @endforeach
                                    </p>
                                @else
                                    <p>No team formed yet</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <h4 class="font-bold">Inspector</h4>
                                @if ($ins_ass->isNotEmpty())
                                    <p>
                                        @foreach ($ins_ass as $ins)
                                            {{ $ins->name }}
                                            <span> - {{ $ins->phone_number }}</span>
                                        @endforeach
                                    </p>
                                @else
                                    <p>No inspector assigned yet</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <h4 class="font-bold">Parts</h4>
                                {{-- @if ($ins_ass->isNotEmpty())
                                    <p>
                                        @foreach ($ins_ass as $ins)
                                            {{ $ins->name }}
                                            <span> - {{ $ins->phone_number }}</span>
                                        @endforeach
                                    </p>
                                @else --}}
                                <p>No parts required</p>
                                {{-- @endif --}}
                            </div>
                            <div class="mb-3">
                                <h4 class="font-bold">Materials</h4>
                                {{-- @if ($ins_ass->isNotEmpty())
                                    <p>
                                        @foreach ($ins_ass as $ins)
                                            {{ $ins->name }}
                                            <span> - {{ $ins->phone_number }}</span>
                                        @endforeach
                                    </p>
                                @else --}}
                                <p>No materials required</p>
                                {{-- @endif --}}
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <h1 class="text-3xl font-bold mt-10">Reports</h1>
            <table id="myTable" class="table table-zebra w-full">
                <!-- head -->
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Worker Name</th>
                        <th class="!text-center">Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($tasks as $key => $t) --}}
                    <tr>
                        <td>1</td>
                        <td>labib</td>
                        <td class="text-center">
                            <div class="badge badge-primary mr-1">on Progress</div>
                        </td>
                        <td class="">
                            <label for="report" class="btn btn-info">Report</label>

                            <!-- Put this part before </body> tag -->
                            <input type="checkbox" id="report" class="modal-toggle" />
                            <div class="modal modal-bottom sm:modal-middle lg:pl-80">
                                <div class="modal-box w-full lg:w-11/12" style="max-width: none !important">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="flex flex-row justify-center">
                                            <h1 class="font-bold text-2xl mb-3">Report</h1>
                                        </div>
                                        <div class="mt-5 flex flex-col lg:flex-row gap-5 !text-left">
                                            <div class="avatar w-full lg:w-1/2">
                                                <div class="w-full rounded-xl">
                                                    <img src="https://picsum.photos/200" />
                                                </div>
                                            </div>
                                            <div class="flex flex-col text-left justify-between w-full">
                                                <div class="flex flex-col gap-3">
                                                    <h1 class="text-xl font-bold">Job report</h1>
                                                    <p class="mb-5">description</p>
                                                    <div class="flex flex-col">
                                                        <label for="desc_inspect" class="text-md font-bold">Add notes
                                                            :</label>
                                                        <textarea name="desc_inspect" id="" class="textarea textarea-bordered" cols="30" rows="3"></textarea>
                                                    </div>
                                                    <div class="flex flex-col">
                                                        <label for="photo_inspect" class="text-md font-bold">Add photo
                                                            :</label>
                                                        <input type="file"
                                                            class="file-input file-input-bordered file-input-info">
                                                    </div>
                                                    <div class="flex flex-col">
                                                        <label for="status" class="text-md font-bold">Status :</label>
                                                        <select name="status" id=""
                                                            class="select select-bordered w-full">
                                                            <option value="done">Done</option>
                                                            <option value="revision">Revision</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex justify-center gap-5 mt-5">
                                            <label for="report" class="btn btn-error w-50 modal-button text-white">
                                                Close</label>
                                            <input type="submit" class="btn btn-primary" value="Submit">
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </td>
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
            </table>

        </div>

    </div>
@endsection
