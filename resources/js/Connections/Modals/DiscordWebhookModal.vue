<template>
    <Modal :show="show" @closeModal="emits('closeModal')">
        <div class="p-8">
            <h1 class="text-3xl">Add Discord webhook</h1>

            <form class="mt-4" @submit.prevent="save">
                <div class="mb-4">
                    <label for="webhook_url" class="block mb-2">Webhook URL</label>
                    <input type="text"
                           id="webhook_url"
                           class="outline outline-[1px] bg-slate-800 outline-slate-500 w-full rounded-md p-2"
                           v-model="discordWebhookForm.webhook_url" required
                    >
                    <span v-if="discordWebhookForm.errors.webhook_url" class="text-red-500">{{ discordWebhookForm.errors.webhook_url }}</span>
                </div>

                <div>
                    <label for="name" class="block mb-2">Webhook name</label>
                    <input type="text"
                           id="name"
                           class="outline outline-[1px] bg-slate-800 outline-slate-500 w-full rounded-md p-2"
                           v-model="discordWebhookForm.name" required
                    >
                    <span v-if="discordWebhookForm.errors.name" class="text-red-500">{{ discordWebhookForm.errors.name }}</span>
                </div>

                <div v-if="webhook" class="mt-4 flex">
                    <input type="checkbox" id="enabled" v-model="discordWebhookForm.enabled">
                    <label for="enabled" class="ms-2">Enabled</label>
                </div>
            </form>
        </div>

        <div class="bg-slate-900">
            <div class="px-8 py-4 flex justify-end">
                <button
                    class="uppercase text-sm font-bold border-[1px] border-white px-4 py-2 rounded-md hover:bg-white hover:text-black transition-colors ease-linear duration-150 me-2"
                    @click.prevent="cancel"
                    :disabled="discordWebhookForm.processing"
                >
                    cancel
                </button>
                <button class="uppercase text-sm font-bold bg-green-600 px-4 py-2 rounded-md hover:bg-green-700 transition-colors ease-in-out duration-150"
                        @click.prevent="save"
                        :disabled="discordWebhookForm.processing"
                >
                    save
                </button>
            </div>
        </div>
    </Modal>
</template>

<script lang="ts" setup>
import { useForm } from "@inertiajs/vue3";
import { DiscordWebhook } from "@/types";
import { watch } from "vue";
import Modal from "@/Components/Modal.vue";

type Props = {
    show: boolean,
    webhook: DiscordWebhook | null,
};

const props = defineProps<Props>();

const emits = defineEmits(['closeModal']);

type Form = {
    webhook_url: string,
    name: string,
    enabled: boolean,
}

const discordWebhookForm = useForm<Form>({
    webhook_url: '',
    name: '',
    enabled: false,
});

const hideModal = (): void => {
    emits('closeModal');
}

const cancel = (): void => {
    hideModal();

    discordWebhookForm.reset();
}

const save = (): void => {
    if (props.webhook) {
        discordWebhookForm.put(route('profile.discord.webhooks.update', { webhook: props.webhook.id }), {
            preserveState: 'errors',
        });
    } else {
        discordWebhookForm.post(route('profile.discord.webhooks.store'), {
            preserveState: 'errors',
        });
    }
}

watch(() => props.webhook, (newWebhook) => {
    discordWebhookForm.webhook_url = newWebhook?.webhook_url ?? '';
    discordWebhookForm.name = newWebhook?.name ?? '';
    discordWebhookForm.enabled = newWebhook?.enabled ?? false;
});
</script>
