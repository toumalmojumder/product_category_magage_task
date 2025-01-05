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
                                <option value="{{ $category->name }}">
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

                    <div class="col-span-6 sm:col-span-6 lg:col-span-6">
                        <label for="product_code" class="block text-sm font-medium text-gray-700">Product Code:<span
                                class="text-red-500">*</span>
                        </label>
                        <input wire:model.blur="product_code" type="text" id="product_code" placeholder="product Code..."
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                        <div class="text-red-500">
                            @error('product_code')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="col-span-3 sm:col-span-3 lg:col-span-3">
                        <label for="title_en" class="block text-sm font-medium text-gray-700">Product Title:(EN)<span
                                class="text-red-500">*</span>
                        </label>
                        <input wire:model.blur="title_en" type="text" id="title_en" placeholder="product Name..."
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                        <div class="text-red-500">
                            @error('title_en')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="col-span-3 sm:col-span-3 lg:col-span-3">
                        <label for="title_bn" class="block text-sm font-medium text-gray-700">Product Title:(BN)<span
                                class="text-red-500">*</span></label>
                        <input wire:model.blur="title_bn" type="text" id="title_bn" placeholder="খাবারের নাম..."
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                        <div class="text-red-500">
                            @error('title_bn')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div wire:ignore class="col-span-3 sm:col-span-3 lg:col-span-3">
                        <label for="desc_en" class="block text-sm font-medium text-gray-700">Product
                            Description:(EN)<span class="text-red-500">*</span>
                        </label>
                        <div>
                            <textarea wire:model="desc_en" id="desc_en" rows="3" cols="38" placeholder="Product Description..."></textarea>
                        </div>
                        <div class="text-red-500">
                            @error('desc_en')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div wire:ignore class="col-span-3 sm:col-span-3 lg:col-span-3">
                        <label for="desc_bn" class="block text-sm font-medium text-gray-700">Product
                            Description:(BN)<span class="text-red-500">*</span>
                        </label>
                        <div>
                            {{-- <textarea wire:model="desc_bn" id="desc_bn" rows="3" cols="38" placeholder="খাবারের আনুসাঙ্গির বর্ননা"></textarea> --}}
                            <textarea wire:model="desc_bn" id="desc_bn"></textarea>
                        </div>

                        <div class="text-red-500">
                            @error('desc_bn')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    @push('scripts')
                        <script src="{{ asset('asset/ck_editor/ckeditor/ckeditor.js') }}"></script>
                        <script src="{{ asset('asset/ck_editor/ckeditor/samples/js/sample.js') }}"></script>
                        <script>
                            CKEDITOR.replace('desc_bn')
                            CKEDITOR.replace('desc_en')
                        </script>

                        <script>
                            var editor1 = CKEDITOR.instances['desc_bn'];
                            var editor2 = CKEDITOR.instances['desc_en'];
                            editor1.on('change', function() {
                                const value = editor1.getData();
                                @this.set('desc_bn', value);
                            });
                            editor2.on('change', function() {
                                const value2 = editor2.getData();
                                @this.set('desc_en', value2);
                            });
                        </script>
                    @endpush


                    <div wire:ignore class="col-span-6 sm:col-span-6 lg:col-span-6">
                        <label for="image" class="block text-sm font-medium text-gray-700 text-left"> Image: <span
                                class="text-green-500">&nbsp; &nbsp; &nbsp; &nbsp; ***Image size must be 500*500 & under
                                1mb & group maximum 2mb*** </span></label>
                        <input type="file" id="image" name="image" class="filepond" multiple credits="false"  data-max-files="10"
                            x-init="const inputElement = document.querySelector('#image');
                            const pond = FilePond.create(inputElement, {
                                maxFileSize: '1MB',
                                maxTotalFileSize: '2MB',
                            });" />
                    </div>
                    @push('scripts')
                        <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
                        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
                        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
                        <script>
                            FilePond.registerPlugin(FilePondPluginFileValidateSize);
                            FilePond.registerPlugin(FilePondPluginImagePreview);
                            FilePond.setOptions({
                                server: {
                                    process: '/admin/generalsettings/temporary/image/upload',
                                    revert: '/admin/generalsettings/temporary/image/delete',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    },
                                },
                            });
                        </script>

                    @endpush
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
                    </div>
                    <div class="col-span-3 sm:col-span-3 lg:col-span-3">
                        <label for="discount" class="block text-sm font-medium text-gray-700">Discount:(%)</label>
                        <input wire:model.blur="discount" type="number" id="discount"
                            placeholder="Discount(মূল্য ছাড়) %" oninput="validity.valid||(value='0');" min="0"
                            max="100"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                        <span class="text-gray-400 text-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Integer( পূর্ণ সংখ্যা
                            )</span>
                        <div class="text-red-500">
                            @error('discount')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="col-span-6 inline-flex justify-around">
                        <label>
                            <input wire:model="selectedSpecials" type="checkbox" name="special[]" value="bestseller" class="form-checkbox h-10 w-10 text-indigo-600">
                            Best Sells
                        </label>
                        <label>
                            <input wire:model="selectedSpecials" type="checkbox" name="special[]" value="topbrand" class="form-checkbox h-10 w-10 text-indigo-600">
                            Top Brand
                        </label>
                        <label>
                            <input wire:model="selectedSpecials" type="checkbox" name="special[]" value="newarrival" class="form-checkbox h-10 w-10 text-indigo-600">
                            New Arrival
                        </label>
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="status" class="block text-sm font-medium text-gray-700 text-left">Status</label>
                        <div class="mt-1 text-left">
                            <label class="inline-flex items-center">
                                <input wire:model="status" type="checkbox" id="status" value="1"
                                    class="form-checkbox h-10 w-10 text-indigo-600">
                                <span class="ml-2 text-gray-700">Active</span>
                            </label>
                        </div>
                        <div class="text-red-500">
                            @error('status')
                                {{ $message }}
                            @enderror
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
