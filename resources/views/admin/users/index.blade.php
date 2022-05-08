<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            List of Users
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <table class="w-full">
                    <thead class="bg-gray-200 border-b-2 border-gray-400" >
                        <tr>
                            <th class="p-3 text-sm text-left" >name</th>
                            <th class="p-3 text-sm text-left" >email</th>
                            <th class="p-3 text-sm text-left" >Role(s)</th>
                            <th class="p-3 text-sm text-left" >Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="p-3 text-left  border-b-2 border-gray-100"> {{$user->name}}</td>
                            <td class="p-3 text-left border-b-2 border-gray-100">{{$user->email}}</td>
                            <td class="p-3 text-left border-b-2 border-gray-100">{{implode(', ',$user->roles()->pluck('name')->toArray()) }}</td>
                            
                            <td class="p-3 text-left border-b-2 border-gray-100">  

                            @can('delete-users')
                                <a href="{{route('admin.users.edit',$user->id)}} "> <button class="text-center  font-bold rounded py-1 px-2 focus:outline-none bg-green-500  hover:bg-green-900 ">edit</button></a>    
                                <form action="{{route('admin.users.destroy',$user->id)}}" method="post" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-center  font-bold rounded py-1 px-2 focus:outline-none bg-red-500  hover:bg-red-900 ">delete</button>
                                </form>
                            @endcan


                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                


            </div>
        </div>
    </div>
</x-app-layout>