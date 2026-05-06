/**
 * resources/js/admin.js — Admin panel entry point
 *
 * Stack: Alpine.js + laravel-precognition-alpine
 */

import './bootstrap';
import Alpine from 'alpinejs';
import Precognition from 'laravel-precognition-alpine';
import registerForms from './admin/forms';
import mediaUploader from './admin/media-uploader';
import richEditor from './admin/forms/rich-editor';

window.Alpine = Alpine;
Alpine.plugin(Precognition);

registerForms(Alpine);
Alpine.data('mediaUploader', mediaUploader);
Alpine.data('richEditor', richEditor);

Alpine.start();
