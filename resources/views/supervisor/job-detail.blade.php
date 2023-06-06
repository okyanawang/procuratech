@extends('supervisor.drawer')

@section('supervisor-content')
    <div class="flex flex-col md:flex-row">
        <div class="flex flex-row mb-10">
            <a href="{{ route('supervisor.project.detail', ['id' => $cid]) }}" class="self-center">
                <i class="fa-solid fa-arrow-left fa-2xl"></i>
            </a>
            <h1 class="text-4xl font-bold ml-5 mb-3">{{ $job->name }}</h1>

        </div>
        <label for="edit_task" class="md:ml-5 btn btn-primary">Edit Task</label>
        <input type="checkbox" id="edit_task" class="modal-toggle" />
        <div class="modal modal-bottom lg:pl-96 lg:pr-20 pt-24">
            <div class="modal-box">
                <form action="{{ route('supervisor.project.job.update', ['id' => $job->id]) }}" method="POST"
                    class="flex flex-col" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <h3 class="font-bold text-lg mb-5">Edit Task</h3>

                    <label for="name" class="mb-2">Task Name</label>
                    <input type="text" name="name" class="input input-bordered mb-3" value="{{ $job->name }}"
                        required>
                    <label for="type" class="mb-2">Type</label>
                    <input type="text" name="type" class="input input-bordered mb-3" value="{{ $job->type }}"
                        required>
                    <label for="start_date" class="mb-2">Start Date</label>
                    <input type="date" name="start_date" class="input input-bordered mb-3"
                        value="{{ \Carbon\Carbon::parse($job->start_date)->format('Y-m-d') }}" required>
                    <label for="end_date" class="mb-2">End Date</label>
                    <input type="date" name="end_date" class="input input-bordered mb-3"
                        value="{{ \Carbon\Carbon::parse($job->end_date)->format('Y-m-d') }}" required>
                    <label for="description" class="mb-2">Description</label>
                    <textarea name="description" id="" class="textarea textarea-bordered" cols="30" rows="5" required>{{ $job->description }}</textarea>
                    <label for="image_path" class="mr-3 font-semibold">Upload Photo :</label>
                    <input name="image_path" type="file" class="file-input file-input-bordered file-input-info">

                    <div class="modal-action">
                        <label for="edit_task" class="btn btn-error">Cancel</label>
                        <input type="submit" class="btn btn-success" value="Update">
                    </div>
                </form>
            </div>
        </div>
        <label for="delete_task" class="md:ml-3 my-2 md:my-0 btn btn-error">Delete Task</label>
        <input type="checkbox" id="delete_task" class="modal-toggle" />
        <div class="modal modal-bottom sm:modal-middle lg:pl-80">
            <div class="modal-box">
                <form action="{{ route('supervisor.project.job.destroy', ['id' => $job->id]) }}" method="POST"
                    class="flex flex-col">
                    @csrf
                    @method('DELETE')
                    <h3 class="font-bold text-lg mb-5">Delete Task</h3>
                    <p>Are you sure you want to delete this task? This action can't be undone</p>
                    <div class="modal-action">
                        <label for="delete_task" class="btn btn-error">Cancel</label>
                        <input type="submit" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
        {{--  --}}
        <label for="cancel_task" class="md:ml-3 my-2 md:my-0 btn btn-warning">Cancel Task</label>
        <input type="checkbox" id="cancel_task" class="modal-toggle" />
        <div class="modal modal-bottom sm:modal-middle lg:pl-80">
            <div class="modal-box">
                <form action="{{ route('supervisor.project.job.cancel', ['id' => $job->id]) }}" method="POST"
                    class="flex flex-col">
                    @csrf
                    @method('PUT')
                    <h3 class="font-bold text-lg mb-5">Cancel Task</h3>
                    <p>Are you sure you want to cancel this task? You can only change the task through IT Admin after this
                        change</p>
                    <div class="modal-action">
                        <label for="cancel_task" class="btn btn-warning">Cancel</label>
                        <input type="submit" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
        {{--  --}}
    </div>
    <div class="container">
        <x-Alert />


        <div class="flex flex-col lg:flex-row gap-2">
            <div class="avatar w-full lg:w-1/3">
                <div class="w-full rounded-xl">
                    <img src="{{ asset('task/' . $job->image_path) }}" />
                </div>
            </div>
            <div class="flex flex-col w-full">
                <div class="flex flex-row gap-2">
                    <div class="badge badge-primary">{{ $job->type }}</div>
                    <div class="badge {{ $job->status === 'cancelled' ? 'badge-warning' : 'badge-success' }}">
                        {{ $job->status }}</div>
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
                                            <form
                                                action="{{ route('supervisor.project.job.remove_staff', ['tasks_id' => $job->id, 'users_id' => $m->id]) }}"
                                                class="flex flex-row mb-3" method="POST">
                                                @csrf
                                                <p class="mr-3">
                                                    {{ $m->name }} - {{ $m->phone_number }}
                                                </p>
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
                                            <form
                                                action="{{ route('supervisor.project.job.remove_staff', ['tasks_id' => $job->id, 'users_id' => $m->id]) }}"
                                                class="flex flex-row mb-3" method="POST">
                                                @csrf
                                                <p class="mr-3">
                                                    {{ $m->name }} - {{ $m->phone_number }}
                                                </p>
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
                                            <form
                                                action="{{ route('supervisor.project.job.remove_staff', ['tasks_id' => $job->id, 'users_id' => $m->id]) }}"
                                                class="flex flex-row mb-3" method="POST">
                                                @csrf
                                                <p class="mr-3">
                                                    {{ $m->name }} - {{ $m->phone_number }}
                                                </p>
                                                <input type="submit" class="bg-error text-white w-10 rounded-full"
                                                    style="cursor: pointer;" value="-">
                                            </form>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        <form action="{{ route('supervisor.project.job.assign_staff', ['id' => $job->id]) }}"
                            class="mt-3 flex flex-row" method="POST">
                            @csrf
                            <select name="staff" class="js-example-basic-single w-full" id="" required>
                                <option value="" disabled selected>Add Worker</option>
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
                                        <option value={{ $m->id }}>{{ $m->name }} - Worker</option>
                                    @endforeach
                                </optgroup>
                            </select>
                            {{-- <input type="hidden" name="task_id" value={{ $job->id }}> --}}

                            {{-- <input type="submit" class="btn btn-circle btn-primary" value="+"> --}}
                            <input type="submit" class="bg-primary text-white w-10 rounded-full ml-3"
                                style="cursor: pointer;" value="+">
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
                                        <form
                                            action="{{ route('supervisor.project.job.remove_staff', ['tasks_id' => $job->id, 'users_id' => $m->id]) }}"
                                            class="flex flex-row mb-3" method="POST">
                                            @csrf
                                            <p class="mr-3">
                                                {{ $m->name }} - {{ $m->phone_number }}
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
                        <form action="{{ route('supervisor.project.job.assign_staff', ['id' => $job->id]) }}"
                            class="mt-3 flex flex-row" method="POST">
                            @csrf
                            <select name="staff" class="js-example-basic-single w-full" id="">
                                <option value="" disabled selected>Add Inspector</option>
                                @foreach ($inspector_all as $i)
                                    <option value={{ $i->id }}>{{ $i->name }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="task_id" value={{ $job->id }}>

                            <input type="submit" class="bg-primary text-white w-10 rounded-full ml-3"
                                style="cursor: pointer;" value="+">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-row mt-10 mb-3">
            <h1 class="text-3xl font-bold">Items</h1>
            @if ($job->status !== 'Done')
                <label for="add_item" class="ml-5 btn btn-primary">+</label>
                <input type="checkbox" id="add_item" class="modal-toggle" />
                <div class="modal modal-bottom lg:pl-96 lg:pr-20 pt-24">
                    <div class="modal-box">
                        <form action="{{ route('supervisor.project.job.add_item', ['id' => $job->id]) }}" method="POST"
                            class="flex flex-col">
                            @csrf
                            <h3 class="font-bold text-lg mb-5">Add Item</h3>

                            <label for="item" class="mb-2">Item Name</label>
                            <select name="item" id="" class="js-example-basic-single select select-bordered">
                                <option value="">Choose Item</option>
                                <optgroup label="Parts">
                                    @foreach ($parts_all as $item)
                                        @if ($item->stock > 0)
                                            <option value="{{ $item->id }}">{{ $item->name }}
                                                ({{ $item->sku }})
                                                /
                                                {{ $item->unit }} -
                                                {{ $item->brand }}
                                            </option>
                                        @endif
                                    @endforeach
                                </optgroup>
                                <optgroup label="Material">
                                    @foreach ($material_all as $item)
                                        @if ($item->stock > 0)
                                            <option value="{{ $item->id }}">{{ $item->name }}
                                                ({{ $item->sku }})
                                                /
                                                {{ $item->unit }} -
                                                {{ $item->brand }}
                                            </option>
                                        @endif
                                    @endforeach
                                </optgroup>
                                <optgroup label="tools">
                                    @foreach ($tool_all as $item)
                                        @if ($item->stock > 0)
                                            <option value="{{ $item->id }}">{{ $item->name }}
                                                ({{ $item->sku }})
                                                /
                                                {{ $item->unit }} -
                                                {{ $item->brand }}
                                            </option>
                                        @endif
                                    @endforeach
                                </optgroup>
                            </select>
                            <label for="amount" class="mt-3 mb-2">Amount of Item</label>
                            <input type="number" name="amount" class="input input-bordered mb-3" required>

                            <div class="modal-action">
                                <label for="add_item" class="btn btn-error">Cancel</label>
                                <input type="submit" class="btn btn-success" value="Update">
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
        <div class="overflow-x-auto mb-10">
            <table id="myTable" class="table table-zebra w-full">
                <!-- head -->
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>SKU</th>
                        <th>Amount</th>
                        <th>Unit</th>
                        <th style="text-align-last: center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items_ass as $i)
                        <tr>
                            {{-- <td>{{ $i->id }}</td> --}}
                            <td>{{ $i->name }}</td>
                            <td>{{ $i->sku }}</td>
                            <td>{{ $i->amount }}</td>
                            <td>{{ $i->unit }}</td>
                            <td class="text-center">
                                @if ($job->status == 'Done')
                                    <button class="btn btn-disabled">Task already done</button>
                                @else
                                    <form
                                        action="{{ route('supervisor.project.job.items_delete', ['taskId' => $i->task_id, 'itemId' => $i->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" class="btn btn-error font-semibold" value="Delete Item">
                                    </form>
                                    {{-- <button class="btn btn-info font-semibold">Detail</button> --}}
                                    <label for="update_item-{{ $i->id }}" class="md:ml-5 btn btn-primary">Update
                                        Item</label>
                                @endif
                            </td>
                            {{-- <td class="text-center"> --}}
                            <input type="checkbox" id="update_item-{{ $i->id }}" class="modal-toggle" />
                            <div class="modal modal-bottom lg:pl-96 lg:pr-20 pt-24">
                                <div class="modal-box">
                                    <form action="{{ route('supervisor.project.job.update_item', ['id' => $i->id]) }}"
                                        method="POST" class="flex flex-col" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <h3 class="font-bold text-lg mb-5">Update Item</h3>

                                        <input type="hidden" name="items_id" value={{ $i->id }}>
                                        <input type="hidden" name="tasks_id" value={{ $i->task_id }}>
                                        <label for="name" class="mb-2">Item Name</label>
                                        <input type="text" name="name" class="input input-bordered mb-3"
                                            value="{{ $i->name }}" required readonly>
                                        <label for="amount" class="mb-2">Amount</label>
                                        <input type="number" name="amount" class="input input-bordered mb-3"
                                            value="{{ $i->amount }}" required>

                                        <div class="modal-action">
                                            <label for="update_item-{{ $i->id }}"
                                                class="btn btn-error">Cancel</label>
                                            <input type="submit" class="btn btn-success" value="Update">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- <button class="btn btn-info font-semibold">Detail</button> --}}
                            {{-- </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
        <table id="myTable2" class="table table-zebra w-full">
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
                                                            <textarea name="description_inspect" id="" class="textarea textarea-bordered" cols="30"
                                                                rows="3" required></textarea>
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
                                                <div class="badge">Review on progress, Please wait...
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
@endsection
