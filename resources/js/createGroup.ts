import api from '@/bootstrap';
import type { User } from '@/models';

let timeout: ReturnType<typeof setTimeout>;
let selectedUserIds: number[] = [];
let currentGroupId: string | null = null;

const modalList = document.getElementById('userBulletList');
const addedMembersContainer = document.getElementById('addedMembers') as HTMLDivElement | null;
const titleInput = document.getElementById('titleInput') as HTMLInputElement | null;
const saveBtn = document.getElementById('saveGroup') as HTMLButtonElement | null;
const searchInput = document.getElementById("searchInput") as HTMLInputElement | null;
const descriptionInput = document.getElementById("descriptionInput") as HTMLTextAreaElement | null;
const errorHandler = document.getElementById("errorHandler") as HTMLDivElement | null;
const groupModal = document.getElementById('groupModal');

const resetModal = () => {
    currentGroupId = null;
    selectedUserIds = [];
    if (titleInput) {
        titleInput.value = '';
        titleInput.disabled = false;
    }
    if (descriptionInput) {
        descriptionInput.value = '';
        descriptionInput.disabled = false;
    }
    if (addedMembersContainer) addedMembersContainer.innerHTML = '';
    if (modalList) modalList.innerHTML = '';
    if (errorHandler) errorHandler.innerHTML = '';
    if (saveBtn) {
        saveBtn.innerText = "Save Group";
        saveBtn.disabled = false;
        saveBtn.classList.remove('d-none');
    }
    if (searchInput) {
        searchInput.value = '';
        searchInput.parentElement?.classList.remove('d-none');
    }
};

groupModal?.addEventListener('show.bs.modal', (event: any) => {
    const button = event.relatedTarget;
    resetModal();

    if (button.classList.contains('group-card')) {
        currentGroupId = button.getAttribute('data-id');
        const isCreator = button.getAttribute('data-is-creator') === 'true';

        if (titleInput) titleInput.value = button.getAttribute('data-name') || '';
        if (descriptionInput) descriptionInput.value = button.getAttribute('data-description') || '';
        const membersData = JSON.parse(button.getAttribute('data-members') || '[]');
        membersData.forEach((user: User) => {
            addMemberToGroup(user, isCreator);
        });

        if (!isCreator) {
            titleInput?.setAttribute('disabled', 'true');
            descriptionInput?.setAttribute('disabled', 'true');
            saveBtn?.classList.add('d-none');
            searchInput?.parentElement?.classList.add('d-none');
        } else {
            if (saveBtn) saveBtn.innerText = "Update Group";
        }
    }
});

const addMemberToGroup = (user: User, canDelete: boolean = true) => {
    if (!addedMembersContainer) return;
    if (selectedUserIds.includes(user.id)) return;

    selectedUserIds.push(user.id);

    const card = document.createElement('div');
    card.className = "card border border-light-subtle rounded-pill px-3 py-2 mb-1 w-100";
    card.innerHTML = `
        <div class="d-flex align-items-center">
            <div class="rounded-circle overflow-hidden border border-secondary-subtle me-2">
                <img src="https://ui-avatars.com/api/?name=${user.email}&background=198754&color=fff" class="w-100 profile-pic" alt="acc">
            </div>
            <div class="small flex-grow-1">
                <span class="fw-bold text-success me-1">Member</span>
                <span class="text-muted d-none d-sm-inline">${user.email}</span>
            </div>
            ${canDelete ? '<div class="remove-user-btn text-danger small fw-bold px-1" role="button">✕</div>' : ''}
        </div>`;

    if (canDelete) {
        card.querySelector('.remove-user-btn')?.addEventListener('click', () => {
            selectedUserIds = selectedUserIds.filter(id => id !== user.id);
            card.remove();
        });
    }

    addedMembersContainer.appendChild(card);
    if (modalList) modalList.innerHTML = '';
    if (searchInput) searchInput.value = '';
};

const createUserCard = (user: User) => {
    const email = user.email ?? '';
    const card = document.createElement('div');
    card.className = "card border border-light-subtle rounded-pill px-3 py-2 w-100";
    card.innerHTML = `
        <div class="d-flex align-items-center">
            <div class="rounded-circle overflow-hidden border border-secondary-subtle me-2">
                <img src="https://ui-avatars.com/api/?name=${email}&background=E9ECEF&color=6C757D" class="w-100 profile-pic" alt="acc">
            </div>
            <div class="small flex-grow-1">
                <span class="text-muted"><strong>${email}</strong></span>
            </div>
            <div class="add-user-btn fw-bold text-primary px-2" role="button">+</div>
        </div>`;
    card.querySelector('.add-user-btn')?.addEventListener('click', () => {
        addMemberToGroup(user);
        card.remove();
    });
    return card;
};

const searchAndLog = async (search: string) => {
    try {
        const response = await api.post('/listusers', { email: search });
        const users: User[] = response.data;
        if (!modalList) return;
        modalList.innerHTML = '';
        const filteredUsers = users.filter(u => !selectedUserIds.includes(u.id));
        if (filteredUsers.length === 0) return;
        const container = document.createElement('div');
        container.className = "d-flex flex-column gap-2 w-100";
        filteredUsers.forEach(user => container.appendChild(createUserCard(user)));
        modalList.appendChild(container);
    } catch (error) {
        console.error(error);
    }
};

searchInput?.addEventListener("input", (e) => {
    const val = (e.target as HTMLInputElement).value;
    clearTimeout(timeout);
    timeout = setTimeout(() => {
        if (val.length > 0) searchAndLog(val);
        else if (modalList) modalList.innerHTML = '';
    }, 300);
});

saveBtn?.addEventListener("click", async () => {
    if (!errorHandler || !titleInput) return;
    const titleValue = titleInput.value.trim();
    if (!titleValue) {
        errorHandler.innerHTML = "Title is required";
        return;
    }

    const data = {
        name: titleValue,
        description: descriptionInput?.value.trim() || '',
        users_ids: selectedUserIds
    };

    try {
        saveBtn.disabled = true;
        saveBtn.innerText = "Saving...";
        const url = currentGroupId ? `/group/edit/${currentGroupId}` : '/group/create';
        await api.post(url, data);
        window.location.reload();
    } catch (error: any) {
        saveBtn.disabled = false;
        saveBtn.innerText = currentGroupId ? "Update Group" : "Save Group";
        if (error.response?.data?.errors) {
            errorHandler.innerHTML = Object.values(error.response.data.errors).flat().join('<br>');
        } else {
            errorHandler.innerHTML = "Error saving group.";
        }
    }
});
