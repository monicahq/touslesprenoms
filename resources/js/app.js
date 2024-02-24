import './bootstrap';
import '../css/app.css';

import Alpine from 'alpinejs';
import Clipboard from "@ryangjchandler/alpine-clipboard";
import htmx from 'htmx.org';

window.Alpine = Alpine;
window.htmx = htmx;

Alpine.plugin(Clipboard);
window.Alpine = Alpine;
Alpine.start();
