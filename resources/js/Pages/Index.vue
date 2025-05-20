<template>
    <div class="min-h-full w-full flex justify-center items-center">
        <div class="max-w-5xl text-center">
            <h2 class="text-3xl lg:text-5xl">Is it AIRAC update day?</h2>

            <h1 class="text-5xl lg:text-8xl my-4 lg:my-20 font-black" :class="{ 'text-[#0A9115]': releasesToday, 'text-[#EE2D3B]': !releasesToday }">
                {{ releasesToday ? 'YES' : 'NO' }}
            </h1>

            <p>
                <template v-if="releasesToday">
                    The new
                </template>
                <template v-else>
                    Current
                </template>
                cycle is <span class="font-black">{{ current.ident }}</span>
            </p>

            <p class="mt-2">
                <template v-if="releasesToday">
                    <template v-if="hasBeenReleased">
                        This cycle should <span class="font-bold">now</span> be available
                    </template>
                    <template v-else>
                        This cycle should be available <span class="font-bold">today</span>
                        at around
                        <span class="font-bold">0900Z</span>
                    </template>
                </template>
                <template v-else>
                    Cycle
                    <span class="font-black">{{ next.ident }}</span>
                    will be available on
                    <span class="font-bold">{{ next.starts_at.formatted }}</span>
                    at around
                    <span class="font-bold">0900Z</span>
                </template>
            </p>

            <p class="mt-10 lg:mt-40">
                Want to receive updates when a new cycles become available?<br>
            </p>

            <p class="mt-2">
                <InertiaLink :href="route('connections.index')" class="hover:underline-offset-8 hover:underline">
                    Sign in using one of the supported services to get started &rarr;
                </InertiaLink>
            </p>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { Cycle } from "@/types";

type Props = {
    releasesToday: boolean;
    hasBeenReleased: boolean;
    current: Cycle;
    next: Cycle;
}

defineProps<Props>();
</script>
