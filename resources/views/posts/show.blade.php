<x-app-layout>
    <x-slot name="header">
       
        <div class="flex justify-around items-center">
            <h3 class="text-lg font-semibold text-white">Detail Post</h3>
            @if (Auth::user()->id === $user->id)
                <div class="btn bg-blue-500 text-white px-4 py-2 rounded cursor-pointer" data-modal-target="#editModalPost">
                    edit your Post
                </div>
            @endif
        </div>
    </x-slot>

    <div class="container  mx-auto mt-5 flex flex-col items-center">
        <div class="max-w-2xl w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mb-5 h-72 flex flex-col">
            <div class="flex gap-3 bg-white border border-gray-300 rounded-xl overflow-hidden items-center justify-start flex-grow">

                <div class="flex flex-col gap-2 py-2 px-3">
                    <p class="text-xl font-bold">{{ $post->title }}</p>
                    <p class="text-gray-500">
                        {{ $post->content }}
                    </p>
                    <span class="flex items-center justify-start text-gray-500">
                        <span class="flex items-center justify-start text-gray-500 py-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm7.753 18.305c-.261-.586-.789-.991-1.871-1.241-2.293-.529-4.428-.993-3.393-2.945 3.145-5.942.833-9.119-2.489-9.119-3.388 0-5.644 3.299-2.489 9.119 1.066 1.964-1.148 2.427-3.393 2.945-1.084.25-1.608.658-1.867 1.246-1.405-1.723-2.251-3.919-2.251-6.31 0-5.514 4.486-10 10-10s10 4.486 10 10c0 2.389-.845 4.583-2.247 6.305z"/></svg>
                          
                        </span>
                        <p class="px-3">{{ $user->name }}</p>
                    </span>

                    <span class="flex items-center justify-between text-gray-500">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M10.773 21.585l-1.368 1.415-10.405-10.429v-8.571h2v7.719l9.773 9.866zm1.999-20.585h-9.772v9.772l12.074 12.228 9.926-9.85-12.228-12.15zm-4.772 7c-1.105 0-2-.895-2-2s.895-2 2-2 2 .895 2 2-.895 2-2 2z" /></svg>
                           <span class="px-3"> {{ 'ngetest' }}</span>
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
            <h1 class="text-lg font-semibold">Edit Post</h1>
            <button data-modal-dismiss="addModalPost" class="cursor-pointer">
                <span >
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 5L5 19M5 5l14 14" color="currentColor"/></svg>
                </span>
            </button>
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
