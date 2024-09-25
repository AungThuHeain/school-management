import './bootstrap';
import 'flowbite';
import axios from 'axios';
import Alpine from 'alpinejs';
import user from './user';


window.Alpine = Alpine;
Alpine.data('user', user);
Alpine.start();
