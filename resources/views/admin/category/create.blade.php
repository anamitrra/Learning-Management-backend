<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            Create Category
        </h2>

        <x-primary-button-link :href="route('category.index')">
            < Back
                </x-primary-button-link>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-3 lg:px-6 py-10">
        <div class="bg-white  overflow-hidden shadow-sm sm:rounded-lg p-5">

            <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                @csrf
                <div>
                    <x-input-label for="category_name" value="Category Name" />
                    <x-text-input id="category_name" class="block mt-1 w-full" type="text" name="category_name" :value="old('category_name')" />
                    <x-input-error :messages="$errors->get('category_name')" class="mt-2" />
                </div>
                <br>
                <div>
                    <x-input-label for="category_image" value="Category Image" />
                    <x-text-input id="category_image" class="block mt-1 w-full" type="file" name="category_image" :value="old('category_image')" />
                    <x-input-error :messages="$errors->get('category_image')" class="mt-2" />
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