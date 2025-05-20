<template>
    <div class="mt-4">
        <h1 class="text-4xl" :id="anchor">{{ heading }}</h1>

        <ProfileSettingDetailsWrapper>
            <slot/>
        </ProfileSettingDetailsWrapper>
        <!--        <x-setting-details-wrapper>-->
        <!--            {{ $slot }}-->
        <!--        </x-setting-details-wrapper>-->
    </div>
</template>

<script lang="ts" setup>
import ProfileSettingDetailsWrapper from "@/Components/ProfileSettingDetailsWrapper.vue";

type Props = {
    anchor: string;
    heading: string;
}

defineProps<Props>();
</script>
