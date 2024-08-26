<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <a href="{{route('importfile')}}" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Import File</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}<br>
                    {{ __("Welcome ".Auth::user()->name) }}
                </div>
            </div> -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
                <div class="sidebar">
                    <i>
                        <h2>Income Statement</h2>
                    </i>
                    <ul>

                        <li><a href="#">Home</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Clients</a></li>
                        <li><a href="#">Contact</a></li>

                        <i>
                            <h2 class="user">Import Excel File</h2><br>
                        </i>
                        <li><a href="{{route('importfile')}}">Import File</a></li>

                    </ul>
                </div>
                <div class="p-6 text-gray-900 flex-1">
                    <canvas id="myBarChart" width="800" height="400"></canvas>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

