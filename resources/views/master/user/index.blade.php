<x-app-layout>
    <div>
        <a href="{{ route('user.create') }}"
            class="bg-gray-800 text-white rounded-lg px-5 py-2 border border-gray-500 hover:bg-opacity-80">Tambah
            User</a>
        <div class="relative">
            <table id="table" class="!w-full hover stripe">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <td>No</td>
                        <td>Nama</td>
                        <td>Group</td>
                        <td>Email</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody class="text-white bg-gray-700">
                    @foreach ($user as $item)
                        <tr class="capitalize">
                            <td class="text-center">{{ $loop->index + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <ul>
                                    @foreach ($item->group as $group)
                                        <li class="list-disc">{{ $group->group_name }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $item->email }}</td>
                            <td class="flex items-center justify-center">
                                <form action="{{ route('user.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"><i class="fa-solid fa-trash text-red-500"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
<script>
    $(document).ready(function() {
        $('#table').DataTable({
            info: false,
            paging: false,
            language: {
                'search': '',
                'searchPlaceholder': 'Search for items'
            },
        })
    })
</script>
