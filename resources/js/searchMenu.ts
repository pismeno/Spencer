import api from './bootstrap';

document.addEventListener('DOMContentLoaded', (event: Event) => {
    const searchInput = document.getElementById("searchUserGroup") as HTMLInputElement | null;
    const searchResult = document.getElementById("searchResult") as HTMLElement | null;

    if (!searchInput || !searchResult) return;

    const performSearch = async (query: string) => {
        if (query.length < 1) {
            searchResult.innerHTML = '';
            return;
        }

        try {
            const responseUser = await api.post("/listusers", { email: query });
            const users = responseUser.data;

            const responseGroups = await api.post("/listgroups", { title: query });
            const groups = responseGroups.data;

            const responseEvents = await api.post("/listevents", { title: query });
            const events = responseEvents.data;

            searchResult.innerHTML = "";

            searchResult.innerHTML += "<div class='fw-bold'>Users</div><br>";
            users.forEach((user: any) => {
                searchResult.innerHTML += `
                    <div class="d-flex align-items-center gap-2 mb-2 p-1">
                        <div class="rounded-circle overflow-hidden border border-secondary-subtle profile-pic">
                            <img src="https://ui-avatars.com/api/?name=${user.email}&background=198754&color=fff" class="w-100 h-100"style=" object-fit: cover;" alt="acc">
                        </div>
                        <div class="fw-medium">${user["email"]}</div>
                    </div>
                `;
            });
            searchResult.innerHTML += "<div class='fw-bold'>Groups</div><br>";
            groups.forEach((group: any) => {
                searchResult.innerHTML += "<div>" + group["name"] + "</div><br>";
            });
            searchResult.innerHTML += "<div class='fw-bold'>Events</div><br>";
            events.forEach((event: any) => {
                searchResult.innerHTML += "<div>" + event["title"] + "</div><br>";
            });

        } catch (error) {
            console.error("Search failed", error);
        }
    };

    searchInput.addEventListener('input', () => {
        const query = searchInput.value;
        performSearch(query);
    });

    document.addEventListener('click', (event: Event) => {
        const target = event.target as HTMLElement;
        if (!searchInput.contains(target) && !searchResult.contains(target)) {
            searchResult.innerHTML = '';
        }
    });
});
