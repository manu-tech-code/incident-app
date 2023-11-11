<x-app-layout>
    <div class="w-max bg-white py-12 px-3 overflow-hidden">
        <div class="mx-auto sm:px-6 lg:px-0">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
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
                        <td class="px-1 py-2 w-fit">{{ $incident->number }}</td>
                        <td class="px-1 py-2">{{ $incident->caller }}</td>
                        <td class="px-1 py-2">{{ $incident->opened }}</td>
                        <td class="px-1 py-2">{{ $incident->opened_by }}</td>
                        <td class="px-1 py-2">{{ $incident->location }}</td>
                        <td class="px-1 py-2">{{ $incident->impacted_item }}</td>
                        <td class="px-1 py-2">{{ $incident->category }}</td>
                        <td class="px-1 py-2">{{ $incident->priority }}</td>
                        <td class="px-1 py-2">{{ $incident->short_description }}</td>
                        <td class="px-1 py-2 text-clip w-96">{{ $incident->description }}</td>
                        <td class="px-1 py-2">{{ $incident->incident_state }}</td>
                        <td class=" space-y-2">
                            <form action="{{route('incidents.show', ['incident' => $incident->id])}}" method="get">
                                <button class="bg-blue-600 p-2 rounded-md text-white" type="submit">Details</button>
                            </form>
                            @if(Auth::user()->role != 2)
                                <form action="{{route('incidents.destroy', ['incident' => $incident->id])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-600 p-2 rounded-md text-white" type="submit">Delete</button>
                                </form>
                            @endif
                            @if(Auth::user()->role === 3)
                                <form action="{{route('incidents.edit', ['incident' => $incident->id])}}" method="get">
                                    @csrf
                                    <button class="bg-green-600 p-2 rounded-md text-white" type="submit">Edit</button>
                                </form>
                            @endif
                            @if(Auth::user()->role === 2 && $incident->incident_state != 'Resolved')
                                <form action="{{route('incidents.status', ['incident' => $incident->id])}}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <button class="rounded-md p-3 text-white @if($incident->incident_state === 'Pending')bg-orange-600 @else bg-green-600 @endif" type="submit">
                                        @if($incident->incident_state === 'Pending')
                                            Set as In progress
                                        @elseif($incident->incident_state === 'In Progress')
                                            Set as Resolved
                                        @endif
                                    </button>
                                </form>
                            @endif
                        </td>
                        @if(Auth::user()->role === 1)
                            <td>
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <form action="{{route('incidents.assign', ['incident' => $incident->id])}}" method="post">
                                    @csrf
                                    <div class="space-y-2">
                                        <select name="assign" id="">
                                            <option selected disabled>Select IT Personnel</option>
                                            @foreach($personnel as $it)
                                                <option value="{{$it->id}}">{{$it->name}}</option>
                                            @endforeach
                                        </select>
                                        <button class="bg-green-600 p-2 rounded-md text-white" type="submit">Assign</button>
                                    </div>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
</x-app-layout>

