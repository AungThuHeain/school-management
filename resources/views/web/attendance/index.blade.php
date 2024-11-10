
<x-app-layout>
    <div x-data="attendance()">
        <div x-show="stillUpdate" class="fixed left-0 right-0 z-50 flex items-center justify-center  overflow-hidden top-4 md:inset-0 h-modal sm:h-full bg-gray-200 opacity-50">
            <div  class="flex z-60 relative justify-center m-auto items-center ">
                <div class="flex flex-row gap-2">
                  <div class="w-2 h-2 rounded-full bg-red-700 animate-bounce"></div>
                  <div class="w-2 h-2 rounded-full bg-red-700 animate-bounce [animation-delay:-.3s]"></div>
                  <div class="w-2 h-2 rounded-full bg-red-700 animate-bounce [animation-delay:-.5s]"></div>
                </div>
            </div>
        </div>
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
                              <a href="#" class="ml-1 text-gray-700 hover:text-primary-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">Attendance</a>
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
                    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Attendance</h1>
                </div>
                <div class="sm:flex">
                    <div class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700">
                        <form class="lg:pr-3" action="#" method="GET">
                        <label for="users-search" class="sr-only">Search</label>
                        <div class="relative mt-1 lg:w-64 xl:w-96">
                            <input type="text" name="s" id="users-search" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search for attendance">
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="relative overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400 border border-gray-300 bg-white rounded-lg shadow-lg">
                    <thead class="bg-gray-100 text-gray-700 uppercase">
                        <tr>
                            <th class="p-6 border text-xs  ">Name</th>
                            <th class="p-6 border text-xs">Class</th>
                            @php
                                $today = today();
                                $dates = [];

                                for ($i = 1; $i <= $today->daysInMonth; ++$i) {
                                    $dates[] = \Carbon\Carbon::createFromDate($today->year, $today->month, $i)->format('Y-m-d');
                                }
                            @endphp
                            @foreach ($dates as $date)
                                <th class="p-6 text-xs border whitespace-nowrap -rotate-45">{{ $date }}</th>
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
                                            <div class="flex items-center space-x-2">
                                                <label class="flex items-center">
                                                    <input @click="deleteOrStore({{$user->id}},'{{$date_picker}}',1)" type="checkbox" @click= name="checkin[{{ $date_picker }}][{{ $user->id }}]" class="form-checkbox text-green-600 focus:outline-none focus:ring focus:ring-green-300" value="1" @if (isset($check_in)) checked @endif>
                                                </label>
                                                <label class="flex items-center">
                                                    <input @click="deleteOrStore({{$user->id}},'{{$date_picker}}',2)" type="checkbox" name="checkout[{{ $date_picker }}][{{ $user->id }}]" class="form-checkbox text-green-600 focus:outline-none focus:ring focus:ring-green-300" value="1" @if (isset($check_out)) checked @endif>
                                                </label>
                                                <label class="flex items-center">
                                                    <input @click="deleteOrStore({{$user->id}},'{{$date_picker}}',3)" type="checkbox" name="leave[{{ $date_picker }}][{{ $user->id }}]" class="form-checkbox text-red-600 focus:outline-none focus:ring focus:ring-red-300" value="1" @if (isset($leave)) checked @endif>

                                                </label>
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
