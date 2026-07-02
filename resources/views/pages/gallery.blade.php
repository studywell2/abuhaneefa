@extends('layouts.app')

@section('title', 'Gallery | Abu Aneefah Islamic Academy')

@section('content')
<!-- Page Header -->
<section class="pt-20 bg-primary-700 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl sm:text-5xl font-bold mb-4">Gallery</h1>
        <p class="text-primary-200 max-w-2xl mx-auto">A glimpse into life at Abu Haneefah Islamic Academy.</p>
    </div>
</section>

<!-- Gallery Grid -->
<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="columns-1 sm:columns-2 lg:columns-3 gap-4 space-y-4">
            @foreach ($images as $image)
                <a href="#" data-lightbox="{{ asset($image['src']) }}" data-alt="{{ $image['alt'] }}"
                   class="reveal group relative block overflow-hidden rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 break-inside-avoid">
                    <img src="{{ asset($image['src']) }}" alt="{{ $image['alt'] }}"
                         class="w-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-primary-900/0 group-hover:bg-primary-900/50 transition-all duration-300 flex items-center justify-center">
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </div>
                    </div>
                    <p class="absolute bottom-0 left-0 right-0 p-4 text-white text-sm font-medium bg-gradient-to-t from-primary-900/80 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        {{ $image['alt'] }}
                    </p>
                </a>
            @endforeach
        </div>

        @if (count($images) === 0)
            <div class="text-center py-16">
                <p class="text-gray-500">No images available at this time. Please check back soon.</p>
            </div>
        @endif
    </div>
</section>

<!-- CTA -->
<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center reveal">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">See Yourself Here?</h2>
        <p class="text-gray-600 mb-8">Join our academy and be part of our growing community of learners.</p>
        <a href="{{ route('admissions') }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-primary-600 text-white font-semibold hover:bg-primary-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1">
            Apply Now
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</section>
@endsection
