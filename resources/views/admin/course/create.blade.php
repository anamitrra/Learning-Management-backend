<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Create Course
        </h2>

        <x-primary-button-link :href="route('course.index')">
            < Back
                </x-primary-button-link>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-3 lg:px-6 py-10">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-5">

            <form method="POST" action="{{ route('course.store') }}" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div>
                    <x-input-label for="course_name" value="Course Name" />
                    <x-text-input id="course_name" class="block mt-1 w-full" type="text" name="course_name" :value="old('course_name')" />
                    <x-input-error :messages="$errors->get('course_name')" class="mt-2" />
                </div>
                <br>
                <div>
                    <x-input-label for="course_image" value="Course Image" />
                    <x-text-input id="course_image" class="block mt-1 w-full" type="file" name="course_image" :value="old('course_image')" />
                    <x-input-error :messages="$errors->get('course_image')" class="mt-2" />
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