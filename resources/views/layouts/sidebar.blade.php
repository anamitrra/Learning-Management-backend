<div class="bg-white w-full h-screen sticky top-0">
    <div class="shadow p-5 text-center">
        Admin Panel
    </div>

    <div class="flex flex-col gap-3 px-10 py-5">
        <x-nav-link class="py-2" :href="route('dashboard')" :active="request()->routeIs('dashboard')">Dashboard</x-nav-link>
        <!-- <x-nav-link class="py-2" :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">Users</x-nav-link> -->
        <x-nav-link class="py-2" :href="route('category.index')" :active="request()->routeIs('category.index')">Categories</x-nav-link>
        <x-nav-link class="py-2" :href="route('course.index')" :active="request()->routeIs('course.index')">Courses</x-nav-link>
        <!-- <x-nav-link class="py-2" :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">Sliders</x-nav-link> -->
        <x-nav-link class="py-2" :href="route('videos.index')" :active="request()->routeIs('videos.index')">Videos</x-nav-link>
        <x-nav-link class="py-2" :href="route('slider.index')" :active="request()->routeIs('slider.index')">Sliders</x-nav-link>
    </div>
</div>