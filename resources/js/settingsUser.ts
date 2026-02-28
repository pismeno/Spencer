import api from './bootstrap';

addEventListener("DOMContentLoaded", () => {
    const firstName = document.getElementById("firstName") as HTMLInputElement;
    const lastName = document.getElementById("lastName") as HTMLInputElement;
    const checkboxes = document.querySelectorAll('input[name^="options["]');
    const editFirstBtn = document.getElementById("editFirstName");
    const editLastBtn = document.getElementById("editLastName");
    const saveSuccess = document.getElementById("saveSuccess");
    const profilePicContainer = document.getElementById("profilePicContainer");
    const profilePicInput = document.getElementById("profilePicInput") as HTMLInputElement;
    const avatarDisplay = document.getElementById("avatarDisplay") as HTMLImageElement;

    const saveProfile = async () => {
        const formData = new FormData();
        formData.append('first_name', firstName.value);
        formData.append('last_name', lastName.value);

        if (profilePicInput.files?.[0]) {
            formData.append('profile_picture', profilePicInput.files[0]);
        }

        try {
            const response = await api.post('/settings/profile', formData, {
                headers: { 'Content-Type': 'multipart/form-data' }
            });

            if (response.data.path && avatarDisplay) {
                avatarDisplay.src = `/storage/${response.data.path}?t=${new Date().getTime()}`;
            }

            saveSuccess?.classList.remove("d-none");
            setTimeout(() => saveSuccess?.classList.add("d-none"), 2000);
        } catch (e) {
            console.error(e);
        }
    };

    editFirstBtn?.addEventListener("click", () => firstName.focus());
    editLastBtn?.addEventListener("click", () => lastName.focus());
    firstName?.addEventListener("change", saveProfile);
    lastName?.addEventListener("change", saveProfile);
    profilePicContainer?.addEventListener("click", () => profilePicInput.click());
    profilePicInput?.addEventListener("change", () => {
        if (profilePicInput.files && profilePicInput.files[0]) {
            const reader = new FileReader();
            reader.onload = (e) => {
                if (avatarDisplay) avatarDisplay.src = e.target?.result as string;
            };
            reader.readAsDataURL(profilePicInput.files[0]);
            saveProfile();
        }
    });

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener("change", async () => {
            let selectedIds: string[] = [];
            const checkedBoxes = document.querySelectorAll('input[name^="options["]:checked');
            checkedBoxes.forEach(checkedBox => {
                selectedIds.push((checkedBox as HTMLInputElement).value);
            });

            try {
                await api.post('/settings/options', {
                    options: selectedIds
                });
                window.location.reload();
            } catch (e) {
                console.error("Chyba při ukládání nastavení:", e);
            }
        });
    });

    const openDeleteDialog = document.getElementById("openDeleteDialog");
    const deleteMenu = document.getElementById("deleteMenu") as HTMLElement;
    const cancelDelete = document.getElementById("cancelDelete");
    const submitDelete = deleteMenu?.querySelector('button[type="submit"]') as HTMLButtonElement;
    let interval: number;

    openDeleteDialog?.addEventListener("click", (e) => {
        e.preventDefault();
        deleteMenu.classList.remove("d-none");

        let count = 10;
        submitDelete.disabled = true;
        submitDelete.innerText = `Wait ${count}s`;

        interval = window.setInterval(() => {
            count--;
            submitDelete.innerText = `Wait ${count}s`;
            if (count <= 0) {
                clearInterval(interval);
                submitDelete.disabled = false;
                submitDelete.innerText = "Delete account";
            }
        }, 1000);
    });

    const closeDelete = () => {
        deleteMenu.classList.add("d-none");
        clearInterval(interval);
    };

    cancelDelete?.addEventListener("click", closeDelete);

    deleteMenu?.addEventListener("click", (e) => {
        if (e.target === deleteMenu) closeDelete();
    });
});
