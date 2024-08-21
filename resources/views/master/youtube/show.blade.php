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
    <div class="space-y-2 p-3">
        <div class="flex gap-4">
            <div class="w-2/3 flex-none">
                <div class="h-[379px]">
                    <iframe class="w-full h-full rounded-lg" src="https://www.youtube.com/embed/{{ $youtube->link }}"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer;  clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        allowfullscreen></iframe>
                </div>
                <div class="space-y-4 mt-4">
                    <p class="text-xl text-white font-extrabold my-2">{{ $youtube->judul }}</p>
                    <div class="flex gap-3">
                        <div>
                            <img src="{{ $youtube->channel->snippet->thumbnails->default->url }}"
                                class="h-10 w-10 object-cover rounded-full" alt="">
                        </div>
                        <div>
                            <p class="text-base text-white">
                                {{ $youtube->channel->snippet->title }}
                            </p>
                            <p class="text-xs text-gray-500">
                                {{ formatAngka($youtube->channel->statistics->subscriberCount) }}
                                Subscriber</p>
                        </div>
                    </div>
                    <div class="w-full cp-1 rounded-lg p-3 text-white bg-gray-800">
                        <p>
                            {!! nl2br(e($youtube->deskripsi)) !!}
                        </p>
                    </div>
                </div>
            </div>
            <div>
                <ul class="space-y-2">
                    @foreach ($youtubeAll as $item)
                        @if ($item->id !== $youtube->id)
                            <li>
                                <a href="{{ route('youtube.show', $item->id) }}">
                                    <div class="flex gap-2">
                                        <div class="flex-none w-[168px]">
                                            <img src="{{ end($item->video->snippet->thumbnails)->url }}"
                                                class="w-[168px] h-[94px] rounded-lg object-cover" alt="">
                                            {{-- <iframe class="w-[168px] h-[94px] rounded-lg"
                                                src="https://www.youtube.com/embed/{{ $item->link }}"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer;  clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                allowfullscreen></iframe> --}}
                                        </div>
                                        <div>
                                            <a href="{{ route('youtube.show', $item->id) }}" class="space-y-1">
                                                <p class="text-white text-sm line-clamp-2 mt-2">{{ $item->judul }}
                                                </p>
                                                <p class="text-gray-500 text-xs"> {{ $item->channel->snippet->title }}
                                                </p>
                                                <p class="text-gray-500 text-xs">
                                                    {{ formatAngka($item->video->statistics->viewCount) }} x ditonton
                                                </p>
                                            </a>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
