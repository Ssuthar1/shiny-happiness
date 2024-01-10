@props(['value'])

<label {{ $attributes->merge(['class' => 'mb-2.5 block font-medium text-black dark:text-white']) }}>
    {{ $value ?? $slot }}
</label>
