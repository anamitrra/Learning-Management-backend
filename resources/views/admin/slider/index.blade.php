<x-app-layout>
    <script src="https://cdn.datatables.net/2.1.7/css/dataTables.tailwindcss.css"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.tailwindcss.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Sliders
        </h2>
        <x-primary-button-link :href="route('slider.create')">Add +
        </x-primary-button-link>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-3 lg:px-6 py-10">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-5">

            <table id="table" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sliders as $slider)

                    <tr>
                        <td><img src="{{ asset('storage/'.$slider->slider_image) }}" alt="image" width="100"></td>
                        <td>{{ $slider->slider_name }}</td>
                        <td>
                            <x-primary-button-link :href="route('slider.edit', ['slider' => 
                        $slider->id])">Edit
                            </x-primary-button-link>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <script>
        new DataTable('#table');
    </script>
</x-app-layout>