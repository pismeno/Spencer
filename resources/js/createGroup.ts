import api from '@/bootstrap';
import type { User } from '@/models/User';

const searchUsersByEmail = async (partialEmail: string): Promise<User[]> => {
    try {
        const response = await api.post<User[]>('/listusers', {
            email: partialEmail
        });

        return response.data;
    } catch (error) {
        console.error("Search failed:", error);
        return [];
    }
};

const runSearch = async () => {
    const users = await searchUsersByEmail("d@d");

    if (users.length === 0) {
        console.log("No users found.");
        return;
    }

    for (const user of users) {
        console.log(user.email);
    }
};

runSearch();
