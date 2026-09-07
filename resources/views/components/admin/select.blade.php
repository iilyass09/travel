@props([
    'name' => '',
    'label' => '',
    'value' => '',
    'options' => [],
])

<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1.5">{{ $label }}</label>
    <select id="{{ $name }}" name="{{ $name }}" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all text-sm">
        @foreach ($options as $v => $l)
        <option value="{{ $v }}" @selected((string) old($name, $value) === (string) $v)>{{ $l }}</option>
        @endforeach
    </select>
</div>
