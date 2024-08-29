@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Comparison Results</h2>
    <div class="row">
        @foreach ($companies as $company)
        <div class="col-md-6">
            <h3>{{ $company->name }}</h3>
            <p>Details about {{ $company->name }}...</p>
            <!-- Add more comparison details here -->
        </div>
        @endforeach
    </div>
</div>
@endsection
