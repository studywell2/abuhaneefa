@extends('layouts.app')

@section('title', 'Abu Haneefah Islamic Academy | Home')

@section('content')
<!-- Preloader -->
<div id="preloader" class="preloader">
    <div class="preloader-icon-wrapper">
        <div class="preloader-ring"></div>
        <div class="preloader-icon">
            <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 2C10 3.5 9 5 9 7c0 2 1.5 3 3 3s3-1 3-3c0-2-1-3.5-3-5z"/>
                <path d="M4 22V11l8-4 8 4v11"/>
                <path d="M9 22v-4a3 3 0 016 0v4"/>
                <path d="M2 22h2M20 22h2"/>
            </svg>
        </div>
    </div>
    <p class="preloader-text">Abu Haneefah Islamic Academy</p>
</div>

<!-- ==================== HERO SECTION ==================== -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/classroom.jpg') }}" alt="Students in classroom"
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-b from-primary-900/80 via-primary-800/70 to-primary-900/85"></div>
    </div>

    <!-- Hero Content -->
    <div class="relative z-10 text-center px-4 max-w-4xl mx-auto">
        <span class="inline-block px-5 py-2 rounded-full bg-white/15 backdrop-blur-sm text-primary-50 text-sm font-medium mb-6 animate-[fade-in_0.8s_ease-out]">
            بسم الله الرحمن الرحيم
        </span>
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6 animate-[fade-in-up_0.8s_ease-out]">
            Abu Haneefah
            <span class="block text-primary-300">Islamic Academy</span>
        </h1>
        <p class="text-lg sm:text-xl text-primary-100 leading-relaxed mb-10 max-w-2xl mx-auto animate-[fade-in-up_1s_ease-out]">
            Nurturing God-conscious, morally upright, and academically excellent learners who serve humanity with integrity.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 animate-[fade-in-up_1.2s_ease-out]">
            <a href="{{ route('admissions') }}"
               class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-primary-500 text-white font-semibold
                      hover:bg-primary-400 transition-all duration-300 shadow-xl hover:shadow-2xl hover:-translate-y-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                </svg>
                Apply Now
            </a>
            <a href="{{ route('contact.create') }}"
               class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-white/10 backdrop-blur-sm text-white font-semibold
                      border-2 border-white/30 hover:bg-white hover:text-primary-700 transition-all duration-300">
                Contact Us
            </a>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
        <svg class="w-6 h-6 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
        </svg>
    </div>
</section>

