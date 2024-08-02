@extends('admin.layout')

@section('style')
    <style>
        .button {
            display: flex;
            transition: 200ms;
            align-items: center;
        }

        .button .text {
            padding-right: 20px;
        }

        .button .icon {
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

        .form-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 3;
        }

        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 500px;
        }

        .form-container h1 {
            margin-bottom: 20px;
        }

        .form-container div {
            margin-bottom: 15px;
        }

        .form-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-container input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-container button {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }

        .close-button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .close-button:hover {
            background-color: #c82333;
        }
    </style>
@endsection

@section('content')
    @if (session('success'))
        <script>
            SweetAlert.fire({
                icon: 'success',
                title: '{{ session('success') }}',
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            SweetAlert.fire({
                icon: 'error',
                title: '{{ session('error') }}',
            });
        </script>
    @endif

    <div class="flex justify-center items-center w-full">
        <div class="w-3/4 mx-auto">
            <h1 class="uppercase mb-3 mt-3 text-center text-2xl font-bold" style="text-shadow: 0 0 5px white;">
                data perawat
            </h1>

            <table>
                <tr>
                    <th scope="col" class="font-bold px-6 py-3 text-center border border-slate-900 uppercase">Name</th>
                    <th scope="col" class="font-bold px-6 py-3 text-center border border-slate-900 uppercase">Email</th>
                    <th scope="col" class="font-bold px-6 py-3 text-center border border-slate-900 uppercase">Certification
                    </th>
                    <th scope="col" class="font-bold px-6 py-3 text-center border border-slate-900 uppercase">Actions
                    </th>
                </tr>
                @foreach ($dataPerawat as $data)
                    <tr>
                        <td class="px-4 py-1 border border-slate-900 text-center items-center justify-center">
                            {{ $data->name }}
                        </td>
                        <td class="px-4 py-1 border border-slate-900 text-center items-center justify-center">
                            {{ $data->email }}
                        </td>
                        <td class="px-4 py-1 border border-slate-900 text-center items-center justify-center">
                            {{ $data->certification }}</td>
                        <td class="px-1 py-1 border border-slate-900 text-center items-center justify-center flex">
                            <button
                                onclick="openEditForm({{ $data->id }}, '{{ $data->name }}', '{{ $data->email }}', '{{ $data->certification }}')"
                                class="button mt-2 focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-900"><span
                                    class="text">Edit</span><span class="icon icEdit"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path
                                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                        <path fill-rule="evenodd"
                                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                    </svg></span></button>
                            <form action="{{ route('dataPerawat.destroy', $data->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="button mt-2 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"><span
                                        class="text">Delete</span><span class="icon icDelete"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                            <path
                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                        </svg></span></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            <button
                class="button absolute mt-4 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900"
                onclick="openCreateForm()"><span class="text">Add perawat</span><span class="icon icAdd"><svg
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-person-add" viewBox="0 0 16 16">
                        <path
                            d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                        <path
                            d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                    </svg></span></button>
        </div>

        <div id="createForm" class="form-overlay" style="display: none;">
            <div class="form-container">
                <h1>Create Perawat</h1>
                <button class="close-button" onclick="closeForm()">X</button>
                <form action="{{ route('dataPerawat.store') }}" method="POST">
                    @csrf
                    <div>
                        <label>Name:</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}">
                    </div>
                    <div>
                        <label>Email:</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}">
                    </div>
                    <div>
                        <label>Password:</label>
                        <input id="pass" type="password" name="password">
                    </div>
                    <div>
                        <label>Confirm Password:</label>
                        <input id="cpass" type="password" name="cpassword">
                    </div>
                    <div>
                        <label>Certification:</label>
                        <input id="certi" type="text" name="certification" value="{{ old('certification') }}">
                    </div>
                    <button type="submit">Create</button>
                </form>
            </div>
        </div>

        <div id="editForm" class="form-overlay" style="display: none;">
            <div class="form-container">
                <h1>Edit Perawat</h1>
                <button class="close-button" onclick="closeForm()">X</button>
                <form id="editFormAction" method="POST">
                    @csrf
                    @method('PUT')
                    <div>
                        <label>Name:</label>
                        <input type="text" name="name" id="editName">
                    </div>
                    <div>
                        <label>Email:</label>
                        <input type="email" name="email" id="editEmail">
                    </div>
                    <div>
                        <label>Certification:</label>
                        <input type="text" name="certification" id="editCertification">
                    </div>
                    <button type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function openCreateForm() {
            document.getElementById('createForm').style.display = 'flex';
        }

        function openEditForm(id, name, email, certification) {
            document.getElementById('editName').value = name;
            document.getElementById('editEmail').value = email;
            document.getElementById('editCertification').value = certification;
            document.getElementById('editFormAction').action = "/admin/dataPerawat2/" + id;
            document.getElementById('editForm').style.display = 'flex';
        }

        function closeForm() {
            document.getElementById('createForm').style.display = 'none';
            document.getElementById('editForm').style.display = 'none';
            document.getElementById('name').value = '';
            document.getElementById('email').value = '';
            document.getElementById('pass').value = '';
            document.getElementById('cpass').value = '';
            document.getElementById('certi').value = '';
        }
    </script>
@endsection
