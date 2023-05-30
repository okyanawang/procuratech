@extends('pimpinanProject.drawer')

@section('pimpinanProject-content')
    <div class="flex flex-row mb-10">
        <a href="javascript:history.back()" class="self-center">
            <i class="fa-solid fa-arrow-left fa-2xl"></i>
        </a>
    </div>
    <div class="container">
        <div class="flex flex-col lg:flex-row justify-between">
            <div class="flex flex-col mb-5">
                <h1 class="text-4xl font-bold mb-3">{{ $proj->name }}</h1>
                <h2 class="text-2xl font-bold">{{ $cat->name }} <span class="text-xl">at {{ $loc->name }}</span></h2>
                <p><span class="text-green-500">{{ $proj->start_date }}</span> - <span
                        class="text-red-500">{{ $proj->end_date }}</span>
                </p>
                <p class="mt-5">{{ $proj->description }}</p>
            </div>
            <div class="avatar w-full lg:w-1/2 h-60">
                <div class="w-full rounded-xl">
                    @if($proj->image_path != null)
                        <img src="{{ asset('project/' . $proj->image_path) }}" />
                    @else
                        <img src="https://picsum.photos/200" />
                    @endif
                </div>
            </div>
        </div>
        <h2 class="text-2xl font-bold mt-5">{{ $task->name }} <span class="text-xl">({{ $task->type }})</span> <span
                class="ml-5 font-normal text-xl">{{ $task->start_date }} -
                {{ $task->end_date }}</span></h2>
        <div class="p-2 lg:p-5">
            <div class="flex flex-col lg:flex-row gap-5 items-center">
                <div class="avatar w-full lg:w-1/2 mt-3">
                    <div class="w-full rounded-xl">
                        @if($task->image_path != null)
                            <img src="{{ asset('task/' . $task->image_path) }}" />
                        @else
                            <img src="https://picsum.photos/200" />
                        @endif
                    </div>
                </div>
                <div>
                    <div class="flex flex-row gap-2">
                        <div class="badge badge-primary">{{ $task->type }}</div>
                        <div class="badge badge-info">{{ $task->status }}</div>
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
                            @foreach ($worker as $w)
                                <li>{{ $w->name }} - <span>{{ $w->phone_number }}</span></li>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <h4 class="font-bold">Inspector</h4>
                            @foreach ($inspector as $w)
                                <li>{{ $w->name }} - <span>{{ $w->phone_number }}</span></li>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <h4 class="font-bold">Parts</h4>
                            @foreach ($parts as $i)
                                <li>{{ $i->name }} - <span>{{ $i->quantity }} {{ $i->unit }}</span></li>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <h4 class="font-bold">Material</h4>
                            @foreach ($materials as $i)
                                <li>{{ $i->name }} - <span>{{ $i->quantity }} {{ $i->unit }}</span></li>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
