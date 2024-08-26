<x-app-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Charts') }} 
            </h2>
        </div>
        <a href="{{ route('company') }}" class="text-blue-600 hover:text-blue-800 flex items-center ml-auto float-right">
        <!-- Back Arrow Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Back
    </a><br><br>
    <button id="printBtn" class="btn text-blue-600" onclick="window.print()">Print PDF</button>

    </x-slot>

    @section('content')
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-4">
                @foreach ($data as $category => $dataByDate)
                    <div>
                        <h2>{{ $category }}</h2> <!-- Display the category -->
                        <canvas id="chart-{{ \Illuminate\Support\Str::slug($category) }}" width="100%" height="60px"></canvas>
                    </div>

                    @php
                        // Prepare data for Chart.js
                        $dates = $dataByDate->keys()->toArray(); // Extract the dates as labels
                        $values = $dataByDate->map(function ($entries) {
                            return $entries->sum('value'); // Sum values for each date
                        })->toArray();
                    @endphp

                    @php
                        // Store the data in a JavaScript variable
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
    @endsection

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const chartData = @json($chartData);

                chartData.forEach(data => {
                    const ctx = document.getElementById(data.id).getContext('2d');
                    
                    new Chart(ctx, {
                        type: 'bar', // Specify the chart type
                        data: {
                            labels: data.labels, // Dates as labels for the x-axis
                            datasets: [{
                                label: data.label, // The label for the dataset
                                data: data.values, // The data for the chart
                                
                            backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                                borderWidth: 1 // The width of the border around the bars
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true // The y-axis will start at zero
                                }
                            }
                        }
                    });
                });
            });
        </script>


                    <script>
                        document.getElementById('printBtn').addEventListener('click', function () {
    const { jsPDF } = window.jspdf;

    const doc = new jsPDF();
    
    // You can get the content of the screen using the HTML element
    let content = document.getElementById('content-to-print'); // Replace with your content's ID

    doc.html(content, {
        callback: function (doc) {
            // Save the generated PDF
            doc.save('screen-data.pdf');
        },
        x: 10,
        y: 10,
        width: 190, // Adjust width
        windowWidth: 650 // Adjust window width to your content's width
    });
});

                    </script>



    @endpush
</x-app-layout>