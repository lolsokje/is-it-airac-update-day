@extends('layout.default')

@section('body')
    <div class="relative">
        @if (Session::has('success'))
            <div class="absolute w-full lg:w-1/2 py-4 px-2 lg:px-0 text-center text-sm uppercase font-bold rounded-lg lg:translate-x-1/2 top-5 lg:top-10 bg-green-200 text-green-600">
                {{ Session::get('success') }}
            </div>
        @endif
    </div>

    <div class="min-h-full w-full flex justify-center items-center">
        <div class="max-w-5xl text-center">
            <h2 class="text-3xl lg:text-5xl">Is it AIRAC update day?</h2>

            <h1 class="text-5xl lg:text-8xl my-4 lg:my-20 font-black {{ $releasesToday ? 'text-[#0A9115]' : 'text-[#EE2D3B]' }}">
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

            <p class="mt-10 lg:mt-40">
                Want to receive updates when a new cycles become available?<br>
                Leave your email address and we'll let you know!
            </p>

            <div class="w-full lg:w-2/3 text-center mx-auto mt-8">
                <form action="{{ route('subscription.store') }}" method="POST">
                    @csrf

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
                        subscribe
                    </button>

                    <a href="{{ route('unsubscribe.show') }}" class="text-sm text-white uppercase">
                        already subscribed?
                    </a>
                </form>
            </div>
        </div>
    </div>
@endsection
