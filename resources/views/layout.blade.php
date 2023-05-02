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
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js"></script> --}}

</head>

<body>
    <x-Navbar />
    <div>
        @yield('content')
    </div>
    <x-Footer />

    @yield('scripts')

</body>

</html>
