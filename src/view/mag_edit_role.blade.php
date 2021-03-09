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
                <ul class="menu">
                    <li> <a href="{{ URL::to('/') }}">home </a> </li>
                    <li><a href="{{ URL::to('mag_roles') }}">roles </a></li>
                    <li><a href="{{ URL::to('mag_permissions') }}">permissions </a></li>
                    <li class="active"><a href="{{ URL::to('mag_users') }}">users </a></li>
                </ul>
                <div class="content">
                    <div>
                        <table id="customers" style="width: 48%;float: right; ">
                            <form action="{{ url('unckeck_permission_from_role') }}" method="POST">
                                @csrf
                                <tr>
                                    <td>the role have :</td>
                                </tr>
                                <input type="hidden" name="id_role" value="{{  $id }}">
                                @forelse($mag_permissions as $permission)
                                    <tr>
                                        <td> <input type="checkbox" name="unckeck[]" value="{{  $permission->id }}"> {{ $permission->name }} </td>
                                    </tr>
                                @empty
                                    is impty !! this role don't have any permission
                                @endforelse
                                <tr>
                                    <td><input class="btn-danger" type="submit" value="remove"></td>
                                </tr>
                            </form>
                        </table>
                        @php
                            // $results=array_diff($all_permissions,$mag_permissions);
                        @endphp
                    </div>

                    <table id="customers" style="width: 48%; ">

                        <form action="{{ url('ckeck_permission_from_role') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_role" value="{{  $id }}">
                            <tr>
                                <td>don't have :</td>
                            </tr>
                            @forelse($all_permissions as $all_permission)
                                @unless(in_array($all_permission->name,$mag_permissions_array))
                                    <tr>
                                        <td> <input type="checkbox" name="ckeck[]" value="{{  $all_permission->id }}"> {{ $all_permission->name  }}</td>
                                    </tr>
                                @endunless
                            @empty
                                is impty !! go to <a href="{{ URL::to('mag_permissions') }}">permissions </a>
                                to add new permission
                            @endforelse
                            <tr>
                                <td><input class="btn-info" type="submit" value="add"></td>
                            </tr>
                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
