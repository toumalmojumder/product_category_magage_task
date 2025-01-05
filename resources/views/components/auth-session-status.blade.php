@props(['status'])

@if ($status)
    <div x-data="{ open: true }" id="alertMessage" x-show="open" {{ $attributes->merge(['class' => 'alert mb-4 bg-green-200 text-green-700 border border-green-700 px-4 py-3 rounded relative']) }}>
        <span class="block sm:inline">{{ $status }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3" @click="open = false">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <title>Close</title>
                <path d="M14.348 5.652a.5.5 0 0 1 0 .707L10.707 10l3.64 3.64a.5.5 0 0 1-.708.708L10 10.707l-3.64 3.64a.5.5 0 0 1-.708-.708L9.293 10 5.652 6.348a.5.5 0 0 1 .708-.708L10 9.293l3.64-3.64a.5.5 0 0 1 .708 0z" />
            </svg>
        </span>
    </div>
@endif