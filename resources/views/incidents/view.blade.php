<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 dark:text-gray-300">
            <div class="dark:bg-gray-800 bg-white shadow-md rounded-lg p-4 max-w-sm mx-auto">
                <div class="dark:text-gray-300">
                    <p><strong>ID:</strong> {{ $incident->id }}</p>
                    <p><strong>Number:</strong> {{ $incident->number }}</p>
                    <p><strong>Caller:</strong> {{ $incident->caller }}</p>
                    <p><strong>Opened:</strong> {{ $incident->opened }}</p>
                    <p><strong>Opened By:</strong> {{ $incident->opened_by }}</p>
                    <p><strong>Location:</strong> {{ $incident->location }}</p>
                    <p><strong>Incident State:</strong> {{ $incident->incident_state }}</p>
                    <p><strong>Logged For:</strong> {{ $incident->logged_for }}</p>
                    <p><strong>Impacted Item:</strong> {{ $incident->impacted_item }}</p>
                    <p><strong>Category:</strong> {{ $incident->category }}</p>
                    <p><strong>Priority:</strong> {{ $incident->priority }}</p>
                    <p><strong>Short Description:</strong> {{ $incident->short_description }}</p>
                    <p><strong>Description:</strong> {{ $incident->description }}</p>
                    <p><strong>Status:</strong> {{ $incident->status }}</p>
                    <p><strong>IT Personnel:</strong> {{ $incident->it_personnel_id }}</p>
                    <p><strong>Created At:</strong> {{ $incident->created_at }}</p>
                    <p><strong>Updated At:</strong> {{ $incident->updated_at }}</p>
                </div>
            </div>


        </div>
    </div>
</x-app-layout>
