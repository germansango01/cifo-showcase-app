/**
 * resources/js/admin.js — Admin panel entry point
 *
 * Stack: Alpine.js + laravel-precognition-alpine
 */

import './bootstrap';
import Alpine from 'alpinejs';
import Precognition from 'laravel-precognition-alpine';
import registerForms from './admin/forms';

window.Alpine = Alpine;
Alpine.plugin(Precognition);

registerForms(Alpine);

Alpine.start();
