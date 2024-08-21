<x-app-layout>
    <div class="mx-auto max-w-3xl space-y-3">
        <p class="text-white text-lg font-bold">Tambah Youtube</p>
        <div class="bg-gray-800 rounded-lg p-5">
            <form action="{{ route('youtube.store') }}" method="POST">
                @csrf
                @method('POST')
                <div class="space-y-3">
                    <div class="flex flex-col gap-1">
                        <label for="link" class="text-white">Link</label>
                        <input type="url" id="link" name="link"
                            class="bg-gray-900 rounded-lg text-sm text-white" placeholder="Masukkan Url Youtube"
                            required>
                    </div>
                    <div class="flex flex-col gap-1">
                        <div class="flex justify-between">
                            <label for="user" class="text-white">User</label>
                            <select name="" id="group"
                                class="bg-transparent border-none focus:ring-0 active:ring-0 py-0 text-gray-500 text-sm">
                                <option value="" selected disabled>Pilih Dari Group</option>
                                @foreach ($group as $item)
                                    <option value="{{ $item->id }}">{{ $item->group_name }} </option>
                                @endforeach
                            </select>
                        </div>
                        <select name="user[]" id="user" required
                            class="!bg-gray-900 rounded-lg text-sm text-white p-2.5 select2" multiple>
                            @foreach ($user as $item)
                                <option value="{{ $item->id }}" data-group="{{ $item->group->pluck('id') }}">
                                    {{ $item->name }}
                                </option>
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
        $('.select2').select2({
            placeholder: 'Pilih User',
        })

        function updateUserOptions() {
            var selectedGroup = $('#group').val();


            $('#user').find('option').each(function() {
                var optionGroups = $(this).data('group');


                if (optionGroups.length > 0) {
                    optionGroups;
                } else {
                    optionGroups = [];
                }



                if (selectedGroup && optionGroups.includes(parseInt(selectedGroup))) {
                    $(this).prop('selected', true);
                }

            });

            $('#user').trigger('change');

        }

        $('#group').on('change', function() {
            updateUserOptions();
            $('#group').val(null);
        });

    })
</script>
