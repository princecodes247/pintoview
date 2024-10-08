@props(['disabled' => false, 'options' => [], 'id' => null, 'name' => null, 'class' => ''])

<select id="{{ $id }}" name="{{ $name }}" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm ' . $class]) !!}>
    @foreach($options as $option)
        <option value="{{ $option["value"] }}">{{ $option["label"] }}</option>
    @endforeach
</select>
