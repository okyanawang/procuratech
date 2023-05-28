@extends('pelaksana.pengukuran.drawer')

@section('pengukuran-content')
    <div class="flex flex-row mb-5">
        <a href="javascript:history.back()" class="self-center">
            <i class="fa-solid fa-arrow-left fa-2xl"></i>
        </a>
        <h1 class="text-4xl font-bold ml-5"></h1>
    </div>
    <div class="container">
        <div class="my-14">

            <div class="flex flex-row">
                <h1 class="font-bold text-2xl mb-3">Job name</h1>
                <p class="ml-3 mb-3 self-center"><span>12/12/23</span> - <span>-</span></p>
            </div>
            <div class="flex flex-row mb-5">
                <div class="badge badge-primary mr-1">on progress</div>
                <div class="badge badge-info mr-1">pengukuran</div>
            </div>
            <div class="mt-5">
                <div class="mb-3">
                    <h4 class="font-bold">Job Description</h4>
                    <p>Hallo</p>
                </div>
                <div class="grid grid-cols-4 gap-1 items-center">

                    <div class="mb-3">
                        <h4 class="font-bold">Project Manager</h4>
                        <p>ikal - <span>0192739012</span></p>
                    </div>
                    <div class="mb-3">
                        <h4 class="font-bold">Supervisor</h4>
                        <p>ikal - <span>0192739012</span></p>
                    </div>
                    <div class="mb-3">
                        <h4 class="font-bold">Woker</h4>
                        <p>ikal <span>as measurer</span> - <span>0192739012</span></p>
                    </div>
                    <div class="mb-3">
                        <h4 class="font-bold">Work Checker</h4>
                        <p>ikal - <span>0192739012</span></p>
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
                    <form action="">
                        @csrf
                        <div class="flex flex-row justify-center">
                            <h1 class="font-bold text-2xl mb-3">Report</h1>
                        </div>
                        <div class="mt-5">
                            <textarea class="textarea textarea-bordered p-3 text-black w-full" name="" id="" cols="30"
                                rows="6" placeholder="I have done ...." required></textarea>
                            <label for="image-report" class="mr-3 font-semibold">Proof of picture</label>
                            <input name="image-report" type="file" class="file-input file-input-bordered file-input-info"
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

        </div>

    </div>
@endsection
