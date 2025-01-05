<div class="grid gap-8 md:grid-cols-3 lg:grid-cols-6">
   @forelse ($categorys as $category)

   <x-categorycard name="{{ $category->name }}" id="{{ $category->id }}" />
    
   @empty
   @endforelse
</div>
