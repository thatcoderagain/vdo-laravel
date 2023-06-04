<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (isset($error))
                        {{ __($error) }}
                    @else
                        <h2 style="font-size: 2rem">{{ __($title) }}</h2>
                        <iframe
                          src="{{"https://player.vdocipher.com/v2/?otp=${otp}&playbackInfo=${playbackInfo}"}}"
                          style="border:0;width:720px;height:405px"
                          allow="encrypted-media"
                          allowfullscreen
                        ></iframe>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
