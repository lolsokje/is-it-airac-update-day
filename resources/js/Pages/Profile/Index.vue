<template>
    <ProfileSettingBlock anchor="discord" heading="Discord">
        <Discord :connected="hasConnection('discord')" :webhooks="user.discord_webhooks"/>
    </ProfileSettingBlock>
</template>

<script lang="ts" setup>
import ProfileSettingBlock from "@/Components/ProfileSettingBlock.vue";
import { usePage } from "@inertiajs/vue3";
import { User } from "@/types";
import Discord from "@/Connections/Discord.vue";

const user: User = usePage().props.user as User;

const hasConnection = (connection: string): boolean => {
    return user.connections.find(c => c.provider === connection) !== undefined;
}
</script>
