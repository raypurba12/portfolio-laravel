import './bootstrap';

import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';
import { chatbot } from './chatbot';

Alpine.plugin(intersect);

window.Alpine = Alpine;
window.chatbot = chatbot;

Alpine.start();
