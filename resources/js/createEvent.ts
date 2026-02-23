import api from './bootstrap';
import ErrorHandlingForm from './errorHandling';
const title = document.getElementById("input-title") as HTMLInputElement;
const description = document.getElementById("input-description") as HTMLTextAreaElement;
const deadline = document.getElementById("input-deadline") as HTMLInputElement;
const from = document.getElementById("input-from") as HTMLInputElement;
const to = document.getElementById("input-to") as HTMLInputElement;
const img = document.getElementById("event-image-upload") as HTMLInputElement;
const submitBtn = document.getElementById("save-changes") as HTMLButtonElement;
const groupID = document.getElementById("group-hidden") as HTMLInputElement;
console.log(img);

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


