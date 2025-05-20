<template>
    <div class="min-h-full w-full flex justify-center items-center">
        <InertiaLink :href="route('index')" class="absolute top-4 lg:top-10 text-center text-sm uppercase">&larr; back</InertiaLink>

        <div class="max-w-5xl text-center">
            <h2 class="text-3xl lg:text-5xl mb-8">Sign in using one of the listed services to get started</h2>

            <a :href="route('auth.discord.redirect')" class="bg-[#5865F2] flex py-4 justify-center items-center rounded-lg uppercase font-bold text-base">
                <Discord class="w-12 me-4"/>
                Sign in using Discord
            </a>
        </div>
    </div>
</template>

<script lang="ts" setup>

import Discord from "@/Icons/Discord.vue";
</script>
