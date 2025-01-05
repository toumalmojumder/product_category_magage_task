<div class="grid gap-8 md:grid-cols-3 lg:grid-cols-6">
    @forelse ($products as $product)
        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            <!-- Image -->
            <img class="rounded-t-lg w-full h-48 object-cover" src="{{ Storage::url($product->image) }}"
                alt="{{ $product->name }}" />

            <!-- Card Content -->
            <div class="p-4">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $product->name }}
                </h5>
                
                <p class="mb-2 text-gray-700 dark:text-gray-400">Category: @foreach ($product->categories as $key => $category)
                    {{ $category->name }}@if (!$loop->last), @endif
                @endforeach
            </p>
                <p class="mb-4 text-xl font-semibold text-gray-900 dark:text-gray-200">
                    ${{ number_format($product->price, 2) }}</p>

                <!-- Action Buttons -->
                <div class="flex space-x-2">
                    <!-- Edit Button -->
                    <a href="{{ route('product.edit', $product->id) }}" as="button"
                        class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
                        style="margin: 5px">
                        Edit
                    </a>

                    <!-- Delete Button -->
                    <button wire:click="delete({{ $product->id }})"
                        class="px-4 py-2 text-white bg-red-500 rounded hover:bg-red-600 focus:outline-none">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center text-gray-600 dark:text-gray-300">
            No products found.
        </div>
    @endforelse
</div>
