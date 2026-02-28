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

    const saveProfile = async () => {
        try {
            await api.post('/settings/profile', {
                first_name: firstName.value,
                last_name: lastName.value
            });
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
        if (profilePicInput.files?.[0]);
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
            } catch (e) {
                console.log(e);
            }
        });
    });

    const openDeleteDialog = document.getElementById("openDeleteDialog");
    const deleteMenu = document.getElementById("deleteMenu") as HTMLElement;
    const cancelDelete = document.getElementById("cancelDelete");
    const submitDelete = deleteMenu?.querySelector('button[type="submit"]') as HTMLButtonElement;
    let interval: number = 10

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
