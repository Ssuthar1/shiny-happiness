<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full cursor-pointer rounded-lg border border-primary bg-primary p-4 font-medium text-white transition hover:bg-opacity-90']) }}>
    {{ $slot }}
</button>
