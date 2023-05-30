@extends('pelaksana.analisis.drawer')

@section('analisis-content')
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
                @if($project->project_image != null)
                    <img src="{{ asset('project/' . $project->project_image) }}" />
                @else
                    <img src="https://picsum.photos/200" />
                @endif
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
                <div class="avatar w-full lg:w-1/2">
                    <div class="w-full rounded-xl">
                        @if($task->image_path != null)
                            <img src="{{ asset('task/' . $task->image_path) }}" />
                        @else
                            <img src="https://picsum.photos/200" />
                        @endif
                    </div>
                </div>
                <div class="flex flex-col gap-2">
                    <div class="badge badge-primary mr-1">
                        @if ($reports)
                            {{ $reports->status }}
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
            
            <div class="modal-action justify-center w-full">
                @if ($reports == null)
                <form action="{{ route('analisis.tasks.execute', ['id' => $task->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="submit" class="btn btn-primary" value="Execute Task">
                    {{-- <button class="btn btn-primary">Execute Task</button> --}}
                </form>
                @else
                    <label for="report" class="btn btn-info">Report</label>
                    <input type="checkbox" id="report" class="modal-toggle" />
                    <div class="modal modal-bottom lg:pl-80">
                        <div class="modal-box w-11/12 max-w-5xl rounded-lg self-center">
                            <form action="{{ route('analisis.tasks.update', ['id' => $reports->id]) }}" enctype="multipart/form-data" method="POST">
                                {{-- {{ route('analisis.tasks.update', ['id' => $reports->id]) }} --}}
                                @csrf
                                @method('PUT')
                                <div class="flex flex-row justify-center">
                                    <h1 class="font-bold text-2xl mb-3">Report</h1>
                                </div>
                                <div class="mt-5">
                                    <textarea class="textarea textarea-bordered p-3 text-black w-full" name="description_work" id="description_work" cols="30"
                                        rows="6" placeholder="I have done ...." required></textarea>
                                    <label for="image_path_work" class="mr-3 font-semibold">Proof of picture</label>
                                    <input name="image_path_work" type="file" class="file-input file-input-bordered file-input-info"
                                        placeholder="full name" required />
                                </div>
                                <div class="flex justify-center gap-5 mt-5">
                                    <label for="report" class="btn btn-error w-50 modal-button text-white">
                                        Close</label>
                                    <input type="submit" class="btn btn-primary" value="Report">
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
