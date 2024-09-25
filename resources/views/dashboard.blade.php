<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in as school member!") }}
                    {{Auth::user()->roles->pluck('name')->implode(',')}}
                </div>
            </div>
        </div>
    </div>
    @yield('content');
</x-app-layout>
