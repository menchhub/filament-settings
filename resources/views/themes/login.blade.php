@extends('filament-panels::pages.auth.login') {{-- ✅ Correct Filament authentication layout --}}

@section('body') {{-- ✅ Ensures the login page content is rendered --}}
<div class="flex min-h-screen">
    <!-- ✅ Left Side: Welcome Message -->
    <div class="hidden md:flex w-1/2 bg-blue-600 text-white items-center justify-center p-10">
        <div class="text-center">
            <h1 class="text-4xl font-bold">Welcome to {{ config('app.name') }}</h1>
            <p class="mt-4 text-lg">
                Manage your account and access all features easily.
            </p>
        </div>
    </div>

    <!-- ✅ Right Side: Login Form -->
    <div class="w-full md:w-1/2 flex items-center justify-center p-6">
        <div class="w-full max-w-md bg-white p-6 shadow-md rounded-lg">
            {{ $this->form }} {{-- ✅ This renders Filament’s login form --}}
        </div>
    </div>
</div>
@endsection
