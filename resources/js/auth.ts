import api from './bootstrap';

document.addEventListener("DOMContentLoaded", () => {
    const registerForm = document.getElementById("register") as HTMLFormElement;
    const loginForm = document.getElementById("login-form") as HTMLFormElement;
    const emailInput = document.getElementById("email") as HTMLInputElement;
    const passwordInput = document.getElementById("password") as HTMLInputElement;

    function updateStatus(elId: string, isValid: boolean) {
        const el = document.getElementById(elId);
        if (el) {
            el.classList.toggle("text-success", isValid);
            el.classList.toggle("text-danger", !isValid);
        }
    }

    if (registerForm) {
        const passwordRepeat = document.getElementById("password_repeat") as HTMLInputElement;
        const submitBtn = document.getElementById("submit-btn") as HTMLButtonElement;

        const validateRegister = () => {
            const pass = passwordInput.value;
            const repeat = passwordRepeat.value;

            const checks = {
                length: pass.length >= 8,
                upper: /[A-Z]/.test(pass),
                number: /[0-9]/.test(pass),
                match: pass === repeat && pass.length > 0
            };

            updateStatus("req-length", checks.length);
            updateStatus("req-upper", checks.upper);
            updateStatus("req-number", checks.number);
            updateStatus("req-match", checks.match);

            const isValid = Object.values(checks).every(Boolean);
            submitBtn.disabled = !isValid;
            submitBtn.classList.toggle("btn-primary", isValid);
            submitBtn.classList.toggle("btn-secondary", !isValid);
        };

        passwordInput.addEventListener("input", validateRegister);
        passwordRepeat.addEventListener("input", validateRegister);

        registerForm.addEventListener("submit", async (e) => {
            e.preventDefault();
            try {
                await api.post("/register", {
                    email: emailInput.value,
                    password: passwordInput.value,
                    password_confirmation: passwordRepeat.value
                });
                window.location.href = "/";
            } catch (error) {
                alert("Registrace selhala.");
            }
        });
    }

    if (loginForm) {
        const errorLogger = document.getElementById("errorlogger");
        const submitBtn = loginForm.querySelector('button[type="submit"]') as HTMLButtonElement;

        const validateLogin = () => {
            const isEmailValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value);
            const isPasswordFilled = passwordInput.value.length > 0;
            const isValid = isEmailValid && isPasswordFilled;

            submitBtn.disabled = !isValid;
            submitBtn.classList.toggle("btn-primary", isValid);
            submitBtn.classList.toggle("btn-secondary", !isValid);
        };

        emailInput.addEventListener("input", validateLogin);
        passwordInput.addEventListener("input", validateLogin);

        loginForm.addEventListener("submit", async (e) => {
            e.preventDefault();
            if (errorLogger) errorLogger.innerText = "";
            try {
                await api.post("/login", {
                    email: emailInput.value,
                    password: passwordInput.value
                });
                window.location.href = "/dashboard";
            } catch (error: any) {
                if (errorLogger) errorLogger.innerText = "No account matches these info";
            }
        });
    }
});
