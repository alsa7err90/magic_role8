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
                    <li><a href="{{ URL::to('mag_roles') }}">roles </a></li>
                    <li class="active"><a href="{{ URL::to('mag_permissions') }}">permissions </a></li>
                    <li><a href="{{ URL::to('mag_users') }}">users </a></li>
                </ul>
                <div class="content">
                    <div>
                        add your permissions?
                    </div>
                    <div>
                        <form action="{{ route('mag_permissions.store') }}" method="POST">
                            @csrf
                            <div>
                                <input type="text" name="name" placeholder="Name" />
                                <input type="text" name="slug" placeholder="slug" />
                                <input class="button" type="submit" value="add">
                            </div>
                        </form>
                    </div>

                    <a class="btn-info" href="auto_insert_permission">auto add permission</a>

                    <table id="customers">
                        <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
                        <thead>
                            <tr>
                                <th>Roel</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($Magpermissions as $permission)
                            <tr>
                                <td> {{ $permission->name }} </td>
                                <form action="{{ url('mag_permissions/'.$permission->id ) }}" method="POST">
                                    @csrf
                                    <td>
                                        <input class="btn-danger" type="submit" value="Delete" />
                                    </td>
                                    <input type="hidden" name="_method" value="delete" />
                                </form>
                            </tr>
                            @empty
                            empty !! please add new permissins or click auto add permission
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>{{-- py-12 --}}
</x-app-layout>
