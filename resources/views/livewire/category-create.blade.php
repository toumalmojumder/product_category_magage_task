<div class="mb-8 flex justify-center">
    <form wire:submit.prevent="save" class="w-full max-w-2xl">
        <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="bg-white py-6 px-4 space-y-6 sm:p-6">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Add New Category
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Use this form to create a new Category.
                    </p>
                </div>
                <x-auth-session-status class="mb-4" :status="session('category_create')" />
                <div class="grid grid-cols-1 gap-6">
                    <div class="col-span-1 sm:col-span-1">
                        <label for="name" class="block text-sm font-medium text-gray-700 text-left">Name:<span
                                class="text-red-500">*</span></label>
                        <input wire:model.blur="name" type="text" id="name" name="name" placeholder="category Name English"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                        <div class="text-red-500">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>               
                </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 flex justify-between">
                <a x-on:click="$dispatch('close-modal')" as="button"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-indigo-600 border border-transparent rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Save
                </button>
            </div>
        </div>
    </form>
</div>
