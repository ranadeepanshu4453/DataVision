<x-app-layout>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <x-slot name="header">
        <div class="flex justify-between items-center bg-gray-200 p-4 shadow-md rounded-lg">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    @section('content')
    <!-- Search Form -->
    <div class="max-w-md mx-auto p-4">
        <div class="relative">
            <form action="{{ route('dashboard') }}" method="get" class="flex items-center space-x-2">
                <input
                    type="text"
                    name="search"
                    value="{{ request()->get('search') }}"
                    placeholder="Search..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                <button
                    type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150 ease-in-out"
                    aria-label="Search"
                >
                <svg class="w-6 h-6 text-white dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
                </button>
            </form>
        </div>
    </div>

    <!-- Companies Grid -->
    <div class="px-4 sm:px-6 lg:px-8 py-6 ">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 ">
            @foreach ($companies as $company)
            <div class="bg-indigo-600  text-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 flex flex-col items-center justify-center ">
                <h3 class="text-lg font-semibold mb-4 text-center ">{{ $company->name }}</h3>
                <a href="{{ route('chart', $company->id) }}" class="inline-block px-6 py-3 bg-white text-black font-semibold rounded-lg shadow-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-150 ease-in-out">
                    View Charts
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @endsection
</x-app-layout>
