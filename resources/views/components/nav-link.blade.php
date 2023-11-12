@props(['active'])

@php
    $user = \Illuminate\Support\Facades\Auth::user();
   $classes = ($active ?? false)
               ? 'text-[1rem] inline-flex items-center px-1 pt-1 '. ($user && $user->role === 1 ? 'border-r-4' : 'border-b-4')  .' border-white text-sm font-medium leading-5 text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
               : 'text-[1.12rem] inline-flex items-center px-1 pt-1 border-r-4 border-transparent text-sm font-medium leading-5 text-gray-400 hover:text-gray-300 hover:border-white focus:outline-none focus:text-gray-300 focus:border-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
