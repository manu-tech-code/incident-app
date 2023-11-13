<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __(Route::currentRouteName()) }}
        </h2>
    </x-slot>

    @if(Auth::user()->role != 1)
        <div class="py-12 h-screen @if(Auth::user()->role === 1) float-right w-[calc(100%-15rem)] @endif" style="background: url(http://localhost:8000/images/bg-2.jpg) no-repeat;background-size: cover">
    @else
        <div class="py-12 @if(Auth::user()->role === 1) float-right w-[calc(100%-15rem)] @endif">
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
                           @forelse($remarks as $remark)
                               <div class="cursor-default hover:shadow-lg transition-all ease-in-out duration-300 flex items-center space-x-2 shadow p-3 rounded-md">
                                   <p class="bg-orange-500 shadow-lg w-5 h-5 rounded-full"></p>
                                   <div>
                                       <span class="text-fuchsia-600">{{$remark->user->name}}</span> made a remark</p>
                                       <p>{{$remark->remarks}}</p>
                                   </div>
                               </div>
                           @empty
                               No recent remarks made
                           @endforelse
                       </div>
                   </div>
                   {{-- Pie Chart --}}
                   <div class="shadow-2xl rounded-md p-5 align-center space-y-5 w-fit bg-white" style="position: relative; height:50vh;">
                       <div class="flex justify-between">
                           <p>Incident By Status</p>
                           <p class="font-bold bg-violet-600 rounded-full p-4 w-5 h-5 text-white flex items-center justify-center">
                               {{ $resolved + $pending + $inProgress }}</p></div>

                       <canvas id="dChart"></canvas>
                   </div>
                   <div class="shadow-2xl rounded-md p-5 align-center space-y-5 w-fit bg-white" style="position: relative; height:50vh;">
                       <div class="flex justify-between">
                           <p>Incidents By Category</p>
                           <p class="font-bold bg-violet-600 rounded-full p-4 w-5 h-5 text-white flex items-center justify-center">
                               {{$application + $hardware + $mobileDevice + $meetingRoom + $infrastructure}}</p></div>
                       <canvas id="pieChart"></canvas>
                   </div>
               </div>

               <div>
                   <p class="text-lg mb-4 ">All Users</p>
                   <div class="relative overflow-x-auto shadow-lg sm:rounded-lg ">
                       <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 bg-white">
                           <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                           <tr>
                               <th scope="col" class="px-6 py-3 bg-gray-200 dark:bg-gray-800">Name</th>
                               <th scope="col" class="px-6 py-3 bg-gray-200 dark:text-black">Email</th>
                               <th scope="col" class="px-6 py-3 bg-gray-200 dark:bg-gray-800">Role</th>
                           </tr>
                           </thead>
                           <tbody>
                           @foreach ($users as $index => $user)
                               <tr class="border-b border-gray-300 dark:border-gray-700">
                                   <th scope="row" class="capitalize bg-gray-100 px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white dark:bg-gray-800">
                                       {{ $user->name }}
                                   </th>
                                   <td class="px-6 py-4 text-black">
                                       {{$user->email}}
                                   </td>
                                   <td class="px-6 py-4 bg-gray-100 text-black dark:bg-gray-800 dark:text-white">
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
                        <x-card-component class="!bg-violet-500 border-violet-500" title="Get Help" description="description" route="incidents.index">
                        <svg class="w-7 h-7 fill-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512"><path d="M544 248v3.3l69.7-69.7c21.9-21.9 21.9-57.3 0-79.2L535.6 24.4c-21.9-21.9-57.3-21.9-79.2 0L416.3 64.5c-2.7-.3-5.5-.5-8.3-.5H296c-37.1 0-67.6 28-71.6 64H224V248c0 22.1 17.9 40 40 40s40-17.9 40-40V176c0 0 0-.1 0-.1V160l16 0 136 0c0 0 0 0 .1 0H464c44.2 0 80 35.8 80 80v8zM336 192v56c0 39.8-32.2 72-72 72s-72-32.2-72-72V129.4c-35.9 6.2-65.8 32.3-76 68.2L99.5 255.2 26.3 328.4c-21.9 21.9-21.9 57.3 0 79.2l78.1 78.1c21.9 21.9 57.3 21.9 79.2 0l37.7-37.7c.9 0 1.8 .1 2.7 .1H384c26.5 0 48-21.5 48-48c0-5.6-1-11-2.7-16H432c26.5 0 48-21.5 48-48c0-12.8-5-24.4-13.2-33c25.7-5 45.1-27.6 45.2-54.8v-.4c-.1-30.8-25.1-55.8-56-55.8c0 0 0 0 0 0l-120 0z"/></svg>
                    </x-card-component>

                    <x-card-component  class="!bg-yellow-500 border-yellow-500" title="Create Request" description="description" route="incidents.create">
                        <svg class="w-7 h-7 fill-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                            <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>
                    </x-card-component>

                    <x-card-component  class="!bg-green-500 border-green-500" title="Posts" description="description" route="posts.index">
                        <svg class="w-7 h-7 fill-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512">
                            <path d="M446.6 222.7c-1.8-8-6.8-15.4-12.5-18.5-1.8-1-13-2.2-25-2.7-20.1-.9-22.3-1.3-28.7-5-10.1-5.9-12.8-12.3-12.9-29.5-.1-33-13.8-63.7-40.9-91.3-19.3-19.7-40.9-33-65.5-40.5-5.9-1.8-19.1-2.4-63.3-2.9-69.4-.8-84.8.6-108.4 10C45.9 59.5 14.7 96.1 3.3 142.9 1.2 151.7.7 165.8.2 246.8c-.6 101.5.1 116.4 6.4 136.5 15.6 49.6 59.9 86.3 104.4 94.3 14.8 2.7 197.3 3.3 216 .8 32.5-4.4 58-17.5 81.9-41.9 17.3-17.7 28.1-36.8 35.2-62.1 4.9-17.6 4.5-142.8 2.5-151.7zm-322.1-63.6c7.8-7.9 10-8.2 58.8-8.2 43.9 0 45.4.1 51.8 3.4 9.3 4.7 13.4 11.3 13.4 21.9 0 9.5-3.8 16.2-12.3 21.6-4.6 2.9-7.3 3.1-50.3 3.3-26.5.2-47.7-.4-50.8-1.2-16.6-4.7-22.8-28.5-10.6-40.8zm191.8 199.8l-14.9 2.4-77.5.9c-68.1.8-87.3-.4-90.9-2-7.1-3.1-13.8-11.7-14.9-19.4-1.1-7.3 2.6-17.3 8.2-22.4 7.1-6.4 10.2-6.6 97.3-6.7 89.6-.1 89.1-.1 97.6 7.8 12.1 11.3 9.5 31.2-4.9 39.4z"/></svg>
                    </x-card-component>

                    <x-card-component  class="!bg-blue-500 border-blue-500" title="View My Tickets" description="description" route="incidents.index">
                        <svg class="w-7 h-7 fill-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                            <path d="M64 64C28.7 64 0 92.7 0 128v64c0 8.8 7.4 15.7 15.7 18.6C34.5 217.1 48 235 48 256s-13.5 38.9-32.3 45.4C7.4 304.3 0 311.2 0 320v64c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V320c0-8.8-7.4-15.7-15.7-18.6C541.5 294.9 528 277 528 256s13.5-38.9 32.3-45.4c8.3-2.9 15.7-9.8 15.7-18.6V128c0-35.3-28.7-64-64-64H64zm64 112l0 160c0 8.8 7.2 16 16 16H432c8.8 0 16-7.2 16-16V176c0-8.8-7.2-16-16-16H144c-8.8 0-16 7.2-16 16zM96 160c0-17.7 14.3-32 32-32H448c17.7 0 32 14.3 32 32V352c0 17.7-14.3 32-32 32H128c-17.7 0-32-14.3-32-32V160z"/></svg>
                    </x-card-component>
                @endif
                @if(Auth::user()->role === 2)
                    <x-card-component  class="!bg-orange-500 border-orange-500" title="Assigned Incidents" description="description" route="incidents.index">
                        <svg class="w-7 h-7 fill-white" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512">
                            <path d="M64 64C28.7 64 0 92.7 0 128v64c0 8.8 7.4 15.7 15.7 18.6C34.5 217.1 48 235 48 256s-13.5 38.9-32.3 45.4C7.4 304.3 0 311.2 0 320v64c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V320c0-8.8-7.4-15.7-15.7-18.6C541.5 294.9 528 277 528 256s13.5-38.9 32.3-45.4c8.3-2.9 15.7-9.8 15.7-18.6V128c0-35.3-28.7-64-64-64H64zm64 112l0 160c0 8.8 7.2 16 16 16H432c8.8 0 16-7.2 16-16V176c0-8.8-7.2-16-16-16H144c-8.8 0-16 7.2-16 16zM96 160c0-17.7 14.3-32 32-32H448c17.7 0 32 14.3 32 32V352c0 17.7-14.3 32-32 32H128c-17.7 0-32-14.3-32-32V160z"/></svg>
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
                    label: 'Incident Requests: ' + {{count($requests)}},
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
                        'rgb(154, 162, 235)',
                        'rgb(54, 62, 235)',
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
