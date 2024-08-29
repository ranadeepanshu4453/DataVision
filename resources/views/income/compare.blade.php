<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <x-slot name="header">
        <div class="flex justify-between items-center bg-white p-4 shadow-md rounded-lg">
            <h2 class="font-semibold text-xl text-indigo-600 leading-tight">
                {{ __('Compare  --  Select any two') }}
            </h2>
        </div>
    </x-slot>

    <x-slot name="content">
        <!-- Companies Grid -->
        <div class="px-4 sm:px-6 lg:px-8 py-6">
            <form id="compareForm" action="{{ route('compareCompanies') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($companies as $company)
                    <div class="relative bg-indigo-600 text-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 flex flex-col items-center justify-center">
                        <!-- Checkbox for Selection -->
                        <label class="absolute top-2 right-2 flex items-center">
                            <input type="checkbox" class="form-checkbox h-5 w-5 text-indigo-400" name="company_ids[]" value="{{ $company->id }}" onclick="limitSelection(event)" />
                        </label>
                        <h3 class="text-lg font-semibold mb-4 text-center">{{ $company->name }}</h3>
                    </div>
                    @endforeach
                </div>

                <div class="flex items-center space-x-2 p-3 bg-indigo-100 border border-indigo-300 rounded-lg shadow-md w-30 h-10 absolute top-200 m-4 transition-transform duration-200 hover:scale-90">
                    <span class="text-indigo-700 font-semibold"><a href="#" onclick="document.getElementById('compareForm').submit();">Compare</a></span>
                    <svg class="h-8 w-8 text-indigo-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 16 16 12 12 8" />
                        <line x1="8" y1="12" x2="16" y2="12" />
                    </svg>
                </div>
            </form>
        </div>

        <script>
            function limitSelection(event) {
                const checkboxes = document.querySelectorAll('input[type="checkbox"]');
                const checkedCount = Array.from(checkboxes).filter(checkbox => checkbox.checked).length;

                if (checkedCount > 2) {
                    event.target.checked = false;
                    alert('You can only select two companies at a time for comparison.');
                }
            }
        </script>
    </x-slot>
</x-app-layout>