<!-- ==================== ABOUT SECTION ==================== -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <!-- Image -->
            <div class="reveal relative">
                <img src="{{ asset('images/students-group.jpg') }}" alt="Students of Abu Haneefah Islamic Academy"
                     class="rounded-3xl shadow-2xl w-full object-cover">
                <div class="absolute -bottom-6 -right-6 bg-primary-600 text-white rounded-2xl p-6 shadow-xl hidden sm:block">
                    <p class="text-3xl font-bold">15+</p>
                    <p class="text-sm text-primary-100">Years of Excellence</p>
                </div>
            </div>
            <!-- Text -->
            <div class="reveal">
                <span class="inline-block px-4 py-1.5 rounded-full bg-primary-50 text-primary-600 text-sm font-semibold mb-4">
                    About Our School
                </span>
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6">
                    Building Faith, Knowledge &amp; Character for a Better Ummah
                </h2>
                <p class="text-gray-600 leading-relaxed mb-5">
                    Abu Haneefah Islamic Academy is a distinguished educational institution committed to
                    providing quality Islamic and contemporary education rooted in the Qur'an and Sunnah.
                    We strive to develop well-rounded individuals who excel spiritually, intellectually,
                    and socially.
                </p>
                <p class="text-gray-600 leading-relaxed mb-8">
                    Our academy integrates traditional Islamic values with modern educational practices,
                    ensuring that our students are prepared for success in both this world and the Hereafter.
                    We offer comprehensive programs from primary to senior secondary levels.
                </p>
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-primary-50 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Qur'an &amp; Sunnah Based</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-primary-50 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Academic Excellence</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-primary-50 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Strong Community</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-primary-50 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-700">Moral Uprightness</span>
                    </div>
                </div>
                <a href="{{ route('about') }}" class="inline-flex items-center gap-2 mt-8 text-primary-600 font-semibold hover:gap-3 transition-all">
                    Learn More About Us
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ==================== MISSION SECTION ==================== -->
<section class="py-24 bg-primary-50 relative overflow-hidden">
    <!-- Decorative Pattern -->
    <div class="absolute top-0 left-0 w-72 h-72 bg-primary-200/30 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-primary-100/40 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <x-section-header title="Our Mission" subtitle="What We Strive For">
            Our commitment to integrating Islamic values with modern education.
        </x-section-header>

        <div class="mt-16 max-w-4xl mx-auto">
            <!-- English Mission -->
            <div class="reveal bg-white rounded-3xl shadow-xl p-8 sm:p-12 border border-primary-100 mb-8">
                <div class="flex justify-center mb-6">
                    <div class="w-16 h-16 rounded-full bg-primary-600 flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-lg sm:text-xl text-gray-700 leading-relaxed text-center font-medium">
                    "To provide sound Islamic and contemporary education that nurtures God-conscious, morally upright, and academically excellent learners who serve humanity with integrity. We are committed to integrating the Qur'an, Sunnah, and modern knowledge to develop responsible Muslims who excel spiritually, intellectually, and socially while preparing them for success in this world and the Hereafter."
                </p>
            </div>

            <!-- Arabic Mission -->
            <div class="reveal bg-primary-700 rounded-3xl shadow-xl p-8 sm:p-12">
                <div class="flex justify-center mb-6">
                    <span class="text-4xl">🕌</span>
                </div>
                <p class="font-arabic text-xl sm:text-2xl text-primary-50 leading-loose text-center" dir="rtl">
                    تقديم تعليم متكامل يجمع بين القيم الإسلامية والمعرفة الحديثة، ويُسهم في بناء شخصية الطالب علمياً وأخلاقياً، وغرس الإيمان، وتنمية العلم، وترسيخ الأخلاق الحميدة في نفوس المتعلمين لإعدادهم أفراداً صالحين في المجتمع.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ==================== VISION SECTION ==================== -->
<section class="py-24 bg-white relative overflow-hidden">
    <div class="absolute top-0 right-0 w-72 h-72 bg-primary-50 rounded-full blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <x-section-header title="Our Vision" subtitle="Where We Are Heading">
            Our aspiration to be a leading Islamic educational institution.
        </x-section-header>

        <div class="mt-16 max-w-4xl mx-auto">
            <!-- English Vision -->
            <div class="reveal bg-gradient-to-br from-primary-600 to-primary-800 rounded-3xl shadow-xl p-8 sm:p-12 mb-8">
                <div class="flex justify-center mb-6">
                    <div class="w-16 h-16 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                </div>
                <p class="text-lg sm:text-xl text-white leading-relaxed text-center font-medium">
                    "To be a leading Islamic educational institution that produces God-fearing, knowledgeable, and responsible leaders who positively impact society by combining strong faith, excellent character, and academic excellence."
                </p>
            </div>

            <!-- Arabic Vision -->
            <div class="reveal bg-primary-50 rounded-3xl shadow-lg p-8 sm:p-12 border border-primary-100">
                <div class="flex justify-center mb-6">
                    <span class="text-4xl">🌙</span>
                </div>
                <p class="font-arabic text-xl sm:text-2xl text-primary-800 leading-loose text-center" dir="rtl">
                    أن نكون مؤسسة تعليمية إسلامية رائدة تُخرّج جيلاً مؤمناً، متميزاً علمياً، وقادراً على خدمة المجتمع بإخلاص، يجمع بين قوة الإيمان، وحسن الخُلُق، والتفوق العلمي.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ==================== WHY CHOOSE US ==================== -->
