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
                                <li><a href="{{ URL::to('mag_permissions') }}" >permissions </a></li>
                                <li><a href="{{ URL::to('mag_users') }}" >users </a></li>
                            </ul>

                            <div  style="padding:20px ; ">
                                the role have :<br>
                                <form action="{{ url('unckeck_permission_from_role') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id_role"  value="{{  $id }}">
                                    @forelse($mag_permissions as $permission)
                                        -<input type="checkbox" name="unckeck[]"  value="{{  $permission->id }}"> {{  $permission->name }}
                                        <br>

                                    @empty
                                        is impty !! this role don't have any permission
                                    @endforelse
                                    <input type="submit" value="remove">
                                </form>
                                @php
                                // $results=array_diff($all_permissions,$mag_permissions);
                                @endphp
                                <br>
                                don't have :<br>
                                <form action="{{ url('ckeck_permission_from_role') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id_role"  value="{{  $id }}">
                                    @forelse($all_permissions as $all_permission)
                                        @unless(in_array($all_permission->name,$mag_permissions_array))
                                        -<input type="checkbox" name="ckeck[]"  value="{{  $all_permission->id }}">{{  $all_permission->name  }}<br>
                                        @endunless
                                    @empty
                                        is impty !! go to  <a href="{{ URL::to('mag_permissions') }}" >permissions </a>
                                        to add new permission

                                    @endforelse
                                    <input type="submit" value="add">
                                </form>
                            </div>
                        </div>
                    </div>
                </div> {{-- py-12 --}}
            </div>
        </div>
    </div>
</x-app-layout>