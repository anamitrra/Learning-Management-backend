<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Update Category
        </h2>

        <x-primary-button-link :href="route('category.index')">
            < Back
                </x-primary-button-link>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-3 lg:px-6 py-10">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-5">

            <form method="POST" action="{{ route('category.update', ['category' => $category->id]) }}" enctype="multipart/form-data" onsubmit="return confirmUpdate();">
                @csrf
                @method('PATCH')
                <div>
                    <x-input-label for="category_name" value="Category Name" />
                    <x-text-input id="category_name" class="block mt-1 w-full" type="text" name="category_name" value="{{ $category->category_name }}" />
                    <x-input-error :messages="$errors->get('category_name')" class="mt-2" />
                </div>
                <br>
                <div>
                    <img src="{{ asset('storage/'.$category->category_image) }}" alt="image" width="200">
                </div>
                <br>
                <div>
                    <x-input-label for="category_image" value="Category Image" />
                    <x-text-input id="category_image" class="block mt-1 w-full" type="file" name="category_image" :value="old('category_image')" />
                    <x-input-error :messages="$errors->get('category_image')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4 gap-3">
                    <x-primary-button type="submit">
                        Update
                    </x-primary-button>
                    <x-danger-button onclick="confirmDelete(event, '{{ route('category.destroy', ['category' => $category->id]) }}')">
                        Delete
                    </x-danger-button>
                </div>
            </form>

            <form id="delete-form" action="{{ route('category.destroy', ['category' => $category->id]) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>

        </div>
    </div>

    <script>
        function confirmUpdate() {
            return confirm("Are you sure you want to update this category?");
        }

        function confirmDelete(event, url) {
            event.preventDefault(); // Prevent the default link action
            if (confirm("Are you sure you want to delete this category?")) {
                document.getElementById('delete-form').action = url; // Set the action for the delete form
                document.getElementById('delete-form').submit(); // Submit the delete form
            }
        }
    </script>

</x-app-layout>