<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-section-header title="Why Choose Our School" subtitle="Excellence in Every Aspect">
            Discover what makes Abu Aneefah Islamic Academy the right choice for your child's education.
        </x-section-header>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-16">
            <!-- Card 1 -->
            <div class="reveal bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 p-8 hover:-translate-y-2 border border-gray-100">
                <div class="w-14 h-14 rounded-xl bg-primary-100 flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Integrated Curriculum</h3>
                <p class="text-gray-600 leading-relaxed">A balanced blend of Qur'anic studies, Sunnah, and modern sciences ensuring holistic development.</p>
            </div>

            <!-- Card 2 -->
            <div class="reveal bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 p-8 hover:-translate-y-2 border border-gray-100">
                <div class="w-14 h-14 rounded-xl bg-primary-100 flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Qualified Teachers</h3>
                <p class="text-gray-600 leading-relaxed">Experienced and dedicated educators passionate about nurturing both faith and knowledge.</p>
            </div>

            <!-- Card 3 -->
            <div class="reveal bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 p-8 hover:-translate-y-2 border border-gray-100">
                <div class="w-14 h-14 rounded-xl bg-primary-100 flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Moral Development</h3>
                <p class="text-gray-600 leading-relaxed">Strong emphasis on character building and Islamic values in every aspect of learning.</p>
            </div>

            <!-- Card 4 -->
            <div class="reveal bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 p-8 hover:-translate-y-2 border border-gray-100">
                <div class="w-14 h-14 rounded-xl bg-primary-100 flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l9 6 9-6"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Multilingual Education</h3>
                <p class="text-gray-600 leading-relaxed">Instruction in Arabic, English, and Yoruba to prepare students for a connected world.</p>
            </div>

            <!-- Card 5 -->
            <div class="reveal bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 p-8 hover:-translate-y-2 border border-gray-100">
                <div class="w-14 h-14 rounded-xl bg-primary-100 flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Safe Environment</h3>
                <p class="text-gray-600 leading-relaxed">A nurturing and secure Islamic environment where students feel valued and protected.</p>
            </div>

            <!-- Card 6 -->
            <div class="reveal bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 p-8 hover:-translate-y-2 border border-gray-100">
                <div class="w-14 h-14 rounded-xl bg-primary-100 flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Adult Classes</h3>
                <p class="text-gray-600 leading-relaxed">Weekend Arabic classes for adults seeking to deepen their Islamic knowledge.</p>
            </div>
        </div>
    </div>
</section>

