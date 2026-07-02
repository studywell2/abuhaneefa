@php
    $navLinks = [
        ['route' => 'home', 'label' => 'Home'],
        ['route' => 'about', 'label' => 'About'],
        ['route' => 'admissions', 'label' => 'Admissions'],
        ['route' => 'academics', 'label' => 'Academics'],
        ['route' => 'gallery', 'label' => 'Gallery'],
        ['route' => 'contact.create', 'label' => 'Contact'],
    ];
    $isHome = request()->routeIs('home');
@endphp

<nav id="navbar"
     class="fixed top-0 left-0 right-0 z-50 transition-all duration-300
     {{ $isHome ? 'bg-transparent' : 'bg-white shadow-md' }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 shrink-0">
                <img src="{{ asset('images/logo.jpg') }}" alt="Abu Haneefah Islamic Academy Logo"
                     class="h-12 w-12 rounded-full object-cover ring-2 ring-primary-500 ring-offset-2">
                <span class="font-bold text-lg leading-tight {{ $isHome ? 'text-white' : 'text-primary-600' }}">
                    Abu Haneefah
                    <span class="block text-xs font-medium {{ $isHome ? 'text-primary-100' : 'text-gray-500' }}">Islamic Academy</span>
                </span>
            </a>

            <!-- Desktop Nav -->
            <div class="hidden lg:flex items-center gap-1">
                @foreach ($navLinks as $link)
                    <a href="{{ route($link['route']) }}"
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200
                       {{ request()->routeIs($link['route'])
                            ? ($isHome ? 'text-white bg-white/15' : 'text-primary-600 bg-primary-50')
                            : ($isHome ? 'text-white/90 hover:text-white hover:bg-white/10' : 'text-gray-600 hover:text-primary-600 hover:bg-primary-50') }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
                <a href="{{ route('contact.create') }}"
                   class="ml-3 inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold
                          bg-primary-600 text-white hover:bg-primary-700 transition-all duration-300
                          shadow-md hover:shadow-lg hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Contact Us
                </a>
            </div>

            <!-- Mobile Hamburger -->
            <button id="nav-toggle" class="lg:hidden p-2 rounded-lg transition-colors
                {{ $isHome ? 'text-white hover:bg-white/10' : 'text-primary-600 hover:bg-primary-50' }}">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="nav-menu" class="hidden lg:hidden border-t border-gray-100 bg-white shadow-lg">
        <div class="px-4 py-4 space-y-1">
            @foreach ($navLinks as $link)
                <a href="{{ route($link['route']) }}"
                   class="block px-4 py-3 rounded-lg text-sm font-medium transition-colors
                   {{ request()->routeIs($link['route']) ? 'text-primary-600 bg-primary-50' : 'text-gray-600 hover:text-primary-600 hover:bg-primary-50' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
            <a href="{{ route('contact.create') }}"
               class="block mt-3 text-center px-5 py-3 rounded-full text-sm font-semibold
                      bg-primary-600 text-white hover:bg-primary-700 transition-colors">
                Contact Us
            </a>
        </div>
    </div>
</nav>
