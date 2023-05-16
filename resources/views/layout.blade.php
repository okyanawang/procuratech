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

        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

</body>

</html>
