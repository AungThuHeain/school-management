<div x-show="modalOpen" x-cloak class="fixed left-0 right-0 z-50 flex items-center justify-center  overflow-x-hidden overflow-y-auto top-4 md:inset-0 h-modal sm:h-full" >
    <div class="relative w-full h-full max-w-2xl px-4 md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-700">
                <h3 class="text-xl font-semibold dark:text-white" x-text="editMode ? 'Edit classroom' : 'Add new schedule'"></h3>
                <button @click="modalOpen = false" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white" >
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <form @submit.prevent="editMode ? update : store">
                    <div class="grid grid-cols-2 gap-6">
                        <input type="hidden" name="school_id" x-init="form = { school_id: '{{auth()->user()->school_id}}'}" x-model="form.school_id">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="first-name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Schedule Name</label>
                            <input x-model='form.name' type="text" name="first-name" id="first-name" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Classroom name" >
                            <template x-if="errors.name">
                                <p class="text-red-500" x-text="errors.name"></p>
                            </template>
                        </div>
                    </div>
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="time" class="mt-3 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Checkin time:</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <input type="time" id="time" class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" min="01:00" max="24:59" x-model="form.check_in"   required />
                                <template x-if="errors.check_in">
                                    <p class="text-red-500" x-text="errors.check_in"></p>
                                </template>
                            </div>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="time" class=" mt-3 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Chekout time:</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <input type="time" id="time" class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" min="01:00" max="24:59"  x-model="form.check_out" value="00:00" required />
                                <template x-if="errors.check_out">
                                    <p class="text-red-500" x-text="errors.check_out"></p>
                                </template>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-6 sm:col-span-3 mt-3">
                        <label for="class_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Assign Class</label>
                        <div class="flex flex-wrap gap-3 ms-3">
                            <template x-for="clas in Classes" :key="clas.id">
                                <label class="basis-1/5">
                                    <input @click="toggleClass(clas.id)" type="checkbox" :value="clas.id" x-model="form.classes[]"  :checked="form.classes.includes(clas.id)" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <span x-text="clas.name"></span>
                                </label>
                            </template>
                        </div>
                        <template x-if="errors.classes">
                            <p class="text-red-500" x-text="errors.classes"></p>
                        </template>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class=" justify-between flex p-6 border-t border-gray-200 rounded-b dark:border-gray-700">
                    <button type="button" @click="modalOpen = false" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancle</button>
                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" >Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
