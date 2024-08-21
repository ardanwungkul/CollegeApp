<x-app-layout>
    <div class="mx-auto max-w-3xl space-y-3">
        <p class="text-white text-lg font-bold">Tambah User</p>
        <div class="bg-gray-800 rounded-lg p-5">
            <form action="{{ route('user.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="space-y-3">
                    <div class="flex flex-col gap-1">
                        <label for="name" class="text-white">Name</label>
                        <input type="text" id="name" name="name"
                            class="bg-gray-900 rounded-lg text-sm text-white" placeholder="Masukkan Nama User" required>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label for="email" class="text-white">Email</label>
                        <input type="Email" id="email" name="email"
                            class="bg-gray-900 rounded-lg text-sm text-white" placeholder="Masukkan Email User"
                            required>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label for="password" class="text-white">Password</label>
                        <input type="text" id="password" name="password"
                            class="bg-gray-900 rounded-lg text-sm text-white" placeholder="Masukkan Password User"
                            required>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label for="group" class="text-white">Group</label>
                        <select name="group[]" id="select2" class="!bg-gray-900 rounded-lg text-sm text-white"
                            multiple>
                            @foreach ($group as $item)
                                <option value="{{ $item->group_name }}">{{ $item->group_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="bg-gray-600 text-white px-5 py-1 rounded-lg hover:bg-opacity-80">Tambah</button>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>
<script>
    $(document).ready(function() {
        $('#select2').select2({
            placeholder: 'Pilih User Group',
            tags: true
        })
    })
</script>
