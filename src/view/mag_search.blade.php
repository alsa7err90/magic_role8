<style>
    .menu {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #333;
    }

    .menu li {
        float: left;
        display: inline;
    }

    .menu li a {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    .menu li a:hover:not(.active) {
        background-color: #111;
    }

    .menu .active {
        background-color: rgb(77, 48, 241);
    }

    .content {
        padding: 10px;
    }

    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        margin-top: 20px;
    }

    #customers td,
    #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #customers tr:hover {
        background-color: #ddd;
    }

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: rgb(25, 27, 29);
        color: white;
    }

    .btn-danger {
        background-color: rgb(255, 30, 30);
        color: #fff;
        padding: 10px;
        font-size: 14px;

    }

    .btn-info {
        background-color: hsla(214, 86%, 56%);
        color: #fff;
        padding: 10px;
        font-size: 14px;

    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <ul class="menu">
                        <li> <a href="{{ URL::to('/') }}">home </a> </li>
                        <li><a href="{{ URL::to('mag_roles') }}">roles </a></li>
                        <li><a href="{{ URL::to('mag_permissions') }}">permissions </a></li>
                        <li class="active"><a href="{{ URL::to('mag_users') }}">users </a></li>
                    </ul>
                    <div id="app">
                        <form action="{{ url('search_user') }}" method="POST">
                            <input type="text" class="form-control" name="text" placeholder="Search">
                            <button   type="submit">
                                search
                            </button>
                            @csrf
                        </form>
                            <table  id="customers">
                                <thead>
                                    <tr>
                                        <th scope="col">id</th>
                                        <th scope="col">NAME</th>
                                        <th scope="col">EMAIL</th>
                                        <th scope="col">ROLE</th>
                                        <th scope="col">SELECT</th>
                                        <th scope="col">EDIT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($magUsers as $magUser)
                                        <tr>
                                            <td>
                                                {{ $magUser->id }}
                                            </td>
                                            <td>
                                                {{ $magUser->name }}
                                            </td>
                                            <td>
                                                {{ $magUser->email }}
                                            </td>
                                            <td>{{ $magUser->roles[0]->name ?? "don't have role" }}
                                            </td>
                                            <form action="{{ url('edit_role_user/'.$magUser->id) }}" method="POST">
                                                <td>
                                                    <select class="form-control" name="new_role" id="{{ $magUser->id }}">
                                                        <option> select role </option>
                                                        @foreach ($magRoles as $role)
                                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                @csrf
                                                <td><input type="submit" value="save"></td>
                                            </form>
                                        </tr>
                                    @empty
                                        don't found data!!
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>{{-- container --}}
                </div>
            </div>
        </div>
</x-app-layout>