<!-- ==================== PROGRAMS SECTION ==================== -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-section-header title="Programs Offered" subtitle="Our Academic Programs">
            Comprehensive educational programs designed to nurture every stage of learning.
        </x-section-header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-16">
            @php
                $programs = [
                    ['title' => 'Comprehensive Arabic Class', 'desc' => 'In-depth study of Arabic language, grammar, and literature for all levels.', 'icon' => 'M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129'],
                    ['title' => 'Ibtidaiyah (Primary)', 'desc' => 'Foundational Islamic and contemporary education for young learners.', 'icon' => 'M12 14l9-5-9-5-9 5 9 5z'],
                    ['title' => 'Idaadiyah (Junior Secondary)', 'desc' => 'Intermediate level combining Islamic studies with modern sciences.', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253'],
                    ['title' => 'Thanawiyah (Senior Secondary)', 'desc' => 'Advanced program preparing students for higher education and leadership.', 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622'],
                    ['title' => 'Adult Arabic Class', 'desc' => 'Weekend classes for adults seeking to learn Arabic and Islamic studies.', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857'],
                    ['title' => 'Qur\'an Memorization', 'desc' => 'Specialized program for Hifz with proper Tajweed and understanding.', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                ];
            @endphp

            @foreach ($programs as $program)
                <div class="reveal group bg-gradient-to-br from-primary-50 to-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 p-8 hover:-translate-y-2 border border-primary-100">
                    <div class="w-14 h-14 rounded-xl bg-primary-600 group-hover:bg-primary-700 transition-colors flex items-center justify-center mb-5">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $program['icon'] }}"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $program['title'] }}</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $program['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ==================== FACILITIES SECTION ==================== -->
<section class="py-24 bg-primary-800 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-primary-800 to-primary-900"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center reveal">
            <span class="inline-block px-4 py-1.5 rounded-full bg-primary-700 text-primary-100 text-sm font-semibold mb-3">
                Our Facilities
            </span>
            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Modern Facilities for Holistic Learning</h2>
            <p class="max-w-2xl mx-auto text-primary-200 leading-relaxed">
                Well-equipped facilities to support both academic and spiritual growth.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-16">
            @php
                $facilities = [
                    ['title' => 'Prayer Hall', 'desc' => 'A dedicated mosque for daily prayers and spiritual activities.'],
                    ['title' => 'Classrooms', 'desc' => 'Comfortable and well-ventilated learning spaces for all levels.'],
                    ['title' => 'Library', 'desc' => 'Extensive collection of Islamic and contemporary educational resources.'],
                    ['title' => 'Sports Ground', 'desc' => 'Open space for physical education and recreational activities.'],
                ];
            @endphp

            @foreach ($facilities as $facility)
                <div class="reveal bg-primary-700/50 backdrop-blur-sm rounded-2xl p-6 border border-primary-600 hover:bg-primary-700 transition-all duration-300 hover:-translate-y-2">
                    <div class="w-12 h-12 rounded-full bg-primary-500/30 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-primary-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h4 class="text-lg font-semibold text-white mb-2">{{ $facility['title'] }}</h4>
                    <p class="text-sm text-primary-200 leading-relaxed">{{ $facility['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ==================== GALLERY PREVIEW ==================== -->
<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-section-header title="Gallery Preview" subtitle="Life at Our Academy">
            A glimpse into the vibrant life and activities at Abu Aneefah Islamic Academy.
        </x-section-header>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mt-16">
            @php
                $galleryImages = [
                    ['src' => 'images/classroom.jpg', 'alt' => 'Students in classroom', 'span' => 'sm:col-span-2 sm:row-span-2'],
                    ['src' => 'images/students-girls.jpg', 'alt' => 'Female students', 'span' => ''],
                    ['src' => 'images/students-group.jpg', 'alt' => 'Students with teacher', 'span' => ''],
                    ['src' => 'images/islamic-architecture.jpg', 'alt' => 'Islamic architecture', 'span' => ''],
                    ['src' => 'images/admissions-student.jpg', 'alt' => 'Admissions', 'span' => ''],
                ];
            @endphp

            @foreach ($galleryImages as $img)
                <div class="reveal group relative overflow-hidden rounded-2xl shadow-md {{ $img['span'] }}">
                    <img src="{{ asset($img['src']) }}" alt="{{ $img['alt'] }}"
                         class="w-full h-48 sm:h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-primary-900/0 group-hover:bg-primary-900/40 transition-all duration-300 flex items-end p-4">
                        <p class="text-white text-sm font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-300">{{ $img['alt'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-12 reveal">
            <a href="{{ route('gallery') }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-primary-600 text-white font-semibold hover:bg-primary-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1">
                View Full Gallery
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- ==================== TESTIMONIALS ==================== -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-section-header title="Testimonials" subtitle="What Parents Say">
            Hear from the families who trust us with their children's education.
        </x-section-header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-16">
            @php
                $testimonials = [
                    ['name' => 'Aisha Mohammed', 'role' => 'Parent', 'text' => 'My children have grown tremendously in both character and knowledge. The teachers truly care about each student\'s spiritual and academic growth.'],
                    ['name' => 'Ibrahim Adeyemi', 'role' => 'Parent', 'text' => 'The integration of Qur\'anic studies with modern education is exactly what we wanted. Abu Haneefah has exceeded our expectations in every way.'],
                    ['name' => 'Fatima Olatunji', 'role' => 'Parent', 'text' => 'The environment is nurturing and safe. My daughter has memorized several Ajza of the Qur\'an while maintaining excellent academic performance.'],
                ];
            @endphp

            @foreach ($testimonials as $testimonial)
                <div class="reveal bg-primary-50 rounded-2xl p-8 shadow-md border border-primary-100">
                    <div class="flex gap-1 mb-4 text-gold-500">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                            </svg>
                        @endfor
                    </div>
                    <p class="text-gray-700 leading-relaxed mb-6 italic">"{{ $testimonial['text'] }}"</p>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-primary-600 flex items-center justify-center">
                            <span class="text-white font-bold text-lg">{{ strtoupper(substr($testimonial['name'], 0, 1)) }}</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">{{ $testimonial['name'] }}</h4>
                            <p class="text-sm text-gray-500">{{ $testimonial['role'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ==================== FAQ SECTION ==================== -->
<section class="py-24 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-section-header title="Frequently Asked Questions" subtitle="Got Questions?">
            Find answers to the most common questions about our academy.
        </x-section-header>

        <div class="mt-16 space-y-4">
            @php
                $faqs = [
                    ['q' => 'What ages does the academy accept?', 'a' => 'We accept students from primary level through senior secondary, as well as adults for our weekend Arabic classes.'],
                    ['q' => 'What languages are used for instruction?', 'a' => 'Our instruction is delivered in three languages: Arabic, English, and Yoruba, ensuring comprehensive learning.'],
                    ['q' => 'Is the academy only for Muslim students?', 'a' => 'While our curriculum is rooted in Islamic values, we welcome all students who wish to benefit from our quality education.'],
                    ['q' => 'How can I apply for admission?', 'a' => 'You can apply by visiting our Admissions page or contacting us directly. Our admissions process is simple and straightforward.'],
                    ['q' => 'Do you offer financial aid or scholarships?', 'a' => 'We believe every child deserves quality education. Please contact our office to discuss available financial assistance options.'],
                ];
            @endphp

            @foreach ($faqs as $faq)
                <div class="reveal bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <details class="group">
                        <summary class="flex items-center justify-between gap-4 p-6 cursor-pointer list-none">
                            <span class="font-semibold text-gray-900">{{ $faq['q'] }}</span>
                            <svg class="w-5 h-5 text-primary-600 shrink-0 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </summary>
                        <div class="px-6 pb-6 text-gray-600 leading-relaxed">
                            {{ $faq['a'] }}
                        </div>
                    </details>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- ==================== CALL TO ACTION ==================== -->
<section class="relative py-24 overflow-hidden">
    <div class="absolute inset-0">
        <img src="{{ asset('images/islamic-architecture.jpg') }}" alt="" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-primary-900/85"></div>
    </div>

    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center reveal">
        <span class="text-5xl block mb-6">🕌</span>
        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6">
            Ready to Give Your Child the Gift of Islamic Education?
        </h2>
        <p class="text-lg text-primary-100 mb-10 max-w-2xl mx-auto leading-relaxed">
            Join the Abu Aneefah Islamic Academy family today. Together, we can build a generation
            of confident, knowledgeable, and God-conscious leaders.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('admissions') }}"
               class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-primary-500 text-white font-semibold hover:bg-primary-400 transition-all duration-300 shadow-xl hover:shadow-2xl hover:-translate-y-1">
                Start Application
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            <a href="mailto:abuaneefah330@gmail.com"
               class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-white/10 backdrop-blur-sm text-white font-semibold border-2 border-white/30 hover:bg-white hover:text-primary-700 transition-all duration-300">
                Email Us
            </a>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    window.addEventListener('load', function () {
        var preloader = document.getElementById('preloader');
        if (preloader) {
            setTimeout(function () {
                preloader.classList.add('hidden');
            }, 600000);
        }
    });
</script>
@endsection
