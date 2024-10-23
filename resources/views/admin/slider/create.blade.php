<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Create Slider
        </h2>

        <x-primary-button-link :href="route('slider.index')">
            < Back
                </x-primary-button-link>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-3 lg:px-6 py-10">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-5">

            <form method="POST" action="{{ route('slider.store') }}" enctype="multipart/form-data">
                @csrf
                <div>
                    <x-input-label for="slider_name" value="Slider Name" />
                    <x-text-input id="slider_name" class="block mt-1 w-full" type="text" name="slider_name" :value="old('slider_name')" />
                    <x-input-error :messages="$errors->get('slider_name')" class="mt-2" />
                </div>
                <br>
                <div>
                    <x-input-label for="slider_image" value="Slider Image" />
                    <x-text-input id="slider_image" class="block mt-1 w-full" type="file" name="slider_image" :value="old('slider_image')" />
                    <x-input-error :messages="$errors->get('slider_image')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button>
                        Create
                    </x-primary-button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>