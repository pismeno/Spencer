import api from './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById("searchUserGroup") as HTMLInputElement | null;
    const searchResult = document.getElementById("searchResult") as HTMLElement | null;
    const mobileTrigger = document.getElementById("mobileTrigger") as HTMLElement | null;
    const mobileSearchPopup = document.getElementById("mobileSearchPopup") as HTMLElement | null;
    const mobileInput = document.getElementById("mobileSearchInput") as HTMLInputElement | null;
    const mobileSearchResult = document.getElementById("MobilesearchResult") as HTMLElement | null;

    if (!searchInput || !searchResult) return;

    const performSearch = async (query: string, resultContainer: HTMLElement) => {
        if (query.length < 1) {
            resultContainer.innerHTML = '';
            return;
        }

        try {
            const [resUser, resGroups, resEvents] = await Promise.all([
                api.post("/listusers", { email: query }),
                api.post("/listgroups", { title: query }),
                api.post("/listevents", { title: query })
            ]);

            const users = resUser.data;
            const groups = resGroups.data;
            const events = resEvents.data;

            resultContainer.innerHTML = "";

            if (users.length > 0) {
                resultContainer.innerHTML += `<div class="px-3 py-2 small text-uppercase fw-bold text-muted border-bottom">Uživatelé</div>`;
                users.forEach((user: any) => {
                    const [short, suffix] = user.email.split("@");
                    const fullName = `${user.first_name ?? ''} ${user.last_name ?? ''}`.trim();

                    resultContainer.innerHTML += `
                    <div class="d-flex align-items-center p-3 border-bottom shadow-sm-hover">
                        <div class="w-25">
                            <div class="rounded-circle overflow-hidden border">
                                <img src="https://ui-avatars.com/api/?name=${user.email}&background=198754&color=fff" class="w-100 h-100">
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <div class="d-flex flex-column">
                                <span class="fw-bold text-dark">${short}</span>
                                <span class="text-muted small">@${suffix}</span>
                                ${fullName ? `<span class="text-secondary mt-1">${fullName}</span>` : ''}
                            </div>
                        </div>
                    </div>`;
                });
            }

            if (groups.length > 0 || events.length > 0) {
                resultContainer.innerHTML += `<div class="px-3 py-2 small text-uppercase fw-bold text-muted border-bottom mt-2">Ostatní</div>`;

                groups.forEach((group: any) => {
                    resultContainer.innerHTML += `
                    <div class="d-flex align-items-center p-3 border-bottom shadow-sm-hover">
                        <div class="w-25 rounded-circle overflow-hidden border">
                            <img src="https://ui-avatars.com/api/?name=${group.name}&background=198754&color=fff" class="w-100 h-100">
                        </div>
                        <div class="ms-3">
                            <div class="fw-bold text-dark">${group.name}</div>
                            <div class="text-muted small">Skupina</div>
                        </div>
                    </div>`;
                });

                events.forEach((event: any) => {
                    resultContainer.innerHTML += `
                    <div class="d-flex align-items-center p-3 border-bottom shadow-sm-hover">
                        <div class="w-25 rounded-circle overflow-hidden border">
                            <img src="https://ui-avatars.com/api/?name=${event.title}&background=198754&color=fff" class="w-100 h-100">
                        </div>
                        <div class="ms-3">
                            <div class="fw-bold text-dark">${event.title}</div>
                            <div class="text-muted small">Událost</div>
                        </div>
                    </div>`;
                });
            }
        } catch (e) {
            console.error(e);
        }
    };

    searchInput.addEventListener('input', () => performSearch(searchInput.value, searchResult));
    mobileInput?.addEventListener('input', () => performSearch(mobileInput.value, mobileSearchResult!));

    mobileTrigger?.addEventListener('click', () => {
        mobileSearchPopup?.classList.remove('d-none');
        mobileInput?.focus();
    });

    document.addEventListener('click', (event: Event) => {
        const target = event.target as HTMLElement;
        if (!searchInput.contains(target) && !searchResult.contains(target)) {
            searchResult.innerHTML = '';
        }
        if (mobileSearchPopup && !mobileSearchPopup.contains(target) && !mobileTrigger?.contains(target)) {
            mobileSearchPopup.classList.add('d-none');
        }
    });
});
