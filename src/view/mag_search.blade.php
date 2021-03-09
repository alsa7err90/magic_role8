<style>
    .menu{
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

        .menu  .active {
        background-color: #4CAF50;
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
                        <form action="{{ url('search_user') }}" class="form-inline" method="POST">
                            <div class="input-group">
                                <input type="text" class="form-control" name="text" placeholder="Search">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </div>
                            </div>
                            @csrf
                        </form>
                        <div class="row mt-4">
                            <table class="table">
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
