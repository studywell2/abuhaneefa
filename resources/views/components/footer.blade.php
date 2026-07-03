<footer class="bg-primary-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
            <!-- School Info -->
            <div class="lg:col-span-1">
                <div class="flex items-center gap-3 mb-4">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Logo"
                         class="h-14 w-14 rounded-full object-cover ring-2 ring-primary-400 ring-offset-2 ring-offset-primary-800">
                    <div>
                        <h3 class="font-bold text-lg leading-tight">Abu Haneefah</h3>
                        <p class="text-sm text-primary-200">Islamic Academy</p>
                    </div>
                </div>
                <p class="text-sm text-primary-200 leading-relaxed">
                    Providing sound Islamic and contemporary education that nurtures God-conscious, morally upright, and academically excellent learners.
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="font-semibold text-base mb-4 text-white">Quick Links</h4>
                <ul class="space-y-2.5">
                    <li><a href="{{ route('home') }}" class="text-sm text-primary-200 hover:text-white transition-colors">Home</a></li>
                    <li><a href="{{ route('about') }}" class="text-sm text-primary-200 hover:text-white transition-colors">About Us</a></li>
                    <li><a href="{{ route('admissions') }}" class="text-sm text-primary-200 hover:text-white transition-colors">Admissions</a></li>
                    <li><a href="{{ route('academics') }}" class="text-sm text-primary-200 hover:text-white transition-colors">Academics</a></li>
                    <li><a href="{{ route('gallery') }}" class="text-sm text-primary-200 hover:text-white transition-colors">Gallery</a></li>
                    <li><a href="{{ route('contact.create') }}" class="text-sm text-primary-200 hover:text-white transition-colors">Contact Us</a></li>
                </ul>
            </div>

            <!-- Mission Summary -->
            <div>
                <h4 class="font-semibold text-base mb-4 text-white">Our Mission</h4>
                <p class="text-sm text-primary-200 leading-relaxed">
                    To integrate the Qur'an, Sunnah, and modern knowledge to develop responsible Muslims who excel spiritually, intellectually, and socially.
                </p>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="font-semibold text-base mb-4 text-white">Get in Touch</h4>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-300 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <a href="mailto:abuaneefah330@gmail.com" class="text-sm text-primary-200 hover:text-white transition-colors break-all">
                            abuaneefah330@gmail.com
                        </a>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-primary-300 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <a href="tel:+2348056501115" class="text-sm text-primary-200 hover:text-white transition-colors">
                            +234 805 650 1115
                        </a>
                    </li>
                </ul>

                <!-- Social Icons -->
                <div class="flex items-center gap-3 mt-5">
                    <a href="https://www.facebook.com/SulaimonYusufAbuHaneefah" aria-label="Facebook"
                       class="w-9 h-9 rounded-full bg-primary-700 hover:bg-primary-600 flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    {{-- <a href="#" aria-label="Twitter"
                       class="w-9 h-9 rounded-full bg-primary-700 hover:bg-primary-600 flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.932 4.932 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.937 4.937 0 004.604 3.417 9.868 9.868 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.054 0 13.999-7.496 13.999-13.986 0-.209 0-.42-.015-.63A9.936 9.936 0 0024 4.59z"/>
                        </svg>
                    </a> --}}
                    <a href="https://www.instagram.com/ibnalaroby" aria-label="Instagram"
                       class="w-9 h-9 rounded-full bg-primary-700 hover:bg-primary-600 flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227a3.81 3.81 0 01-.899 1.382 3.744 3.744 0 01-1.38.896c-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421a3.716 3.716 0 01-1.379-.899 3.744 3.744 0 01-.9-1.38c-.165-.42-.359-1.065-.42-2.235-.057-1.266-.07-1.646-.07-4.85s.015-3.585.074-4.85c.061-1.17.255-1.814.42-2.234.21-.57.479-.96.899-1.382.419-.419.81-.679 1.379-.896.42-.166 1.051-.36 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.672c-3.405 0-6.168 2.76-6.168 6.168 0 3.405 2.76 6.168 6.168 6.168s6.168-2.76 6.168-6.168c0-3.405-2.76-6.168-6.168-6.168zm0 10.162a3.992 3.992 0 110-7.985 3.992 3.992 0 010 7.985zm7.836-10.405a1.44 1.44 0 11-2.88 0 1.44 1.44 0 012.88 0z"/>
                        </svg>
                    </a>
                    <a href="https://wa.me/080565011155" aria-label="WhatsApp"
                       class="w-9 h-9 rounded-full bg-primary-700 hover:bg-primary-600 flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.71.306 1.263.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.247-.694.247-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <div class="border-t border-primary-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">
            <p class="text-center text-sm text-primary-300">
                &copy; {{ date('Y') }} Abu Haneefah Islamic Academy. All rights reserved.
            </p>
        </div>
    </div>
</footer>
