<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            udate {{ $user->name }}
        </h2>
    </x-slot>
    <x-jet-validation-errors class="mb-4" />
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="{{route('admin.users.update',$user->id)}}" method="post">
                    @csrf
                    @method('PATCH')

                    <div>
                        <x-jet-label for="name" value="{{ __('Name') }}" class=" mt-2 ml-5" />
                        <x-jet-input id="name" class="block mt-2 ml-5  w-64" type="text" name="name" :value="old('name')?? $user->name" required autofocus />
                    </div>
                    
                    <div>
                        <x-jet-label for="email" value="{{ __('Email') }}" class=" mt-2 ml-5" />
                        <x-jet-input id="email" class="block mt-2 ml-5  w-64" type="email" name="email" :value="old('name')?? $user->email" required autofocus />
                    </div>




                    @foreach ($roles as $role)
                    <div class="flex p-4 ">
                        <div>
                            <div class="form-check">
                                <input
                                    class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                    type="checkbox" name="roles[]" id="{{$role->id}}" value="{{$role->id}} "
                                    {{-- first method --}}
                                    @if ($user->roles->contains($role->id))
                                    checked
                                    @endif
                                    {{-- second method --}}
                                    {{-- @foreach ($user->roles as $userRole) 
                                    @if ($userRole->id == $role->id)
                                    checked
                                    @endif
                                    @endforeach --}}
                                    
                                    >
                                <label class="form-check-label inline-block text-gray-800" for="{{$role->id}}">
                                    {{$role->name}}
                                </label>
                            </div>

                        </div>
                    </div>
                    @endforeach
                    <button
                        class="text-center m-4 font-bold rounded py-1 px-2 focus:outline-none bg-green-500  hover:bg-green-900 ">Submit</button>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>