<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Updated Report') }}
            </h2>
        </div>
    </x-slot>

    @section('content')
    <div class="flex justify-center items-center  px-4 sm:px-6 lg:px-8">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-4 p-4 text-green-800 bg-green-100 rounded-lg">
                {{ session('success') }}
            </div>
        @endif
        
    
        <div class="relative bg-indigo-600 text-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 flex flex-col items-center justify-center">
            <!-- Cross Icon with Confirmation -->
            <a href="#" class="absolute top-2 right-2 text-white hover:text-red-800" onclick="confirmDelete(event, '{{ $updated_company->id }}')">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
            <h3 class="text-lg font-semibold mb-4 text-center">{{ $updated_company->name }}</h3>
            <a href="{{ route('chart', $updated_company->id) }}" class="inline-block px-6 py-3 bg-white text-black font-semibold rounded-lg shadow-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-150 ease-in-out">
                View Report
            </a>
        </div> 
    </div>
</div>

    @endsection
</x-app-layout>
