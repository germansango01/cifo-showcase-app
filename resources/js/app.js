import Alpine from "alpinejs";
import Precognition from "laravel-precognition-alpine";
import focus from "@alpinejs/focus";

Alpine.plugin(Precognition);
Alpine.plugin(focus);

window.Alpine = Alpine;
Alpine.start();