
<x-app-layout>
    <div>
        <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700"  >
            <div class="w-full mb-1">
                <div class="mb-4">
                    <nav class="flex mb-5" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                          <li class="inline-flex items-center">
                            <a href="#" class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
                              <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                              Home
                            </a>
                          </li>
                          <li>
                            <div class="flex items-center">
                              <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                              <a href="#" class="ml-1 text-gray-700 hover:text-primary-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">Report</a>
                            </div>
                          </li>
                          <li>
                            <div class="flex items-center">
                              <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                              <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">List</span>
                            </div>
                          </li>
                        </ol>
                    </nav>
                    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Report</h1>
                </div>
                <div class="sm:flex">
                    <div class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700">
                        <form class="lg:pr-3" name="s" method="GET">
                        <label for="users-search" class="sr-only">Search</label>
                        <div class="relative mt-1 lg:w-64 xl:w-96">
                            <input type="text" name="s" value="{{request('s')}}" id="users-search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search for reports">
                        </div>
                        </form>
                    </div>

                    <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                        <form class="max-w-sm mx-auto" action="{{route('reports')}}" name="class_filter" method="GET">
                            <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                                <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                                    <select id="countries" name="year_filter" onchange="if(this.value != 0) this.form.submit()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="all">Filter by Year</option>
                                    @php
                                        $last_years = [];
                                        $current_year = date('Y');
                                        for($i=2020;$i < $current_year ; $current_year --) {
                                            $last_years[] = $current_year;
                                        }
                                    @endphp

                                    @foreach ($last_years as $last_year)
                                        <option value="{{$last_year}}" {{request('year_filter') == $last_year ? 'selected' : ''}}>{{$last_year}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                                        <select id="countries" name="class_filter" onchange="if(this.value != 0) this.form.submit()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="all">Filter by class</option>
                                        @foreach ($classes as $class)
                                            <option value="{{$class->id}}" {{request('class_filter') == $class->id ? 'selected' : ''}}>{{$class->name}}</option>
                                        @endforeach
                                        </select>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="my-3">
                Total Attendance: <span class="font-bold ">{{$users->count()}}</span>
            </div>
            <div class="relative overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400 border border-gray-300 bg-white rounded-lg shadow-lg">
                    <thead class="bg-gray-100 text-gray-700 uppercase">
                        <tr>
                            <th class="p-6 border text-xs  ">Name</th>
                            <th class="p-6 border text-xs">Class</th>
                            @php
                                $today = \Carbon\Carbon::parse('today');;
                                $dates = [];

                                for ($i = 1; $i <= $today->daysInMonth; ++$i) {
                                    $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d D') ;
                                }
                            @endphp
                            @foreach ($dates as $date)
                            {{-- <h2>{{substr($date,11,13) == 'Sat' ? 'text-red-500' : ''}}</h2> --}}
                                <th class="p-6 text-xs border text-center whitespace-nowrap -rotate-45 {{(substr($date,11,13) == 'Sat' || substr($date,11,13) == 'Sun') ? 'text-red-500' : ''}}"  >{{ substr($date,0,10) }}<br><span>{{substr($date,11,13)}}</span></th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <form >
                            @csrf

                            @foreach ($users as $user)
                            <tr class="hover:bg-gray-100 transition duration-200">
                                <td class="p-4 border whitespace-nowrap">{{ $user->name }}({{$user->roles->pluck('name')->first()}})    </td>

                                 <td class="p-4 border  whitespace-nowrap">{{ $user->class?->name }}</td>

                                @for ($i = 1; $i <= $today->daysInMonth; ++$i)
                                        @php
                                            $date_picker = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
                                            $check_in = \App\Models\Attendance::query()
                                                ->where('user_id', $user->id)
                                                ->where('attendance_date', $date_picker)
                                                ->where('type', 1)
                                                ->first();

                                            $check_out = \App\Models\Attendance::query()
                                                ->where('user_id', $user->id)
                                                ->where('attendance_date', $date_picker)
                                                ->where('type', 2)
                                                ->first();

                                            $leave = \App\Models\Attendance::query()
                                                ->where('user_id', $user->id)
                                                ->where('attendance_date', $date_picker)
                                                ->where('type', 3)
                                                ->first();
                                        @endphp
                                        <td class="p-4 border">
                                            <div class="flex items-center " >
                                                @if ($leave)
                                                     <svg class="m-auto" width="30px" height="30px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <defs> <path id="cross-a" d="M0.292893219,1.70710678 C-0.0976310729,1.31658249 -0.0976310729,0.683417511 0.292893219,0.292893219 C0.683417511,-0.0976310729 1.31658249,-0.0976310729 1.70710678,0.292893219 L9.70710678,8.29289322 C10.0976311,8.68341751 10.0976311,9.31658249 9.70710678,9.70710678 C9.31658249,10.0976311 8.68341751,10.0976311 8.29289322,9.70710678 L0.292893219,1.70710678 Z"></path> <path id="cross-c" d="M3.58578644,5 L0.292893219,1.70710678 C-0.0976310729,1.31658249 -0.0976310729,0.683417511 0.292893219,0.292893219 C0.683417511,-0.0976310729 1.31658249,-0.0976310729 1.70710678,0.292893219 L5,3.58578644 L8.29289322,0.292893219 C8.68341751,-0.0976310729 9.31658249,-0.0976310729 9.70710678,0.292893219 C10.0976311,0.683417511 10.0976311,1.31658249 9.70710678,1.70710678 L6.41421356,5 L9.70710678,8.29289322 C10.0976311,8.68341751 10.0976311,9.31658249 9.70710678,9.70710678 C9.31658249,10.0976311 8.68341751,10.0976311 8.29289322,9.70710678 L5,6.41421356 L1.70710678,9.70710678 C1.31658249,10.0976311 0.683417511,10.0976311 0.292893219,9.70710678 C-0.0976310729,9.31658249 -0.0976310729,8.68341751 0.292893219,8.29289322 L3.58578644,5 Z"></path> </defs> <g fill="none" fill-rule="evenodd"> <g transform="translate(8 6)"> <mask id="cross-b" fill="#ffffff"> <use xlink:href="#cross-a"></use> </mask> <use fill="#D8D8D8" fill-rule="nonzero" xlink:href="#cross-a"></use> <g fill="#f80d0d" mask="url(#cross-b)"> <rect width="24" height="24" transform="translate(-8 -6)"></rect> </g> </g> <g transform="rotate(-90 12 5)"> <mask id="cross-d" fill="#ffffff"> <use xlink:href="#cross-c"></use> </mask> <use fill="#000000" fill-rule="nonzero" xlink:href="#cross-c"></use> <g fill="#00703c" mask="url(#cross-d)"> <rect width="24" height="24" transform="translate(-7 -7)"></rect> </g> </g> </g> </g></svg>
                                                @else

                                                   @if ($check_in)
                                                   <svg  class="m-auto" width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4.89163 13.2687L9.16582 17.5427L18.7085 8" stroke="#047c06" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                                   @else
                                                    <svg class="m-auto" fill="#ff0000" width="18px" height="18px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" stroke="#ff0000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M18.8,16l5.5-5.5c0.8-0.8,0.8-2,0-2.8l0,0C24,7.3,23.5,7,23,7c-0.5,0-1,0.2-1.4,0.6L16,13.2l-5.5-5.5 c-0.8-0.8-2.1-0.8-2.8,0C7.3,8,7,8.5,7,9.1s0.2,1,0.6,1.4l5.5,5.5l-5.5,5.5C7.3,21.9,7,22.4,7,23c0,0.5,0.2,1,0.6,1.4 C8,24.8,8.5,25,9,25c0.5,0,1-0.2,1.4-0.6l5.5-5.5l5.5,5.5c0.8,0.8,2.1,0.8,2.8,0c0.8-0.8,0.8-2.1,0-2.8L18.8,16z"></path> </g></svg>
                                                   @endif

                                                   @if ($check_out)
                                                   <svg class="m-auto"  width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4.89163 13.2687L9.16582 17.5427L18.7085 8" stroke="#047c06" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                                   @else
                                                    <svg class="m-auto" fill="#ff0000" width="18px" height="18px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" stroke="#ff0000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M18.8,16l5.5-5.5c0.8-0.8,0.8-2,0-2.8l0,0C24,7.3,23.5,7,23,7c-0.5,0-1,0.2-1.4,0.6L16,13.2l-5.5-5.5 c-0.8-0.8-2.1-0.8-2.8,0C7.3,8,7,8.5,7,9.1s0.2,1,0.6,1.4l5.5,5.5l-5.5,5.5C7.3,21.9,7,22.4,7,23c0,0.5,0.2,1,0.6,1.4 C8,24.8,8.5,25,9,25c0.5,0,1-0.2,1.4-0.6l5.5-5.5l5.5,5.5c0.8,0.8,2.1,0.8,2.8,0c0.8-0.8,0.8-2.1,0-2.8L18.8,16z"></path> </g></svg>
                                                   @endif

                                                @endif

                                            </div>
                                        </td>
                                    @endfor
                                </tr>
                            @endforeach
                        </form>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </x-app-layout>
