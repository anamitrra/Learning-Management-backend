<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Update Course
        </h2>

        <x-primary-button-link :href="route('course.index')">
            < Back
                </x-primary-button-link>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-3 lg:px-6 py-10">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-5">

            <form method="POST" action="{{ route('course.update', ['course' => $course->id]) }}" enctype="multipart/form-data" onsubmit="return confirmUpdate();">
                @csrf
                @method('PATCH')
                <div>
                    <x-input-label for="course_name" value="Course Name" />
                    <x-text-input id="course_name" class="block mt-1 w-full" type="text" name="course_name" value="{{ $course->course_name }}" />
                    <x-input-error :messages="$errors->get('course_name')" class="mt-2" />
                </div>
                <br>
                <div>
                    <img src="{{ asset('storage/'.$course->course_image) }}" alt="image" width="200">
                </div>
                <br>
                <div>
                    <x-input-label for="course_image" value="Course Image" />
                    <x-text-input id="course_image" class="block mt-1 w-full" type="file" name="course_image" :value="old('course_image')" />
                    <x-input-error :messages="$errors->get('course_image')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4 gap-3">
                    <x-primary-button type="submit">
                        Update
                    </x-primary-button>
                    <x-danger-button onclick="confirmDelete(event, '{{ route('course.destroy', ['course' => $course->id]) }}')">
                        Delete
                    </x-danger-button>
                </div>
            </form>

            <form id="delete-form" action="{{ route('course.destroy', ['course' => $course->id]) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>

        </div>
    </div>

    <script>
        function confirmUpdate() {
            return confirm("Are you sure you want to update this course?");
        }

        function confirmDelete(event, url) {
            event.preventDefault(); // Prevent the default link action
            if (confirm("Are you sure you want to delete this course?")) {
                document.getElementById('delete-form').action = url; // Set the action for the delete form
                document.getElementById('delete-form').submit(); // Submit the delete form
            }
        }
    </script>

</x-app-layout>