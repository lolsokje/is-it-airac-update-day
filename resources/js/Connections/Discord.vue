<template>
    <ProfileAccountConnectionStatus :connected="connected"/>

    <div class="mt-4">
        <h2 class="text-3xl">Webhooks</h2>

        <table class="table my-4 w-full" v-if="webhooks.length">
            <thead>
            <tr class="bg-slate-700">
                <th class="py-2 ps-2 text-left">Webhook</th>
                <th></th>
                <th class="pe-2" colspan="2"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="webhook in webhooks" :key="webhook.id" class="border-b-[1px] border-b-gray-600 align-middle">
                <td class="ps-2 py-4 max-w-xl">
                    {{ webhook.name }}
                    <br>
                    <p class="max-w-sm truncate text-slate-400" :title="webhook.webhook_url">{{ webhook.webhook_url }}</p>
                </td>
                <td class="text-center w-28">
                        <span class="px-2 py-1 uppercase font-bold text-xs rounded-full" :class="{ 'bg-green-600': webhook.enabled, 'bg-red-600': !webhook.enabled }">
                            {{ webhook.enabled ? 'enabled' : 'disabled' }}
                        </span>
                </td>
                <td>
                    <PencilSquareIcon class="w-6 cursor-pointer" @click.prevent="edit(webhook)"/>
                </td>
                <td>
                    <TrashIcon class="w-6 text-red-500 cursor-pointer hover:text-red-600" @click.prevent="deleteWebhook(webhook.id)"/>
                </td>
            </tr>
            </tbody>
        </table>
        <template v-else>
            <p class="my-2">You currently haven't configured any webhooks</p>
        </template>

        <ProfilePrimaryButton label="Add webhook" @click.prevent="showModal"/>
    </div>

    <!--    <div class="mt-4">-->
    <!--        <h2 class="text-3xl">Private messages</h2>-->

    <!--        <div>-->
    <!--            <input type="checkbox" id="discord_private_messages">-->
    <!--            <label for="discord_private_messages">Allow private messages</label>-->
    <!--        </div>-->
    <!--    </div>-->

    <DiscordWebhookModal :show="show" @closeModal="hideModal" :webhook="editWebhook"/>
</template>

<script lang="ts" setup>
import ProfileAccountConnectionStatus from "@/Components/ProfileAccountConnectionStatus.vue";
import ProfilePrimaryButton from "@/Components/ProfilePrimaryButton.vue";
import { DiscordWebhook } from "@/types";
import { router } from "@inertiajs/vue3";
import { Ref, ref } from "vue";
import { PencilSquareIcon, TrashIcon } from "@heroicons/vue/16/solid";
import DiscordWebhookModal from "@/Connections/Modals/DiscordWebhookModal.vue";

type Props = {
    connected: boolean;
    webhooks: DiscordWebhook[],
}

defineProps<Props>();

const show = ref(false);
const editWebhook: Ref<DiscordWebhook | null> = ref(null);

const showModal = (): void => {
    show.value = true;
}

const hideModal = (): void => {
    show.value = false;

    editWebhook.value = null;
}

const edit = (webhook: DiscordWebhook): void => {
    editWebhook.value = webhook;

    showModal();
}

const deleteWebhook = (id: number): void => {
    if (!confirm('Are you sure you want to delete this webhook? This cannot be undone')) {
        return;
    }

    router.delete(route('profile.discord.webhooks.destroy', { webhook: id }), {
        preserveState: false,
    });
}
</script>
