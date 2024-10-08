<x-app-layout>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <x-slot name="header">
        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Report') }} <br> <span style="color:darkgreen;">Company:: {{$company_id}}</span>
            </h2>
        </div>
        <a href="{{ route('company') }}" class="text-blue-600 hover:text-blue-800 flex items-center ml-auto float-right">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back
        </a>
        <br>
        <div class="flex items-center space-x-2">
            <svg class="h-8 w-8 text-indigo-600 cursor-pointer" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" onclick="window.print()">
                <polyline points="6 9 6 2 18 2 18 9" />
                <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
                <rect x="6" y="14" width="12" height="8" />
            </svg>
        </div>
        <br>
        <div class="float-right">
            <label for="toggleEigh" class="flex items-center cursor-pointer select-none text-dark dark:text-white">
                <span class="btn text-blue-600 m-3">Change Graph</span>
                <div class="relative">
                    <input id="toggleEigh" type="checkbox" class="peer toggleEight sr-only" />
                    <div class="h-5 transition rounded-full peer-checked:bg-[#c4c2c2] shadow-inner box bg-[#c4c2c2] dark:bg-dark-2 w-14 peer-checked:dark:bg-dark-3"></div>
                    <div class="absolute left-0 flex items-center justify-center transition bg-indigo-600 rounded-full dot shadow-switch-1 -top-1 h-7 w-7 dark:bg-dark-3 peer-checked:translate-x-full peer-checked:bg-primary text-white peer-checked:text-white">
                        <span class="w-4 h-4 border border-current rounded-full bg-inherit active"></span>
                    </div>
                </div>
            </label>
        </div>
    </x-slot>

    @section('content')
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 gap-4">
            @foreach ($data as $category => $dataByDate)
            <div>
                <h2>{{ $category }}</h2>
                <canvas id="chart-{{ \Illuminate\Support\Str::slug($category) }}" width="100%" height="60px"></canvas>
            </div>
            @php
            $dates = $dataByDate->keys()->toArray();
            $values = $dataByDate->map(function ($entries) {
                return $entries->sum('value');
            })->toArray();
            @endphp
            @php
            $chartData[] = [
                'id' => 'chart-' . \Illuminate\Support\Str::slug($category),
                'labels' => $dates,
                'values' => $values,
                'label' => $category
            ];
            @endphp
            @endforeach
        </div>
    </div>
    
    <!-- Embed chartData as JSON -->
    <script id="chartData" type="application/json">
        {!! json_encode($chartData) !!}
    </script>
    @endsection

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/chart.js') }}"></script>
    @endpush
</x-app-layout>
