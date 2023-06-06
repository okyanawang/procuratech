<!DOCTYPE html>
<html lang="en" data-theme="garden">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Procuratech</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script> --}}

</head>

<body>
    <x-Navbar />
    <div>
        @yield('content')
    </div>
    <x-Footer />

    @yield('scripts')
    <script>
        let table = new DataTable('#myTable', {
            // options
        });

        let table2 = new DataTable('#myTable2', {
            // options
        });

        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });

        let badges = document.getElementsByClassName('badge');
        for (let badge of badges) {
            // console.log(badges);
            if (badge.innerText == "Done" || badge.innerHTML == "Done" || badge.innerText == "Admin IT") {
                badge.classList.add('badge-success');
            } else if (badge.innerText == "Pending" || badge.innerText == "Revision" ||
                badge.innerHTML == "Pending" || badge.innerText == "On Revision" || badge.innerHTML == "On Revision") {
                badge.classList.add('badge-warning');
            } else if (badge.innerText == "Cancelled" || badge.innerHTML == "Cancelled") {
                badge.classList.add('badge-danger');
            } else if (badge.innerText == "Project Manager" || badge.innerText == "In Progress" || badge.innerText ==
                "On Progress" || badge.innerHTML == "On Progress") {
                badge.classList.add('badge-primary');
            } else if (badge.innerText == "Supervisor") {
                badge.classList.add('badge-info');
            } else if (badge.innerText == "Measurement Executor" || badge.innerText == "Analyst" || badge.innerText ==
                "Job Executor") {
                badge.classList.add('badge-secondary');
            } else if (badge.innerText == "Job Inspector" || badge.innerText == "Inventory Officer") {
                badge.classList.add('badge-accent');
            }
        }
    </script>

</body>

</html>
