import './bootstrap';
import '../css/app.css';

import Alpine from 'alpinejs';
import Clipboard from "@ryangjchandler/alpine-clipboard";
import htmx from 'htmx.org';
import Precognition from 'laravel-precognition-alpine';

window.Alpine = Alpine;
window.htmx = htmx;

Alpine.plugin(Clipboard);
Alpine.plugin(Precognition);
Alpine.start();
