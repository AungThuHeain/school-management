<?php
namespace App\Enums;

enum RoleName:string
{
    case ADMIN= 'Admin';
    case TEACHER = 'Teacher';
    case STUDENT = 'Student';
};
