<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex">
                    <div class="text-white text-2xl font-extrabold rounded-md flex items-center justify-center bg-amber-500 m-2  p-2" style="background-color: rgba(168,85,247,var(--tw-bg-opacity));"><a href="{{ URL::to('/') }}" >home </a></div>
                    <div class="text-white text-2xl font-extrabold rounded-md flex items-center justify-center bg-amber-500 m-2  p-2" style="background-color: rgba(205, 92, 92,var(--tw-bg-opacity));"><a href="{{ URL::to('mag_roles') }}" >roles </a></div>
                    <div class="text-white text-2xl font-extrabold rounded-md flex items-center justify-center bg-amber-500 m-2  p-2" style="background-color: rgba(168,85,247,var(--tw-bg-opacity));"><a   href="{{ URL::to('mag_permissions') }}" >permissions </a></div>
                    <div class="text-white text-2xl font-extrabold rounded-md flex items-center justify-center bg-amber-500 m-2  p-2" style="background-color: rgba(168,85,247,var(--tw-bg-opacity));"><a href="{{ URL::to('mag_users') }}" >users </a></div>
                </div>
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
                <div class="w-full  bg-white py-10 px-5 ">
                    <div class="text-2xl mb-2   mr-10">
                        add your permissions?
                    </div>
                    <div class="grid grid-cols-2  m-auto">
                        <form action="{{ route('mag_roles.store') }}" method="POST">
                            @csrf
                            <div class="flex space-x-5 mt-3">
                            <input type="text" class="w-full  focus:outline-none focus:text-gray-600 p-2" name="name" placeholder="name">
                            <input type="text" class="w-full  focus:outline-none focus:text-gray-600 p-2" name="slug" placeholder="slug">
                            <input type="submit"  class="w-full mt-6 bg-blue-600 hover:bg-blue-500 text-white font-semibold p-3" value="add">
                        </div>
                    </form>
                </div>
                </div>
                <br>
                Roles : Choose one of the roles to edit <br>
                <div class="w-2/3 mx-auto">
                    <div class="bg-white shadow-md rounded my-6">
                        <table class="text-left w-full border-collapse"> <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
                            <thead>
                                <tr>
                                    <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">role</th>
                                    <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">edit</th>
                                    <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($roles as $role)
                                    <tr class="hover:bg-grey-lighter">
                                        <td class="py-4 px-6 border-b border-grey-light">{{ $role->name }}</td>
                                        <td class="py-4 px-6 border-b border-grey-light"><a class="text-white font-bold py-1 px-3 rounded text-xs bg-blue-600 hover:bg-blue-500 text-white  " href="{{ URL::to('mag_roles/' . $role->id) }}">edit permissions</a> </td>
                                        <form action="{{ url('mag_roles/' .  $role->id ) }}" method="POST">
                                            @csrf
                                            <td class="py-4 px-6 border-b border-grey-light"> <input type="submit" class="text-white font-bold py-1 px-3 rounded text-xs bg-red-600 hover:bg-red-200 hover:text-red-600" value="Delete" /></td>
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
    </div>
</x-app-layout>





