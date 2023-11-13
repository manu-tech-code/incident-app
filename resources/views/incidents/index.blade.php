<x-app-layout>
    <div class="bg-gray-300 py-12 px-3 overflow-x-auto">
        <div class="mx-auto sm:px-6 lg:px-0">
            <div class="relative overflow-x-auto @if(Auth::user()->role === 1) w-[calc(100%-15rem)] @else w-full @endif h-screen float-right">
                <table class="text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-black uppercase bg-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Number</th>
                    <th scope="col" class="px-6 py-3">Caller</th>
                    <th scope="col" class="px-6 py-3">Opened</th>
                    <th scope="col" class="px-6 py-3">Opened By</th>
                    <th scope="col" class="px-6 py-3">Location</th>
                    <th scope="col" class="px-6 py-3">Impacted Item</th>
                    <th scope="col" class="px-6 py-3">Category</th>
                    <th scope="col" class="px-6 py-3">Priority</th>
                    <th scope="col" class="px-6 py-3">Short Description</th>
                    <th scope="col" class="px-6 py-3">Description</th>
                    <th scope="col" class="px-6 py-3">Incident State</th>
                    <th scope="col" class="px-6 py-3">Remarks</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                    @if(Auth::user()->role === 1)
                        <th scope="col" class="px-6 py-3">Assign</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach ($incidents as $index => $incident)
                    @php
                        $rowClass = $index % 2 == 0 ? 'bg-white' : 'bg-gray-200';
                    @endphp
                    <tr class="{{ $rowClass }} border-b text-black">
                        <td class="px-2 py-2 w-fit">{{ $incident->number }}</td>
                        <td class="px-2 py-2 truncate">{{ $incident->caller }}</td>
                        <td class="px-2 py-2 truncate">{{ $incident->opened }}</td>
                        <td class="px-2 py-2 truncate">{{ $incident->opened_by }}</td>
                        <td class="px-2 py-2">{{  \Illuminate\Support\Str::limit($incident->location, 10) }}</td>
                        <td class="px-2 py-2">{{ $incident->impacted_item }}</td>
                        <td class="px-2 py-2">{{ $incident->category }}</td>
                        <td class="px-2 py-2">{{ $incident->priority }}</td>
                        <td class="px-2 py-2 truncate">{{ \Illuminate\Support\Str::limit($incident->short_description, 20) }}</td>
                        <td class="px-2 py-2 truncate">{{ \Illuminate\Support\Str::limit($incident->description, 50) }}</td>
                        <td class="px-2 py-2">{{ $incident->incident_state }}</td>
                        <td class="px-2 py-2 truncate">{{ \Illuminate\Support\Str::limit($incident->remarks, 20) ?: 'No Remarks' }}</td>
                        <td class="py-3 flex items-center space-x-2 justify-center">
                           @if($incident->incident_state != 'Resolved')
                                <form action="{{route('incidents.show', ['incident' => $incident->id])}}" method="get">
                                    <button type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 stroke-blue-600 hover:stroke-blue-900 transition-all ease-in-out duration-300">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                        </svg>
                                    </button>
                                </form>
                                @if(Auth::user()->role != 2)
                                    <form action="{{route('incidents.destroy', ['incident' => $incident->id])}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-white" type="submit">  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 stroke-red-600 hover:stroke-red-900 transition-all ease-in-out duration-300">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg></button>
                                    </form>
                                @endif
                                @if(Auth::user()->role === 3)
                                    <form action="{{route('incidents.edit', ['incident' => $incident->id])}}" method="get">
                                        @csrf
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 stroke-green-600 hover:stroke-green-900 transition-all ease-in-out duration-300">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg></button>
                                    </form>
                                @endif
                                @if(Auth::user()->role === 2)
                                    <form action="{{route('incidents.status', ['incident' => $incident->id])}}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <button class="rounded-md p-3 text-white w-fit @if($incident->incident_state === 'Pending') bg-orange-600 @else bg-green-600 @endif" type="submit">
                                            @if($incident->incident_state === 'Pending')
                                                Set as Work In Progress
                                            @elseif($incident->incident_state === 'Work In Progress')
                                                Set as Resolved
                                            @endif
                                        </button>
                                    </form>
                                @endif
                            @elseif(!$incident->remarks)
                                <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="flex items-center bg-blue-700 rounded-md p-2 text-white hover:bg-blue-500 duration-300 transition-all ease-in-out" type="submit">
                                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                    Remarks
                                </button>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512" class="w-6 h-6 fill-green-400"><path d="M96 80c0-26.5 21.5-48 48-48H432c26.5 0 48 21.5 48 48V384H96V80zm313 47c-9.4-9.4-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L409 161c9.4-9.4 9.4-24.6 0-33.9zM0 336c0-26.5 21.5-48 48-48H64V416H512V288h16c26.5 0 48 21.5 48 48v96c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V336z"/></svg>
                           @endif
                        </td>
                            <td class="py-3 px-2">
                        @if(Auth::user()->role === 1)
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if($incident->incident_state === 'Pending')
                                <button data-modal-target="assign-modal" data-modal-toggle="assign-modal" class="bg-green-600 p-2 rounded-md text-white" type="submit">Assign</button>
                            @else
                             <div class="bg-green-600 rounded-full w-7 h-7 shadow-sm shadow-green-300 flex items-center justify-center">
                                 <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512" class="w-4 h-4 fill-white rounded-full">
                                     <path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/>
                                 </svg>
                             </div>
                            @endif
                        @endif
                            </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        </div>
        <!-- Add Remarks modal -->
        <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="hidden bg-slate-300 bg-opacity-70 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Add Remarks
                        </h3>
                        <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5">
                        <form action="{{route('incidents.remarks', ['incident' => $incident->id])}}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="mb-5">
                                <x-input-label for="remarks" :value="__('Remarks')" />
                                <textarea id="remarks" class="block mt-1 w-full rounded-md" name="remarks" required autofocus autocomplete="remarks" >{{old('remarks')}}</textarea>
                                <x-input-error :messages="$errors->get('remarks')" class="mt-2" />
                            </div>
                            <button class="flex items-center bg-blue-700 rounded-md p-2 text-white hover:bg-blue-500 duration-300 transition-all ease-in-out" type="submit">
{{--                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>--}}
                                Add Remarks
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="assign-modal" tabindex="-1" aria-hidden="true" class="hidden bg-slate-300 bg-opacity-70 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Assign Incident
                        </h3>

                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5">
                        <form action="{{route('incidents.assign', ['incident' => $incident->id])}}" method="post">
                            @csrf
                            <div class="space-y-2">
                                <select name="assign" id="">
                                    <option selected disabled>Select IT Personnel</option>
                                    @foreach($personnel as $it)
                                        <option value="{{$it->id}}">{{$it->name}}</option>
                                    @endforeach
                                </select>
                                <button data-modal-target="assign-modal" data-modal-toggle="assign-modal" class="bg-green-600 p-2 rounded-md text-white" type="submit">Assign</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal toggle -->

</x-app-layout>

