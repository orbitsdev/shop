<div class="relative inline-block">
    <!-- Cart Icon (This can be a FontAwesome or custom SVG icon) -->
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l1.34 5.34M17 13l-1.34 5.34M9.34 18.34A1.66 1.66 0 118.66 21a1.66 1.66 0 01.68-2.66M18.34 18.34A1.66 1.66 0 1117.66 21a1.66 1.66 0 01.68-2.66" />
    </svg>

    <!-- Badge (Styled to match the orange circular design) -->
    <span class="absolute top-[-10px] right-[-10px] w-6 h-6 bg-cerise-red-500 text-white text-center text-xs font-bold rounded-full flex items-center justify-center">
        {{ $order_items_count }}
    </span>
</div>
