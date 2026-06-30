@extends('layouts.app')

@section('title', 'About Us | Abu Aneefah Islamic Academy')

@section('content')
<!-- Page Header -->
<section class="pt-20 bg-primary-700 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl sm:text-5xl font-bold mb-4">About Us</h1>
        <p class="text-primary-200 max-w-2xl mx-auto">Learn about our journey, values, and commitment to Islamic education.</p>
    </div>
</section>

<!-- About Intro -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="reveal">
                <img src="{{ asset('images/students-girls.jpg') }}" alt="Students of Abu Aneefah"
                     class="rounded-3xl shadow-2xl w-full object-cover">
            </div>
            <div class="reveal">
                <span class="inline-block px-4 py-1.5 rounded-full bg-primary-50 text-primary-600 text-sm font-semibold mb-4">
                    Who We Are
                </span>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">A Legacy of Islamic Excellence</h2>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Abu Aneefah Islamic Academy was founded with a clear vision: to provide an educational environment
                    where students develop both spiritually and academically. For over 15 years, we have been
                    dedicated to nurturing young minds through a curriculum that seamlessly integrates the teachings
                    of the Qur'an and Sunnah with modern educational standards.
                </p>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Our academy offers a comprehensive educational journey from primary to senior secondary levels,
                    with specialized programs including Qur'an memorization, Arabic language studies, and adult
                    education classes. We believe that true education goes beyond textbooks — it shapes character,
                    builds faith, and prepares students to be responsible contributors to society.
                </p>
                <p class="text-gray-600 leading-relaxed">
                    Located in Ogun State, Nigeria, we serve a diverse community of learners united by their
                    commitment to seeking knowledge and living by Islamic principles.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Core Values -->
<section class="py-24 bg-primary-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-section-header title="Our Core Values" subtitle="What We Stand For">
            The principles that guide everything we do at Abu Aneefah Islamic Academy.
        </x-section-header>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mt-16">
            @php
                $values = [
                    ['title' => 'Building Faith', 'desc' => 'Strengthening the connection between students and Allah through daily practices and Islamic teachings.', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                    ['title' => 'Seeking Knowledge', 'desc' => 'Encouraging curiosity and a lifelong love for learning in both Islamic and contemporary sciences.', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253'],
                    ['title' => 'Shaping Character', 'desc' => 'Developing strong moral character based on the prophetic model of excellence and integrity.', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622'],
                    ['title' => 'Serving Ummah', 'desc' => 'Inspiring students to use their knowledge and skills for the benefit of the community.', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857'],
                ];
            @endphp

            @foreach ($values as $value)
                <div class="reveal bg-white rounded-2xl shadow-lg p-8 text-center hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-primary-100">
                    <div class="w-16 h-16 rounded-full bg-primary-100 flex items-center justify-center mx-auto mb-5">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $value['icon'] }}"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-3">{{ $value['title'] }}</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">{{ $value['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Mission & Vision Summary -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Mission -->
            <div class="reveal bg-gradient-to-br from-primary-600 to-primary-800 rounded-3xl p-8 sm:p-12 text-white">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold">Our Mission</h3>
                </div>
                <p class="leading-relaxed mb-6">
                    To provide sound Islamic and contemporary education that nurtures God-conscious, morally upright, and academically excellent learners who serve humanity with integrity.
                </p>
                <p class="font-arabic text-lg text-primary-100 leading-loose" dir="rtl">
                    تقديم تعليم متكامل يجمع بين القيم الإسلامية والمعرفة الحديثة، ويُسهم في بناء شخصية الطالب علمياً وأخلاقياً.
                </p>
            </div>

            <!-- Vision -->
            <div class="reveal bg-primary-50 rounded-3xl p-8 sm:p-12 border border-primary-100">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 rounded-full bg-primary-600 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900">Our Vision</h3>
                </div>
                <p class="text-gray-700 leading-relaxed mb-6">
                    To be a leading Islamic educational institution that produces God-fearing, knowledgeable, and responsible leaders who positively impact society.
                </p>
                <p class="font-arabic text-lg text-primary-800 leading-loose" dir="rtl">
                    أن نكون مؤسسة تعليمية إسلامية رائدة تُخرّج جيلاً مؤمناً، متميزاً علمياً، وقادراً على خدمة المجتمع بإخلاص.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Stats -->
<section class="py-16 bg-primary-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center">
            @php
                $stats = [
                    ['number' => '15+', 'label' => 'Years of Excellence'],
                    ['number' => '500+', 'label' => 'Students Enrolled'],
                    ['number' => '50+', 'label' => 'Qualified Teachers'],
                    ['number' => '3', 'label' => 'Languages Taught'],
                ];
            @endphp
            @foreach ($stats as $stat)
                <div class="reveal">
                    <p class="text-4xl font-bold text-white mb-2">{{ $stat['number'] }}</p>
                    <p class="text-primary-200">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center reveal">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Want to Learn More?</h2>
        <p class="text-gray-600 mb-8">Contact us today to schedule a visit or learn more about our programs.</p>
        <a href="{{ route('contact.create') }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-primary-600 text-white font-semibold hover:bg-primary-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1">
            Get in Touch
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</section>
@endsection
