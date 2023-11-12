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
                  <div class="flex flex-col space-y-7 capitalize">
                      <div class="flex items-center justify-between">
                          <p class="bg-green-600 rounded-md w-fit p-2 text-white"><strong class="text-white">Assigned To: </strong>{{ $incident->it_personnel_id ?\App\Models\User::whereId($incident->it_personnel_id)->value('name'): 'Not Assigned' }}</p>
                          <div class="flex space-x-2">
                              <p class="bg-violet-400 p-3 rounded-md text-white">{{ $incident->category }}</p>
                              <p class="bg-opacity-70 @if($incident->incident_state === 'Pending') bg-orange-600 @elseif($incident->incident_state === 'Work In Progress') bg-amber-500 @else bg-green-600 @endif rounded-md p-3 w-fit text-white"> {{ $incident->incident_state }}</p>
                          </div>
                      </div>
                      <div class="space-y-5 flex flex-col">
                          <p class="shadow-md bg-gray-200 rounded-md w-fit p-2"><strong class="text-fuchsia-600">Number:</strong> {{ $incident->number }}</p>
                          <p class="shadow-md bg-gray-200 rounded-md w-fit p-2"><strong class="text-fuchsia-600">Caller:</strong> {{ $incident->caller }}</p>
                          <p class="shadow-md bg-gray-200 rounded-md w-fit p-2"><strong class="text-fuchsia-600">Opened:</strong> {{ $incident->opened }}</p>
                          <p class="shadow-md bg-gray-200 rounded-md w-fit p-2"><strong class="text-fuchsia-600">Opened By:</strong> {{ $incident->opened_by }}</p>
                          <p class="shadow-md bg-gray-200 rounded-md w-fit p-2"><strong class="text-fuchsia-600">Location:</strong> {{ $incident->location }}</p>
                          <p class="shadow-md bg-gray-200 rounded-md w-fit p-2"><strong class="text-fuchsia-600">Impacted Item:</strong> {{ $incident->impacted_item }}</p>
                          <p class="shadow-md bg-gray-200 rounded-md w-fit p-2"><strong class="text-fuchsia-600">Priority:</strong> {{ $incident->priority }}</p>
                          <p class="shadow-md bg-gray-200 rounded-md w-fit p-2"><strong class="text-fuchsia-600">Short Description:</strong> {{ $incident->short_description }}</p>
                          <p class="shadow-md bg-gray-200 rounded-md w-fit p-2"><strong class="text-fuchsia-600">Description:</strong> {{ $incident->description }}</p>
                      </div>
                  </div>

                    {{--                    @if(Auth::user()->role === 3)--}}
{{--                        <p><strong>Assigned To:</strong> {{ $incident->it_personnel_id }}</p>--}}
{{--                    @endif--}}
                </div>
                @if(Auth::user()->role === 2 && $incident->incident_state != 'Resolved')
                   <div class="mt-5">
                           <form action="{{route('incidents.status', ['incident' => $incident->id])}}" method="post">
                               @csrf
                               @method('PATCH')
                               <button class="rounded-md p-3 text-white @if($incident->incident_state === 'Pending') bg-orange-600 @else bg-green-600 @endif" type="submit">
                                   @if($incident->incident_state === 'Pending')
                                       Set as Work In Progress
                                   @elseif($incident->incident_state === 'Work In Progress')
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
