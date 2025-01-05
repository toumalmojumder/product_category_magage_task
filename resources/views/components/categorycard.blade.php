@props(['name', 'id'])

<div class="max-w-sm mx-auto my-4">
  <div class="bg-white shadow-lg rounded-lg p-4 flex justify-between items-center">
    <!-- Name Section -->
    <div>
      <h3 class="text-lg font-semibold text-gray-900">{{ $name }}</h3>
    </div>

    <!-- Action Buttons -->
    <div class="flex space-x-2">
        <a href="{{ route('category.edit', $id) }}" as="button"
            class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto"
            style="margin: 5px">
            Edit
        </a>
      <button wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE"
      wire:click="delete({{ $id }})" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 focus:outline-none">
        Delete
      </button>
    </div>
  </div>
</div>