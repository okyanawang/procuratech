@extends('supervisor.drawer')

@section('supervisor-content')
    <div class="flex flex-row mb-10">
        <a href="javascript:history.back()" class="self-center">
            <i class="fa-solid fa-arrow-left fa-2xl"></i>
        </a>
        <h1 class="text-4xl font-bold ml-5 mb-3">Job Name</h1>
    </div>
    <div class="container">
        <x-Alert />

        <div class="flex flex-row gap-2">
            <div class="badge badge-primary">type</div>
            <div class="badge badge-info">condition</div>
        </div>

        <div class="mt-3 mb-3">desc</div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mt-5">
            {{-- <h3 class=" text-2xl font-bold mt-10">Staff involved</h3> --}}
            <div class="">
                <h3 class="text-xl font-bold">Project Manager</h3>
                <li>Ikal</li>
            </div>
            <div class="">
                <h3 class="text-xl font-bold">Supervisor</h3>
                <li>{{ Auth::user()->name }}</li>
            </div>
            <div class="flex flex-col">
                <h3 class="text-xl font-bold">Worker</h3>
                <ul class="list-disc ml-5">
                    <li>
                        <form action="" class="flex flex-row mb-3">
                            <p class="mr-3">
                                Ikal
                            </p>
                            <input type="submit" class="bg-error text-white w-10 rounded-full" style="cursor: pointer;"
                                value="-">
                        </form>
                    </li>
                </ul>
                <form action="" class="mt-3 flex flex-row">
                    <select name="worker" class="js-example-basic-single w-full" id="">
                        <option value="" selected>Add Worker</option>
                        <option value="LA">lalala</option>
                        <option value="YE">yeyeye</option>
                        <option value="HA">hehehe</option>
                    </select>

                    {{-- <input type="submit" class="btn btn-circle btn-primary" value="+"> --}}
                    <input type="submit" class="bg-primary text-white w-10 rounded-full ml-3" style="cursor: pointer;"
                        value="+">
                </form>
            </div>
            <div class="flex flex-col">
                <h3 class="text-xl font-bold">Checker</h3>
                <ul class="list-disc ml-5">
                    <li>
                        <form action="" class="flex flex-row mb-3">
                            <p class="mr-3">
                                Ikal
                            </p>
                            <input type="submit" class="bg-error text-white w-10 rounded-full" style="cursor: pointer;"
                                value="-">
                        </form>
                    </li>
                </ul>
                <form action="" class="mt-3 flex flex-row">
                    <select name="checker" class="js-example-basic-single w-full" id="">
                        <option value="" selected>Add Checker</option>
                        <option value="LA">lalala</option>
                        <option value="YE">yeyeye</option>
                        <option value="HA">hehehe</option>
                    </select>

                    {{-- <input type="submit" class="btn btn-circle btn-primary" value="+"> --}}
                    <input type="submit" class="bg-primary text-white w-10 rounded-full ml-3" style="cursor: pointer;"
                        value="+">
                </form>
            </div>
            <div class="flex flex-col">
                <h3 class="text-xl font-bold">Tools</h3>
                <ul class="list-disc ml-5">
                    <li>
                        <form action="" class="flex flex-row mb-3">
                            <p class="mr-3">
                                Ikal
                            </p>
                            <input type="submit" class="bg-error text-white w-10 rounded-full" style="cursor: pointer;"
                                value="-">
                        </form>
                    </li>
                </ul>
                <form action="" class="mt-3 flex flex-row">
                    <select name="tools" class="js-example-basic-single w-full" id="">
                        <option value="" selected>Add Tools</option>
                        <option value="LA">lalala</option>
                        <option value="YE">yeyeye</option>
                        <option value="HA">hehehe</option>
                    </select>

                    {{-- <input type="submit" class="btn btn-circle btn-primary" value="+"> --}}
                    <input type="submit" class="bg-primary text-white w-10 rounded-full ml-3" style="cursor: pointer;"
                        value="+">
                </form>
            </div>
            <div class="flex flex-col">
                <h3 class="text-xl font-bold">Components</h3>
                <ul class="list-disc ml-5">
                    <li>
                        <form action="" class="flex flex-row mb-3">
                            <p class="mr-3">
                                Ikal
                            </p>
                            <input type="submit" class="bg-error text-white w-10 rounded-full" style="cursor: pointer;"
                                value="-">
                        </form>
                    </li>
                </ul>
                <form action="" class="mt-3 flex flex-row">
                    <select name="component" class="js-example-basic-single w-full" id="">
                        <option value="" selected>Add Component</option>
                        <option value="LA">lalala</option>
                        <option value="YE">yeyeye</option>
                        <option value="HA">hehehe</option>
                    </select>

                    {{-- <input type="submit" class="btn btn-circle btn-primary" value="+"> --}}
                    <input type="submit" class="bg-primary text-white w-10 rounded-full ml-3" style="cursor: pointer;"
                        value="+">
                </form>
            </div>
        </div>
    </div>
@endsection
