<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-cerise-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-cerise-red-700 focus:bg-cerise-red-700 active:bg-cerise-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
