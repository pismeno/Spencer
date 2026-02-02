import axios from 'axios';
import {setupImageInput} from "./showImg";

/**
 * A typed Axios instance for the app.
 * - Avoids polluting the global `window` object (better for tree-shaking & typing).
 * - Export `http` for use across your TypeScript modules.
 * - If you need the legacy `window.axios` (for vendor scripts), you can opt-in by setting ATTACH_AXIOS_TO_WINDOW = true.
 */

const http = axios.create({
    headers: { 'X-Requested-With': 'XMLHttpRequest' },
});

// Attach CSRF token if present (Laravel default meta tag)
const token = document.head?.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
if (token) {
    http.defaults.headers.common['X-CSRF-TOKEN'] = token;
}

declare global {
    interface Window {
        axios?: ReturnType<typeof axios.create>;
    }
}
document.addEventListener("DOMContentLoaded", () => {
    setupImageInput();
})
