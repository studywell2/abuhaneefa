@extends('layouts.app')

@section('title', 'Academics | Abu Haneefah Islamic Academy')

@section('content')
<!-- Page Header -->
<section class="pt-20 bg-primary-700 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl sm:text-5xl font-bold mb-4">Academics</h1>
        <p class="text-primary-200 max-w-2xl mx-auto">A balanced curriculum integrating Islamic knowledge with contemporary sciences.</p>
    </div>
</section>

<!-- Curriculum Overview -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="reveal">
                <span class="inline-block px-4 py-1.5 rounded-full bg-primary-50 text-primary-600 text-sm font-semibold mb-4">
                    Our Approach
                </span>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Integrated Curriculum</h2>
                <p class="text-gray-600 leading-relaxed mb-4">
                    At Abu Aneefah Islamic Academy, we believe that the best education is one that harmonizes
                    spiritual growth with academic excellence. Our curriculum is carefully designed to integrate
                    the teachings of the Qur'an and Sunnah with modern educational standards.
                </p>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Students study a wide range of subjects — from Qur'anic sciences and Arabic language to
                    mathematics, sciences, and social studies — all delivered through an Islamic lens that
                    reinforces values of faith, character, and service to humanity.
                </p>
                <p class="text-gray-600 leading-relaxed">
                    Our motto, <span class="font-semibold text-primary-600">"Knowledge Before Action,"</span>
                    reflects our commitment to ensuring students not only acquire knowledge but also learn
                    to apply it in ways that please Allah and benefit society.
                </p>
            </div>
            <div class="reveal">
                <img src="{{ asset('images/classroom.jpg') }}" alt="Classroom learning"
                     class="rounded-3xl shadow-2xl w-full object-cover">
            </div>
        </div>
    </div>
</section>

<!-- Academic Programs -->
<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-section-header title="Academic Programs" subtitle="Educational Levels">
            Comprehensive programs designed for every stage of a student's educational journey.
        </x-section-header>

        <div class="space-y-8 mt-16">
            @php
                $programs = [
                    [
                        'name' => 'Comprehensive Arabic Class',
                        'level' => 'Foundation',
                        'subjects' => ['Arabic Grammar (Nahwu)', 'Arabic Morphology (Sarf)', 'Arabic Literature', 'Qur\'anic Recitation (Tajwid)', 'Islamic Studies'],
                        'desc' => 'A thorough immersion into the Arabic language, providing students with the tools to understand the Qur\'an and Islamic texts directly.',
                    ],
                    [
                        'name' => 'Ibtidaiyah (Primary Classes)',
                        'level' => 'Primary',
                        'subjects' => ['Qur\'an & Hadith', 'Arabic Language', 'English Language', 'Mathematics', 'Basic Science', 'Islamic Studies'],
                        'desc' => 'Foundational education that introduces young learners to both Islamic and contemporary subjects in a nurturing environment.',
                    ],
                    [
                        'name' => 'Idaadiyah (Junior Secondary)',
                        'level' => 'Junior Secondary',
                        'subjects' => ['Qur\'an & Tafsir', 'Arabic & English Language', 'Mathematics', 'Integrated Science', 'Social Studies', 'Fiqh & Islamic History'],
                        'desc' => 'An intermediate level that deepens students\' knowledge and prepares them for advanced studies.',
                    ],
                    [
                        'name' => 'Thanawiyah (Senior Secondary)',
                        'level' => 'Senior Secondary',
                        'subjects' => ['Advanced Qur\'an & Hadith Studies', 'Arabic & English Literature', 'Mathematics & Sciences', 'Islamic Jurisprudence (Fiqh)', 'Civic & Islamic Education'],
                        'desc' => 'An advanced program that prepares students for higher education and leadership roles in their communities.',
                    ],
                ];
            @endphp

            @foreach ($programs as $program)
                <div class="reveal bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300">
                    <div class="grid grid-cols-1 lg:grid-cols-3">
                        <div class="bg-primary-700 p-8 text-white lg:col-span-1">
                            <span class="inline-block px-3 py-1 rounded-full bg-primary-600 text-primary-100 text-xs font-semibold mb-4">{{ $program['level'] }}</span>
                            <h3 class="text-2xl font-bold mb-4">{{ $program['name'] }}</h3>
                            <p class="text-primary-200 text-sm leading-relaxed">{{ $program['desc'] }}</p>
                        </div>
                        <div class="p-8 lg:col-span-2">
                            <h4 class="font-semibold text-gray-900 mb-4">Key Subjects:</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach ($program['subjects'] as $subject)
                                    <div class="flex items-center gap-2">
                                        <svg class="w-5 h-5 text-primary-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <span class="text-sm text-gray-700">{{ $subject }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Teaching Methodology -->
<section class="py-24 bg-primary-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-section-header title="Our Teaching Methodology" subtitle="How We Teach">
            A student-centered approach that balances traditional Islamic pedagogy with modern educational practices.
        </x-section-header>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-16">
            @php
                $methods = [
                    ['title' => 'Qur\'an-Centric Learning', 'desc' => 'The Qur\'an is at the heart of our curriculum, guiding all aspects of learning and character development.'],
                    ['title' => 'Interactive Teaching', 'desc' => 'We use modern, interactive teaching methods to engage students and make learning enjoyable.'],
                    ['title' => 'Small Class Sizes', 'desc' => 'We maintain small class sizes to ensure each student receives personalized attention from teachers.'],
                    ['title' => 'Practical Application', 'desc' => 'Students learn to apply their knowledge through projects, community service, and real-world scenarios.'],
                    ['title' => 'Character Building', 'desc' => 'Moral education is woven into every subject, reinforcing Islamic values and good character.'],
                    ['title' => 'Multilingual Instruction', 'desc' => 'Students develop fluency in Arabic, English, and Yoruba, preparing them for a globalized world.'],
                ];
            @endphp

            @foreach ($methods as $method)
                <div class="reveal bg-white rounded-2xl shadow-lg p-8 border border-primary-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                    <div class="w-12 h-12 rounded-xl bg-primary-100 flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-3">{{ $method['title'] }}</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">{{ $method['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center reveal">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Interested in Our Programs?</h2>
        <p class="text-gray-600 mb-8">Contact us to learn more about our academic offerings and how to enroll.</p>
        <a href="{{ route('contact.create') }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-primary-600 text-white font-semibold hover:bg-primary-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1">
            Contact Us
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</section>
@endsection
