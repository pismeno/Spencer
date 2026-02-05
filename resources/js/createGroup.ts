import api from '@/bootstrap';
import type { User } from '@/models';

let timeout: ReturnType<typeof setTimeout>;

const searchAndLog = async (email: string) => {
    try {
        const response = await api.post('/listusers', { email });
        const users: User[] = response.data;
        console.log(!users || users.length === 0 ? "No one matches" : users[0]?.email);
    } catch (e) {
        console.log("Chyba při komunikaci:", e);
    }
};

const searchInput = document.getElementById("searchInput") as HTMLInputElement | null;
if (searchInput) {
    searchInput.addEventListener("input", (e) => {
        const value = (e.target as HTMLInputElement).value;
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            if (value.length >= 2 || value.length === 0) {
                searchAndLog(value);
            }
        }, 300);
    });
}
