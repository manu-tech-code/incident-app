<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="x-auto sm:px-6 lg:px-8 dark:text-gray-300">
            <div class="dark:bg-gray-800 bg-white shadow-md rounded-lg p-4 mx-auto">
                <div class="dark:text-gray-300 space-y-3">
                    <p><strong>Number:</strong> {{ $incident->number }}</p>
                    <p><strong>Caller:</strong> {{ $incident->caller }}</p>
                    <p><strong>Opened:</strong> {{ $incident->opened }}</p>
                    <p><strong>Opened By:</strong> {{ $incident->opened_by }}</p>
                    <p><strong>Location:</strong> {{ $incident->location }}</p>
                    <p><strong>Incident State:</strong> {{ $incident->incident_state }}</p>
                    <p><strong>Impacted Item:</strong> {{ $incident->impacted_item }}</p>
                    <p><strong>Category:</strong> {{ $incident->category }}</p>
                    <p><strong>Priority:</strong> {{ $incident->priority }}</p>
                    <p><strong>Short Description:</strong> {{ $incident->short_description }}</p>
                    <p><strong>Description:</strong> {{ $incident->description }}</p>
{{--                    @if(Auth::user()->role === 3)--}}
{{--                        <p><strong>Assigned To:</strong> {{ $incident->it_personnel_id }}</p>--}}
{{--                    @endif--}}
                </div>
                @if(Auth::user()->role === 2 && $incident->incident_state != 'Resolved')
                   <div class="mt-5">
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
                   </div>
                @endif
            </div>


        </div>
    </div>
</x-app-layout>
