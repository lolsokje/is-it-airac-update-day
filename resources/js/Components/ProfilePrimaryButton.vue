<template>
    <button class="uppercase text-sm font-bold py-2 px-4 bg-blue-600 rounded-lg">{{ label }}</button>
</template>

<script lang="ts" setup>
type Props = {
    label: string;
}

defineProps<Props>();
</script>
