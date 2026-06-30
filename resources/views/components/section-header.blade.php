@props(['title', 'subtitle' => null, 'centered' => true])

<div class="{{ $centered ? 'text-center' : '' }} reveal">
    <span class="inline-block px-4 py-1.5 rounded-full bg-primary-50 text-primary-600 text-sm font-semibold mb-3">
        {{ $subtitle }}
    </span>
    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
        {{ $title }}
    </h2>
    @isset($slot)
        <div class="max-w-2xl {{ $centered ? 'mx-auto' : '' }} text-gray-600 leading-relaxed">
            {{ $slot }}
        </div>
    @endisset
</div>
