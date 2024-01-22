import './bootstrap';

import Alpine from 'alpinejs';
import Clipboard from "@ryangjchandler/alpine-clipboard";
import htmx from 'htmx.org';
import 'charts.css';

window.Alpine = Alpine;
window.htmx = htmx;

Alpine.plugin(Clipboard);
window.Alpine = Alpine;
Alpine.start();
