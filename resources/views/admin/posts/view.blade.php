<x-app-layout>

    <div class="px-10 py-24 space-y-5">
        <a href="{{ route('posts.index') }}" class="text-gray-600 hover:text-gray-900">
            <svg class="w-6 h-6 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back
        </a>
        <div>
            <h5 class="text-center mb-2 text-2xl font-bold tracking-tight text-gray-900">{{$post->title}}</h5>
            <p class="text-center mb-3 font-normal text-black">{{$post->body}}</p>
        </div>
    </div>

</x-app-layout>
