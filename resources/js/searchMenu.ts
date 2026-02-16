import api from './bootstrap';

document.addEventListener('DOMContentLoaded', (event: Event) => {
    const searchInput = document.getElementById("searchUserGroup") as HTMLInputElement | null;
    const searchResult = document.getElementById("searchResult") as HTMLElement | null;
    if (!searchInput || !searchResult) return;
    const performSearch = async (query: string) => {
        if (query.length < 1) {
            if (searchResult) searchResult.innerHTML = '';
            return;
        }

        try {
            const response = await api.post("/listusers", { email: query });
            const users = response.data;
            users.forEach((user :any) => {
                searchResult.innerHTML += "<div>" + user["email"] +"</div><br>";
            })
        } catch (error) {
            throw new Error();
        }
    };

    searchInput.addEventListener('input', () => {
        const query = searchInput.value;
        if (searchResult.innerHTML.length > 0) {
            searchResult.innerHTML = "";
            performSearch(query);
        } else {
            performSearch(query);
        }
    });
});
