import api from './bootstrap';
const title = document.getElementById("input-title") as HTMLInputElement;
const description = document.getElementById("input-description") as HTMLTextAreaElement;
const deadline = document.getElementById("input-deadline") as HTMLInputElement;
const from = document.getElementById("input-from") as HTMLInputElement;
const to = document.getElementById("input-to") as HTMLInputElement;
const img = document.getElementById("input-img") as HTMLInputElement;
const submitBtn = document.getElementById("save-changes") as HTMLButtonElement;




submitBtn.addEventListener("click", async (e)=>{
    e.preventDefault();
    if (!title?.value.trim()) {
        console.error("title je povinny");
        title?.focus();
        return;
    }
    if (!deadline?.value) {
        console.error("deadline je povinny");
        deadline?.focus();
        return;
    }
    if (!from?.value) {
        console.error("Event musí někdy začít");
        from?.focus();
        return;
    }
    if (!to?.value) {
        console.error("Event musi nekdy koncit");
        to?.focus();
        return;
    }
    const formData = new FormData();
    formData.append("title", title.value.trim());
    formData.append("description",description.value.trim());
    formData.append("deadline", deadline.value);
    formData.append("from", from.value);
    formData.append("to", to.value);
    if (img.files && img.files?.[0]) {
        formData.append("img", img.files?.[0])
    }
    try{
        submitBtn.disabled=true;
        const response = await api.post("/create", formData);
        window.location.href="/";
    }catch (error:unknown){
        console.error("Error: "+error);
        submitBtn.disabled=false;
    }
})


