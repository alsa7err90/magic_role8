    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>
                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                                <div class="flex ">
                                    <div class="text-white text-2xl font-extrabold rounded-md flex items-center justify-center bg-amber-500 m-2  p-2" style="background-color: rgba(168,85,247,var(--tw-bg-opacity));"><a href="{{ URL::to('/') }}" >home </a></div>
                                    <div class="text-white text-2xl font-extrabold rounded-md flex items-center justify-center bg-amber-500 m-2  p-2" style="background-color: rgba(168,85,247,var(--tw-bg-opacity));"><a href="{{ URL::to('mag_roles') }}" >roles </a></div>
                                    <div class="text-white text-2xl font-extrabold rounded-md flex items-center justify-center bg-amber-500 m-2  p-2" style="background-color: rgba(168,85,247,var(--tw-bg-opacity));"><a   href="{{ URL::to('mag_permissions') }}" >permissions </a></div>
                                    <div class="text-white text-2xl font-extrabold rounded-md flex items-center justify-center bg-amber-500 m-2  p-2" style="background-color: rgba(205, 92, 92,var(--tw-bg-opacity));"><a href="{{ URL::to('mag_users') }}" >users </a></div>
                                  </div>
                                <table    class="min-w-full divide-y divide-gray-200 mt-2">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <td scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NAME</td>
                                            <td scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">EMAIL</td>
                                            <td scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ROLE</td>
                                            <td scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SELECT</td>
                                            <td scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">EDIT</td>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($magUsers as $magUser)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $magUser->name }}
                                                </td>
                                                <td>
                                                    {{ $magUser->email }}
                                                </td>
                                                <td>{{ $magUser->roles[0]->name ?? "don't have role" }}
                                                </td>

                                                    <form action="{{ url('edit_role_user/'.$magUser->id) }}"  method="POST">
                                                        <td><select   class="form-control" name="new_role" id="{{ $magUser->id }}"  >
                                                            <option > select role </option>
                                                            @foreach ($magRoles as $role)
                                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                            @endforeach
                                                        </select></td>
                                                        @csrf
                                                        <td> <input type="submit" value="save"></td>
                                                </form>

                                            </tr>
                                        @empty
                                        ooops !! it's empty !!
                                        @endforelse
                                    </tbody>

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
