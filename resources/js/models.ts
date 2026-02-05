export interface Models {
    id: number;
    email: string;
    avatar_url: string | null;
    created_at: Date;
    updated_at: Date;
}

export interface Event {
    id: number;
    title: string;
    description: string | null;
    starts_at: Date;
    ends_at: Date;
    deadline: Date | null;
    created_at: Date;
    updated_at: Date;
}

export interface User {
    id: number;
    email: string;
    created_at: Date;
    updated_at: Date;
}

export interface Membership {
    id: number;
    user_id: number;
    event_id: number;
    role_id: number;
    created_at: Date;
    updated_at: Date;
}
