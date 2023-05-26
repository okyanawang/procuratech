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

    // ADD CATEGORY AND LOCATION INPUTS
    const addLocationButton = document.getElementById('add-location');
    const addCategoryButton = document.getElementById('add-category');
    const locationContainer = document.getElementById('location-container');

    let locationCount = 1;
    let categoryCount = [
        [1]
    ]; // Mengubah nilai awal categoryCount menjadi [[2]]

    locationContainer.addEventListener('click', (e) => {
        if (e.target.classList.contains('delete-location')) {
            e.target.parentElement.parentElement.parentElement.remove();
            const locationContainer = document.getElementById('location-container');
            if(locationContainer.children[1] == undefined && locationContainer.children[0].children[1].children[0].children[1] != undefined){
                locationContainer.children[0].children[1].children[0].children[1].remove();
                // locationContainer.children[0].children[1].children[0].children[0].children[0].lastChild.remove();
            }
            

            locationCount--;
        }
        if (e.target.classList.contains('delete-category')) {

            const locationContainer = document.getElementById('location-container');

            const currentLocationGroup = e.target.closest('.location-group');
            const locationIndex = Array.from(locationContainer.children).indexOf(currentLocationGroup);
            const categoryIndex = Array.from(currentLocationGroup.querySelectorAll('.category-item')).indexOf(e
                .target.closest('.category-item'));

            e.target.parentElement.remove();

            const currentCategoryGroup = currentLocationGroup.querySelector('.category-group').children[0];
            
            if (currentCategoryGroup.children[1] == undefined) {
                currentCategoryGroup.children[0].children[1].remove();
            }
            categoryCount[locationIndex].splice(categoryIndex, 1);
            
        }
    });

    addLocationButton.addEventListener('click', () => {
        const locationGroup = document.createElement('div');

        locationGroup.className = 'location-group';
        locationGroup.innerHTML = `
        <div class="flex flex-col md:flex-row gap-3 mb-2">
            <div class="grid grid-cols-1 grid-rows-1 gap-2 items-center lg:w-2/3">
                <label class="mr-3 font-semibold">Location :</label>
            </div>
            <div class="grid grid-cols-1 grid-rows-1 gap-2 items-center lg:w-2/3">
                <label class="mr-3 font-semibold">Category :</label>
            </div>
        </div>
        <div class="flex flex-col md:flex-row gap-3 mb-2">
            <div class="grid grid-cols-10 grid-rows-1 gap-2 items-center lg:w-2/3">
                <input name="location[]" type="text" class="input input-bordered w-full col-span-9"
                    placeholder="location" required />
                <button type="button" class="delete-location px-2 py-1 text-white bg-red-500 rounded-md"><i
                    class="fa-solid fa-trash fa-xs"></i></button>
            </div>
            <div class="category-group grid grid-cols-1 grid-rows-1 gap-2 items-center lg:w-2/3">
                    <div class="flex flex-col gap-3">
                        <div class="category-item grid grid-cols-10 grid-rows-1 gap-2 items-center">
                            <input name="category[1][]" type="text" class="input input-bordered w-full col-span-9"
                            placeholder="category" required />
                        </div>
                    </div>
                
            </div>
        </div>
        `;
        let currentLocationGroup = locationContainer.querySelector('.location-group:last-of-type');
        const previousLocationDeleteButton = currentLocationGroup.querySelector('.delete-location');
        // if (previousLocationDeleteButton) {
        //     previousLocationDeleteButton.parentNode.removeChild(previousLocationDeleteButton);
        // }
        locationContainer.appendChild(locationGroup);
        currentLocationGroup = locationContainer.querySelector('.location-group:last-of-type');
        if (currentLocationGroup.parentNode.children[1] != undefined && currentLocationGroup.parentNode.children[0]
            .children[1].children[0].children[1] == undefined) {
            const buttonDeleteLocation = document.createElement('button');
            buttonDeleteLocation.className = 'delete-location px-2 py-1 text-white bg-red-500 rounded-md';
            buttonDeleteLocation.innerHTML = `
            <i class="fa-solid fa-trash fa-xs"></i>
            `;
            const locationItem = locationContainer.children[0].children[1].children[0];
            locationItem.append(buttonDeleteLocation);
        }

        locationCount++;
        categoryCount.push([1]); // Menambahkan [2] ke dalam categoryCount untuk setiap penambahan lokasi
    });

    addCategoryButton.addEventListener('click', () => {
        const categoryInput = document.createElement('div');
        categoryInput.className = 'category-item grid grid-cols-10 grid-rows-1 gap-2 items-center'
        categoryInput.innerHTML = `
            <input name="category[${locationCount}][]" type="text" class="input input-bordered w-full col-span-9"
            placeholder="category" required />
            <button type="button" class="delete-category px-2 py-1 text-white bg-red-500 rounded-md">
                <i class="fa-solid fa-trash fa-xs"></i>
            </button>
    `;

        const currentLocationGroup = locationContainer.querySelector('.location-group:last-of-type');
        const currentCategoryGroup = currentLocationGroup.querySelector('.category-group').children[0];

        currentCategoryGroup.appendChild(categoryInput);

        if (currentCategoryGroup.children[1] != undefined && currentCategoryGroup.children[0].children[1] ==
            undefined) {
            const buttonDeleteCategory = document.createElement('button');
            buttonDeleteCategory.className = 'delete-category px-2 py-1 text-white bg-red-500 rounded-md';
            buttonDeleteCategory.innerHTML = `
                <i class="fa-solid fa-trash fa-xs"></i>
            `;
            currentCategoryGroup.children[0].append(buttonDeleteCategory)
        }
        categoryCount[locationCount - 1].push(categoryCount[locationCount - 1].length + 1);
    });



    // END OF ADD CATEGORY AND LOCATION INPUTS
    </script>

</body>

</html>