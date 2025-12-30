@extends('installer::installation.layout')

@section('content')
    <div>
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">License Verification</h2>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 mb-6">
            <h3 class="text-lg font-medium text-gray-800 mb-4">Skipping License Verification</h3>

            <p class="text-gray-600 mb-4">
                This software is now open source. Redirecting to the next step...
            </p>
        </div>
    </div>
    <script>
        setTimeout(function() {
            window.location.href = "{{ route('install.user') }}";
        }, 2000);
    </script>
@endsection