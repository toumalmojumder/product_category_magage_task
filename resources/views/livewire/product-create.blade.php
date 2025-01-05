<div class="mb-1 flex justify-center">
    <form wire:submit.prevent="save" class="w-full">
        <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="bg-white py-1 px-4 space-y-6 sm:p-1">
                <div>
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Add New product Information
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Use this form to create a new product.
                    </p>
                </div>
                <x-auth-session-status class="mb-4" :status="session('product_create')" />
                <div class="grid grid-cols-6 gap-6">
                    <div wire:ignore class="col-span-6 sm:col-span-6">
                        <label for="category_id" class="block text-sm font-medium text-gray-700 text-left">Select
                            Category:<span class="text-red-500">*</span></label>
                        <select wire:model="category_id" name="category_id" id="category_id" multiple
                            class="multiselect w-full" x-init="MultiselectDropdown(window.MultiselectDropdownOptions);" placeholder="Select Category"
                            multiselect-search="true" multiselect-select-all="true">
                            @forelse($categorys as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="text-red-500 col-span-6 sm:col-span-6">
                        @error('category_id')
                            {{ $message }}
                        @enderror
                    </div>

            
                    <div class="col-span-3 sm:col-span-3 lg:col-span-3">
                        <label for="name" class="block text-sm font-medium text-gray-700">Product Title:<span
                                class="text-red-500">*</span>
                        </label>
                        <input wire:model.blur="name" type="text" id="name" placeholder="product Name..."
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                        <div class="text-red-500">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    
                    


                    
                    <div class="col-span-3 sm:col-span-3 lg:col-span-3">
                        <label for="price" class="block text-sm font-medium text-gray-700">Product Price:(৳)<span
                                class="text-red-500">*</span>
                        </label>
                        <input wire:model.blur="price" type="number" id="price" placeholder="product"
                            oninput="validity.valid||(value='0');" min="0" max="100000"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                        <span class="text-gray-400 text-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Integer( পূর্ণ সংখ্যা
                            )</span>
                        <div class="text-red-500">
                            @error('price')
                                {{ $message }}
                            @enderror
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="image" class="block text-sm font-medium text-gray-700 text-left">
                                Image: <span class="text-green-500">&nbsp; &nbsp;***Image size must be
                                    1400px X 550px & under
                                    1mb***</span></label>
                            <input wire:model.blur="image" accept="image/png, image/jpeg, image/webp" type="file"
                                name="image" id="image"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                            @error('image')
                                <span class="text-red-500 text-xs">{{ $message }}</span>
                            @enderror
    
                        </div>
                        <div class="col-span-6 sm:col-span-6 w-[100px]">
                            @if ($image)
                                <img class="rounded mt-5 block h-20 w-full" src="{{ $image->temporaryUrl() }}"
                                    alt="User Avatar">
                            @endif
                        </div>
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
    </form>


</div>
