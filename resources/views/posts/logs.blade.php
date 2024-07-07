<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-around items-center">
            <h3 class="text-lg font-semibold text-white">Detail Logs</h3>
        </div>
    </x-slot>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-5">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Post ID</th>
                    <th scope="col" class="px-6 py-3">Changes</th>
                    <th scope="col" class="px-6 py-3">Created At</th>
                    <th scope="col" class="px-6 py-3">Updated At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $log->post_id }}
                        </th>
                        <td class="px-6 py-4">{{ $log->changes }}</td>
                        <td class="px-6 py-4" id="created_at_{{ $log->id }}">
                            {{ $log->created_at }}
                        </td>
                        <td class="px-6 py-4" id="updated_at_{{ $log->id }}">
                            {{ $log->updated_at }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @foreach ($logs as $log)
                var createdAtTimestamp = new Date("{{ $log->created_at }}");
                var updatedAtTimestamp = new Date("{{ $log->updated_at }}");

                function formatTimestamp(timestamp) {
                    var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                    var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    var dayName = days[timestamp.getDay()];
                    var day = timestamp.getDate();
                    var monthIndex = timestamp.getMonth();
                    var year = timestamp.getFullYear();
                    var hours = timestamp.getHours();
                    var minutes = timestamp.getMinutes();

                    var ampm = hours >= 12 ? 'PM' : 'AM';
                    hours = hours % 12;
                    hours = hours ? hours : 12; 
                    minutes = minutes < 10 ? '0' + minutes : minutes;

                    return hours + '.' + minutes + ' ' + ampm + ', ' + dayName + ' ' + day + ' ' + months[monthIndex] + ' ' + year;
                }

                document.getElementById('created_at_{{ $log->id }}').textContent = formatTimestamp(createdAtTimestamp);
                document.getElementById('updated_at_{{ $log->id }}').textContent = formatTimestamp(updatedAtTimestamp);
            @endforeach
        });
    </script>
</x-app-layout>
