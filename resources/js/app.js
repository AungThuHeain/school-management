import './bootstrap';
import 'flowbite';
import axios from 'axios';
import Alpine from 'alpinejs';
import user from './user';
import school  from './school';


window.Alpine = Alpine;
Alpine.data('user', user);
Alpine.data('school', school);
Alpine.start();
