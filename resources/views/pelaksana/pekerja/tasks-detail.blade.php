@extends('pelaksana.pekerja.drawer')

@section('pekerja-content')
    <div class="flex flex-row mb-5 items-center bg-slate-200 p-0 lg:p-5 rounded-xl">
        <a href="/pekerja/tasks" class="self-center hidden md:block">
            <i class="fa-solid fa-arrow-left fa-2xl"></i>
        </a>
        <div class="flex flex-col mx-5 self-center w-full">
            <h1 class="text-xl lg:text-4xl font-bold">{{ $project->project_name }} -
                <span class="text-primary">
                    {{ $project->project_number }}
                </span>
            </h1>
            <p>{{ $project->project_description }}</p>
        </div>
        <div class="avatar w-full justify-end">
            <div class="w-40 h-w-40 rounded-xl">
                <img src="{{ asset('project/' . $project->project_image) }}" />
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
                <div class="flex flex-col gap-2">
                    <div class="badge mr-1">
                        @if ($reports)
                            @if ($reports->status == 'Pending')
                                Revision
                            @else
                                {{ $reports->status }}
                            @endif
                        @else
                            Pending
                        @endif
                        {{-- {{ $task->status }} --}}
                    </div>
                    <div class="badge badge-info mr-1">{{ $task->type }}</div>
                    <div class="mt-5">
                        <div class="mb-5">
                            <h4 class="font-bold">Job Description</h4>
                            <p>{{ $task->description }}</p>
                        </div>
                        <div class="grid gripd-cols-1 lg:grid-cols-2 gap-5 items-center">
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
                                    <p>No material required</p>
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
                                    <p>No tools required</p>
                                @endif
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <div class="modal-action justify-center w-full">
                @if ($reports == null || $reports->status == 'Pending' || $reports->status == null || $reports->status == 'On Revision')
                    <form action="{{ route('pekerja.tasks.execute', ['id' => $task->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="submit" class="btn btn-primary" value="Execute Task">
                        {{-- <button class="btn btn-primary">Execute Task</button> --}}
                    </form>
                @else
                    @switch($reports->status)
                        @case('On Review')
                            <button class="btn btn-disabled">Your Work is On review...</button>
                        @break

                        @case('In Progress')
                            {{-- <button class="btn btn-disabled">Your Work is On Progress...</button> --}}
                            <label for="report" class="btn btn-info">Report</label>
                            <input type="checkbox" id="report" class="modal-toggle" />
                            <div class="modal modal-bottom lg:pl-80">
                                <div class="modal-box w-11/12 max-w-5xl rounded-lg self-center">
                                    <form action="{{ route('pekerja.tasks.update', ['id' => $reports->id]) }}"
                                        enctype="multipart/form-data" method="POST">
                                        {{-- {{ route('pekerja.tasks.update', ['id' => $reports->id]) }} --}}
                                        @csrf
                                        @method('PUT')
                                        <div class="flex flex-row justify-center">
                                            <h1 class="font-bold text-2xl mb-3">Report</h1>
                                        </div>
                                        <div class="mt-5">
                                            <textarea class="textarea textarea-bordered p-3 text-black w-full" name="description_work" id="description_work"
                                                cols="30" rows="6" placeholder="I have done ...." required></textarea>
                                            <label for="image_path_work" class="mr-3 font-semibold">Proof of picture</label>
                                            <input name="image_path_work" type="file"
                                                class="file-input file-input-bordered file-input-info" placeholder="full name"
                                                required />
                                        </div>
                                        <div class="flex justify-center gap-5 mt-5">
                                            <label for="report" class="btn btn-error w-50 modal-button text-white">
                                                Close</label>
                                            <input type="submit" class="btn btn-primary" value="Report">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @break

                        @case('Done')
                            <button class="btn btn-disabled">Your Work is Done</button>
                        @break

                        @default
                    @endswitch
                @endif
            </div>

            <div class="mt-10">
                <h1 class="text-2xl font-bold">My Reports</h1>
                <table id="myTable" class="table table-zebra w-full">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>date</th>
                            <th class="!text-center">Status</th>
                            <th style="text-align-last: center">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports_by_user as $key => $t)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $t->created_at }}</td>
                                <td class="text-center">
                                    @if ($t->status == 'Pending')
                                        <div class="badge mr-1">{{ $t->status }}</div>
                                    @else
                                        <div class="badge mr-1">{{ $t->status }}</div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <label for="detail-{{ $t->id }}" class="btn btn-info">detail</label>
                                    <input type="checkbox" id="detail-{{ $t->id }}" class="modal-toggle" />
                                    <div class="modal modal-bottom lg:pl-80">
                                        <div class="modal-box w-full lg:w-11/12 lg:max-w-5xl">
                                            <div class="flex flex-row justify-center">
                                                <h1 class="font-bold text-2xl mb-3">Job Report</h1>
                                                <p class="mb-5">{{ $t->created_at }}</p>
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
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
