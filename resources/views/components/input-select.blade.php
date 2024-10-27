@props(['disabled' => false, 'value'])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border border-gray-300   focus:border-indigo-500  focus:ring-indigo-500  rounded-md shadow-sm px-3 py-2']) !!}>
    {{ $value ?? $slot }}
</select>