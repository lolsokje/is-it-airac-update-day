<template>
    <div class="bg-black/75 w-full h-full top-0 left-0" :class="{ 'fixed': show, 'hidden': !show }" @click.self="hideModal">
        <div class="relative w-[700px] mt-32 mx-auto bg-slate-800 rounded-md">
            <slot/>
        </div>
    </div>
</template>

<script lang="ts" setup>
type Props = {
    show: boolean,
};

defineProps<Props>();

const emits = defineEmits(['closeModal']);

const hideModal = (): void => {
    emits('closeModal');
}
</script>
