@extends('pimpinanProject.drawer')

@section('pimpinanProject-content')
    <div class="flex flex-row mb-10">
        <a href="javascript:history.back()" class="self-center">
            <i class="fa-solid fa-arrow-left fa-2xl"></i>
        </a>
        <h1 class="text-4xl font-bold ml-5 mb-3">{{ $loc->name }}</h1>
    </div>
    <div class="container">
        <x-Alert />

        <!-- The button to open modal -->
        <label for="new-user" class="btn btn-primary mb-12 w-full modal-button"><i class="fa-solid fa-puzzle-piece"></i>&nbsp;
            Add new category</label>

        <!-- Put this part before </body> tag -->
        <input type="checkbox" id="new-user" class="modal-toggle" />
        <div class="modal modal-bottom lg:pl-80">
            <div class="modal-box w-11/12 max-w-5xl rounded-lg self-center">
                <h3 class="font-bold text-lg mb-10">Add new category</h3>
                <form action="{{ route('pimpinan.project.category.register.submit') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-col md:flex-row ">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 items-center lg:w-2/3">
                            <label for="name" class="mr-3 font-semibold">Category name :</label>
                            <input name="name" type="text" class="input input-bordered w-full max-w-xs col-span-1"
                                placeholder="Category name" required />
                            <label for="uid" class="mr-3 font-semibold">Supervisor :</label>
                            <select name="uid" class="js-example-basic-single select select-bordered" id="">
                                <option value="" selected disabled>Choose supervisor</option>
                                @foreach ($svs as $s)
                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                @endforeach
                            </select>
                            {{-- <label for="lid" class="mr-3 font-semibold">Location ID :</label> --}}
                            {{-- <input name="lid" type="text" class="input input-bordered w-full max-w-xs col-span-1" required value="{{ $loc->id }} " /> --}}
                            <input type="hidden" name="lid" value={{ $loc->id }}>
                        </div>
                    </div>

                    <div class="modal-action">
                        <label for="new-user" class="btn btn-error">cancel</label>
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>

        <div class="overflow-x-auto mb-80">
            <table id="myTable" class="table table-zebra w-full">
                <!-- head -->
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Supervisor</th>
                        <th style="text-align-last: center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cats as $c)
                        <tr>
                            <td>{{ $c->id }}</td>
                            <td>{{ $c->name }}</td>
                            <td>{{ $c->sv_name }}</td>
                            <td class="text-center">
                                <!-- The button to open modal -->
                                <label for="cat_detail-{{ $c->id }}" class="btn btn-primary modal-button">
                                    Detail</label>
                                <!-- The button to open modal -->
                                <label for="cat_delete" class="btn btn-error modal-button">
                                    Delete</label>
                            </td>

                            <!-- Put this part before </body> tag -->
                            <input type="checkbox" id="cat_detail-{{ $c->id }}" class="modal-toggle" />
                            <div class="modal modal-bottom lg:pl-80">
                                <div class="modal-box w-11/12 max-w-5xl rounded-lg self-center">
                                    <h1 class="text-3xl font-bold mb-2">{{ $proj->name }}</h1>
                                    <div class="flex flex-row">
                                        <h1 class="font-bold text-2xl mb-3">{{ $c->name }} <span>at
                                                {{ $loc->name }}</span></h1>
                                    </div>
                                    <div class="mt-5 grid grid-cols-2">
                                        <div class="mb-3">
                                            <h4 class="font-bold">Project Manager</h4>
                                            <li>{{ Auth::user()->name }}<span> - {{ Auth::user()->phone_number }}</span>
                                            </li>
                                        </div>
                                        <div class="mb-3">
                                            <h4 class="font-bold">Supervisor</h4>
                                            <li>{{ $c->sv_name }} - <span>0192739012</span></li>
                                        </div>
                                    </div>
                                    <div class="mt-5">
                                        <h1 class="font-bold text-xl">List of Tasks</h1>
                                        <div class="flex flex-col max-h-52 overflow-auto">
                                            @foreach (DB::table('tasks')->where('categories_id', $c->id)->select('tasks.*')->get() as $t)
                                                <div class="mb-3 grid grid-cols-3 w-full items-center">
                                                    <h4 class="">{{ $t->name }}</h4>
                                                    <div class="badge badge-primary mr-1 text-center">{{ $t->status }}</div>
                                                    <a
                                                        href="{{ route('pimpinan.project.category.task.detail', ['id' => $t->id]) }}">
                                                        <button class="btn btn-info font-semibold">Detail</button>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="modal-action">
                                        <label for="cat_detail-{{ $c->id }}" class="btn btn-error">close</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Put this part before </body> tag -->
                            <input type="checkbox" id="cat_delete" class="modal-toggle" />
                            <div class="modal lg:pl-80">
                                <div class="modal-box w-11/12 max-w-5xl">
                                    <div class="flex flex-col">
                                        <h1 class="font-bold text-2xl mb-3">Delete Category?</h1>
                                        <p>Are you sure you want to delete the category? This action can't be undone</p>
                                    </div>
                                    <div class="modal-action">
                                        <label for="cat_delete" class="btn btn-primary">close</label>
                                        <form action="" method="POST">
                                            <input type="submit" class="btn btn-error" value="Delete">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
