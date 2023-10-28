<div {{$attributes->merge(['class' => 'flex space-x-7 w-full max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 hover:shadow-md transition-all ease-in-out duration-500 hover:dark:shadow-gray-600'])}}>
    {{$slot}}
   <div>
       <a href="{{route($route)}}">
           <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{$title}}</h5>
       </a>
       <p class="mb-3 font-normal text-gray-500 dark:text-gray-700">{{$description}}</p>
   </div>
</div>

