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
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <!-- Success Message -->
        @if (session('success'))
            <div class="mb-4 p-4 text-green-800 bg-green-100 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="file" class="block text-sm font-medium text-gray-700">Choose file</label>
                <input type="file" id="file" name="file" accept=".xlsx,.xls" required class="form-input mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
            </div>
            <div class="flex justify-end">
                <button type="submit" class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-md text-sm px-5 py-3 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">
                    Import
                </button>
            </div>
        </form>
    </div>
</div>

    @endsection
</x-app-layout>
