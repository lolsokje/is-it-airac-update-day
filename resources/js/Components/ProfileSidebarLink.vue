<template>
    <InertiaLink :href="anchor">
        <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-blue-600 text-white">
            <span class="text-[15px] ml-4 text-gray-200 font-bold">{{ label }}</span>
        </div>
    </InertiaLink>
</template>

<script lang="ts" setup>
type Props = {
    anchor: string;
    label: string;
}

defineProps<Props>();
</script>
