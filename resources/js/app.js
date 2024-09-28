import './bootstrap';
import 'flowbite';
import axios from 'axios';
import Alpine from 'alpinejs';
import user from './user';
import school  from './school';
import confirm from './confirm';


window.Alpine = Alpine;
Alpine.data('user', user);
Alpine.data('school', school);
Alpine.data('confirm', confirm);
Alpine.start();
