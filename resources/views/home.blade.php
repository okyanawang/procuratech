@extends('layout')

@section('content')
    <div class="hero min-h-screen bg-base-200">
        <div class="hero-content flex-col lg:flex-row-reverse gap-10">
            <img src="{{ asset('/img/hero.jpg') }}" alt="hero" class="max-h-96 rounded-xl" />
            <div class="">
                <h1 class="text-5xl font-bold">Procuratech</h1>
                <p class="py-6q w-full max-w-sm mt-10 mb-5">Our maintenance management web application simplifies maintenance
                    processes,
                    allowing
                    you to track schedules, assign work orders, and generate reports with ease. Gain insights to optimize
                    processes and improve asset performance.</p>
                <a href="/login">
                    <button class="btn btn-primary w-full">Login</button>
                </a>
                {{-- <button class="btn btn-primary w-full">Dashboard</button>
                <button class="btn btn-error w-full mt-2">Logout</button> --}}
            </div>
        </div>
    </div>
@endsection
