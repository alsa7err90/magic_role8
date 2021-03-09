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

    @media screen and (min-width: 480px) {
        input[type=text] {
            width: 30%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 2px solid rgb(77, 48, 241);
            border-radius: 4px;
        }
    }

    @media screen and (max-width: 480px) {
        input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 2px solid rgb(77, 48, 241);
            border-radius: 4px;
        }
    }

    .button {
        background-color: rgb(77, 48, 241);
        /* Green */
        border: 1px solid rgb(77, 48, 241);
        color: white;
        padding: 12px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
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
                <ul class="menu">
                    <li> <a href="{{ URL::to('/') }}">home </a> </li>
                    <li class="active"><a href="{{ URL::to('mag_roles') }}">roles </a></li>
                    <li><a href="{{ URL::to('mag_permissions') }}">permissions </a></li>
                    <li><a href="{{ URL::to('mag_users') }}">users </a></li>
                </ul>
                <div class="content">
                    <div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                    </div>
                    <div>
                        <div>
                            add your permissions?
                        </div>
                        <form action="{{ route('mag_roles.store') }}" method="POST">
                            @csrf
                            <input type="text" name="name" placeholder="name">
                            <input type="text" name="slug" placeholder="slug">
                            <input type="submit" class="button" value="add">
                        </form>
                    </div>

                    Roles : Choose one of the roles to edit
                    <table id="customers">
                        <thead>
                            <tr>
                                <th>role</th>
                                <th>edit</th>
                                <th>delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $role)
                                <tr>
                                    <td>{{ $role->name }}</td>
                                    <td><a class="btn-info" href="{{ URL::to('mag_roles/' . $role->id) }}">edit permissions</a> </td>
                                    <form action="{{ url('mag_roles/' .  $role->id ) }}" method="POST">
                                        @csrf
                                        <td> <input class="btn-danger" type="submit" value="Delete" /></td>
                                        <input type="hidden" name="_method" value="delete" />
                                    </form>
                                </tr>
                            @empty
                                empty !! pleas add new roles
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>{{-- py-12 --}}
</x-app-layout>
