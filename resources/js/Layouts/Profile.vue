<template>
    <div class="text-white px-4 0 fixed top-0 bottom-0 left-0 p-2 w-[300px] text-center border-r-gray-600 border-r-[1px]">
        <h1 class="text-2xl mt-4">Available connections</h1>
        <ProfileSidebarLink anchor="discord" label="Discord"/>
    </div>

    <div class="ms-[300px] px-16 text-white max-w-4xl">
        <slot/>
    </div>
</template>

<script setup lang="ts">
import ProfileSidebarLink from "@/Components/ProfileSidebarLink.vue";
</script>
