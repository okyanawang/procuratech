@extends('pelaksana.pekerjaan.drawer')

@section('pekerjaan-content')
<div class="flex flex-row mb-5">
    <a href="javascript:history.back()" class="self-center">
        <i class="fa-solid fa-arrow-left fa-2xl"></i>
    </a>
    <h1 class="text-4xl font-bold ml-5"></h1>
</div>
<div class="container">
    <div class="my-14">

        <div class="flex flex-row">
            <h1 class="font-bold text-2xl mb-3">{{ $task->name }}</h1>
            <p class="ml-3 mb-3 self-center"><span style="color: green;">{{ $task->start_date->format('Y-m-d') }}</span> - 
                <span style="color: red;">{{ $task->start_date->format('Y-m-d') }}</span></p>
        </div>
        <div class="flex flex-row mb-5">
            <div class="badge badge-primary mr-1">{{ $task->status }}</div>
            <div class="badge badge-info mr-1">{{ $task->type }}</div>
        </div>
        <div class="mt-5">
            <div class="mb-3">
                <h4 class="font-bold">Job Description</h4>
                <p>{{ $task->description }}</p>
            </div>
            <div class="grid grid-cols-4 gap-1 items-center">

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
            </div>


        </div>
        <div class="modal-action justify-center w-full">
            <label for="report" class="btn btn-primary">Report</label>
            {{-- <input type="submit" class="btn btn-primary" value="Submit"> --}}
        </div>
        <input type="checkbox" id="report" class="modal-toggle" />
        <div class="modal modal-bottom lg:pl-80">
            <div class="modal-box w-11/12 max-w-5xl rounded-lg self-center">
                <div class="flex flex-row justify-center">
                    <h1 class="font-bold text-2xl mb-3">Report</h1>
                    <p class="ml-3 mb-3 self-center"><span>12/12/23</span> - <span>-</span></p>
                </div>
                <div class="mt-5">
                    <textarea class="border-2 border-black rounded-md p-3 text-black w-full" name="" id="" cols="30" rows="6"></textarea>
                    <label for="image-report" class="mr-3 font-semibold">Bukti Gambar</label>
                    <input name="image-report" type="file" class=""
                        placeholder="full name" required />
                </div>
                <div class="flex justify-center gap-5">
                    <!-- The button to open modal -->
                    <label for="report" class="btn btn-error mt-5 w-50 modal-button text-white">&nbsp; Close</label>
                    <!-- The button to open modal -->
                    <label for="report" class="btn btn-primary mt-5 w-50 modal-button">&nbsp; Submit</label>
    
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
