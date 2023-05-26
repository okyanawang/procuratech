@extends('supervisor.drawer')

@section('supervisor-content')
    <div class="flex flex-row mb-10">
        <a href="javascript:history.back()" class="self-center">
            <i class="fa-solid fa-arrow-left fa-2xl"></i>
        </a>
        <h1 class="text-4xl font-bold ml-5 mb-3">{{ $job->name }}</h1>
    </div>
    <div class="container">
        <x-Alert />

        <div class="flex flex-row gap-2">
            <div class="badge badge-primary">{{ $job->type }}</div>
            <div class="badge badge-info">{{ $job->status }}</div>
        </div>

        <div class="mt-3 mb-3">{{ $job->description }}</div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mt-5">
            {{-- <h3 class=" text-2xl font-bold mt-10">Staff involved</h3> --}}
            <div class="">
                <h3 class="text-xl font-bold">Project Manager</h3>
                <li>{{ $pm->name }}</li>
            </div>
            <div class="">
                <h3 class="text-xl font-bold">Supervisor</h3>
                <li>{{ Auth::user()->name }}</li>
            </div>
            <div class="flex flex-col">
                <h3 class="text-xl font-bold">Worker</h3>
                <div class="ml-5">
                    <h3 class="text-lg font-bold">Analyst(s)</h3>
                    <ul class="list-disc ml-5">
                        @if ($analyst_ass->isEmpty())
                            <p>No Analyst on this task</p>
                        @else
                            @foreach ($analyst_ass as $m)
                                <li>
                                    <form action="{{ route('supervisor.project.job.remove_staff') }}"
                                        class="flex flex-row mb-3" method="POST">
                                        @csrf
                                        <p class="mr-3">
                                            {{ $m->name }}
                                        </p>
                                        <input type="hidden" name="staff" value={{ $m->id }}>
                                        <input type="hidden" name="task_id" value={{ $job->id }}>
                                        <input type="submit" class="bg-error text-white w-10 rounded-full"
                                            style="cursor: pointer;" value="-">
                                    </form>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="ml-5">
                    <h3 class="text-lg font-bold">Measurer(s)</h3>
                    <ul class="list-disc ml-5">
                        @if ($measurer_ass->isEmpty())
                            <p>No measurer on this task</p>
                        @else
                            @foreach ($measurer_ass as $m)
                                <li>
                                    <form action="{{ route('supervisor.project.job.remove_staff') }}"
                                        class="flex flex-row mb-3" method="POST">
                                        @csrf
                                        <p class="mr-3">
                                            {{ $m->name }}
                                        </p>
                                        <input type="hidden" name="staff" value={{ $m->id }}>
                                        <input type="hidden" name="task_id" value={{ $job->id }}>
                                        <input type="submit" class="bg-error text-white w-10 rounded-full"
                                            style="cursor: pointer;" value="-">
                                    </form>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="ml-5">
                    <h3 class="text-lg font-bold">Worker(s)</h3>
                    <ul class="list-disc ml-5">
                        @if ($worker_ass->isEmpty())
                            <p>No worker on this task</p>
                        @else
                            @foreach ($worker_ass as $m)
                                <li>
                                    <form action="{{ route('supervisor.project.job.remove_staff') }}"
                                        class="flex flex-row mb-3" method="POST">
                                        @csrf
                                        <p class="mr-3">
                                            {{ $m->name }}
                                        </p>
                                        <input type="hidden" name="staff" value={{ $m->id }}>
                                        <input type="hidden" name="task_id" value={{ $job->id }}>
                                        <input type="submit" class="bg-error text-white w-10 rounded-full"
                                            style="cursor: pointer;" value="-">
                                    </form>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <form action="{{ route('supervisor.project.job.assign_staff') }}" class="mt-3 flex flex-row"
                    method="POST">
                    @csrf
                    <select name="staff" class="js-example-basic-single w-full" id="">
                        <option value="" selected>Add Worker</option>
                        <optgroup label="Measurer">
                            @foreach ($measurer_all as $m)
                                <option value={{ $m->id }}>{{ $m->name }} - Measurer</option>
                            @endforeach
                        </optgroup>
                        <optgroup label="Analyst">
                            @foreach ($analyst_all as $m)
                                <option value={{ $m->id }}>{{ $m->name }} - Analyst</option>
                            @endforeach
                        </optgroup>
                        <optgroup label="Worker">
                            @foreach ($worker_all as $m)
                                <option value={{ $m->id }}>{{ $m->name }} - Measurer</option>
                            @endforeach
                        </optgroup>
                    </select>
                    <input type="hidden" name="task_id" value={{ $job->id }}>

                    {{-- <input type="submit" class="btn btn-circle btn-primary" value="+"> --}}
                    <input type="submit" class="bg-primary text-white w-10 rounded-full ml-3" style="cursor: pointer;"
                        value="+">
                </form>
            </div>
            <div class="flex flex-col">
                <h3 class="text-xl font-bold">Inspector(s)</h3>
                <ul class="list-disc ml-5">
                    @if ($inspector_ass->isEmpty())
                        <p>No inspector on this task</p>
                    @else
                        @foreach ($inspector_ass as $m)
                            <li>
                                <form action="{{ route('supervisor.project.job.remove_staff') }}"
                                    class="flex flex-row mb-3" method="POST">
                                    @csrf
                                    <p class="mr-3">
                                        {{ $m->name }}
                                    </p>
                                    <input type="hidden" name="staff" value={{ $m->id }}>
                                    <input type="hidden" name="task_id" value={{ $job->id }}>
                                    <input type="submit" class="bg-error text-white w-10 rounded-full"
                                        style="cursor: pointer;" value="-">
                                </form>
                            </li>
                        @endforeach
                    @endif
                </ul>
                <form action="{{ route('supervisor.project.job.assign_staff') }}" class="mt-3 flex flex-row"
                    method="POST">
                    @csrf
                    <select name="staff" class="js-example-basic-single w-full" id="">
                        <option value="" selected>Add Inspector</option>
                        @foreach ($inspector_all as $i)
                            <option value={{ $i->id }}>{{ $i->name }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="task_id" value={{ $job->id }}>

                    <input type="submit" class="bg-primary text-white w-10 rounded-full ml-3" style="cursor: pointer;"
                        value="+">
                </form>
            </div>
        </div>
    </div>
@endsection
