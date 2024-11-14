<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-green-500 border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-green-500 dark:bg-gray-800">
       <ul class="space-y-2 font-medium">
          <li>
             <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <i class="ri-pie-chart-2-fill"></i>
                <span class="ms-3">Dashboard</span>
             </a>
          </li>
          <li>
            <a href="{{route('roles.index')}}" class=" {{ Request::routeIs('roles.*') ? 'bg-gray-50' : ''}} flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <i class="ri-shield-keyhole-fill"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">Roles</span>
               <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">{{Spatie\Permission\Models\Role::where('school_id',auth()->user()->school_id)->count()}}</span>

            </a>
         </li>
          <li>
             <a href="{{route('classes.index')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <i class="ri-artboard-fill"></i>
                <span class="flex-1 ms-3 whitespace-nowrap">Class</span>
               <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">{{App\Models\ClassRoom::count()}}</span>

             </a>
          </li>
          <li>
            <a href="{{route('teachers.index')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <i class="ri-presentation-fill"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">Teacher</span>
               <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">{{App\Models\User::Role('Teacher')->count()}}</span>
            </a>
         </li>
          <li>
             <a href="{{route('students.index')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <i class="ri-group-3-fill"></i>
                <span class="flex-1 ms-3 whitespace-nowrap">Student</span>
               <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">{{App\Models\User::Role('Student')->count()}}</span>
             </a>
          </li>
          <li>
            <a href="{{route('schedules.index')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <i class="ri-calendar-schedule-fill"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">Schedule</span>
              <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">{{App\Models\Schedule::count()}}</span>
            </a>
         </li>
         <li>
            <a href="{{route('attendances.index')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <i class="ri-body-scan-fill"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">Attendance</span>

            </a>
         </li>
         <li>
            <a href="{{route('reports')}}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <i class="ri-file-chart-fill"></i>
               <span class="flex-1 ms-3 whitespace-nowrap">Report</span>

            </a>
         </li>
       </ul>
    </div>
 </aside>
