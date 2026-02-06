import api from '@/bootstrap';
import type { User } from '@/models';

let timeout: ReturnType<typeof setTimeout>;
const modal = document.getElementById('userBulletList');

const searchAndLog = async (searchQuery: string) => {
    try {
        const response = await api.post('/listusers', { email: searchQuery });
        const users: User[] = response.data;
        if (!modal) return;
        if (!users || users.length === 0) {
            return(modal.innerHTML = "No one matches");
        }

        let html = '<ul>';
        users.forEach(user => {
            html += `<li>${user.email}</li>`;
        });
        html += '</ul>';
        modal.innerHTML = html;

    } catch (e) {
        if (modal) modal.innerText = "Error while communication with server", e;
    }
};

const searchInput = document.getElementById("searchInput") as HTMLInputElement | null;
if (searchInput) {
    searchInput.addEventListener("input", (event: Event) => {
        const target = event.target as HTMLInputElement;
        const value = target.value;
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            if (value.length >= 2 || value.length === 0) {
                searchAndLog(value);
            }
        }, 300);
    });
} else {
    console.error("Input se nepodařilo najít v HTML!");
}
