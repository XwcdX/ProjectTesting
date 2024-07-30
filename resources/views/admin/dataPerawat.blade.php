@extends('admin.layout')

@section('style')
    <style>
        .hide {
            display: none;
        }

        .scroll::-webkit-scrollbar {
            width: 12px;
        }

        .scroll::-webkit-scrollbar-thumb {
            background: linear-gradient(transparent, rgb(142, 142, 253));
            border-radius: 6px;
            display: none;
        }

        .scroll:hover::-webkit-scrollbar-thumb {
            display: block;
        }

        .button {
            display: flex;
            transition: 200ms;
            align-items: center;
        }

        .button .text {
            padding-right: 20px;
        }

        .button .icon {
            z-index: 0;
            padding-left: 10px;
            border-left: 1px solid black;
            transform: translateX(10px);
        }

        .button svg {
            width: 15px;
            fill: #eee;
        }

        .button:hover .text {
            color: transparent;
        }

        .button:hover .icDelete {
            transform: translateX(-33px);
            border-left: none;
            transition: 500ms;
        }

        .button:hover .icEdit {
            transform: translateX(-25px);
            border-left: none;
            transition: 500ms;
        }

        .button:hover .icAdd {
            transform: translateX(-54px);
            border-left: none;
            transition: 500ms;
        }

        .button:focus {
            outline: none;
        }

        .button:active .icon svg {
            transform: scale(0.8);
        }

        .show:hover {
            color: white;
            transition: 200ms;
        }
    </style>
@endsection


@section('content')
    <div class="flex justify-center items-center w-full">
        <div class="w-3/4 mx-auto">
            <h1 class="uppercase mb-3 mt-3 text-center text-2xl font-bold" style="text-shadow: 0 0 5px white;">
                data perawat
            </h1>
            <input class="mb-1 pl-1 rounded-lg" placeholder="Search"
                type="search" id="search" data-search>
            <div class="scroll relative overflow-x-auto shadow-md sm:rounded-lg" style="max-height: 36rem; overflow-y: auto;">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead>
                        <tr class="absolute text-xs uppercase"
                            style="overflow-y: hidden; position: sticky; top: -1px; z-index: 1;">
                            <th scope="col" class="font-bold px-6 py-3 border border-slate-900 uppercase"
                                style="text-shadow: 0 0 2px white;">name</th>
                            <th scope="col" class="font-bold px-6 py-3 border border-slate-900 uppercase"
                                style="text-shadow: 0 0 2px white;">email</th>
                            <th scope="col" class="font-bold px-6 py-3 border border-slate-900 uppercase"
                                style="text-shadow: 0 0 2px white;">certification</th>
                            <th scope="col" class="font-bold px-6 py-3 border border-slate-900 uppercase"
                                style="text-shadow: 0 0 2px white;">action</th>
                        </tr>
                    </thead>
                    <template table-template>
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-4 py-1 border border-slate-900 text-center items-center justify-center" data-name>
                            </td>
                            <td class="px-4 py-1 border border-slate-900 text-center items-center justify-center"
                                data-email>
                            </td>
                            <td class="px-4 py-1 border border-slate-900 text-center items-center justify-center"
                                data-certification></td>
                            <td class="px-1 py-1 border border-slate-900 text-center justify-center" style="display:flex;"
                                data-action></td>
                        </tr>
                    </template>
                    <tbody id="data" data-container>
                    </tbody>
                </table>
            </div>
            <button
                class="button absolute mt-4 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900"
                onclick="add()"><span class="text">Add perawat</span><span class="icon icAdd"><svg
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-person-add" viewBox="0 0 16 16">
                        <path
                            d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                        <path
                            d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                    </svg></span></button>
        </div>
    </div>
    <span id="X"
        style="display: none; position: absolute; font-size: 50px; font-weight: bolder; cursor: pointer; z-index: 3; right: 15px; top: 0; color: white;"
        onclick="back()">&times;</span>

    <div id="add" class="px-16 w-full absolute flex-col gap-8"
        style="display: none; z-index: 2; top: 0; left: 0; background: rgba(0,0,0,.9); height: 100%;">
        <h1 class="text-center uppercase text-2xl font-bold"
            style="padding-top: 175px; color: white; text-shadow: 0 0 6px white;">Form Add Perawat</h1>
        <div class="mt-2">
            <label class="text-gray-800 font-bold text-lg m-0 text-white" style="text-shadow: 0 0 5px white;">Name</label>
            <input
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required type="text" id="name" placeholder="Name">
        </div>
        <div class="mt-2">
            <label class="text-gray-800 font-bold text-lg m-0 text-white" style="text-shadow: 0 0 5px white;">Email</label>
            <input
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required type="email" id="email" placeholder="Email">
        </div>
        <div class="mt-2">
            <label class="text-gray-800 font-bold text-lg m-0 text-white" style="text-shadow: 0 0 5px white;">Password</label>
            <input
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required type="password" id="pass" placeholder="Password">
        </div>
        <div class="mt-2">
            <label class="text-gray-800 font-bold text-lg m-0 text-white" style="text-shadow: 0 0 5px white;">Confirm Password</label>
            <input
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required type="password" id="cpass" placeholder="Confirm Password">
        </div>
        <div class="mt-2">
            <label class="text-gray-800 font-bold text-lg m-0 text-white"
                style="text-shadow: 0 0 5px white;">Certification</label>
            <input
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required type="text" id="certification" placeholder="Certification">
        </div>
        <button type="button" onclick="addPerawat()"
            class="mt-4 outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Add</button>
    </div>


    <div id="Fedit" class="px-16 w-full fixed flex-col gap-8"
        style="display: none; z-index: 2; top: 0; left: 0; background: rgba(0,0,0,.9); height: 100%;">
        <h1 class="text-center uppercase text-2xl font-bold"
            style="padding-top: 175px; color: white; text-shadow: 0 0 6px white;">Form Edit Perawat</h1>
        <div class="mt-2">
            <label class="text-gray-800 font-bold text-lg m-0 text-white" style="text-shadow: 0 0 5px white;">Name</label>
            <div id="inputName"></div>
        </div>
        <div class="mt-2">
            <label class="text-gray-800 font-bold text-lg m-0 text-white" style="text-shadow: 0 0 5px white;">Email</label>
            <div id="inputEmail"></div>
        </div>
        <div class="mt-2">
            <label class="text-gray-800 font-bold text-lg m-0 text-white"
                style="text-shadow: 0 0 5px white;">Certification</label>
            <div id="inputCertification"></div>
        </div>
        <div id="editButton"></div>
    </div>
