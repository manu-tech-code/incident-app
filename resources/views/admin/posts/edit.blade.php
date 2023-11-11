<x-app-layout>

<div class="px-10 py-24 space-y-5">
    <p class="text-center">Edit Post</p>
    <form action="{{route('posts.update', ['post' => $post->id])}}" method="POST" class="p-4 md:p-5">
        @csrf
        @method('PATCH')
        <div class="space-y-5 w-3/12">
            <!-- Title -->
            <div>
                <x-input-label for="title" :value="__('Title')" class="!text-black" />
                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{$post->title}}" required autofocus autocomplete="title" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="body" :value="__('Body')" class="!text-black"/>
                <textarea id="body" class="block mt-1 w-full" name="body" required autofocus autocomplete="body" >{{$post->body}}</textarea>
                <x-input-error :messages="$errors->get('body')" class="mt-2" />
            </div>
            <button type="submit" class="text-white inline-flex items-center bg-blue-700 transition-all ease-in-out duration-300 hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Update Post
            </button>
        </div>
    </form>
    </div>
</x-app-layout>
