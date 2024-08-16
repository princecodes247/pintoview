@props(['disabled' => false, 'id' => null, 'type' => 'text', 'required' => false, 'name' => null, 'class' => ''])

<input 
    id="{{ $id }}" 
    name="{{ $name }}" 
    type="{{ $type }}" 
    {{ $disabled ? 'disabled' : '' }} 
    {{ $required ? 'required' : '' }} 
    {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm ' . $class]) !!}>
