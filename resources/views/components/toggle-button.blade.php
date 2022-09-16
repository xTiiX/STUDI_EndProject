@props(['label', 'id'])

<!-- Toggle -->
<div class="flex items-center justify-center w-full mb-4">
    <label
      for="{{ $id }}"
      class="flex items-center cursor-pointer">
        <!-- label -->
        <div class="mr-3 text-gray-700 font-medium">
            {{ $label }}
        </div>
        <!-- toggle -->
        <div class="relative">
            <!-- input -->
            <input id="{{ $id }}" type="checkbox" class="sr-only" />
            <!-- line -->
            <div class="w-10 h-4 bg-gray-400 rounded-full shadow-inner"></div>
            <!-- dot -->
            <div class="dot absolute w-6 h-6 bg-white rounded-full shadow -left-1 -top-1 transition"></div>
        </div>
    </label>
</div>

<style>
    /* Toggle A */
    input:checked ~ .dot {
    transform: translateX(100%);
    background-color: #48bb78;
    }
</style>
