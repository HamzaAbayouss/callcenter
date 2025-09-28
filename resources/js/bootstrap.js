/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from "axios";
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
import Echo from "laravel-echo";
import Pusher from "pusher-js";
import Swal from "sweetalert2"; // si tu utilises sweetalert2

window.Pusher = Pusher;
Pusher.logToConsole = true;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: "44645a364d82245506b1",
    cluster: "ap1",
    forceTLS: true,
    authEndpoint: "/broadcasting/auth", // nécessaire pour private channels
});

// `userId` doit venir du backend (par ex: window.Laravel.user.id)
const userId = window.Laravel.user.id;

window.Echo.private("App.Models.User." + userId).listen(
    ".ticket.assigned",
    (e) => {
        // Affichage du toast
        Swal.fire({
            toast: true,
            position: "top-end",
            icon: "info",
            showConfirmButton: true,
            // timer: 4000,
            html: `
        <strong>Nouveau ticket :</strong><br>
        <div><strong>Objet :</strong> ${e.objet}</div>
        <div><a href="${e.url}" target="_blank" style="color:#0d6efd;text-decoration:underline;">Voir le ticket</a></div>
    `,
        });
    }
);
