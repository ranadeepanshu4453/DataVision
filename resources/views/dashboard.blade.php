<x-app-layout>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <x-slot name="header">
        
        <div class="flex justify-between items-center bg-indigo-50 p-4 shadow-md rounded-lg">
            <h2 class="font-semibold text-xl text-indigo-600 leading-tight">
                {{ __('Dashboard') }}
                <!-- container -->
                @include('partials.container')
                <!--  -->
            </h2>
        </div>

        

        <!-- compare functionality -->
        <div class="hidden flex items-center space-x-2 p-3 bg-indigo-100 border border-indigo-300 rounded-lg shadow-md w-30 h-10 absolute top-200 right-0 m-4 transition-transform duration-200 hover:scale-90">
    <span class="text-indigo-700 font-semibold" ><a href="{{route('compare')}}">Compare</a></span>
    <svg class="h-10 w-10 text-indigo-500 hover:scale-110" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z"/>
        <circle cx="6" cy="6" r="2" />
        <circle cx="18" cy="18" r="2" />
        <path d="M11 6h5a2 2 0 0 1 2 2v8" />
        <polyline points="14 9 11 6 14 3" />
        <path d="M13 18h-5a2 2 0 0 1 -2 -2v-8" />
        <polyline points="10 15 13 18 10 21" />
    </svg>
</div>
<!--compare functionality-->
    </x-slot>

    @section('content')
    <!-- Search Form -->
    <div class="max-w-md mx-auto p-4">
        <div class="relative">
        @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Error!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 5.652a1 1 0 010 1.415l-3.793 3.793a1 1 0 01-1.415 0L5.652 7.067a1 1 0 011.415-1.415l2.793 2.793 2.793-2.793a1 1 0 011.415 0z"/></svg>
        </span>
    </div>
@endif
@if(session('updated'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Success!</strong>
        <span class="block sm:inline">{{ session('updated') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            
        </span>
    </div>
@endif



            <form action="{{ route('dashboard') }}" method="get" class="flex items-center space-x-2">
                <input
                    type="text"
                    name="search"
                    value="{{ request()->get('search') }}"
                    placeholder="Search..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 bg-indigo-50" 
                />
                <button
                    type="submit"
                    class="px-4 py-2  text-white rounded-lg hover:scale-110  focus:outline-none focus:ring-2 focus:ring-indigo-600 transition duration-150 ease-in-out"
                    aria-label="Search"
                >
                <svg class="h-8 w-8 text-indigo-600"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <circle cx="11" cy="11" r="8" />  <line x1="21" y1="21" x2="16.65" y2="16.65" /></svg>
                </button>
            </form>
        </div>
    </div>

    <!-- Companies Grid -->
    <div class="px-4 sm:px-6 lg:px-8 py-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($companies as $company)
        <div class="relative bg-indigo-600 text-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 flex flex-col items-center justify-center">
            <!-- Cross Icon with Confirmation -->
             @can('isAdmin')
            <a href="#" class="absolute top-2 right-2 text-white hover:text-red-800" onclick="confirmDelete(event, '{{ $company->id }}')">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
@endcan
            <h3 class="text-lg font-semibold mb-4 text-center">{{ $company->name }}</h3>
            <a href="{{ route('chart', $company->id) }}" >
            <!-- class="inline-block px-6 py-3 bg-white text-black font-semibold rounded-lg shadow-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-150 ease-in-out" -->
            <div class="flex items-center justify-center h-12 w-12 bg-white text-indigo-600 rounded-full hover:bg-indigo-100 ">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4 20v-6m4 6v-10m4 10v-14m4 14v-8m4 8v-4" />
    </svg>
</div>

            </a>
        </div>
        @endforeach
    </div>
</div>

    @endsection
</x-app-layout>



<script>
function confirmDelete(event, companyId) {
    event.preventDefault(); // Prevent the default link behavior

    if (confirm("Are you sure you want to delete this item?")) {
        // If confirmed, redirect to the URL with the company ID
        window.location.href = '/delete-company/' + companyId;
    }
}
</script>