<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <div class="flex justify-around">
            <h3 class="text-lg font-semibold text-white">Detail Post</h3>
            @if (Auth::user()->id === $user->id)
                <div class="btn bg-blue-500 text-white px-4 py-2 rounded cursor-pointer" data-modal-target="#editModalPost">
                    edit your Post
                </div>
            @endif
        </div>
    </x-slot>

    <div class="container mx-auto mt-5">
        <div class="max-w-2xl mx-auto mt-3">
            <div class="flex gap-3 bg-white border border-gray-300 rounded-xl overflow-hidden items-center justify-start">
        
                {{-- <div class="relative w-32 h-32 flex-shrink-0">
                    <img class="absolute left-0 top-0 w-full h-full object-cover object-center transition duration-50" loading="lazy" src="https://via.placeholder.com/150">
                </div> --}}
        
                <div class="flex flex-col gap-2 py-2 px-3">
                    <p class="text-xl font-bold">{{ $post->title }}</p>
                    <p class="text-gray-500">
                        {{ $post->content }}
                    </p>
                    <span class="flex items-center justify-start text-gray-500">
                        <svg class="w-4 h-4 mr-1 mt-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd"></path>
                        </svg>
                        <p>{{ $user->name }}</p>
                    </span>

                    <span class="flex items-center justify-between text-gray-500">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1 mt-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                            </svg>
                            {{ 'ngetest' }}
                        </div>
                    </span>
                </div>
            </div>
        </div>
    </div>


    {{-- modal add --}}
    <div id="editModalPost" class="fixed inset-0 flex items-center justify-center z-50 hidden modal">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full">
        <div class="bg-gray-100 p-4 flex justify-between items-center">
            <h1 class="text-lg font-semibold">Create Post</h1>
            <button type="button" class="btn-close" data-modal-dismiss="editModalPost">&times;</button>
        </div>
        <div class="p-4">
            <form action="{{ route('posts.update', $post->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" id="title" value="{{ $post->title }}" name="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>
            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                <textarea id="content" name="content" value="{{ $post->content }}" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ $post->content }}</textarea>
            </div>
            <div class="flex justify-end">
                <button type="button" id="close_modal" class="btn bg-gray-500 text-white px-4 py-2 rounded" data-modal-dismiss="editModalPost">Close</button>
                <button type="submit" class="ml-2 btn bg-blue-500 text-white px-4 py-2 rounded">Save changes</button>
            </div>
            </form>
        </div>
        </div>
    </div>
      
    <script>
        document.querySelectorAll('[data-modal-target]').forEach(trigger => {
            trigger.addEventListener('click', () => {
                const modal = document.querySelector(trigger.getAttribute('data-modal-target'));
                modal.classList.remove('hidden');
            });
        });
    
        document.querySelectorAll('[data-modal-dismiss]').forEach(trigger => {
        trigger.addEventListener('click', () => {
            const modal = trigger.closest('.modal');
            modal.classList.add('hidden');
        });
        });
    </script>

  
</x-app-layout>
