import './bootstrap';
import Alpine from 'alpinejs';
import Precognition from 'laravel-precognition-alpine';
import registerForms from './forms';

window.Alpine = Alpine;
Alpine.plugin(Precognition);

registerForms(Alpine);

Alpine.start();