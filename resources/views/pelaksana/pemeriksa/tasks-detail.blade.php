@extends('pelaksana.pemeriksa.drawer')

@section('pemeriksa-content')
    <div class="flex flex-row mb-5 items-center bg-slate-200 p-0 lg:p-5 rounded-xl">
        <a href="/pemeriksa/tasks" class="self-center hidden md:block">
            <i class="fa-solid fa-arrow-left fa-2xl"></i>
        </a>
        <div class="flex flex-col mx-5 self-center w-full">
            <h1 class="text-xl lg:text-4xl font-bold">{{ $project->name }} -
                <span class="text-primary">
                    {{ $project->project_number }}
                </span>
            </h1>
            <p>{{ $project->description }}</p>
        </div>
        <div class="avatar w-full justify-end">
            <div class="w-40 h-w-40 rounded-xl">
                <img src="{{ asset('project/' . $project->image_path) }}" />
            </div>
        </div>
    </div>
    <div class="container">
        <x-Alert />

        <div class="my-14">

            <div class="flex flex-row">
                <h1 class="font-bold text-2xl mb-3">{{ $task->name }} -
                    <span class="text-secondary">
                        {{ $task->task_number }}
                    </span>
                    ({{ $category->name }}) at {{ $location->name }}
                </h1>
                <p class="ml-3 mb-3 self-center"><span style="color: green;">{{ $task->start_date->format('Y-m-d') }}</span>
                    -
                    <span style="color: red;">{{ $task->end_date->format('Y-m-d') }}</span>
                </p>
            </div>

            <div class="flex flex-col lg:flex-row mb-5 gap-5">
                <div class="avatar w-full lg:w-1/2">
                    <div class="w-full rounded-xl">
                        <img src="{{ asset('task/' . $task->image_path) }}" />
                    </div>
                </div>
                <div class="flex flex-col gap-2 w-full">
                    <div class="flex flex-row">
                        <div class="badge badge-primary mr-1">{{ $task->status }}</div>
                        <div class="badge badge-info mr-1">{{ $task->type }}</div>
                    </div>
                    <div class="mt-5">
                        <div class="mb-5">
                            <h4 class="font-bold">Job Description</h4>
                            <p>{{ $task->description }}</p>
                        </div>
                        <div class="grid gripd-cols-1 lg:grid-cols-2 gap-2 lg:gap-5 items-center">
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
                                @if ($parts->isNotEmpty())
                                    <div class="flex flex-col">
                                        @foreach ($parts as $ins)
                                            <p>
                                                {{ $ins->name }} ({{ $ins->sku }})
                                                <span> - {{ $ins->amount }} {{ $ins->unit }}</span>
                                            </p>
                                        @endforeach
                                    </div>
                                @else
                                    <p>No parts required</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <h4 class="font-bold">Materials</h4>
                                @if ($material->isNotEmpty())
                                    <div class="flex flex-col">
                                        @foreach ($material as $ins)
                                            <p>
                                                {{ $ins->name }} ({{ $ins->sku }})
                                                <span> - {{ $ins->amount }} {{ $ins->unit }}</span>
                                            </p>
                                        @endforeach
                                    </div>
                                @else
                                    <p>No materials required</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <h4 class="font-bold">Tools</h4>
                                @if ($tools->isNotEmpty())
                                    <div class="flex flex-col">
                                        @foreach ($tools as $ins)
                                            <p>
                                                {{ $ins->name }} ({{ $ins->sku }})
                                                <span> - {{ $ins->amount }} {{ $ins->unit }}</span>
                                            </p>
                                        @endforeach
                                    </div>
                                @else
                                    <p>No toolss required</p>
                                @endif
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="w-full text-center">
                <form action="{{ route('pemeriksa.tasks.complete', ['id' => $task->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="submit" class="btn btn-primary" value="Complete Job">
                </form>
            </div>
            <h1 class="text-3xl font-bold mt-10">Reports</h1>
            <table id="myTable" class="table table-zebra w-full">
                <!-- head -->
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Worker Name</th>
                        <th>date</th>
                        <th class="!text-center">Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $key => $t)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $t->name }}</td>
                            <td>{{ $t->created_at }}</td>
                            <td class="text-center">
                                <div class="badge badge-primary mr-1">{{ $t->status }}</div>
                            </td>
                            <td class="">
                                @if ($t->status == 'On Review')
                                    <label for="report-{{ $t->id }}" class="btn btn-info">Review</label>
                                    <!-- Put this part before </body> tag -->
                                    <input type="checkbox" id="report-{{ $t->id }}" class="modal-toggle" />
                                    <div class="modal modal-bottom sm:modal-middle lg:pl-80">
                                        <div class="modal-box w-full lg:w-11/12" style="max-width: none !important">
                                            <form
                                                action="{{ route('pemeriksa.tasks.update_inspect', ['id' => $t->id, 'worker_id' => $t->worker_id]) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="flex flex-row justify-center">
                                                    <h1 class="font-bold text-2xl mb-3">Report</h1>
                                                </div>
                                                <div class="mt-5 flex flex-col lg:flex-row gap-5 !text-left">
                                                    <div class="avatar w-full lg:w-1/2">
                                                        <div class="w-full rounded-xl">
                                                            <img src="{{ asset('report/' . $t->image_path_work) }}" />
                                                        </div>
                                                    </div>
                                                    <div class="flex flex-col text-left justify-between w-full">
                                                        <div class="flex flex-col gap-3">
                                                            <h1 class="text-xl font-bold">Job report</h1>
                                                            <p class="mb-5">{{ $t->description_work }}</p>
                                                            <div class="flex flex-col">
                                                                <label for="description_inspect"
                                                                    class="text-md font-bold">Add
                                                                    notes
                                                                    :</label>
                                                                <textarea name="description_inspect" id="" class="textarea textarea-bordered" cols="30" rows="3"
                                                                    required></textarea>
                                                            </div>
                                                            <div class="flex flex-col">
                                                                <label for="photo_inspect" class="text-md font-bold">Add
                                                                    photo
                                                                    :</label>
                                                                <input type="file" name="image_path_inspect"
                                                                    class="file-input file-input-bordered file-input-info"
                                                                    required>
                                                            </div>
                                                            <div class="flex flex-col">
                                                                <label for="status" class="text-md font-bold">Status
                                                                    :</label>
                                                                <select name="status" id=""
                                                                    class="select select-bordered w-full" required>
                                                                    <option value="" disabled selected>Set Status
                                                                    </option>
                                                                    <option value="Done">Done</option>
                                                                    <option value="Revision">Revision</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex justify-center gap-5 mt-5">
                                                    <label for="report-{{ $t->id }}"
                                                        class="btn btn-error w-50 modal-button text-white">
                                                        Close</label>
                                                    <input type="submit" class="btn btn-primary" value="Submit">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @else
                                    <label for="detail-{{ $t->id }}" class="btn btn-info"
                                        @if ($t->status == 'In Progress') disabled @endif>detail</label>
                                    <input type="checkbox" id="detail-{{ $t->id }}" class="modal-toggle" />
                                    <div class="modal modal-bottom lg:pl-80">
                                        <div class="modal-box w-full lg:w-11/12 lg:max-w-5xl">
                                            <div class="flex flex-row justify-center">
                                                <h1 class="font-bold text-2xl mb-3">Job Report</h1>
                                            </div>
                                            <div class="mt-5 flex flex-col lg:flex-row gap-5 !text-left">
                                                <div class="avatar w-full lg:w-1/2">
                                                    <div class="w-full rounded-xl">
                                                        <img src="{{ asset('report/' . $t->image_path_work) }}" />
                                                    </div>
                                                </div>
                                                <div class="flex flex-col text-left justify-between w-full">
                                                    <div class="flex flex-col gap-3">
                                                        <h1 class="text-xl font-bold">Report</h1>
                                                        <p class="mb-5">{{ $t->description_work }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($t->description_inspect == null)
                                                <div class="flex flex-col gap-3 items-center">
                                                    <div class="badge badge-primary">Review on progress, Please wait...
                                                    </div>
                                                </div>
                                            @else
                                                <div class="flex flex-row justify-center">
                                                    <h1 class="font-bold text-2xl mb-3">Job Review</h1>
                                                </div>
                                                <div class="mt-5 flex flex-col lg:flex-row gap-5 !text-left">
                                                    <div class="avatar w-full lg:w-1/2">
                                                        <div class="w-full rounded-xl">
                                                            <img src="{{ asset('report/' . $t->image_path_inspect) }}" />
                                                        </div>
                                                    </div>
                                                    <div class="flex flex-col text-left justify-between w-full">
                                                        <div class="flex flex-col gap-3">
                                                            <h1 class="text-xl font-bold">Review</h1>
                                                            <p class="mb-5">{{ $t->description_inspect }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="flex justify-center gap-5 mt-5">
                                                <label for="detail-{{ $t->id }}"
                                                    class="btn btn-error w-50 modal-button text-white">
                                                    Close</label>
                                            </div>
                                        </div>
                                    </div>
                                @endif


                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>
@endsection
