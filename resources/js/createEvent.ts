import api from './bootstrap';
import ErrorHandlingForm from './errorHandling';
import type { User } from './models';
const title = document.getElementById("input-title") as HTMLInputElement;
const description = document.getElementById("input-description") as HTMLTextAreaElement;
const deadline = document.getElementById("input-deadline") as HTMLInputElement;
const from = document.getElementById("input-from") as HTMLInputElement;
const to = document.getElementById("input-to") as HTMLInputElement;
const img = document.getElementById("event-image-upload") as HTMLInputElement;
const submitBtn = document.getElementById("save-changes") as HTMLButtonElement;
const groupID = document.getElementById("group-hidden") as HTMLInputElement;
const addedMembersContainer = document.getElementById('addedMembers') as HTMLDivElement | null;
const searchInput = document.getElementById("searchInput") as HTMLInputElement | null;


let timeout: ReturnType<typeof setTimeout>;
let selectedUserIds: number[] = [];


submitBtn.addEventListener("click", async (e)=>{
    e.preventDefault();
    if (!title?.value.trim()) {
        ErrorHandlingForm(title, "titleErrorBlock", "title je povinny");
        title?.focus();
        return;
    }
    if (!deadline?.value) {
        ErrorHandlingForm(deadline, "deadlineErrorBlock", "deadline je povinny");
        deadline?.focus();
        return;
    }
    if (!from?.value) {
        ErrorHandlingForm(from, "fromErrorBlock", "Event musí někdy začít");
        from?.focus();
        return;
    }
    if (!to?.value) {
        ErrorHandlingForm(to, "toErrorBlock", "Event musi nekdy koncit");        
        to?.focus();
        return;
    }
    const formData = new FormData();
    formData.append("title", title.value.trim());
    formData.append("description",description.value.trim());
    formData.append("deadline", deadline.value);
    formData.append("from", from.value);
    formData.append("to", to.value);
    // temporary
    formData.append("group_id", groupID.value);
    // temporary-end
    if (img.files && img.files?.[0]) {
        formData.append("img", img.files?.[0])
    }
    try{
        submitBtn.disabled=true;
        const response = await api.post("/event/create", formData);
        window.location.href="/";
    }catch (error:unknown){
        console.error("Error: "+error);
        submitBtn.disabled=false;
    }
})
const modalList = document.getElementById('userBulletList');

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
            <div class="small">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown button</button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                    </ul>
                </div>
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

searchInput?.addEventListener("input", (e) => {
    const val = (e.target as HTMLInputElement).value;
    clearTimeout(timeout);
    timeout = setTimeout(() => {
        if (val.length > 0) searchAndLog(val);
        else if (modalList) modalList.innerHTML = '';
    }, 300);
});

