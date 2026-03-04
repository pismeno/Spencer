import api from './bootstrap';

addEventListener("DOMContentLoaded", () => {
    showGroups(true);
});

async function showGroups(isMainPage: boolean) {
    try {
        await api.get('/sanctum/csrf-cookie');
        const response: any = await api.get('/api/groups', {});
        const groupsContainer = document.getElementById("container-groups") as HTMLDivElement;
        const userIconPath = groupsContainer?.getAttribute('data-url') || "";

        if (response.data && groupsContainer) {
            let html = "";
            let data = response.data.data;

            if (isMainPage && response.data.length > 5) {
                data = data.slice(0, 5);
            }
            console.log(data);
            for (let index = 0; index < data.length; index++) {
                html += `
                <div class="col-12 mb-3">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-header bg-white border-0 py-3 px-3">
                            <h5 class="mb-0 text-dark fw-bold text-truncate">${data[index].name}</h5>
                        </div>
                        <div class="text-muted mt-1 px-3">
                            <p class="text-truncate" style="max-height: 50px;">${data[index].description || 'Bez popisu'}</p>
                        </div>
                        <div class="card-footer bg-white border-0 py-3 px-3 mt-auto">
                            <div class="d-flex align-items-center gap-2 text-muted small">
                                <img src="${userIconPath}" alt="users" class="h-auto w-auto opacity-75" style="width:16px;">
                                <span>Skupina</span>
                            </div>
                        </div>
                    </div>
                </div>`;
            };

            groupsContainer.innerHTML = html;
        } else if (groupsContainer) {
            groupsContainer.innerHTML = '<p class="text-muted">Žádné skupiny k zobrazení.</p>';
        }
    } catch (error) {
        console.error("Chyba při načítání skupin:", error);
    }
}
