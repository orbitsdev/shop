@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-cerise-red-500 focus:ring-cerise-red-500 rounded-md shadow-sm']) !!}>
