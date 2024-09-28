<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Update Video
        </h2>

        <x-primary-button-link :href="route('videos.index')">
            < Back
                </x-primary-button-link>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-3 lg:px-6 py-10">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-5">

            <form method="POST" action="{{ route('videos.update', ['video'=>$video->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div>
                    <x-input-label for="title" value="Video Title" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{$video->title}}" />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>
                <br>
                <div>
                    <x-input-label for="description" value="Video Description" />
                    <x-textarea-input id="description" class="block mt-1 w-full" type="text" name="description" value="{{$video->description}}" />
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
                <br>
                <div>
                    <x-input-label for="long_description" value="Video Long Description" />
                    <x-textarea-input id="long_description" class="block mt-1 w-full" type="text" name="long_description" value="{{$video->long_description}}" />
                    <x-input-error :messages="$errors->get('long_description')" class="mt-2" />
                </div>
                <br>
                <div>
                    <x-input-label for="category" value="Video Category" />
                    <x-input-select id="category" class="block mt-1 w-full" name="category">
                        <option value="">Please Select</option>
                        @foreach ($categories as $category)
                        <option {{ ($video->category == $category->category_name ? "selected":"") }} value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                        @endforeach
                    </x-input-select>
                    <x-input-error :messages="$errors->get('category')" class="mt-2" />
                </div>

                <br>
                <div>
                    <x-input-label for="course" value="Video Courses" />
                    <x-input-select id="course" class="block mt-1 w-full" name="course">
                        <option value="">Please Select</option>
                        @foreach ($courses as $course)
                        <option {{ ($video->course == $course->course_name ? "selected":"") }} value="{{ $course->course_name }}">{{ $course->course_name }}</option>
                        @endforeach
                    </x-input-select>
                    <x-input-error :messages="$errors->get('course')" class="mt-2" />
                </div>

                <br>
                <div>
                    <img src="{{ asset('storage/'.$video->image) }}" alt="image" width="200">
                </div>
                <br>
                <div>
                    <x-input-label for="image" value="Video Image" />
                    <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" :value="old('image')" />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>
                <br>
                <div>
                    <video width="320" height="240" controls>
                        <source src="{{ asset('storage/'.$video->video_path) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
                <br>
                <div>
                    <x-input-label for="video" value="Video" />
                    <x-text-input id="video" class="block mt-1 w-full" type="file" name="video" :value="old('video')" />
                    <x-input-error :messages="$errors->get('video')" class="mt-2" />
                </div>


                <br>
                <div class="flex gap-2 items-center">
                    <x-input-label for="is_free" value="Is Free?" />
                    <input class="mt-1" id="is_free" class="block" type="checkbox" name="is_free" {{ ($video->is_free ? "checked":"") }} :value="old('is_free')" />
                    <x-input-error :messages="$errors->get('is_free')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4 gap-3">
                    <x-primary-button>
                        Upload
                    </x-primary-button>
                    <x-danger-button onclick="confirmDelete(event, '{{ route('videos.destroy', ['video' => $video->id]) }}')">
                        Delete
                    </x-danger-button>
                </div>
            </form>

            <form id="delete-form" action="{{ route('videos.destroy', ['video' => $video->id]) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>

        </div>
    </div>

    <script>
        function confirmUpdate() {
            return confirm("Are you sure you want to update this video?");
        }

        function confirmDelete(event, url) {
            event.preventDefault(); // Prevent the default link action
            if (confirm("Are you sure you want to delete this video?")) {
                document.getElementById('delete-form').action = url; // Set the action for the delete form
                document.getElementById('delete-form').submit(); // Submit the delete form
            }
        }
    </script>

</x-app-layout>