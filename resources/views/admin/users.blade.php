<x-app-layout>
    <div class="py-12 px-3">
        <div class="w-1/2 mx-auto sm:px-6 lg:px-0">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">Name</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">Role</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $index => $user)
{{--                        @php--}}
{{--                            $rowClass = $index % 2 == 0 ? 'bg-white' : 'bg-gray-200';--}}
{{--                        @endphp--}}
                        <tr class="{{ $rowClass }} border-b border-gray-200 dark:border-gray-700 text-black">
                            <td class="px-2 py-2">{{ $user->name }}</td>
                            <td class="px-1 py-2">{{ $user->email }}</td>
                            <td class="px-1 py-2">
                                {{ $user->role === 1 ? 'Admin' : ($user->role === 2 ? 'IT Personnel' : 'Staff') }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

