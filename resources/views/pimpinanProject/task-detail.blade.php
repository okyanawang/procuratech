@extends('pimpinanProject.drawer')

@section('pimpinanProject-content')
    <div class="flex flex-row mb-10">
        <a href="{{ route('pimpinan.project.location.detail', ['id' => $loc->id]) }}" class="self-center">
            <i class="fa-solid fa-arrow-left fa-2xl"></i>
        </a>
    </div>
    <div class="container">
        <div class="flex flex-col lg:flex-row justify-between">
            <div class="flex flex-col mb-5">
                <h1 class="text-4xl font-bold mb-3">{{ $proj->name }} -
                    <span class="text-primary">
                        {{ $proj->project_number }}
                    </span>
                </h1>
                <h2 class="text-2xl font-bold">{{ $cat->name }} <span>at {{ $loc->name }}</span></h2>
                <p><span class="text-green-500">{{ $proj->start_date }}</span> - <span
                        class="text-red-500">{{ $proj->end_date }}</span>
                </p>
                <p class="mt-5">{{ $proj->description }}</p>
            </div>
            <div class="avatar w-full lg:w-1/2 h-60">
                <div class="w-full rounded-xl">
                    <img src="{{ asset('project/' . $proj->image_path) }}" />
                </div>
            </div>
        </div>
        <h2 class="text-2xl font-bold mt-5">{{ $task->name }} -
            <span class="text-secondary">
                {{ $task->task_number }}
            </span>
            <span>({{ $task->type }})</span>
            <span class="ml-5 font-normal">{{ $task->start_date }} -
                {{ $task->end_date }}</span>
        </h2>
        <div class="p-2 lg:p-5">
            <div class="flex flex-col lg:flex-row gap-5 items-center">
                <div class="avatar w-full lg:w-1/2 mt-3">
                    <div class="w-full rounded-xl">
                        <img src="{{ asset('task/' . $task->image_path) }}" />
                    </div>
                </div>
                <div>
                    <div class="flex flex-row gap-2">
                        <div class="badge badge-primary">{{ $task->type }}</div>
                        <div class="badge">{{ $task->status }}</div>
                    </div>
                    <p class="mt-3">{{ $task->description }}</p>
                    <div class="mt-5 grid grid-cols-2 gap-3">
                        <div class="mb-3">
                            <h4 class="font-bold">Project Manager</h4>
                            <li>{{ Auth::user()->name }}<span> - {{ Auth::user()->phone_number }}</span>
                            </li>
                        </div>
                        <div class="mb-3">
                            <h4 class="font-bold">Supervisor</h4>
                            <li>{{ $sv->name }} - <span>{{ $sv->phone_number }}</span></li>
                        </div>
                        <div class="mb-3">
                            <h4 class="font-bold">Worker</h4>
                            @if ($worker->isNotEmpty())
                                <p>
                                    @foreach ($worker as $w)
                                        <li>{{ $w->name }} - <span>{{ $w->phone_number }}</span></li>
                                    @endforeach
                                </p>
                            @else
                                <p>No worker assigned yet</p>
                            @endif
                        </div>
                        <div class="mb-3">
                            <h4 class="font-bold">Inspector</h4>
                            @if ($inspector->isNotEmpty())
                                <p>
                                    @foreach ($inspector as $w)
                                        <li>{{ $w->name }} - <span>{{ $w->phone_number }}</span></li>
                                    @endforeach
                                </p>
                            @else
                                <p>No inspector assigned yet</p>
                            @endif
                        </div>
                        <div class="mb-3">
                            <h4 class="font-bold">Parts</h4>
                            @if ($parts->isNotEmpty())
                                <p>
                                    @foreach ($parts as $w)
                                        <li>{{ $w->name }} - <span>{{ $w->amount }} {{ $w->unit }}</span>
                                        </li>
                                    @endforeach
                                </p>
                            @else
                                <p>No parts assigned yet</p>
                            @endif
                        </div>
                        <div class="mb-3">
                            <h4 class="font-bold">Material</h4>
                            @if ($materials->isNotEmpty())
                                <p>
                                    @foreach ($materials as $w)
                                        <li>{{ $w->name }} - <span>{{ $w->amount }} {{ $w->unit }}</span>
                                        </li>
                                    @endforeach
                                </p>
                            @else
                                <p>No materials assigned yet</p>
                            @endif
                        </div>
                        <div class="mb-3">
                            <h4 class="font-bold">Tools</h4>
                            @if ($tools->isNotEmpty())
                                <p>
                                    @foreach ($tools as $w)
                                        <li>{{ $w->name }} - <span>{{ $w->amount }} {{ $w->unit }}</span>
                                        </li>
                                    @endforeach
                                </p>
                            @else
                                <p>No tools assigned yet</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h1 class="text-3xl font-bold">Item Log</h1>
        <div class="overflow-x-auto mb-10">
            <table id="myTable" class="table table-zebra w-full">
                <!-- head -->
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Amount</th>
                        <th>Unit</th>
                        <th>Status</th>
                        {{-- <th style="text-align-last: center">Action</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($itemLogs_all as $i)
                        <tr>
                            {{-- <td>{{ $i->id }}</td> --}}
                            <td>{{ $i->itemName }}</td>
                            <td>{{ $i->sku }}</td>
                            <td>{{ $i->stock }}</td>
                            <td>{{ $i->unit }}</td>
                            <td>{{ $i->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
                            <div class="badge mr-1">{{ $t->status }}</div>
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
                                                            <label for="description_inspect" class="text-md font-bold">Add
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
                                                                <option value="On Revision">Revision</option>
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
                                            <p class="mb-5">{{ $t->updated_at }}</p>
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
                                                <p class="mb-5">{{ $t->updated_at }}</p>
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
@endsection
