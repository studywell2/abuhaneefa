@extends('layouts.app')

@section('title', 'Admissions | Abu Haneefah Islamic Academy')

@section('content')
<!-- Page Header -->
<section class="pt-20 bg-primary-700 text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl sm:text-5xl font-bold mb-4">Admissions</h1>
        <p class="text-primary-200 max-w-2xl mx-auto">Quality Islamic &amp; Secular Education Rooted in Qur'aan and Sunnah.</p>
    </div>
</section>

<!-- Admission Open Banner -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="reveal bg-gradient-to-r from-primary-600 to-primary-800 rounded-3xl p-8 sm:p-12 text-center text-white shadow-2xl">
            <span class="inline-block px-4 py-1.5 rounded-full bg-white/20 text-white text-sm font-semibold mb-4">Admission in Progress</span>
            <h2 class="text-3xl sm:text-4xl font-bold mb-4">Enroll Your Child Today!</h2>
            <p class="text-primary-100 max-w-2xl mx-auto mb-8 leading-relaxed">
                Building Faith, Knowledge &amp; Character for a Better Ummah. Join us in shaping the next generation of Islamic scholars and leaders.
            </p>
            <a href="{{ route('contact.create') }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-white text-primary-700 font-semibold hover:bg-primary-50 transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1">
                Apply Now
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Admission Process -->
<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-section-header title="Admission Process" subtitle="Simple Steps to Enroll">
            Follow these easy steps to secure your child's place at Abu Haneefah Islamic Academy.
        </x-section-header>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mt-16">
            @php
                $steps = [
                    ['step' => '01', 'title' => 'Inquiry', 'desc' => 'Contact us via phone, email, or visit our campus to express your interest.'],
                    ['step' => '02', 'title' => 'Application', 'desc' => 'Fill out the admission form and submit the required documents.'],
                    ['step' => '03', 'title' => 'Assessment', 'desc' => 'Your child will undergo a brief assessment to determine the appropriate level.'],
                    ['step' => '04', 'title' => 'Enrollment', 'desc' => 'Complete the enrollment process and welcome to the Abu Haneefah family!'],
                ];
            @endphp

            @foreach ($steps as $step)
                <div class="reveal relative bg-white rounded-2xl shadow-lg p-8 border border-gray-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                    <div class="text-5xl font-extrabold text-primary-100 mb-3">{{ $step['step'] }}</div>
                    <h3 class="text-lg font-bold text-gray-900 mb-3">{{ $step['title'] }}</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">{{ $step['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Requirements -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="reveal">
                <img src="{{ asset('images/admissions-student.jpg') }}" alt="Admissions"
                     class="rounded-3xl shadow-2xl w-full object-cover">
            </div>
            <div class="reveal">
                <span class="inline-block px-4 py-1.5 rounded-full bg-primary-50 text-primary-600 text-sm font-semibold mb-4">
                    Requirements
                </span>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">What You Need to Apply</h2>
                <ul class="space-y-4">
                    @php
                        $requirements = [
                            'Completed admission form',
                            'Birth certificate or age declaration',
                            'Previous school report card (if applicable)',
                            'Two passport-size photographs',
                            'Medical report (for boarding students)',
                            'Parent/guardian means of identification',
                        ];
                    @endphp
                    @foreach ($requirements as $req)
                        <li class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-primary-100 flex items-center justify-center shrink-0 mt-0.5">
                                <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="text-gray-700">{{ $req }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Programs Available for Admission -->
<section class="py-24 bg-primary-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-section-header title="Programs Available" subtitle="Choose Your Path">
            We offer programs at every educational level, rooted in Islamic values.
        </x-section-header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-16">
            @php
                $programs = [
                    ['name' => 'Comprehensive Arabic Class', 'level' => 'All Levels', 'desc' => 'Full immersion in Arabic language, literature, and Islamic sciences.'],
                    ['name' => 'Ibtidaiyah', 'level' => 'Primary', 'desc' => 'Foundational education combining Qur\'anic studies with core subjects.'],
                    ['name' => 'Idaadiyah', 'level' => 'Junior Secondary', 'desc' => 'Intermediate studies with expanded curriculum in both Islamic and modern sciences.'],
                    ['name' => 'Thanawiyah', 'level' => 'Senior Secondary', 'desc' => 'Advanced program preparing students for university and leadership roles.'],
                    ['name' => 'Adult Arabic Class', 'level' => 'Weekends', 'desc' => 'Flexible weekend classes for adults seeking Islamic and Arabic knowledge.'],
                    ['name' => 'Qur\'an Memorization', 'level' => 'Special Program', 'desc' => 'Dedicated Hifz program with expert teachers and proper Tajweed instruction.'],
                ];
            @endphp

            @foreach ($programs as $program)
                <div class="reveal bg-white rounded-2xl shadow-lg p-8 border border-primary-100 hover:shadow-xl transition-all duration-300 hover:-translate-y-2">
                    <span class="inline-block px-3 py-1 rounded-full bg-primary-100 text-primary-700 text-xs font-semibold mb-4">{{ $program['level'] }}</span>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $program['name'] }}</h3>
                    <p class="text-gray-600 leading-relaxed mb-5">{{ $program['desc'] }}</p>
                    <a href="{{ route('contact.create') }}" class="inline-flex items-center gap-2 text-primary-600 font-semibold text-sm hover:gap-3 transition-all">
                        Apply for this program
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Official Languages -->
<section class="py-20 bg-primary-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-2xl font-bold mb-8 reveal">Official Languages of Instruction</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
            @foreach (['Arabic', 'English', 'Yoruba'] as $lang)
                <div class="reveal bg-primary-600/50 rounded-2xl p-8 border border-primary-500">
                    <p class="text-2xl font-bold">{{ $lang }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center reveal">
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Ready to Begin the Journey?</h2>
        <p class="text-gray-600 mb-8">Contact us today to start the admission process. Our team is ready to assist you.</p>
        <a href="{{ route('contact.create') }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-primary-600 text-white font-semibold hover:bg-primary-700 transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1">
            Start Application
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</section>
@endsection
