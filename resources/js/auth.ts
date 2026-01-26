import api from '@/bootstrap';

const registerForm = document.getElementById("register") as HTMLFormElement;
const emailInput = document.getElementById("email") as HTMLInputElement;
const passwordInput = document.getElementById("password") as HTMLInputElement;
const passwordRepeat = document.getElementById("password_repeat") as HTMLInputElement;
const submitBtn = document.getElementById("submit-btn") as HTMLButtonElement;
const reqLength = document.getElementById("req-length");
const reqUpper = document.getElementById("req-upper");
const reqNumber = document.getElementById("req-number");
const reqMatch = document.getElementById("req-match");

const validateForm = () => {
    const pass = passwordInput.value;
    const repeat = passwordRepeat.value;

    const hasLength = pass.length >= 8;
    const hasUpper = /[A-Z]/.test(pass);
    const hasNumber = /[0-9]/.test(pass);
    const matches = pass === repeat && pass.length > 0;

    updateStatus(reqLength, hasLength);
    updateStatus(reqUpper, hasUpper);
    updateStatus(reqNumber, hasNumber);
    updateStatus(reqMatch, matches);

    const isFormValid = hasLength && hasUpper && hasNumber && matches;

    if (submitBtn) {
        submitBtn.disabled = !isFormValid;
        if (isFormValid) {
            submitBtn.classList.remove("btn-secondary");
            submitBtn.classList.add("btn-primary");
        } else {
            submitBtn.classList.remove("btn-primary");
            submitBtn.classList.add("btn-secondary");
        }
    }
};

function updateStatus(el: HTMLElement | null, isValid: boolean) {
    if (el) {
        el.classList.toggle("text-success", isValid);
        el.classList.toggle("text-danger", !isValid);
    }
}

passwordInput?.addEventListener("input", validateForm);
passwordRepeat?.addEventListener("input", validateForm);

registerForm?.addEventListener("submit", async (e) => {
    e.preventDefault();

    try {
        await api.post("/register", {
            email: emailInput.value,
            password: passwordInput.value,
            password_confirmation: passwordRepeat.value
        });

        window.location.href = "/";

    } catch (error: any) {
        if (error.response && error.response.status === 422) {
            alert("Validation failed. Maybe the email is already taken?");
        } else {
            console.error("Error:", error);
        }
    }
});
