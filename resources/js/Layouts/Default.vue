<template>
    <!--    <div class="relative">-->
    <!--        @if (Session::has('success'))-->
    <!--        <div-->
    <!--            class="absolute w-full lg:w-1/2 py-4 px-2 lg:px-0 text-center text-sm uppercase font-bold rounded-lg lg:translate-x-1/2 top-5 lg:top-10 bg-green-200 text-green-600">-->
    <!--            {{ Session::get('success') }}-->
    <!--        </div>-->
    <!--        @endif-->
    <!--    </div>-->
    <div class="h-dvh bg-[#091227] text-white text-md lg:text-2xl px-4 lg:px-0">
        <slot/>
    </div>
</template>

<script lang="ts" setup>

</script>
