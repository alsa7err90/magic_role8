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
                                {{ ViewRoles::his_role("admin") }}
                                <ul>
                                    <li><a href="{{ URL::to('/') }}" >home </a></li>
                                    <li><a href="{{ URL::to('mag_roles') }}" >roles </a></li>
                                    <li><a href="{{ URL::to('mag_permissions') }}" >permissions </a></li>
                                    <li><a class="active" href="{{ URL::to('mag_users') }}" >users </a></li>
                                </ul>

                                <table  style="padding:20px ; margin:20px; ">
                                    <tr>
                                        <td>NAME</td>
                                        <td>EMAIL</td>
                                        <td>ROLE</td>
                                        <td>SELECT</td>
                                        <td>EDIT</td>
                                    </tr>
                                    @forelse($magUsers as $magUser)
                                        <tr>
                                            <td>
                                                {{ $magUser->name }}
                                            </td>
                                            <td>
                                                {{ $magUser->email }}
                                            </td>
                                            <td>{{ $magUser->roles[0]->name ?? "don't have role" }}
                                            </td>
                                            <td>
                                                <form action="{{ url('edit_role_user/'.$magUser->id) }}"  method="POST">
                                                    <select   class="form-control" name="new_role" id="{{ $magUser->id }}"  >
                                                        <option > select role </option>
                                                        @foreach ($magRoles as $role)
                                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @csrf
                                                    <input type="submit" value="save">
                                            </form>
                                            </td>
                                        </tr>
                                    @empty
                                    ooops !! it's empty !!
                                    @endforelse

                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- py-12 --}}
                </div>
            </div>
        </div>
    </x-app-layout>

    add style to views
