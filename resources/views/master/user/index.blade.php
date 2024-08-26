<x-app-layout>
    <div>
        <a href="{{ route('user.create') }}"
            class="bg-gray-800 text-white rounded-lg px-5 py-2 border border-gray-500 hover:bg-opacity-80 text-sm">Tambah
            User</a>
        <div class="relative">
            <table id="table" class="!w-full text-sm stripe hover">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <td>No</td>
                        <td>Nama</td>
                        <td>Email</td>
                        <td>Group</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody class="text-white bg-gray-700">
                    @foreach ($user as $item)
                        <tr>
                            <td class="text-center">{{ $loop->index + 1 }}</td>
                            <td class="capitalize">{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <ul>
                                    @foreach ($item->group as $group)
                                        <li class="list-disc">{{ $group->group_name }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="flex items-center justify-center gap-3">
                                <a href="{{ route('user.edit', $item->id) }}">
                                    <i class="fa-solid fa-pen text-blue-500"></i>
                                </a>
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
            responsive: {
                details: {
                    renderer: function(api, rowIdx, columns) {
                        let data = columns.map((col, i) => {
                            return col.hidden ?
                                '<tr class="text-start" data-dt-row="' +
                                col.rowIndex +
                                '" data-dt-column="' +
                                col.columnIndex +
                                '">' +
                                '<td class="text-start">' +
                                col.title +
                                ':' +
                                '</td> ' +
                                '<td class="text-start">' +
                                col.data +
                                '</td>' +
                                '</tr>' :
                                '';
                        }).join('');

                        let table = document.createElement('table');
                        table.innerHTML = data;

                        return data ? table : false;
                    }
                }
            },
        })
    })
</script>
