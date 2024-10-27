<x-app-layout>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Categories
        </h2>
        <x-primary-button-link :href="route('category.create')">Add +</x-primary-button-link>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-3 lg:px-6 py-10">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
            <table id="table" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $cat)
                    <tr>
                        <td><img src="{{ asset('storage/'.$cat->category_image) }}" alt="image" width="100"></td>
                        <td>{{ $cat->category_name }}</td>
                        <td>
                                <x-primary-button-link :href="route('category.edit', ['category' => $cat->id])">Edit</x-primary-button-link>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
  let table = new DataTable('#table');
    </script>
</x-app-layout>
