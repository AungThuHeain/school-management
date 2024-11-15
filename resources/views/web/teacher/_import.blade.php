<div x-show="importModalOpen" x-cloak class="fixed left-0 right-0 z-50 flex items-center justify-center  overflow-x-hidden overflow-y-auto top-4 md:inset-0 h-modal sm:h-full bg-gray-700 bg-opacity-80" >
    <div class="relative w-full h-full max-w-2xl px-4 md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-5 border-b rounded-t dark:border-gray-700">
                <h3 class="text-xl font-semibold dark:text-white" >Teacher Excel Import</h3>
                <div x-show="stillImporting" class="fixed left-0 right-0 z-50 flex items-center justify-center overflow-hidden top-4 md:inset-0 h-modal sm:h-full bg-white bg-opacity-0">
                    <div class="flex z-60 relative justify-center m-auto items-center">
                        <div class="flex flex-row gap-2">
                            <div class="w-2 h-2 rounded-full bg-red-700 animate-bounce"></div>
                            <div class="w-2 h-2 rounded-full bg-red-700 animate-bounce [animation-delay:-.3s]"></div>
                            <div class="w-2 h-2 rounded-full bg-red-700 animate-bounce [animation-delay:-.5s]"></div>
                            <div class="w-2 h-2 rounded-full bg-red-700 animate-bounce [animation-delay:-.7s]"></div>
                            <div class="w-2 h-2 rounded-full bg-red-700 animate-bounce [animation-delay:-.9s]"></div>
                            <div class="w-2 h-2 rounded-full bg-red-700 animate-bounce [animation-delay:-.11s]"></div>
                            <div class="w-2 h-2 rounded-full bg-red-700 animate-bounce [animation-delay:-.13s]"></div>
                        </div>
                    </div>
                </div>
                <button @click="closeImportModel" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white" >
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <form @submit.prevent="importExcel">
                    <div class="grid grid-cols-6 gap-6">
                        <!-- Notice for Class Number Representation in Horizontal Layout -->
                        <div class="col-span-6">
                            <label class="block text-sm font-medium text-gray-900 dark:text-white mb-2">
                                Number Representation for Class Names
                            </label>
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">
                                Each number represents a class name in your Excel file:
                            </p>

                            <!-- Horizontal Layout for Class Names and IDs -->
                            <div class="flex flex-wrap gap-4">
                                <template x-for="classs in classes" :key="classs.id">
                                    <div class="flex items-center space-x-2 bg-gray-100 dark:bg-gray-800 p-2 rounded-lg">
                                        <span class="font-medium text-gray-800 dark:text-white" x-text="classs.name"></span>
                                        <span class="text-gray-500">=> </span>
                                        <span class="text-primary-600 font-semibold" x-text="classs.id"></span>
                                    </div>
                                </template>
                            </div>
                        </div>
                        <div class="col-span-6">
                            <label class="block text-sm font-medium text-gray-900 dark:text-white mb-2">
                                Name Representation for Role Names
                            </label>
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">
                                Each name represents a role name in your Excel file:
                            </p>

                            <!-- Horizontal Layout for Class Names and IDs -->
                            <div class="flex flex-wrap gap-4">
                                <template x-for="role in roles" :key="role.id">
                                    <div class="flex items-center space-x-2 bg-gray-100 dark:bg-gray-800 p-2 rounded-lg">
                                        <span class="font-medium text-gray-800 dark:text-white" x-text="role.name"></span>
                                        <span class="text-gray-500">=> </span>
                                        <span class="text-primary-600 font-semibold" x-text="role.name"></span>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- File Input Section -->
                        <div class="col-span-6 sm:col-span-6">
                            <a class="flex justify-end text-red-500 font-bold" href="{{route('teacher-demo')}}">Demo file</a>
                            <label for="file" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Choose Excel File
                            </label>
                            <input  @change="handleFileUpload(event)" type="file" name="file" id="file"
                                   class="block w-full p-2.5 text-gray-900 bg-gray-50 shadow-sm
                                           sm:text-sm dark:bg-gray-700 dark:text-white
                                          dark:placeholder-gray-400">

                            <!-- Error Message -->
                            <template x-if="errors.file">
                                <p class="mt-1 text-sm text-red-500" x-text="errors.file"></p>
                            </template>
                            <template x-if="errors[0]">
                                <p class="mt-1 text-sm text-red-500" x-text="errors[0]"></p>
                            </template>
                        </div>
                    </div>
                <!-- Modal footer -->
                <div class=" justify-between flex p-6 border-t border-gray-200 rounded-b dark:border-gray-700">
                    <button type="button" @click="closeImportModel" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Cancle</button>
                    <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" >Save</button>
                </div>
                </form>
            </div>
        </div>
  </div>
</div>
