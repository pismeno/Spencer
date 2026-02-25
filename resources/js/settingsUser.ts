import api from './bootstrap';

addEventListener("DOMContentLoaded", () => {
    const firstName = document.getElementById("firstName") as HTMLInputElement;
    const lastName = document.getElementById("lastName") as HTMLInputElement;
    const checkboxes = document.querySelectorAll('input[name^="options["]');

    const saveProfile = async () => {
        try {
            await api.post('/settings/profile', {
                first_name: firstName.value,
                last_name: lastName.value
            });
        } catch (e) {
            console.error(e);
        }
    };

    firstName?.addEventListener("change", saveProfile);
    lastName?.addEventListener("change", saveProfile);

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
});
