import Alpine from "alpinejs";
import Precognition from "laravel-precognition-alpine";

Alpine.plugin(Precognition);

window.Alpine = Alpine;
Alpine.start();