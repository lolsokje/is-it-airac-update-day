<template>
<span class="uppercase text-xs font-bold px-4 py-2 rounded-full" :class="{ 'bg-green-600': connected, 'bg-red-600': !connected }">
    {{ connected ? 'account connected' : 'account not connected' }}
</span>
</template>

<script lang="ts" setup>
type Props = {
    connected: boolean;
}

defineProps<Props>();
</script>
