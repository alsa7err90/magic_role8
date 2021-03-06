<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                            <ul>
                                <li><a href="{{ URL::to('/') }}" >home </a></li>
                                <li><a class="active" href="{{ URL::to('mag_roles') }}" >roles </a></li>
                                <li><a href="{{ URL::to('mag_permissions') }}" >permissions </a></li>
                                <li><a href="{{ URL::to('mag_users') }}" >users </a></li>
                            </ul>

                            <div style="padding:20px ; ">
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
                                <br>
                                Roles : Choose one of the roles to edit <br>
                                @forelse ($roles as $role)
                                    - <a  >{{ $role->name }}</a>
                                    <a class="btn btn-small btn-success" href="{{ URL::to('mag_roles/' . $role->id) }}">Show this role what has permission</a>
                                    <form action="{{ url('mag_roles/' .  $role->id ) }}" method="POST">
                                        @csrf
                                        <input class="btn btn-default" type="submit" value="Delete" />
                                        <input type="hidden" name="_method" value="delete" />
                                    </form>
                                @empty
                                empty !! pleas add new roles
                                @endforelse


                                <form action="{{ route('mag_roles.store') }}" method="POST">
                                    @csrf
                                    <input type="text" name="name" placeholder="name">
                                    <br>
                                    <input type="text" name="slug" placeholder="slug">
                                    <input type="submit" value="add">
                                </form>

                                {{-- If your happiness depends on money, you will never be happy with yourself. --}}
                            </div>
                        </div>
                    </div>
                </div>{{-- py-12 --}}
            </div>
        </div>
    </div>
</x-app-layout>





