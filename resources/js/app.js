import './bootstrap';
import 'flowbite';
import axios from 'axios';
import Alpine from 'alpinejs';
import 'remixicon/fonts/remixicon.css'
import user from './user';
import school  from './school';
import confirm from './confirm';
import classroom  from './classroom';
import teacher from './teacher';
import student from './student';
import role from './role';
import schedule from './schedule';


window.Alpine = Alpine;
Alpine.data('user', user);
Alpine.data('school', school);
Alpine.data('confirm', confirm);
Alpine.data('classroom', classroom);
Alpine.data('teacher',teacher);
Alpine.data('role',role);
Alpine.data('student',student);
Alpine.data('schedule',schedule);
Alpine.start();
