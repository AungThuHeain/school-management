import './bootstrap';
import 'flowbite';
import axios from 'axios';
import Alpine from 'alpinejs';
import user from './user';
import school  from './school';
import confirm from './confirm';
import classroom  from './classroom';
import teacher from './teacher';


window.Alpine = Alpine;
Alpine.data('user', user);
Alpine.data('school', school);
Alpine.data('confirm', confirm);
Alpine.data('classroom', classroom);
Alpine.data('teacher',teacher);
Alpine.start();
