<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-around items-center">
            <h3 class="text-lg font-semibold text-white">All Post</h3>
            <div class="btn bg-blue-500 text-white px-4 py-2 rounded cursor-pointer flex items-center" data-modal-target="#addModalPost">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M19 12.998h-6v6h-2v-6H5v-2h6v-6h2v6h6z"/></svg>
                <span class="px-2">Add your Post</span>
            </div>
        </div>
    </x-slot>

    {{-- table --}}
    <div class="container mx-auto mt-5 flex flex-col items-center">
        @foreach ($posts as $post)
        <div class="max-w-2xl w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 mb-5 h-72 flex flex-col">
            <div class="flex gap-3 bg-white border border-gray-300 rounded-xl overflow-hidden items-center justify-start flex-grow">
                <div class="flex flex-col gap-2 py-2 px-3 flex-grow">
                    <p class="text-xl font-bold">{{ $post->title }}</p>
                    <hr class="my-1">
                    <p class="text-gray-500 flex-grow text-base">{{ $post->content }}</p>
                    <span class="flex items-center justify-between text-gray-500">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path d="M10.773 21.585l-1.368 1.415-10.405-10.429v-8.571h2v7.719l9.773 9.866zm1.999-20.585h-9.772v9.772l12.074 12.228 9.926-9.85-12.228-12.15zm-4.772 7c-1.105 0-2-.895-2-2s.895-2 2-2 2 .895 2 2-.895 2-2 2z" /></svg>
                            <span class="px-3">
                                @if(isset($tags_by_post[$post->id]))
                                    @foreach($tags_by_post[$post->id] as $tag)
                                        <span class="bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">{{ $tag->name }}</span>
                                    @endforeach
                                @else
                                    No tags
                                @endif
                            </span>
                        </div>
                        @if (Auth::user()->id == $post->user_id)
                            <div class="flex items-center">
                                <a href="{{ route('posts.show', $post->id) }}" class="text-black bg-blue-500 px-4 py-2 rounded">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5"/></svg>
                                    </span>
                                </a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');" class="ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white bg-red-500 px-4 py-2 rounded">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256"><path fill="currentColor" d="M216 48h-40v-8a24 24 0 0 0-24-24h-48a24 24 0 0 0-24 24v8H40a8 8 0 0 0 0 16h8v144a16 16 0 0 0 16 16h128a16 16 0 0 0 16-16V64h8a8 8 0 0 0 0-16M112 168a8 8 0 0 1-16 0v-64a8 8 0 0 1 16 0Zm48 0a8 8 0 0 1-16 0v-64a8 8 0 0 1 16 0Zm0-120H96v-8a8 8 0 0 1 8-8h48a8 8 0 0 1 8 8Z"/></svg>
                                        </span>
                                    </button>
                                </form>
                            </div>
                        @elseif (Auth::user()->id != $post->user_id)
                            <div class="flex items-center">
                                <a href="{{ route('posts.show', $post->id) }}" class="text-white bg-blue-500 px-4 py-2 rounded">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5"/></svg>
                                    </span>
                                </a>
                            </div>
                        @endif
                    </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- modal add --}}
    <div id="addModalPost" class="fixed inset-0 flex items-center justify-center z-50 hidden modal">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full">
            <div class="bg-gray-100 p-4 flex justify-between items-center">
                <h1 class="text-lg font-semibold">Create Post</h1>
                <button data-modal-dismiss="addModalPost" class="cursor-pointer">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 5L5 19M5 5l14 14" color="currentColor"/></svg>
                    </span>
                </button>
            </div>
            <div class="p-4">
                <form action="{{ route('posts.store') }}" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" id="title" name="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div class="mb-4">
                        <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                        <textarea id="content" name="content" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" id="close_modal" class="btn bg-gray-500 text-white px-4 py-2 rounded" data-modal-dismiss="addModalPost">Close</button>
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
