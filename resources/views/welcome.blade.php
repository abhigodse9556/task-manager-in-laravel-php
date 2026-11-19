@extends('layouts.app')

@section('page-css')
@vite(['resources/css/welcome.css'])
@endsection

@section('content')

<div class="container home-container">

    <div class="md:w-[95vw] h-fit">
        <div class="flex flex-col justify-center items-center md:gap-4 text-xl md:text-4xl lg:text-6xl text-white md:w-fit">
            <h1 class="text-gray-700 font-bold">Design your day,</h1>
            <h1 class="text-gray-700 font-bold mb-4">own your time</h1>
            <x-button
                class="button text-sm md:text-lg lg:text-xl"
                onclick="window.location.href='/tasks'">
                Get Started
            </x-button>
        </div>
    </div>



</div>

@endsection