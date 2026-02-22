import api from './bootstrap';

addEventListener("DOMContentLoaded", () => {
    console.log("JS Settings nabit v pořádku!"); // Pokud toto nevidíš v konzoli, JS se nenačetl

    const firstName = document.getElementById("firstName") as HTMLInputElement;
    const lastName = document.getElementById("lastName") as HTMLInputElement;
    // Hledáme všechny inputy, které mají name "options[]"
    const checkboxes = document.querySelectorAll('input[name="options[]"]');

    if (!firstName || !lastName) {
        console.warn("Chybí ID firstName nebo lastName v HTML!");
    }

    // Funkce pro uložení jmen (Profile)
    const saveProfile = async () => {
        console.log("Ukládám profil...");
        try {
            await api.post('/settings/profile', {
                first_name: firstName.value,
                last_name: lastName.value
            });
            console.log("Profil uložen!");
        } catch (e) {
            console.error("Chyba při ukládání profilu", e);
        }
    };

    // Eventy pro textová pole (uloží se při opuštění pole)
    firstName?.addEventListener("change", saveProfile);
    lastName?.addEventListener("change", saveProfile);

    // Eventy pro checkboxy (uloží se hned při kliknutí)
    checkboxes.forEach(cb => {
        cb.addEventListener("change", async () => {
            console.log("Měním nastavení...");
            const checked = document.querySelectorAll('input[name="options[]"]:checked');
            const ids = Array.from(checked).map(i => (i as HTMLInputElement).value);

            try {
                await api.post('/settings/options', { options: ids });
                console.log("Nastavení synchronizováno!");
            } catch (e) {
                console.error("Chyba nastavení", e);
            }
        });
    });
});
