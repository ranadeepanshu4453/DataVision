<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Import Statement') }}
            </h2>
        </div>
    </x-slot>

    @section('content')
        <div class="px-4 sm:px-6 lg:px-8">
            {{session('success')}}
            <form action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" class="form-input rounded-lg border-gray-300" name="file" accept=".xlsx,.xls" required>
                <button type="submit" class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:ring-indigo-300 font-medium rounded-md text-sm px-5 py-3 me-2 mb-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 focus:outline-none dark:focus:ring-indigo-800">Import</button>
                
            </form>
        </div>
    @endsection
</x-app-layout>
