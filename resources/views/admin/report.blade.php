<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Incident Report') }}
        </h2>
    </x-slot>

    <div class="flex justify-end p-3 space-x-2">
{{--       <form action="{{route('generate-pdf')}}" method="get">--}}
{{--           @csrf--}}
{{--           <button class='border border-blue-700 text-white bg-blue-700 hover:bg-white hover:text-black transition-all ease-in-out duration-500 rounded-md p-3' type="submit">Generate Report as PDF</button>--}}
{{--       </form>--}}
       <form action="{{route('generate-excel')}}" method="get">
           @csrf
           <button class='border border-blue-700 text-white bg-blue-700 hover:bg-white hover:text-black transition-all ease-in-out duration-500 rounded-md p-3' type="submit">Generate Report as Excel</button>
       </form>
    </div>
    <div class="py-12 px-3">
        <div class="w-full mx-auto sm:px-6 lg:px-0">
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
                        <th scope="col" class="px-6 py-3">Assigned To</th>
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
                            <td class="px-1 py-2">{{ $incident->it_personnel_id ?\App\Models\User::whereId($incident->it_personnel_id)->value('name'): 'Not Assigned' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

