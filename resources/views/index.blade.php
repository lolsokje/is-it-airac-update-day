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
<body class="h-screen bg-[#091227] text-white text-2xl">
    <div class="h-full w-full flex justify-center items-center">
        <div class="max-w-5xl text-center">
            <h2 class="text-5xl">Is it AIRAC update day?</h2>

            <h1 class="text-8xl my-20 font-black {{ $releasesToday ? 'text-[#0A9115]' : 'text-[#EE2D3B]' }}">
                {{ $releasesToday ? 'YES' : 'NO' }}
            </h1>

            <p>
                @if ($releasesToday)
                    The new
                @else
                    Current
                @endif cycle is <span class="font-black">{{ $current->ident }}</span>
            </p>

            <p class="mt-2">
                @if ($releasesToday)
                    @if ($hasBeenReleased)
                        This cycle should <span class="font-bold">now</span> be available
                    @else
                        This cycle should be available <span class="font-bold">today</span>
                        at around
                        <span class="font-bold">0900Z</span>
                    @endif
                @else
                    Cycle
                    <span class="font-black">{{ $next->ident }}</span>
                    will be available on
                    <span class="font-bold">{{ $next->starts_at->format('F jS, Y') }}</span>
                    at around
                    <span class="font-bold">0900Z</span>
                @endif
            </p>

            <p class="mt-40">
                Want to receive updates when a new cycles become available?<br>
                Leave your email address and we'll let you know!
            </p>

            <div class="w-2/3 text-center mx-auto mt-8">
                <input type="text"
                       placeholder="Enter your email here"
                       class="block w-full p-4 rounded-md mb-4 text-base uppercase text-center"
                >
                <button class="w-full py-3 uppercase text-base tracking-widest bg-[#3C72FF] rounded-md">signup</button>
            </div>
        </div>
    </div>
</body>
</html>
