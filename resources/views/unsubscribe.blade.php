<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=rubik:100,200,300,400,500,600,700,800,900&display=swap"
          rel="stylesheet"/>

    @vite('resources/css/app.css')
</head>
<body class="h-dvh bg-[#091227] text-white text-md lg:text-2xl px-4 lg:px-0">
    <div class="min-h-full w-full flex justify-center items-center">
        <a href="{{ route('index') }}" class="absolute top-4 lg:top-10 text-center text-sm uppercase">&larr; back</a>

        <div class="max-w-5xl text-center">
            <h2 class="text-3xl lg:text-5xl mb-5 lg:mb-10">Unsubscribe</h2>

            <p class="mb-5 lg:mb-10">
                If you no longer wish to be notified of new AIRAC cycles, you can unsubscribe using the form below
            </p>

            <div class="w-full lg:w-2/3 text-center mx-auto mt-8">
                <form action="{{ route('subscription.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="mb-4">
                        <input type="email"
                               name="email"
                               placeholder="Enter your email here"
                               class="block w-full p-4 rounded-md text-base text-center text-gray-500"
                        >

                        @if ($errors)
                            <span class="uppercase text-sm text-[#EE2D3B]">{{ $errors->first() }}</span>
                        @endif
                    </div>

                    <button class="w-full py-3 uppercase text-base tracking-widest bg-[#3C72FF] rounded-md">
                        unsubscribe
                    </button>
                </form>
            </div>
        </div>
    </div>
</html>
