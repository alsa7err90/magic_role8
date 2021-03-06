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
                                <li><a href="{{ URL::to('mag_roles') }}" >roles </a></li>
                                <li><a class="active" href="{{ URL::to('mag_permissions') }}" >permissions </a></li>
                                <li><a href="{{ URL::to('mag_users') }}" >users </a></li>
                            </ul>
                            <div  style="padding:20px ; ">
                                <br>permissions :<br>
                                @forelse ($Magpermissions as $permission)
                                    <label for="{{ $permission->id }}">{{ $permission->name }}</label>
                                    <form action="{{ url('mag_permissions/'.$permission->id ) }}" method="POST">
                                        @csrf
                                        <input class="btn btn-default" type="submit" value="Delete" />
                                        <input type="hidden" name="_method" value="delete" />
                                    </form>
                                @empty
                                    empty !! please add new permissins or click auto add permission
                                @endforelse

                                <form action="{{ route('mag_permissions.store') }}" method="POST">
                                        @csrf
                                        <input type="text" name="name" placeholder="name">
                                        <br>
                                        <input type="text" name="slug" placeholder="slug">
                                        <input type="submit" value="add">
                                    </form>

                                    <a href="auto_insert_permission">auto add permission</a>
                            </div>
                        </div>
                    </div>
                </div>{{-- py-12 --}}
            </div>
        </div>
    </div>
</x-app-layout>





