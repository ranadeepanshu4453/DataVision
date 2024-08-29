<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Import Statement') }}
            </h2>
        </div>
    </x-slot>

    @section('content')
    
        <div class="flex justify-center items-center  px-4 sm:px-6 lg:px-8">
        <div class="bg-indigo-50 p-6 rounded-lg shadow-lg w-full max-w-md">
            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-4 p-4 text-green-800 bg-green-100 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif
    
            <!-- Form -->
            <form action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4 ">
                    <label for="file" class="block text-sm font-medium text-gray-700">Choose Xlsx file</label>
                    <input type="file" id="file" name="file" accept=".xlsx,.xls,.csv" required class="form-input mt-1 block w-full rounded-lg border-indigo-300 bg-indigo-50 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="text-white bg-indigo-700 hover:scale-90 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-md text-sm px-5 py-3 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">
                    <svg class="h-8 w-8 text-white"  width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <path d="M14 3v4a1 1 0 0 0 1 1h4" />  <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />  <line x1="12" y1="11" x2="12" y2="17" />  <polyline points="9 14 12 17 15 14" /></svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    

    @endsection
</x-app-layout>

