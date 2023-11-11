<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Incident Requests') }}
        </h2>
    </x-slot>

    <div class="py-12" style="background: url(http://localhost:8000/images/ecg.jpg) no-repeat;background-size: cover">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('incidents.store') }}">
                @csrf
                <!-- Additional Fields from Database Table -->
                <div class="mt-4">
                    <x-input-label for="opened" :value="__('Opened')" />
                    <x-text-input type="date" id="opened" class="block mt-1 w-full" name="opened" :value="old('opened')" required />
                    <x-input-error :messages="$errors->get('opened')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="opened_by" :value="__('Opened By')" />
                    <x-text-input id="opened_by" class="block mt-1 w-full" type="text" name="opened_by" :value="old('opened_by')" required />
                    <x-input-error :messages="$errors->get('opened_by')" class="mt-2" />
                </div>

                <!-- Location, Incident State, Logged For (text inputs) -->
                <!-- Impacted Item (text input) -->
                <!-- Category (Select Field) -->
                <div class="mt-4">
                    <x-input-label for="location" :value="__('Location')" />
                    <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location')" required />
                    <x-input-error :messages="$errors->get('location')" class="mt-2" />
                </div>

{{--                <div class="mt-4">--}}
{{--                    <x-input-label for="incident_state" :value="__('Incident State')" />--}}
{{--                    <x-text-input id="incident_state" class="block mt-1 w-full" type="text" name="incident_state" :value="old('incident_state')" required />--}}
{{--                    <x-input-error :messages="$errors->get('incident_state')" class="mt-2" />--}}
{{--                </div>--}}
{{--                @if(Auth::user()->role === 1)--}}
{{--                    <div class="mt-4">--}}
{{--                        <x-input-label for="logged_for" :value="__('Logged For')" />--}}
{{--                        <select name="logged_for" class="block mt-1 w-full" id="logged_for">--}}
{{--                            <option selected disabled>Select IT Personnel</option>--}}
{{--                            @foreach($ITPersonnel as $personnel)--}}
{{--                                <option value="{{$personnel->name}}">{{$personnel->name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                        <x-input-error :messages="$errors->get('logged_for')" class="mt-2" />--}}
{{--                    </div>--}}
{{--                @endif--}}

                <div class="mt-4">
                    <x-input-label for="impacted_item" :value="__('Impacted Item')" />
                    <x-text-input id="impacted_item" class="block mt-1 w-full" type="text" name="impacted_item" :value="old('impacted_item')" required />
                    <x-input-error :messages="$errors->get('impacted_item')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="category" :value="__('Category')" />
                    <select name="category" class="block mt-1 w-full" id="category">
                        <option selected disabled>Select Category</option>
                        <option value="Application">Application</option>
                        <option value="Hardware">Hardware</option>
                        <option value="Mobile device">Mobile device</option>
                        <option value="Meeting Room">Meeting Room</option>
                        <option value="Infrastructure">Infrastructure</option>
                    </select>
                    <x-input-error :messages="$errors->get('category')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="priority" :value="__('Priority')" />
                    <select name="priority" class="block mt-1 w-full" id="priority">
                        <option selected disabled>Select Priority</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select>
                    <x-input-error :messages="$errors->get('priority')" class="mt-2" />
                </div>

                <!-- Description (Text Area) -->
                <div class="mt-4">
                    <x-input-label for="short_description" :value="__('Short Description')" />
                    <x-text-input id="short_description" class="block mt-1 w-full" type="text" name="short_description" :value="old('short_description')" required />
                    <x-input-error :messages="$errors->get('short_description')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea id="description" name="description" class="block mt-1 w-full" rows="4" required>{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ml-4">
                        {{ __('Create') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