@endsection

@section('script')
    <script>
        const template = document.querySelector("[table-template]");
        const dataContainer = document.querySelector("[data-container]");
        const searchInput = document.querySelector("[data-search]");

        let perawats = []


        searchInput.addEventListener("input", (e) => {
            const value = e.target.value.toLowerCase();
            perawats.forEach(perawat => {
                const isVisible = perawat.name.toLowerCase().includes(value) ||
                    perawat.email.toLowerCase().includes(value) ||
                    perawat.certification.toLowerCase().includes(value);
                perawat.element.classList.toggle("hide", !isVisible);
            });
        });

        fetch("{{ route('dataPerawat.index') }}", {
                'method': 'GET',
                'headers': {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                perawats = data.map(perawat => {
                    console.log(perawat);
                    const table = template.content.cloneNode(true).querySelector("tr");
                    const name = table.querySelector("[data-name]");
                    const email = table.querySelector("[data-email]");
                    const certification = table.querySelector("[data-certification]");
                    const action = table.querySelector("[data-action]")
                    name.textContent = perawat.name;
                    email.textContent = perawat.email;
                    certification.textContent = perawat.certification;
                    action.innerHTML = `
                    <button onclick="deletePerawat('${perawat.id}')" class="button mt-2 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"><span class="text">Delete</span><span class="icon icDelete"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                    </svg></span></button>
                    <button onclick="editPerawat('${perawat.id}','${perawat.name}','${perawat.email}','${perawat.certification}')" class="button mt-2 focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900"><span class="text">Edit</span><span class="icon icEdit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg></span></button>
                    <i class="bi bi-box-arrow-up-right show" style="margin:17px 0 0 15px; cursor:pointer;" onclick="show('${perawat.id}','${perawat.name}','${perawat.email}','${perawat.certification}')"></i>
                `;
                    dataContainer.appendChild(table);
                    return {
                        name: perawat.name,
                        email: perawat.email,
                        certification: perawat.certification,
                        element: table
                    };
                });
            })

        function deletePerawat(id) {
            fetch("{{ route('dataPerawat.index') }}/" + id, {
                    'method': 'DELETE',
                    'headers': {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    alert('perawat deleted');
                    location.reload();
                })
        }

        function editPerawat(id, name, email, certification) {
            document.getElementById('X').style.display = 'block';
            document.getElementById('Fedit').style.display = 'block';
            document.getElementById('inputName').innerHTML += `
        <input
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required type="text" id="nameE" value='${name}'>
        `;
            document.getElementById('inputEmail').innerHTML += `
        <input
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required type="email" id="emailE" value='${email}'>
        `;
            document.getElementById('inputCertification').innerHTML += `
        <input
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                required type="text" id="certificationE" value='${certification}'>
        `;
            document.getElementById('editButton').innerHTML += `
        <button type="button" onclick="edit('${id}')"
            class="mt-4 focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Edit</button>
        `;
        }

        function edit(id) {
            let name = document.getElementById('nameE').value;
            let email = document.getElementById('emailE').value;
            let certification = document.getElementById('certificationE').value;
            fetch("{{ route('dataPerawat.store') }}/" + id, {
                    'method': 'POST',
                    'headers': {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    'body': JSON.stringify({
                        'method': 'PUT',
                        'name': name,
                        'email': email,
                        'certification': certification
                    })
                })
                .then(response => response.json())
                .then(data => {
                    alert('perawat edited');
                    location.reload();
                })
                .catch(function(err) {
                    err.json().then(function(error) {
                        let errorMessage = '';
                        for (const [key, value] of Object.entries(error)) {
                            errorMessage += `${key}: ${value.join(', ')}\n`;
                        }
                        alert(errorMessage);
                    });
                });
        }

        function add() {
            document.getElementById('X').style.display = 'block';
            document.getElementById('add').style.display = 'block';
        }

        function addPerawat() {
            let name = document.getElementById('name').value;
            let email = document.getElementById('email').value;
            let pass = document.getElementById('pass').value;
            let cpass = document.getElementById('cpass').value;
            let certification = document.getElementById('certification').value;

            if (pass !== cpass) {
                alert('Passwords do not match.');
                return;
            }

            fetch("{{ route('dataPerawat.store') }}", {
                    'method': 'POST',
                    'headers': {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    'body': JSON.stringify({
                        'name': name,
                        'email': email,
                        'password': pass,
                        'certification': certification
                    })
                })
                .then(function(response) {
                    if (!response.ok) {
                        throw response;
                    }
                    return response.json();
                })
                .then(data => {
                    alert('perawat added');
                    location.reload();
                })
                .catch(function(err) {
                    err.json().then(function(error) {
                        let errorMessage = '';
                        for (const [key, value] of Object.entries(error)) {
                            errorMessage += `${key}: ${value.join(', ')}\n`;
                        }
                        alert(errorMessage);
                    });
                });
        }

        function back() {
            document.getElementById('add').style.display = 'none';
            document.getElementById('Fedit').style.display = 'none';
            document.getElementById('inputName').innerHTML = '';
            document.getElementById('inputEmail').innerHTML = '';
            document.getElementById('inputCertification').innerHTML = '';
            document.getElementById('editButton').innerHTML = '';
            document.getElementById('X').style.display = 'none';
        }
        window.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                event.preventDefault();
                document.getElementById('add').style.display = 'none';
                document.getElementById('Fedit').style.display = 'none';
                document.getElementById('inputName').innerHTML = '';
                document.getElementById('inputEmail').innerHTML = '';
                document.getElementById('inputCertification').innerHTML = '';
                document.getElementById('editButton').innerHTML = '';
                document.getElementById('X').style.display = 'none';
            }
        })
    </script>
@endSection
