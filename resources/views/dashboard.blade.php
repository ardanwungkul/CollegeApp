<x-app-layout>
    @php
        function formatAngka($angka)
        {
            if ($angka) {
                if ($angka >= 1000000) {
                    return number_format($angka / 1000000, 0) . 'jt';
                } elseif ($angka >= 1000) {
                    return number_format($angka / 1000, 0) . 'rb';
                } else {
                    return number_format($angka);
                }
            } else {
                return 0;
            }
        }
    @endphp
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div>
        <div class="grid grid-cols-4 gap-4">
            @foreach ($youtube as $item)
                <div class="w-full rounded-lg bg-gray-800">
                    {{-- <iframe class="w-full object-cover rounded-t-lg"
                        src="https://www.youtube.com/embed/{{ $item->link }}" title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer;  clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe> --}}
                    <img src="{{ end($item->video->snippet->thumbnails)->url }}"
                        class="w-full h-[160px] rounded-lg object-cover" alt="">
                    <div class="bg-gray-800 rounded-b-lg p-3 space-y-1">
                        <a href="{{ route('youtube.show', $item->id) }}" target="_blank" class="cursor-pointer ">
                            <p class="line-clamp-1 text-white">{{ $item->judul }}</p>
                        </a>
                        <p class="text-gray-500 text-xs"> {{ $item->channel->snippet->title }}
                        </p>
                        <p class="text-gray-500 text-xs">
                            {{ formatAngka($item->video->statistics->viewCount) }} x ditonton
                        </p>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</x-app-layout>
