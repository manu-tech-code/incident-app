<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __(Route::currentRouteName()) }}
        </h2>
    </x-slot>

    @if(Auth::user()->role != 1)
        <div class="py-12 h-screen" style="background: url(http://localhost:8000/images/bg-2.jpg) no-repeat;background-size: cover">
    @else
        <div class="py-12">
    @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10" >
            {{-- Statistics --}}
            @if(Auth::user()->role === 1)
                <div class="shadow-2xl rounded-md p-5 align-center space-x-96 bg-white">
                    <div class="space-y-3 float-left">
                           <div class="flex space-x-2">
                               <p class="bg-orange-500 w-5 h-5 rounded-full"></p>
                               <p>Admin - {{count($admin)}}</p>
                           </div>
                           <div class="flex space-x-2">
                               <p class="bg-green-600 w-5 h-5 rounded-full"></p>
                               <p>IT Personnel - {{count($personnel)}}</p>
                           </div>
                           <div class="flex space-x-2">
                               <p class="bg-pink-700 w-5 h-5 rounded-full"></p>
                               <p>Staff - {{count($employees)}}</p>
                           </div>
                   </div>
                    <div class="h-2/5">
                        <canvas id="myChart" class=""></canvas>
                    </div>
                </div>
               <div class="flex space-x-10">
                   <div class="shadow-2xl rounded-md p-5 align-center space-y-5 w-1/2 bg-white">
                       <p class="text-lg">Remarks</p>
                       <div class="space-y-3">
                           <div class="flex items-center space-x-2 shadow p-3 rounded-md">
                               <p class="bg-orange-500 w-5 h-5 rounded-full"></p>
                               <div>
                                   <p>Text</p>
                                   <p>desc</p>
                               </div>
                           </div>
                           <div class="flex items-center space-x-2 shadow p-3 rounded-md">
                               <p class="bg-orange-500 w-5 h-5 rounded-full"></p>
                               <div>
                                   <p>Text</p>
                                   <p>desc</p>
                               </div>
                           </div>
                           <div class="flex items-center space-x-2 shadow p-3 rounded-md">
                               <p class="bg-orange-500 w-5 h-5 rounded-full"></p>
                               <div>
                                   <p>Text</p>
                                   <p>desc</p>
                               </div>
                           </div>
                       </div>
                   </div>
                   {{-- Pie Chart --}}
                   <div class="shadow-2xl rounded-md p-5 align-center space-y-5 w-fit bg-white" style="position: relative; height:50vh;">
                       <p>Incident By Status</p>
                       <canvas id="dChart"></canvas>
                   </div>
                   <div class="shadow-2xl rounded-md p-5 align-center space-y-5 w-fit bg-white" style="position: relative; height:50vh;">
                       <p>Incidents By Category</p>
                       <canvas id="pieChart"></canvas>
                   </div>
               </div>

               <div>
                   <p class="text-lg mb-4 ">All Users</p>
                   <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
                       <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                           <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                           <tr>
                               <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">Name</th>
                               <th scope="col" class="px-6 py-3 dark:text-black">Email</th>
                               <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">Role</th>
                           </tr>
                           </thead>
                           <tbody>
                           @foreach ($users as $index => $user)
                               <tr class="border-b border-gray-200 dark:border-gray-700">
                                   <th scope="row" class="capitalize px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white dark:bg-gray-800">
                                       {{ $user->name }}
                                   </th>
                                   <td class="px-6 py-4 dark:text-black">
                                       {{$user->email}}
                                   </td>
                                   <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800 text-white">
                                       {{ $user->role === 1 ? 'Admin' : ($user->role === 2 ? 'IT Personnel' : 'Staff') }}
                                   </td>
                               </tr>
                           @endforeach

                           </tbody>
                       </table>
                   </div>
               </div>
            @endif

            <div class="flex gap-5 flex-wrap">
                @if(Auth::user()->role === 2 || Auth::user()->role === 3)
                    <x-card-component @class(['!bg-red-500 border-red-700 dark:bg-red-500 dark:border-red-700']) title="Get Help" description="description" route="incidents.index">
                        <svg class="w-7 h-7 text-gray-500 dark:text-gray-700 mb-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">              <path d="M18 5h-.7c.229-.467.349-.98.351-1.5a3.5 3.5 0 0 0-3.5-3.5c-1.717 0-3.215 1.2-4.331 2.481C8.4.842 6.949 0 5.5 0A3.5 3.5 0 0 0 2 3.5c.003.52.123 1.033.351 1.5H2a2 2 0 0 0-2 2v3a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V7a2 2 0 0 0-2-2ZM8.058 5H5.5a1.5 1.5 0 0 1 0-3c.9 0 2 .754 3.092 2.122-.219.337-.392.635-.534.878Zm6.1 0h-3.742c.933-1.368 2.371-3 3.739-3a1.5 1.5 0 0 1 0 3h.003ZM11 13H9v7h2v-7Zm-4 0H2v5a2 2 0 0 0 2 2h3v-7Zm6 0v7h3a2 2 0 0 0 2-2v-5h-5Z"/>
                        </svg>
                    </x-card-component>

                    <x-card-component @class(['bg-green-500 border-green-700 dark:bg-green-500 dark:border-green-700']) title="Create Request" description="description" route="incidents.create">
                        <svg class="w-7 h-7 text-gray-500 dark:text-gray-700 mb-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M18 5h-.7c.229-.467.349-.98.351-1.5a3.5 3.5 0 0 0-3.5-3.5c-1.717 0-3.215 1.2-4.331 2.481C8.4.842 6.949 0 5.5 0A3.5 3.5 0 0 0 2 3.5c.003.52.123 1.033.351 1.5H2a2 2 0 0 0-2 2v3a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V7a2 2 0 0 0-2-2ZM8.058 5H5.5a1.5 1.5 0 0 1 0-3c.9 0 2 .754 3.092 2.122-.219.337-.392.635-.534.878Zm6.1 0h-3.742c.933-1.368 2.371-3 3.739-3a1.5 1.5 0 0 1 0 3h.003ZM11 13H9v7h2v-7Zm-4 0H2v5a2 2 0 0 0 2 2h3v-7Zm6 0v7h3a2 2 0 0 0 2-2v-5h-5Z"/></svg>
                    </x-card-component>

                    <x-card-component @class(['bg-violet-500 border-violet-700 dark:bg-violet-500 dark:border-violet-700']) title="Posts" description="description" route="posts.index">
                        <svg class="w-7 h-7 text-gray-500 dark:text-gray-700 mb-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M18 5h-.7c.229-.467.349-.98.351-1.5a3.5 3.5 0 0 0-3.5-3.5c-1.717 0-3.215 1.2-4.331 2.481C8.4.842 6.949 0 5.5 0A3.5 3.5 0 0 0 2 3.5c.003.52.123 1.033.351 1.5H2a2 2 0 0 0-2 2v3a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V7a2 2 0 0 0-2-2ZM8.058 5H5.5a1.5 1.5 0 0 1 0-3c.9 0 2 .754 3.092 2.122-.219.337-.392.635-.534.878Zm6.1 0h-3.742c.933-1.368 2.371-3 3.739-3a1.5 1.5 0 0 1 0 3h.003ZM11 13H9v7h2v-7Zm-4 0H2v5a2 2 0 0 0 2 2h3v-7Zm6 0v7h3a2 2 0 0 0 2-2v-5h-5Z"/>
                        </svg>
                    </x-card-component>
                @endif
                @if(Auth::user()->role === 3)
                    <x-card-component @class(['bg-red-500 border-red-700 dark:bg-red-500 dark:border-red-700']) title="View My Tickets" description="description" route="incidents.index">
                        <svg class="w-7 h-7 text-gray-500 dark:text-gray-700 mb-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M18 5h-.7c.229-.467.349-.98.351-1.5a3.5 3.5 0 0 0-3.5-3.5c-1.717 0-3.215 1.2-4.331 2.481C8.4.842 6.949 0 5.5 0A3.5 3.5 0 0 0 2 3.5c.003.52.123 1.033.351 1.5H2a2 2 0 0 0-2 2v3a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V7a2 2 0 0 0-2-2ZM8.058 5H5.5a1.5 1.5 0 0 1 0-3c.9 0 2 .754 3.092 2.122-.219.337-.392.635-.534.878Zm6.1 0h-3.742c.933-1.368 2.371-3 3.739-3a1.5 1.5 0 0 1 0 3h.003ZM11 13H9v7h2v-7Zm-4 0H2v5a2 2 0 0 0 2 2h3v-7Zm6 0v7h3a2 2 0 0 0 2-2v-5h-5Z"/>
                        </svg>
                    </x-card-component>
                @endif
                @if(Auth::user()->role === 2)
                    <x-card-component @class(['bg-yellow-500 border-yellow-500 dark:bg-yellow-500 dark:border-yellow-500']) title="Assigned Incidents" description="description" route="incidents.index">
                        <svg class="w-7 h-7 text-gray-500 dark:text-gray-700 mb-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M18 5h-.7c.229-.467.349-.98.351-1.5a3.5 3.5 0 0 0-3.5-3.5c-1.717 0-3.215 1.2-4.331 2.481C8.4.842 6.949 0 5.5 0A3.5 3.5 0 0 0 2 3.5c.003.52.123 1.033.351 1.5H2a2 2 0 0 0-2 2v3a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V7a2 2 0 0 0-2-2ZM8.058 5H5.5a1.5 1.5 0 0 1 0-3c.9 0 2 .754 3.092 2.122-.219.337-.392.635-.534.878Zm6.1 0h-3.742c.933-1.368 2.371-3 3.739-3a1.5 1.5 0 0 1 0 3h.003ZM11 13H9v7h2v-7Zm-4 0H2v5a2 2 0 0 0 2 2h3v-7Zm6 0v7h3a2 2 0 0 0 2-2v-5h-5Z"/>
                        </svg>
                    </x-card-component>

                    <x-card-component @class(['bg-violet-500 border-violet-700 dark:bg-violet-500 dark:border-violet-700']) title="User Setup" description="description" route="incidents.index">
                        <svg class="w-7 h-7 text-gray-500 dark:text-gray-700 mb-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M18 5h-.7c.229-.467.349-.98.351-1.5a3.5 3.5 0 0 0-3.5-3.5c-1.717 0-3.215 1.2-4.331 2.481C8.4.842 6.949 0 5.5 0A3.5 3.5 0 0 0 2 3.5c.003.52.123 1.033.351 1.5H2a2 2 0 0 0-2 2v3a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V7a2 2 0 0 0-2-2ZM8.058 5H5.5a1.5 1.5 0 0 1 0-3c.9 0 2 .754 3.092 2.122-.219.337-.392.635-.534.878Zm6.1 0h-3.742c.933-1.368 2.371-3 3.739-3a1.5 1.5 0 0 1 0 3h.003ZM11 13H9v7h2v-7Zm-4 0H2v5a2 2 0 0 0 2 2h3v-7Zm6 0v7h3a2 2 0 0 0 2-2v-5h-5Z"/>
                        </svg>
                    </x-card-component>
                @endif

            </div>
        </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        // const Utils = require("Utils/lib/Utils.js");
        const ctx = document.getElementById('myChart');
        const dChart = document.getElementById('dChart');
        const pieChart = document.getElementById('pieChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: 'Incident Requests',
                    data: [{{count($users)}}, 20, 3, 5, 4,10,2,1,12,11,10, 10],
                    backgroundColor: [
                        'rgba(255, 159, 64)',
                        'rgba(75, 192, 192)',
                        'rgba(255, 99, 132)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        new Chart(dChart, {
            type: 'doughnut',
            data:  {
                labels: [
                    'Resolved',
                    'Pending',
                    'Work In Progress'
                ],
                datasets: [{
                    label: 'Incidents By Status',
                    data: [{{$resolved}}, {{$pending}} ,{{$inProgress}}],
                    backgroundColor: [
                        'rgb(54, 162, 235)',
                        'rgb(255, 99, 132)',
                        'rgb(255, 205, 86)',
                    ],
                    hoverOffset: 4,
                    offset: 10,
                    borderRadius: 10,
                }],
            },
            options: {
                plugins: {
                    legend: {
                        align: 'start'
                    }
                }
            }
        })

        new Chart(pieChart, {
            type: 'pie',
            data:  {

                labels: [
                    'Application',
                    'Hardware',
                    'Mobile Device',
                    'Meeting Room',
                    'Infrastructure'
                ],

                datasets: [{
                    label: 'Incidents By Category',
                    data: [{{$application}}, {{$hardware}} ,{{$mobileDevice}}, {{$meetingRoom}}, {{$infrastructure}}],
                    backgroundColor: [
                        'rgb(54, 162, 235)',
                        'rgb(255, 99, 132)',
                        'rgb(255, 205, 86)',
                    ],
                    hoverOffset: 4,
                    offset: 10,
                    borderRadius: 10,
                }],
            },
            options: {
                plugins: {
                    legend: {
                        align: 'start'
                    }
                }
            }
        })
    </script>
</x-app-layout>
