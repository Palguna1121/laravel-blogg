<x-app-layout>
    <x-slot name="header">
       
        <div class="flex justify-around items-center">
            <h3 class="text-lg font-semibold text-white">Detail Logs</h3>
        </div>
    </x-slot>

    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full">
                        <thead class="border-b">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Post ID</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Changes</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Created At</th>
                                <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($logs as $log)
                                <tr class="border-b">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $log->post_id }}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $log->changes }}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $log->created_at }}</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">{{ $log->updated_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  
</x-app-layout>
