export type User = {
    email_address: string;
    connections: Connection[];
    discord_webhooks: DiscordWebhook[]
}

export type Cycle = {
    cycle: number;
    ident: string;
    starts_at: Date;
}

export type Connection = {
    provider: string;
    provider_id: string;
    access_token: string;
    refresh_token: string;
}

export type DiscordWebhook = {
    id: number;
    webhook_url: string;
    name: string;
    enabled: boolean;
}

type Date = {
    formatted: string;
}
