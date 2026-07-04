@extends('layouts.app')

@section('title', $profile->full_name . ' | Portfolio')

@section('content')
<div x-data="portfolioApp()" x-init="init()" class="relative">

    <!-- Top Navigation & Mode Toggle -->
    <header class="sticky top-0 z-40 border-b border-darkBorder/60" style="background: rgba(10,10,15,0.85); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);">
        <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">
            <!-- Logo -->
            <a href="#" class="font-outfit font-black text-lg tracking-tight text-white flex items-center gap-1">
                <span class="gradient-text">PORT</span><span class="text-white">FOLIO.</span>
            </a>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center gap-7 text-xs font-semibold text-gray-400 tracking-wide uppercase">
                <a href="#about" class="nav-link hover:text-purpleLight">About</a>
                <a href="#experience" class="nav-link hover:text-purpleLight">Experience</a>
                <a href="#education" class="nav-link hover:text-purpleLight">Education</a>
                <a href="#projects" class="nav-link hover:text-purpleLight">Projects</a>
                <a href="#skills" class="nav-link hover:text-purpleLight">Skills</a>
                <a href="#contact" class="nav-link hover:text-purpleLight">Contact</a>
            </nav>

            <!-- View / Edit Mode Toggle -->
            <div class="flex items-center gap-1 p-1 rounded-xl border border-darkBorder" style="background: #111118;">
                <button @click="editMode = false" 
                        :class="!editMode ? 'bg-purpleAccent text-white shadow-[0_2px_12px_rgba(124,58,237,0.35)]' : 'text-gray-500 hover:text-gray-300'"
                        class="px-3.5 py-1.5 rounded-lg text-[11px] font-semibold tracking-widest uppercase transition-all duration-200 flex items-center gap-1.5">
                    <i data-lucide="eye" class="w-3 h-3"></i> View
                </button>
                <button @click="editMode = true" 
                        :class="editMode ? 'bg-purpleAccent text-white shadow-[0_2px_12px_rgba(124,58,237,0.35)]' : 'text-gray-500 hover:text-gray-300'"
                        class="px-3.5 py-1.5 rounded-lg text-[11px] font-semibold tracking-widest uppercase transition-all duration-200 flex items-center gap-1.5">
                    <i data-lucide="edit" class="w-3 h-3"></i> Edit
                </button>
            </div>
        </div>
    </header>

    <!-- Info banner if Edit Mode is enabled -->
    <div x-show="editMode" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="border-b border-amber-500/20 text-amber-400 py-2.5 text-center text-[11px] font-semibold tracking-widest uppercase"
         style="background: rgba(245,158,11,0.06);">
        <span class="inline-flex items-center gap-2">
            <span class="w-1.5 h-1.5 rounded-full bg-amber-400 badge-live"></span>
            CMS Edit Mode Active — Click section buttons to manage records
        </span>
    </div>

    <!-- HERO SECTION -->
    <section class="relative overflow-hidden min-h-[92vh] flex items-center">
        <!-- Ambient background glows -->
        <div class="absolute top-0 left-0 w-[600px] h-[600px] rounded-full" style="background: radial-gradient(circle, rgba(124,58,237,0.12) 0%, transparent 70%); pointer-events: none;"></div>
        <div class="absolute bottom-0 right-0 w-[400px] h-[400px] rounded-full" style="background: radial-gradient(circle, rgba(167,139,250,0.07) 0%, transparent 70%); pointer-events: none;"></div>
        <div class="absolute inset-0 dot-grid opacity-20 pointer-events-none"></div>

        <div class="max-w-6xl mx-auto px-6 py-24 md:py-32 grid grid-cols-1 md:grid-cols-12 gap-16 items-center relative z-10 w-full">
            <!-- Left Info column -->
            <div class="md:col-span-7 order-2 md:order-1 text-center md:text-left">
                <!-- Edit mode overlay for Hero/Profile -->
                <div x-show="editMode" class="mb-6">
                    <button @click="openProfileModal()" class="btn-primary mx-auto md:mx-0">
                        <i data-lucide="edit" class="w-3.5 h-3.5"></i> Edit Profile Information
                    </button>
                </div>

                <div class="section-tag mb-4">Hello, Welcome</div>
                <h1 class="font-outfit font-black text-5xl sm:text-6xl lg:text-7xl text-white tracking-tight leading-none mb-5" x-text="profile.full_name"></h1>

                <!-- Animated subtitle bar -->
                <div class="flex items-center justify-center md:justify-start gap-3 mb-6">
                    <div class="h-px w-8 bg-purpleAccent/60"></div>
                    <h2 class="font-outfit text-lg sm:text-xl font-medium" style="color:#A78BFA;" x-text="profile.headline"></h2>
                </div>

                <p class="text-gray-400 leading-relaxed mb-10 max-w-xl text-[15px]" x-text="profile.short_description"></p>

                <!-- Social links -->
                <div class="flex flex-wrap justify-center md:justify-start items-center gap-3">
                    <!-- GitHub -->
                    <a x-show="profile.github" :href="profile.github" target="_blank"
                       class="group flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-white text-xs font-semibold transition-all duration-200"
                       style="background:#111118; border:1px solid #2D2D3A;"
                       onmouseover="this.style.borderColor='rgba(124,58,237,0.6)'; this.style.background='#16161F';" 
                       onmouseout="this.style.borderColor='#2D2D3A'; this.style.background='#111118';"
                       title="GitHub">
                        <svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12z"/>
                        </svg>
                        GitHub
                    </a>

                    <!-- LinkedIn -->
                    <a x-show="profile.linkedin" :href="profile.linkedin" target="_blank"
                       class="group flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-white text-xs font-semibold transition-all duration-200"
                       style="background:#111118; border:1px solid #2D2D3A;"
                       onmouseover="this.style.borderColor='rgba(10,102,194,0.7)'; this.style.background='#16161F';" 
                       onmouseout="this.style.borderColor='#2D2D3A'; this.style.background='#111118';"
                       title="LinkedIn">
                        <svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                        LinkedIn
                    </a>

                    <!-- Instagram -->
                    <a x-show="profile.instagram" :href="profile.instagram" target="_blank"
                       class="group flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-white text-xs font-semibold transition-all duration-200"
                       style="background:#111118; border:1px solid #2D2D3A;"
                       onmouseover="this.style.borderColor='rgba(225,48,108,0.6)'; this.style.background='#16161F';" 
                       onmouseout="this.style.borderColor='#2D2D3A'; this.style.background='#111118';"
                       title="Instagram">
                        <svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/>
                        </svg>
                        Instagram
                    </a>

                    <!-- Contact Me -->
                    <a x-show="profile.email" :href="'mailto:' + profile.email"
                       class="flex items-center gap-2.5 px-4 py-2.5 rounded-xl text-white text-xs font-semibold transition-all duration-200 btn-primary"
                       title="Email">
                        <svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                        </svg>
                        Contact Me
                    </a>
                </div>
            </div>

            <!-- Right Photo column -->
            <div class="md:col-span-5 order-1 md:order-2 flex justify-center">
                <div class="relative animate-float">
                    <!-- Outer ring -->
                    <div class="absolute -inset-4 rounded-full opacity-20" style="background: conic-gradient(from 0deg, #7C3AED, #A78BFA, #C084FC, #7C3AED); animation: spin 8s linear infinite;"></div>
                    <!-- Inner ring glow -->
                    <div class="absolute -inset-2 rounded-full" style="background: radial-gradient(circle, rgba(124,58,237,0.35) 0%, transparent 70%);"></div>
                    <div class="w-60 h-60 md:w-72 md:h-72 rounded-full overflow-hidden relative" style="border: 3px solid rgba(124,58,237,0.6); box-shadow: 0 0 40px rgba(124,58,237,0.4), inset 0 0 30px rgba(124,58,237,0.05);">
                        <template x-if="profile.photo_url">
                            <img :src="profile.photo_url" alt="Profile photo" class="w-full h-full object-cover">
                        </template>
                        <template x-if="!profile.photo_url">
                            <div class="w-full h-full flex items-center justify-center" style="background: linear-gradient(135deg, #111118, #1a1a2e);">
                                <i data-lucide="user" class="w-20 h-20" style="color: rgba(124,58,237,0.5);"></i>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-1.5 opacity-30">
            <span class="text-[10px] font-semibold tracking-widest uppercase text-gray-400">Scroll</span>
            <div class="w-px h-8" style="background: linear-gradient(to bottom, transparent, #7C3AED);"></div>
        </div>
    </section>
    <style>
        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
    </style>

    <style>
        /* ========== SCROLL REVEAL ========== */
        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ========== BENTO CARD HEIGHT ========== */
        @media (min-width: 768px) {
            .bento-tall { min-height: 240px; }
            .bento-short { min-height: 160px; }
        }

        /* ========== EDUCATION CARD ========== */
        .edu-card {
            background: #111118;
            border: 1px solid #1E1E2E;
            border-radius: 20px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .edu-card:hover {
            border-color: rgba(124,58,237,0.45);
            box-shadow: 0 6px 32px rgba(124,58,237,0.1);
            transform: translateY(-2px);
        }

        /* ========== CERT CARD ========== */
        .cert-card {
            background: #111118;
            border: 1px solid #1E1E2E;
            border-radius: 20px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .cert-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 2px;
            background: linear-gradient(90deg, #7C3AED, #A78BFA, #F59E0B);
            opacity: 0;
            transition: opacity 0.3s;
        }
        .cert-card:hover::before { opacity: 1; }
        .cert-card:hover {
            border-color: rgba(124,58,237,0.35);
            box-shadow: 0 8px 40px rgba(124,58,237,0.1);
        }

        /* ========== HERO TYPING CURSOR ========== */
        .hero-title-cursor::after {
            content: '';
            display: inline-block;
            width: 3px;
            height: 0.85em;
            background: #7C3AED;
            margin-left: 4px;
            vertical-align: middle;
            animation: blink 1s step-end infinite;
        }
        @keyframes blink { 0%, 100% { opacity: 1; } 50% { opacity: 0; } }
    </style>

    <script>
        // Scroll reveal observer
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

            document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
        });
    </script>

    <!-- ABOUT SECTION -->
    <section id="about" class="py-24 border-t border-darkBorder relative" style="background:#0C0C12;">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-14">
                <div>
                    <div class="section-tag">About Me</div>
                    <h2 class="font-outfit font-black text-4xl text-white">Professional <span class="gradient-text">Overview</span></h2>
                </div>
                <!-- Quick badges -->
                <div class="flex flex-wrap gap-2">
                    <div class="flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-semibold" style="color:#A78BFA; background: rgba(124,58,237,0.08); border: 1px solid rgba(124,58,237,0.2);">
                        <i data-lucide="graduation-cap" class="w-3.5 h-3.5"></i> Telkom University
                    </div>
                    <div class="flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-semibold" style="color:#34D399; background: rgba(16,185,129,0.08); border: 1px solid rgba(16,185,129,0.2);">
                        <i data-lucide="award" class="w-3.5 h-3.5"></i> BNSP Certified
                    </div>
                    <div class="flex items-center gap-2 px-3.5 py-2 rounded-xl text-xs font-semibold" style="color:#60A5FA; background: rgba(59,130,246,0.08); border: 1px solid rgba(59,130,246,0.2);">
                        <i data-lucide="palette" class="w-3.5 h-3.5"></i> Creative Designer
                    </div>
                </div>
            </div>

            <!-- BENTO GRID LAYOUT -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4">

                <!-- Bio card — Large -->
                <div class="md:col-span-8 rounded-2xl p-8 relative overflow-hidden" style="background:#111118; border:1px solid #1E1E2E; min-height:220px;">
                    <div class="absolute top-0 right-0 w-40 h-40 rounded-full opacity-10" style="background: radial-gradient(circle, #7C3AED 0%, transparent 70%);"></div>
                    <div class="text-[10px] font-bold text-gray-600 uppercase tracking-widest mb-4">Bio</div>
                    <p class="text-gray-300 leading-loose text-[15px] relative z-10" x-text="profile.short_description"></p>
                </div>

                <!-- Location card -->
                <div class="md:col-span-4 rounded-2xl p-6 flex flex-col justify-between" style="background:#111118; border:1px solid #1E1E2E;">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-4" style="background:rgba(59,130,246,0.1); border:1px solid rgba(59,130,246,0.25); color:#60A5FA;">
                        <i data-lucide="map-pin" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <div class="text-[10px] font-bold text-gray-600 uppercase tracking-widest mb-1">Based In</div>
                        <div class="text-white font-semibold text-sm" x-text="profile.location || 'Indonesia'"></div>
                    </div>
                </div>

                <!-- Email card -->
                <div class="md:col-span-4 rounded-2xl p-6 flex flex-col justify-between group" style="background:#111118; border:1px solid #1E1E2E;">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-4" style="background:rgba(124,58,237,0.1); border:1px solid rgba(124,58,237,0.25); color:#A78BFA;">
                        <i data-lucide="mail" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <div class="text-[10px] font-bold text-gray-600 uppercase tracking-widest mb-1">Email</div>
                        <a :href="'mailto:' + profile.email" class="text-sm font-semibold hover:text-purpleLight transition-colors break-all" style="color:#E5E7EB;" x-text="profile.email"></a>
                    </div>
                </div>

                <!-- Phone card -->
                <div x-show="profile.phone_number" class="md:col-span-4 rounded-2xl p-6 flex flex-col justify-between" style="background:#111118; border:1px solid #1E1E2E;">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-4" style="background:rgba(16,185,129,0.1); border:1px solid rgba(16,185,129,0.25); color:#34D399;">
                        <i data-lucide="phone" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <div class="text-[10px] font-bold text-gray-600 uppercase tracking-widest mb-1">Phone</div>
                        <div class="text-white font-semibold text-sm" x-text="profile.phone_number"></div>
                    </div>
                </div>

                <!-- University highlight card -->
                <div class="md:col-span-4 rounded-2xl p-6 relative overflow-hidden" style="background: linear-gradient(135deg, rgba(124,58,237,0.15) 0%, rgba(124,58,237,0.03) 100%); border:1px solid rgba(124,58,237,0.3);">
                    <div class="absolute -bottom-4 -right-4 w-24 h-24 rounded-full opacity-20" style="background: #7C3AED;"></div>
                    <div class="text-[10px] font-bold uppercase tracking-widest mb-3" style="color:#7C3AED;">Institution</div>
                    <div class="font-outfit font-black text-2xl text-white leading-tight">Telkom<br>University</div>
                    <div class="text-[11px] text-gray-400 mt-2">Bandung, West Java</div>
                </div>

            </div>
        </div>
    </section>

    <!-- EXPERIENCE SECTION -->
    <section id="experience" class="py-24 border-t border-darkBorder relative">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex items-start justify-between mb-14">
                <div>
                    <div class="section-tag">Career</div>
                    <h2 class="font-outfit font-black text-4xl text-white">Work <span class="gradient-text">Experience</span></h2>
                </div>
                <div x-show="editMode">
                    <button @click="openExperienceModal('add')" class="btn-primary">
                        <i data-lucide="plus" class="w-3.5 h-3.5"></i> Add Experience
                    </button>
                </div>
            </div>

            <!-- Timeline with counter -->
            <div class="relative">
                <!-- Vertical line -->
                <div class="absolute left-7 top-0 bottom-0 w-px hidden md:block" style="background: linear-gradient(to bottom, rgba(124,58,237,0.6) 0%, rgba(124,58,237,0.1) 100%);"></div>

                <template x-if="experiences.length === 0">
                    <div class="text-gray-500 text-sm py-8">No work experiences added yet.</div>
                </template>

                <div class="space-y-6">
                    <template x-for="(item, index) in experiences" :key="item.id">
                        <div class="flex gap-8 items-start">
                            <!-- Step number bubble -->
                            <div class="hidden md:flex flex-shrink-0 w-14 h-14 rounded-2xl items-center justify-center font-outfit font-black text-lg relative z-10" 
                                 style="background: linear-gradient(135deg, #7C3AED, #5B21B6); box-shadow: 0 0 20px rgba(124,58,237,0.4); color:white;" 
                                 x-text="String(index + 1).padStart(2, '0')">
                            </div>

                            <!-- Card -->
                            <div class="flex-grow rounded-2xl p-6 card-hover group" style="background:#111118; border:1px solid #1E1E2E;">
                                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-4">
                                    <div>
                                        <h3 class="text-base font-bold text-white mb-1" x-text="item.position"></h3>
                                        <span class="text-sm font-semibold" style="color:#A78BFA;" x-text="item.institution"></span>
                                    </div>
                                    <div class="flex items-center gap-2 flex-shrink-0">
                                        <span class="text-[11px] text-gray-400 font-medium px-3 py-1.5 rounded-lg" 
                                              style="background: rgba(124,58,237,0.08); border: 1px solid rgba(124,58,237,0.2);"
                                              x-text="formatDate(item.start_date) + ' — ' + formatDate(item.end_date)"></span>
                                        <div x-show="editMode" class="flex gap-1.5">
                                            <button @click="openExperienceModal('edit', item)" class="btn-icon-yellow" title="Edit">
                                                <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                            </button>
                                            <button @click="deleteItem('experience', item.id)" class="btn-icon-red" title="Delete">
                                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-400 leading-relaxed whitespace-pre-line" x-text="item.description"></p>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </section>

    <!-- EDUCATION SECTION -->
    <section id="education" class="py-24 border-t border-darkBorder relative" style="background:#0C0C12;">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex items-start justify-between mb-14">
                <div>
                    <div class="section-tag">Background</div>
                    <h2 class="font-outfit font-black text-4xl text-white">Education &amp; <span class="gradient-text">Certifications</span></h2>
                </div>
                <!-- Add Education button in Edit Mode -->
                <div x-show="editMode">
                    <button @click="openEducationModal('add')" class="btn-primary">
                        <i data-lucide="plus" class="w-3.5 h-3.5"></i> Add Education
                    </button>
                </div>
            </div>

            <!-- Two-column grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                
                <!-- Left Column: Education History -->
                <div class="lg:col-span-5 space-y-5">
                    <!-- Column header -->
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-6 h-6 rounded-lg flex items-center justify-center" style="background:rgba(124,58,237,0.15); border:1px solid rgba(124,58,237,0.3);">
                            <i data-lucide="graduation-cap" class="w-3.5 h-3.5" style="color:#A78BFA;"></i>
                        </div>
                        <span class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Education History</span>
                    </div>
                    
                    <template x-if="educations.length === 0">
                        <div class="text-gray-500 text-sm pl-2">No education records added yet.</div>
                    </template>
                    
                    <template x-for="item in educations" :key="item.id">
                        <div class="edu-card p-5 relative group flex gap-4">
                            <!-- Logo Box -->
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 rounded-xl flex items-center justify-center font-bold text-xs text-white shadow-lg"
                                     :class="item.logo_bg || 'bg-purpleAccent'"
                                     x-text="item.logo_text || 'EDU'">
                                </div>
                            </div>
                            
                            <!-- Card Info -->
                            <div class="flex-grow">
                                <div class="flex justify-between items-start mb-1">
                                    <div>
                                        <h4 class="font-bold text-white text-base" x-text="item.institution"></h4>
                                        <div class="text-[10px] text-gray-500 font-medium" x-text="formatDate(item.start_date) + ' - ' + formatDate(item.end_date)"></div>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-300 font-medium leading-relaxed mt-2" x-text="item.degree"></p>
                                
                                <template x-if="item.description">
                                    <p class="text-xs text-gray-400 mt-2 whitespace-pre-line" x-text="item.description"></p>
                                </template>
                                
                                <!-- NIM, Angkatan, Dosen Wali details -->
                                <template x-if="item.nim || item.angkatan || item.dosen_wali">
                                    <div class="mt-3 text-[11px] text-gray-400 space-y-0.5 bg-[#101010]/80 border border-darkBorder/60 rounded-xl p-3">
                                        <template x-if="item.nim">
                                            <div>NIM: <span class="text-white font-medium" x-text="item.nim"></span></div>
                                        </template>
                                        <template x-if="item.angkatan">
                                            <div>Angkatan: <span class="text-white font-medium" x-text="item.angkatan"></span></div>
                                        </template>
                                        <template x-if="item.dosen_wali">
                                            <div>Dosen Wali: <span class="text-white font-medium" x-text="item.dosen_wali"></span></div>
                                        </template>
                                    </div>
                                </template>
                                
                                <!-- GPA, EPRT, TAK scores -->
                                <template x-if="item.gpa || item.eprt || item.tak">
                                    <div class="grid grid-cols-3 gap-2 mt-4 border-t border-darkBorder pt-4">
                                        <template x-if="item.gpa">
                                            <div class="border border-darkBorder bg-[#0D0D0D]/65 rounded-xl p-2.5 text-center flex flex-col justify-center items-center">
                                                <span class="text-sm font-bold text-white" x-text="item.gpa"></span>
                                                <span class="text-[8px] font-bold text-gray-500 uppercase tracking-wider mt-0.5">GPA</span>
                                            </div>
                                        </template>
                                        <template x-if="item.eprt">
                                            <div class="border border-darkBorder bg-[#0D0D0D]/65 rounded-xl p-2.5 text-center flex flex-col justify-center items-center">
                                                <span class="text-sm font-bold text-white" x-text="item.eprt"></span>
                                                <span class="text-[8px] font-bold text-gray-500 uppercase tracking-wider mt-0.5">EPRT</span>
                                            </div>
                                        </template>
                                        <template x-if="item.tak">
                                            <div class="border border-darkBorder bg-[#0D0D0D]/65 rounded-xl p-2.5 text-center flex flex-col justify-center items-center">
                                                <span class="text-sm font-bold text-white" x-text="item.tak"></span>
                                                <span class="text-[8px] font-bold text-gray-500 uppercase tracking-wider mt-0.5">TAK SCORE</span>
                                            </div>
                                        </template>
                                    </div>
                                </template>
                                
                                <!-- Final Grade badge for High School -->
                                <template x-if="item.final_grade">
                                    <div class="mt-4 border-t border-darkBorder pt-3">
                                        <div class="bg-[#121212] border border-darkBorder px-3 py-1.5 rounded-xl text-[10px] font-bold text-gray-400 inline-block w-fit">
                                            Final Grade: <span class="text-white ml-0.5" x-text="item.final_grade"></span>
                                        </div>
                                    </div>
                                </template>
                            </div>
                            
                            <!-- Edit/Delete overlay buttons in Edit Mode -->
                            <div x-show="editMode" class="absolute top-4 right-4 flex gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity duration-200 bg-darkCard/95 border border-darkBorder p-1 rounded-lg shadow-lg">
                                <button @click="openEducationModal('edit', item)" class="p-1 text-yellow-500 hover:bg-yellow-500 hover:text-white rounded transition-colors duration-150">
                                    <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                </button>
                                <button @click="deleteItem('education', item.id)" class="p-1 text-red-500 hover:bg-red-500 hover:text-white rounded transition-colors duration-150">
                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
                
                <!-- Right Column: Professional Credential -->
                <div class="lg:col-span-7 space-y-5">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-6 h-6 rounded-lg flex items-center justify-center" style="background:rgba(245,158,11,0.12); border:1px solid rgba(245,158,11,0.3);">
                                <i data-lucide="award" class="w-3.5 h-3.5" style="color:#F59E0B;"></i>
                            </div>
                            <span class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Professional Credentials</span>
                        </div>
                        <!-- Add Certificate button in Edit Mode -->
                        <div x-show="editMode">
                            <button @click="openCertificationModal('add')" class="px-3.5 py-1.5 bg-purpleAccent text-white text-xs font-semibold rounded-lg hover:bg-purpleHover flex items-center gap-1.5 transition-all duration-200">
                                <i data-lucide="plus" class="w-3.5 h-3.5"></i> Add Certification
                            </button>
                        </div>
                    </div>
                    
                    <template x-if="certifications.length === 0">
                        <div class="text-gray-500 text-sm pl-2">No professional credentials added yet.</div>
                    </template>
                    
                    <template x-for="item in certifications" :key="item.id">
                        <div class="cert-card p-6 relative flex flex-col group">
                            <!-- Credential Top Row -->
                            <div class="flex flex-col sm:flex-row justify-between items-start gap-4 pb-4 border-b border-darkBorder">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/25 flex items-center justify-center text-amber-500 shadow-[0_0_15px_rgba(245,158,11,0.15)] flex-shrink-0">
                                        <i data-lucide="award" class="w-6 h-6"></i>
                                    </div>
                                    <div>
                                        <div class="text-[9px] font-bold text-amber-500 uppercase tracking-widest">Official Certification</div>
                                        <h4 class="font-bold text-white text-lg" x-text="item.title"></h4>
                                    </div>
                                </div>
                                
                                <a x-show="item.credential_url" :href="item.credential_url" target="_blank" 
                                   class="btn-primary flex-shrink-0" style="font-size:11px;">
                                    <i data-lucide="external-link" class="w-3.5 h-3.5"></i> View Certificate
                                </a>
                            </div>
                            
                            <!-- Content Details -->
                            <div class="mt-6 flex-grow">
                                <h5 class="text-base font-bold text-white mb-2" x-text="item.sub_title"></h5>
                                <p class="text-xs text-gray-400 leading-relaxed mb-4">
                                    Issued by <span class="text-gray-300 font-semibold" x-text="item.issuer"></span>
                                </p>
                                
                                <div class="text-[10px] text-gray-500 font-semibold mb-4 flex items-center gap-1.5">
                                    <i data-lucide="calendar" class="w-3.5 h-3.5 text-gray-500"></i> Valid: <span x-text="formatDate(item.start_date) + (item.end_date ? ' - ' + formatDate(item.end_date) : ' - Present')"></span>
                                </div>
                                
                                <template x-if="item.description">
                                    <p class="text-xs text-gray-400 leading-relaxed" x-text="item.description"></p>
                                </template>
                            </div>
                            
                            <!-- Tags at Bottom -->
                            <template x-if="item.skills && item.skills.length > 0">
                                <div class="flex flex-wrap gap-2 mt-6 pt-6 border-t border-darkBorder">
                                    <template x-for="skill in item.skills" :key="skill">
                                        <span class="bg-[#121212] border border-darkBorder px-3 py-1.5 rounded-full text-[10px] text-gray-300 font-semibold flex items-center gap-1.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            <span x-text="skill"></span>
                                        </span>
                                    </template>
                                </div>
                            </template>
                            
                            <!-- Edit/Delete overlay buttons in Edit Mode -->
                            <div x-show="editMode" class="absolute top-4 right-4 flex gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity duration-200 bg-darkCard/95 border border-darkBorder p-1 rounded-lg shadow-lg">
                                <button @click="openCertificationModal('edit', item)" class="p-1 text-yellow-500 hover:bg-yellow-500 hover:text-white rounded transition-colors duration-150">
                                    <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                </button>
                                <button @click="deleteItem('certification', item.id)" class="p-1 text-red-500 hover:bg-red-500 hover:text-white rounded transition-colors duration-150">
                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </section>

    <!-- PROJECTS SECTION -->
    <section id="projects" class="py-24 border-t border-darkBorder relative">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-12">
                <div>
                    <div class="section-tag">Portfolio</div>
                    <h2 class="font-outfit font-black text-4xl text-white">Projects <span class="gradient-text">Showcase</span></h2>
                </div>
                <!-- Add Project button in Edit Mode -->
                <div x-show="editMode">
                    <button @click="openProjectModal('add')" class="btn-primary">
                        <i data-lucide="plus" class="w-3.5 h-3.5"></i> Add Project
                    </button>
                </div>
            </div>

            <!-- Category Filter Tabs -->
            <div class="flex flex-wrap items-center gap-2 mb-10">
                <button @click="categoryFilter = 'all'" :class="categoryFilter === 'all' ? 'text-white border-purpleAccent' : 'text-gray-500 border-darkBorder hover:text-gray-300 hover:border-gray-500'" 
                        class="px-5 py-2 text-[11px] font-bold uppercase tracking-widest rounded-full border transition-all duration-200"
                        :style="categoryFilter === 'all' ? 'background: rgba(124,58,237,0.15);' : 'background: transparent;'">
                    All
                </button>
                <button @click="categoryFilter = '3D Art'" :class="categoryFilter === '3D Art' ? 'text-white border-purpleAccent' : 'text-gray-500 border-darkBorder hover:text-gray-300 hover:border-gray-500'" 
                        class="px-5 py-2 text-[11px] font-bold uppercase tracking-widest rounded-full border transition-all duration-200"
                        :style="categoryFilter === '3D Art' ? 'background: rgba(124,58,237,0.15);' : 'background: transparent;'">
                    3D Art
                </button>
                <button @click="categoryFilter = 'Graphic Design'" :class="categoryFilter === 'Graphic Design' ? 'text-white border-purpleAccent' : 'text-gray-500 border-darkBorder hover:text-gray-300 hover:border-gray-500'" 
                        class="px-5 py-2 text-[11px] font-bold uppercase tracking-widest rounded-full border transition-all duration-200"
                        :style="categoryFilter === 'Graphic Design' ? 'background: rgba(124,58,237,0.15);' : 'background: transparent;'">
                    Graphic Design
                </button>
                <button @click="categoryFilter = 'Full Stack Dev'" :class="categoryFilter === 'Full Stack Dev' ? 'text-white border-purpleAccent' : 'text-gray-500 border-darkBorder hover:text-gray-300 hover:border-gray-500'" 
                        class="px-5 py-2 text-[11px] font-bold uppercase tracking-widest rounded-full border transition-all duration-200"
                        :style="categoryFilter === 'Full Stack Dev' ? 'background: rgba(124,58,237,0.15);' : 'background: transparent;'">
                    Full Stack Dev
                </button>
            </div>

            <!-- Grid of Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <template x-if="filteredProjects().length === 0">
                    <div class="col-span-full text-center text-gray-500 text-sm py-12">No projects found in this category.</div>
                </template>
                <template x-for="item in filteredProjects()" :key="item.id">
                    <div class="rounded-2xl overflow-hidden card-hover flex flex-col justify-between group" style="background:#111118; border:1px solid #1E1E2E;">
                        
                        <!-- Card top body -->
                        <div>
                            <!-- Thumbnail with default state -->
                            <div class="relative h-48 w-full overflow-hidden border-b" style="background:#0A0A0F; border-color:#1E1E2E;">
                                <template x-if="item.thumbnail_url">
                                    <img :src="item.thumbnail_url" alt="Project thumbnail" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </template>
                                <template x-if="!item.thumbnail_url">
                                    <div class="w-full h-full flex flex-col justify-center items-center gap-2 p-6" style="background: linear-gradient(135deg, rgba(124,58,237,0.1) 0%, #0A0A0F 100%);">
                                        <i data-lucide="code-xml" class="w-10 h-10" style="color: rgba(124,58,237,0.4);"></i>
                                        <span class="font-outfit text-xs font-bold text-gray-500 tracking-widest uppercase" x-text="item.project_name"></span>
                                    </div>
                                </template>

                                <!-- Edit Mode actions overlay -->
                                <div x-show="editMode" class="absolute inset-0 bg-black/70 opacity-0 group-hover:opacity-100 flex items-center justify-center gap-2 transition-all duration-200">
                                    <button @click="openProjectModal('edit', item)" class="px-3 py-2 rounded-lg text-xs font-bold flex items-center gap-1.5 transition-all" style="background:#EAB308; color:white;">
                                        <i data-lucide="edit-2" class="w-3.5 h-3.5"></i> Edit
                                    </button>
                                    <button @click="deleteItem('project', item.id)" class="px-3 py-2 rounded-lg text-xs font-bold flex items-center gap-1.5 transition-all" style="background:#EF4444; color:white;">
                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i> Delete
                                    </button>
                                </div>
                            </div>

                            <div class="p-5">
                                <h3 class="text-base font-bold text-white mb-1.5 group-hover:text-purpleLight transition-colors duration-200" x-text="item.project_name"></h3>
                                <p class="text-sm text-gray-400 leading-relaxed line-clamp-3 mb-4" x-text="item.description"></p>
                                
                                <!-- Tech badges -->
                                <div class="flex flex-wrap gap-1.5">
                                    <template x-for="tag in item.tech_stack" :key="tag">
                                        <span class="text-[11px] font-semibold px-2.5 py-1 rounded-lg" style="color:#A78BFA; background:rgba(124,58,237,0.1); border:1px solid rgba(124,58,237,0.2);" x-text="tag"></span>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <!-- Card footer actions -->
                        <div class="px-5 pb-5 pt-1 flex gap-3 mt-auto">
                            <a x-show="item.project_url" :href="item.project_url" target="_blank" class="btn-primary flex-1 justify-center">
                                <i data-lucide="external-link" class="w-3.5 h-3.5"></i> Visit
                            </a>
                            <a x-show="item.github_url" :href="item.github_url" target="_blank" class="btn-ghost">
                                <i data-lucide="github" class="w-3.5 h-3.5"></i> Code
                            </a>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </section>

    <!-- SKILLS SECTION -->
    <section id="skills" class="py-24 border-t border-darkBorder relative" style="background:#0C0C12;">
        <div class="max-w-6xl mx-auto px-6">
            <div class="flex items-start justify-between mb-12">
                <div>
                    <div class="section-tag">Expertise</div>
                    <h2 class="font-outfit font-black text-4xl text-white">Skills &amp; <span class="gradient-text">Technologies</span></h2>
                </div>
                <!-- Add Skill button in Edit Mode -->
                <div x-show="editMode">
                    <button @click="openSkillModal('add')" class="btn-primary">
                        <i data-lucide="plus" class="w-3.5 h-3.5"></i> Add Skill
                    </button>
                </div>
            </div>

            <!-- Group skills by categories -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <template x-for="category in getSkillCategories()" :key="category">
                    <div class="rounded-2xl p-6 flex flex-col justify-between min-h-[280px] card-hover" style="background:#111118; border:1px solid #1E1E2E;">
                        <div>
                            <!-- Icon Box with gradient -->
                            <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-5" style="background: linear-gradient(135deg, rgba(124,58,237,0.2), rgba(124,58,237,0.05)); border: 1px solid rgba(124,58,237,0.3); color:#A78BFA; box-shadow: 0 0 20px rgba(124,58,237,0.15);">
                                <i :data-lucide="getCategoryDetails(category).icon" class="w-5 h-5"></i>
                            </div>
                            
                            <!-- Title & Description -->
                            <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-1.5" x-text="getCategoryDetails(category).title"></h3>
                            <p class="text-xs text-gray-500 mb-5 leading-relaxed min-h-[36px]" x-text="getCategoryDetails(category).description"></p>
                        </div>
                        
                        <!-- Skill Tags -->
                        <div class="flex flex-wrap gap-2 mt-auto">
                            <template x-for="item in getSkillsByCategory(category)" :key="item.id">
                                <div class="relative group">
                                    <div class="skill-tag">
                                        <span x-text="item.skill_name"></span>
                                        <span class="text-[9px] px-1.5 py-0.5 rounded-full font-bold uppercase" style="color:#6B7280; background:#0A0A0F;" x-text="item.level"></span>
                                    </div>
                                    
                                    <!-- Edit/Delete overlay buttons in Edit Mode -->
                                    <div x-show="editMode" class="absolute -top-3 -right-2 hidden group-hover:flex items-center gap-0.5 bg-darkCard/95 border border-darkBorder p-1 rounded-lg shadow-lg">
                                        <button @click="openSkillModal('edit', item)" class="p-1 text-yellow-500 hover:bg-yellow-500 hover:text-white rounded transition-colors duration-150">
                                            <i data-lucide="edit-2" class="w-3 h-3"></i>
                                        </button>
                                        <button @click="deleteItem('skill', item.id)" class="p-1 text-red-500 hover:bg-red-500 hover:text-white rounded transition-colors duration-150">
                                            <i data-lucide="trash-2" class="w-3 h-3"></i>
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>
                <template x-if="skills.length === 0">
                    <div class="col-span-full text-center text-gray-500 text-sm py-12">No skills added yet.</div>
                </template>
            </div>
        </div>
    </section>

    <!-- CONTACT SECTION -->
    <section id="contact" class="py-24 border-t border-darkBorder relative">
        <div class="absolute inset-0 dot-grid opacity-15 pointer-events-none"></div>
        <div class="max-w-6xl mx-auto px-6 relative z-10">
            <div class="text-center mb-14">
                <div class="section-tag mx-auto" style="justify-content:center;">Contact</div>
                <h2 class="font-outfit font-black text-4xl text-white mt-1">Get In <span class="gradient-text">Touch</span></h2>
                <p class="text-gray-500 text-sm mt-3 max-w-md mx-auto">Feel free to reach out for collaborations, opportunities, or just to say hello.</p>
            </div>

            <!-- Three-column contact cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 max-w-3xl mx-auto">
                <!-- Email -->
                <a :href="'mailto:' + profile.email" class="group flex flex-col items-center gap-4 p-7 rounded-2xl text-center card-hover cursor-pointer" style="background:#111118; border:1px solid #1E1E2E;">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center transition-all duration-200" style="background: linear-gradient(135deg, rgba(124,58,237,0.2), rgba(124,58,237,0.05)); border: 1px solid rgba(124,58,237,0.3); color:#A78BFA;">
                        <i data-lucide="mail" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <span class="text-[10px] text-gray-500 uppercase tracking-widest font-bold block mb-1">Email</span>
                        <span class="text-gray-200 text-xs group-hover:text-purpleLight transition-colors break-all" x-text="profile.email"></span>
                    </div>
                </a>

                <!-- Phone -->
                <div x-show="profile.phone_number" class="flex flex-col items-center gap-4 p-7 rounded-2xl text-center card-hover" style="background:#111118; border:1px solid #1E1E2E;">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center" style="background: linear-gradient(135deg, rgba(16,185,129,0.15), rgba(16,185,129,0.03)); border: 1px solid rgba(16,185,129,0.25); color:#34D399;">
                        <i data-lucide="phone" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <span class="text-[10px] text-gray-500 uppercase tracking-widest font-bold block mb-1">Phone</span>
                        <span class="text-gray-200 text-xs" x-text="profile.phone_number"></span>
                    </div>
                </div>

                <!-- Location -->
                <div x-show="profile.location" class="flex flex-col items-center gap-4 p-7 rounded-2xl text-center card-hover" style="background:#111118; border:1px solid #1E1E2E;">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center" style="background: linear-gradient(135deg, rgba(59,130,246,0.15), rgba(59,130,246,0.03)); border: 1px solid rgba(59,130,246,0.25); color:#60A5FA;">
                        <i data-lucide="map-pin" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <span class="text-[10px] text-gray-500 uppercase tracking-widest font-bold block mb-1">Location</span>
                        <span class="text-gray-200 text-xs" x-text="profile.location"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ========================================== -->
    <!-- CRUD MODALS -->
    <!-- ========================================== -->

    <!-- Profile Edit Modal -->
    <div x-show="activeModal === 'profile'" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm"
         x-transition>
        <div @click.outside="activeModal = null" class="w-full max-w-2xl bg-darkCard border border-darkBorder rounded-3xl p-6 sm:p-8 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center pb-4 border-b border-darkBorder mb-6">
                <h3 class="font-outfit font-bold text-xl text-white">Edit Profile Details</h3>
                <button @click="activeModal = null" class="text-gray-500 hover:text-white transition-colors">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            <form @submit.prevent="submitProfile()" class="space-y-6 text-sm" id="profileForm">
                <!-- Two-Column Fields -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Full Name</label>
                        <input type="text" x-model="profileForm.full_name" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors">
                        <template x-if="errors.full_name">
                            <span class="text-red-500 text-xs mt-1 block" x-text="errors.full_name[0]"></span>
                        </template>
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Headline</label>
                        <input type="text" x-model="profileForm.headline" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors">
                        <template x-if="errors.headline">
                            <span class="text-red-500 text-xs mt-1 block" x-text="errors.headline[0]"></span>
                        </template>
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Email Address</label>
                        <input type="email" x-model="profileForm.email" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors">
                        <template x-if="errors.email">
                            <span class="text-red-500 text-xs mt-1 block" x-text="errors.email[0]"></span>
                        </template>
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Phone Number</label>
                        <input type="text" x-model="profileForm.phone_number" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors">
                        <template x-if="errors.phone_number">
                            <span class="text-red-500 text-xs mt-1 block" x-text="errors.phone_number[0]"></span>
                        </template>
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Location</label>
                        <input type="text" x-model="profileForm.location" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors">
                        <template x-if="errors.location">
                            <span class="text-red-500 text-xs mt-1 block" x-text="errors.location[0]"></span>
                        </template>
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Profile Photo (Max 2MB)</label>
                        <input type="file" id="profile_photo_input" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-3 py-2 text-gray-300 text-xs focus:outline-none focus:border-purpleAccent transition-colors">
                        <template x-if="errors.photo">
                            <span class="text-red-500 text-xs mt-1 block" x-text="errors.photo[0]"></span>
                        </template>
                    </div>
                </div>

                <div>
                    <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Short Description</label>
                    <textarea x-model="profileForm.short_description" rows="4" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors"></textarea>
                    <template x-if="errors.short_description">
                        <span class="text-red-500 text-xs mt-1 block" x-text="errors.short_description[0]"></span>
                    </template>
                </div>

                <!-- Socials -->
                <div class="border-t border-darkBorder pt-4 mt-4">
                    <h4 class="text-sm font-semibold text-white mb-4">Social Profiles</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">GitHub URL</label>
                            <input type="text" x-model="profileForm.github" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-3 py-2 text-gray-100 focus:outline-none focus:border-purpleAccent text-xs transition-colors">
                            <template x-if="errors.github">
                                <span class="text-red-500 text-[10px] mt-1 block" x-text="errors.github[0]"></span>
                            </template>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">LinkedIn URL</label>
                            <input type="text" x-model="profileForm.linkedin" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-3 py-2 text-gray-100 focus:outline-none focus:border-purpleAccent text-xs transition-colors">
                            <template x-if="errors.linkedin">
                                <span class="text-red-500 text-[10px] mt-1 block" x-text="errors.linkedin[0]"></span>
                            </template>
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500 mb-1">Instagram URL</label>
                            <input type="text" x-model="profileForm.instagram" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-3 py-2 text-gray-100 focus:outline-none focus:border-purpleAccent text-xs transition-colors">
                            <template x-if="errors.instagram">
                                <span class="text-red-500 text-[10px] mt-1 block" x-text="errors.instagram[0]"></span>
                            </template>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3 border-t border-darkBorder pt-4">
                    <button type="button" @click="activeModal = null" class="px-5 py-2.5 rounded-xl border border-darkBorder text-gray-400 hover:text-white transition-colors font-medium">Cancel</button>
                    <button type="submit" :disabled="isSubmitting" class="px-5 py-2.5 rounded-xl bg-purpleAccent hover:bg-purpleHover text-white font-medium flex items-center gap-2 disabled:opacity-50">
                        <template x-if="isSubmitting"><span class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></span></template>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Experience Add/Edit Modal -->
    <div x-show="activeModal === 'experience'" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm"
         x-transition>
        <div @click.outside="activeModal = null" class="w-full max-w-lg bg-darkCard border border-darkBorder rounded-3xl p-6 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center pb-4 border-b border-darkBorder mb-6">
                <h3 class="font-outfit font-bold text-xl text-white" x-text="modalMode === 'add' ? 'Add Work Experience' : 'Edit Work Experience'"></h3>
                <button @click="activeModal = null" class="text-gray-500 hover:text-white transition-colors">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            <form @submit.prevent="submitExperience()" class="space-y-6 text-sm">
                <div>
                    <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Position / Job Title</label>
                    <input type="text" x-model="experienceForm.position" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors">
                    <template x-if="errors.position">
                        <span class="text-red-500 text-xs mt-1 block" x-text="errors.position[0]"></span>
                    </template>
                </div>

                <div>
                    <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Company / Institution</label>
                    <input type="text" x-model="experienceForm.institution" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors">
                    <template x-if="errors.institution">
                        <span class="text-red-500 text-xs mt-1 block" x-text="errors.institution[0]"></span>
                    </template>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Start Date</label>
                        <input type="date" x-model="experienceForm.start_date" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors">
                        <template x-if="errors.start_date">
                            <span class="text-red-500 text-xs mt-1 block" x-text="errors.start_date[0]"></span>
                        </template>
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">End Date (Leave empty if Present)</label>
                        <input type="date" x-model="experienceForm.end_date" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors">
                        <template x-if="errors.end_date">
                            <span class="text-red-500 text-xs mt-1 block" x-text="errors.end_date[0]"></span>
                        </template>
                    </div>
                </div>

                <div>
                    <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Job Description</label>
                    <textarea x-model="experienceForm.description" rows="4" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors"></textarea>
                    <template x-if="errors.description">
                        <span class="text-red-500 text-xs mt-1 block" x-text="errors.description[0]"></span>
                    </template>
                </div>

                <div class="flex justify-end gap-3 border-t border-darkBorder pt-4">
                    <button type="button" @click="activeModal = null" class="px-5 py-2.5 rounded-xl border border-darkBorder text-gray-400 hover:text-white transition-colors font-medium">Cancel</button>
                    <button type="submit" :disabled="isSubmitting" class="px-5 py-2.5 rounded-xl bg-purpleAccent hover:bg-purpleHover text-white font-medium flex items-center gap-2 disabled:opacity-50">
                        <template x-if="isSubmitting"><span class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></span></template>
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Education Add/Edit Modal -->
    <div x-show="activeModal === 'education'" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm"
         x-transition>
        <div @click.outside="activeModal = null" class="w-full max-w-lg bg-darkCard border border-darkBorder rounded-3xl p-6 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center pb-4 border-b border-darkBorder mb-6">
                <h3 class="font-outfit font-bold text-xl text-white" x-text="modalMode === 'add' ? 'Add Education Record' : 'Edit Education Record'"></h3>
                <button @click="activeModal = null" class="text-gray-500 hover:text-white transition-colors">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            <form @submit.prevent="submitEducation()" class="space-y-6 text-sm">
                <div>
                    <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Degree / Qualification</label>
                    <input type="text" x-model="educationForm.degree" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors" placeholder="e.g. Bachelor of Science in IT">
                    <template x-if="errors.degree">
                        <span class="text-red-500 text-xs mt-1 block" x-text="errors.degree[0]"></span>
                    </template>
                </div>

                <div>
                    <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Institution / School</label>
                    <input type="text" x-model="educationForm.institution" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors">
                    <template x-if="errors.institution">
                        <span class="text-red-500 text-xs mt-1 block" x-text="errors.institution[0]"></span>
                    </template>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Start Date</label>
                        <input type="date" x-model="educationForm.start_date" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors">
                        <template x-if="errors.start_date">
                            <span class="text-red-500 text-xs mt-1 block" x-text="errors.start_date[0]"></span>
                        </template>
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">End Date (Leave empty if current)</label>
                        <input type="date" x-model="educationForm.end_date" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors">
                        <template x-if="errors.end_date">
                            <span class="text-red-500 text-xs mt-1 block" x-text="errors.end_date[0]"></span>
                        </template>
                    </div>
                </div>

                <div>
                    <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Description (Optional)</label>
                    <textarea x-model="educationForm.description" rows="3" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors"></textarea>
                    <template x-if="errors.description">
                        <span class="text-red-500 text-xs mt-1 block" x-text="errors.description[0]"></span>
                    </template>
                </div>

                <!-- Custom Logo / Badge Branding -->
                <div class="grid grid-cols-2 gap-4 border-t border-darkBorder pt-4">
                    <div>
                        <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Logo Text</label>
                        <input type="text" x-model="educationForm.logo_text" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors" placeholder="e.g. Tel-U, HS">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Logo Bg Class</label>
                        <select x-model="educationForm.logo_bg" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors">
                            <option value="bg-red-600">Red (Tel-U)</option>
                            <option value="bg-blue-600">Blue (HS)</option>
                            <option value="bg-purpleAccent">Purple (Default)</option>
                            <option value="bg-emerald-600">Green</option>
                            <option value="bg-[#1c1c1c]">Dark Gray</option>
                        </select>
                    </div>
                </div>

                <!-- Score Stats -->
                <div class="grid grid-cols-4 gap-2 border-t border-darkBorder pt-4">
                    <div>
                        <label class="block text-[10px] text-gray-400 uppercase tracking-wider font-bold mb-1.5">GPA / IPK</label>
                        <input type="text" x-model="educationForm.gpa" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-2 py-2.5 text-gray-100 text-center focus:outline-none focus:border-purpleAccent transition-colors" placeholder="e.g. 3.50">
                    </div>
                    <div>
                        <label class="block text-[10px] text-gray-400 uppercase tracking-wider font-bold mb-1.5">EPRT</label>
                        <input type="text" x-model="educationForm.eprt" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-2 py-2.5 text-gray-100 text-center focus:outline-none focus:border-purpleAccent transition-colors" placeholder="e.g. 520">
                    </div>
                    <div>
                        <label class="block text-[10px] text-gray-400 uppercase tracking-wider font-bold mb-1.5">TAK Score</label>
                        <input type="text" x-model="educationForm.tak" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-2 py-2.5 text-gray-100 text-center focus:outline-none focus:border-purpleAccent transition-colors" placeholder="e.g. 73">
                    </div>
                    <div>
                        <label class="block text-[10px] text-gray-400 uppercase tracking-wider font-bold mb-1.5">Final Grade</label>
                        <input type="text" x-model="educationForm.final_grade" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-2 py-2.5 text-gray-100 text-center focus:outline-none focus:border-purpleAccent transition-colors" placeholder="e.g. 89.81">
                    </div>
                </div>

                <!-- Academic Details -->
                <div class="grid grid-cols-3 gap-2 border-t border-darkBorder pt-4">
                    <div>
                        <label class="block text-[10px] text-gray-400 uppercase tracking-wider font-bold mb-1.5">NIM</label>
                        <input type="text" x-model="educationForm.nim" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-2.5 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors" placeholder="e.g. 70708...">
                    </div>
                    <div>
                        <label class="block text-[10px] text-gray-400 uppercase tracking-wider font-bold mb-1.5">Angkatan</label>
                        <input type="text" x-model="educationForm.angkatan" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-2.5 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors" placeholder="e.g. 2023">
                    </div>
                    <div>
                        <label class="block text-[10px] text-gray-400 uppercase tracking-wider font-bold mb-1.5">Dosen Wali</label>
                        <input type="text" x-model="educationForm.dosen_wali" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-2.5 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors" placeholder="e.g. Mindit E...">
                    </div>
                </div>

                <div class="flex justify-end gap-3 border-t border-darkBorder pt-4">
                    <button type="button" @click="activeModal = null" class="px-5 py-2.5 rounded-xl border border-darkBorder text-gray-400 hover:text-white transition-colors font-medium">Cancel</button>
                    <button type="submit" :disabled="isSubmitting" class="px-5 py-2.5 rounded-xl bg-purpleAccent hover:bg-purpleHover text-white font-medium flex items-center gap-2 disabled:opacity-50">
                        <template x-if="isSubmitting"><span class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></span></template>
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Certification Add/Edit Modal -->
    <div x-show="activeModal === 'certification'" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm"
         x-transition>
        <div @click.outside="activeModal = null" class="w-full max-w-lg bg-darkCard border border-darkBorder rounded-3xl p-6 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center pb-4 border-b border-darkBorder mb-6">
                <h3 class="font-outfit font-bold text-xl text-white" x-text="modalMode === 'add' ? 'Add Certification' : 'Edit Certification'"></h3>
                <button @click="activeModal = null" class="text-gray-500 hover:text-white transition-colors">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            <form @submit.prevent="submitCertification()" class="space-y-6 text-sm">
                <div>
                    <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Certification Title</label>
                    <input type="text" x-model="certificationForm.title" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors" placeholder="e.g. BNSP Competency Certificate">
                    <template x-if="errors.title">
                        <span class="text-red-500 text-xs mt-1 block" x-text="errors.title[0]"></span>
                    </template>
                </div>

                <div>
                    <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Credential Name / Subtitle</label>
                    <input type="text" x-model="certificationForm.sub_title" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors" placeholder="e.g. Desainer Multimedia Madya">
                    <template x-if="errors.sub_title">
                        <span class="text-red-500 text-xs mt-1 block" x-text="errors.sub_title[0]"></span>
                    </template>
                </div>

                <div>
                    <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Issuing Organisation</label>
                    <input type="text" x-model="certificationForm.issuer" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors" placeholder="e.g. BNSP">
                    <template x-if="errors.issuer">
                        <span class="text-red-500 text-xs mt-1 block" x-text="errors.issuer[0]"></span>
                    </template>
                </div>

                <div>
                    <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Credential URL / Drive Link</label>
                    <input type="text" x-model="certificationForm.credential_url" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors" placeholder="e.g. https://drive.google.com/...">
                    <template x-if="errors.credential_url">
                        <span class="text-red-500 text-xs mt-1 block" x-text="errors.credential_url[0]"></span>
                    </template>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Start Date</label>
                        <input type="date" x-model="certificationForm.start_date" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors">
                        <template x-if="errors.start_date">
                            <span class="text-red-500 text-xs mt-1 block" x-text="errors.start_date[0]"></span>
                        </template>
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">End Date (Leave empty if current)</label>
                        <input type="date" x-model="certificationForm.end_date" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors">
                        <template x-if="errors.end_date">
                            <span class="text-red-500 text-xs mt-1 block" x-text="errors.end_date[0]"></span>
                        </template>
                    </div>
                </div>

                <div>
                    <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Description (Optional)</label>
                    <textarea x-model="certificationForm.description" rows="3" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors"></textarea>
                    <template x-if="errors.description">
                        <span class="text-red-500 text-xs mt-1 block" x-text="errors.description[0]"></span>
                    </template>
                </div>

                <div>
                    <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Competency Tags (Comma-separated)</label>
                    <input type="text" x-model="certificationForm.skills_input" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors" placeholder="e.g. Creative Design, Audio-Visual">
                </div>

                <div class="flex justify-end gap-3 border-t border-darkBorder pt-4">
                    <button type="button" @click="activeModal = null" class="px-5 py-2.5 rounded-xl border border-darkBorder text-gray-400 hover:text-white transition-colors font-medium">Cancel</button>
                    <button type="submit" :disabled="isSubmitting" class="px-5 py-2.5 rounded-xl bg-purpleAccent hover:bg-purpleHover text-white font-medium flex items-center gap-2 disabled:opacity-50">
                        <template x-if="isSubmitting"><span class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></span></template>
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Project Add/Edit Modal -->
    <div x-show="activeModal === 'project'" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm"
         x-transition>
        <div @click.outside="activeModal = null" class="w-full max-w-lg bg-darkCard border border-darkBorder rounded-3xl p-6 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center pb-4 border-b border-darkBorder mb-6">
                <h3 class="font-outfit font-bold text-xl text-white" x-text="modalMode === 'add' ? 'Create New Project' : 'Edit Project Details'"></h3>
                <button @click="activeModal = null" class="text-gray-500 hover:text-white transition-colors">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            <form @submit.prevent="submitProject()" class="space-y-6 text-sm" id="projectForm">
                <div>
                    <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Project Name</label>
                    <input type="text" x-model="projectForm.project_name" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors">
                    <template x-if="errors.project_name">
                        <span class="text-red-500 text-xs mt-1 block" x-text="errors.project_name[0]"></span>
                    </template>
                </div>

                <div>
                    <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Description</label>
                    <textarea x-model="projectForm.description" rows="3" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors"></textarea>
                    <template x-if="errors.description">
                        <span class="text-red-500 text-xs mt-1 block" x-text="errors.description[0]"></span>
                    </template>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Project Demo URL</label>
                        <input type="text" x-model="projectForm.project_url" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors" placeholder="https://example.com">
                        <template x-if="errors.project_url">
                            <span class="text-red-500 text-xs mt-1 block" x-text="errors.project_url[0]"></span>
                        </template>
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">GitHub Code URL</label>
                        <input type="text" x-model="projectForm.github_url" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors" placeholder="https://github.com/...">
                        <template x-if="errors.github_url">
                            <span class="text-red-500 text-xs mt-1 block" x-text="errors.github_url[0]"></span>
                        </template>
                    </div>
                </div>

                <div>
                    <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Tech Stack (comma-separated)</label>
                    <input type="text" x-model="projectForm.tech_stack_input" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors" placeholder="Laravel, PHP, Vue, MySQL">
                    <template x-if="errors.tech_stack">
                        <span class="text-red-500 text-xs mt-1 block" x-text="errors.tech_stack[0]"></span>
                    </template>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Category</label>
                        <select x-model="projectForm.category" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors">
                            <option value="3D Art">3D Art</option>
                            <option value="Graphic Design">Graphic Design</option>
                            <option value="Full Stack Dev">Full Stack Dev</option>
                        </select>
                        <template x-if="errors.category">
                            <span class="text-red-500 text-xs mt-1 block" x-text="errors.category[0]"></span>
                        </template>
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Thumbnail Image (Max 2MB)</label>
                        <input type="file" id="project_thumbnail_input" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-3 py-2 text-gray-300 text-xs focus:outline-none focus:border-purpleAccent transition-colors">
                        <template x-if="errors.thumbnail">
                            <span class="text-red-500 text-xs mt-1 block" x-text="errors.thumbnail[0]"></span>
                        </template>
                    </div>
                </div>

                <div class="flex justify-end gap-3 border-t border-darkBorder pt-4">
                    <button type="button" @click="activeModal = null" class="px-5 py-2.5 rounded-xl border border-darkBorder text-gray-400 hover:text-white transition-colors font-medium">Cancel</button>
                    <button type="submit" :disabled="isSubmitting" class="px-5 py-2.5 rounded-xl bg-purpleAccent hover:bg-purpleHover text-white font-medium flex items-center gap-2 disabled:opacity-50">
                        <template x-if="isSubmitting"><span class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></span></template>
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Skill Add/Edit Modal -->
    <div x-show="activeModal === 'skill'" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm"
         x-transition>
        <div @click.outside="activeModal = null" class="w-full max-w-md bg-darkCard border border-darkBorder rounded-3xl p-6">
            <div class="flex justify-between items-center pb-4 border-b border-darkBorder mb-6">
                <h3 class="font-outfit font-bold text-xl text-white" x-text="modalMode === 'add' ? 'Add New Skill' : 'Edit Skill Details'"></h3>
                <button @click="activeModal = null" class="text-gray-500 hover:text-white transition-colors">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            <form @submit.prevent="submitSkill()" class="space-y-6 text-sm">
                <div>
                    <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Skill Name</label>
                    <input type="text" x-model="skillForm.skill_name" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors" placeholder="e.g. React, PHP">
                    <template x-if="errors.skill_name">
                        <span class="text-red-500 text-xs mt-1 block" x-text="errors.skill_name[0]"></span>
                    </template>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Proficiency Level</label>
                        <select x-model="skillForm.level" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors">
                            <option value="Beginner">Beginner</option>
                            <option value="Intermediate">Intermediate</option>
                            <option value="Advanced">Advanced</option>
                            <option value="Expert">Expert</option>
                        </select>
                        <template x-if="errors.level">
                            <span class="text-red-500 text-xs mt-1 block" x-text="errors.level[0]"></span>
                        </template>
                    </div>

                    <div>
                        <label class="block text-xs text-gray-400 uppercase tracking-wider font-bold mb-1.5">Category</label>
                        <select x-model="skillForm.category" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors">
                            <option value="Web">Web</option>
                            <option value="Graphic Design">Graphic Design</option>
                            <option value="3D Design">3D Design</option>
                            <option value="Supporting Tools">Supporting Tools</option>
                        </select>
                        <template x-if="errors.category">
                            <span class="text-red-500 text-xs mt-1 block" x-text="errors.category[0]"></span>
                        </template>
                    </div>
                </div>

                <div class="flex justify-end gap-3 border-t border-darkBorder pt-4">
                    <button type="button" @click="activeModal = null" class="px-5 py-2.5 rounded-xl border border-darkBorder text-gray-400 hover:text-white transition-colors font-medium">Cancel</button>
                    <button type="submit" :disabled="isSubmitting" class="px-5 py-2.5 rounded-xl bg-purpleAccent hover:bg-purpleHover text-white font-medium flex items-center gap-2 disabled:opacity-50">
                        <template x-if="isSubmitting"><span class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></span></template>
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<!-- Alpine App Logic -->
<script>
    function portfolioApp() {
        return {
            editMode: false,
            profile: @json($profile),
            experiences: @json($profile->experiences),
            educations: @json($profile->educations),
            projects: @json($profile->projects),
            skills: @json($profile->skills),
            certifications: @json($profile->certifications),
            categoryFilter: 'all',

            // Modal controller
            activeModal: null,
            modalMode: 'add',
            errors: {},
            isSubmitting: false,

            // Form models
            profileForm: {
                full_name: '', headline: '', short_description: '', email: '', phone_number: '',
                location: '', linkedin: '', github: '', instagram: '', photo: null
            },
            experienceForm: {
                id: null, position: '', institution: '', start_date: '', end_date: '', description: ''
            },
            educationForm: {
                id: null, institution: '', degree: '', start_date: '', end_date: '', description: '',
                logo_text: '', logo_bg: 'bg-purpleAccent', gpa: '', eprt: '', tak: '', final_grade: '', nim: '', angkatan: '', dosen_wali: ''
            },
            projectForm: {
                id: null, project_name: '', description: '', thumbnail: null, project_url: '', github_url: '', tech_stack_input: '', category: 'Graphic Design'
            },
            skillForm: {
                id: null, skill_name: '', level: 'Intermediate', category: 'Web'
            },
            certificationForm: {
                id: null, title: '', sub_title: '', issuer: '', credential_url: '', start_date: '', end_date: '', description: '', skills_input: '', skills: []
            },

            init() {
                // Initialize assets correctly
                this.projects = this.projects.map(p => {
                    p.thumbnail_url = p.thumbnail ? `/storage/${p.thumbnail}` : null;
                    return p;
                });
                this.profile.photo_url = this.profile.photo ? `/storage/${this.profile.photo}` : null;

                // Initialize Lucide icons after Alpine templates render
                this.$nextTick(() => {
                    if (typeof lucide !== 'undefined') {
                        lucide.createIcons();
                    }
                });
            },

            formatDate(dateStr) {
                if (!dateStr) return 'Present';
                const date = new Date(dateStr);
                return date.toLocaleDateString('en-US', { month: 'short', year: 'numeric' });
            },

            // Skill groupings
            getSkillCategories() {
                return ['Web', 'Graphic Design', '3D Design', 'Supporting Tools'];
            },

            getCategoryDetails(cat) {
                const details = {
                    'Web': {
                        title: 'WEB DEVELOPMENT',
                        description: 'Building responsive, secure, and database-driven web applications.',
                        icon: 'globe'
                    },
                    'Graphic Design': {
                        title: 'GRAPHIC DESIGN',
                        description: 'Designing creative layouts, visual assets, branding, and digital illustrations.',
                        icon: 'palette'
                    },
                    '3D Design': {
                        title: '3D DESIGN',
                        description: 'Creating 3D models, conceptual environments, realistic lighting, and texturing.',
                        icon: 'box'
                    },
                    'Supporting Tools': {
                        title: 'SUPPORTING TOOLS',
                        description: 'Utilizing AI assistants like Antigravity & ChatGPT, command lines, and productivity apps.',
                        icon: 'wrench'
                    }
                };
                return details[cat] || {
                    title: cat.toUpperCase(),
                    description: 'Skills and technologies related to ' + cat + '.',
                    icon: 'cpu'
                };
            },

            getSkillsByCategory(cat) {
                return this.skills.filter(s => s.category === cat);
            },

            filteredProjects() {
                if (this.categoryFilter === 'all') {
                    return this.projects;
                }
                return this.projects.filter(p => p.category === this.categoryFilter);
            },

            // Modal openers
            openProfileModal() {
                this.errors = {};
                this.profileForm = { ...this.profile };
                this.profileForm.photo = null;
                const fileInput = document.getElementById('profile_photo_input');
                if (fileInput) fileInput.value = '';
                this.activeModal = 'profile';
            },

            openExperienceModal(mode, item = null) {
                this.errors = {};
                this.modalMode = mode;
                if (mode === 'edit' && item) {
                    this.experienceForm = { ...item };
                    // Format dates for html date input (YYYY-MM-DD)
                    if (this.experienceForm.start_date) {
                        this.experienceForm.start_date = this.experienceForm.start_date.split('T')[0];
                    }
                    if (this.experienceForm.end_date) {
                        this.experienceForm.end_date = this.experienceForm.end_date.split('T')[0];
                    }
                } else {
                    this.experienceForm = { id: null, position: '', institution: '', start_date: '', end_date: '', description: '' };
                }
                this.activeModal = 'experience';
            },

            openEducationModal(mode, item = null) {
                this.errors = {};
                this.modalMode = mode;
                if (mode === 'edit' && item) {
                    this.educationForm = { ...item };
                    if (this.educationForm.start_date) {
                        this.educationForm.start_date = this.educationForm.start_date.split('T')[0];
                    }
                    if (this.educationForm.end_date) {
                        this.educationForm.end_date = this.educationForm.end_date.split('T')[0];
                    }
                } else {
                    this.educationForm = { 
                        id: null, institution: '', degree: '', start_date: '', end_date: '', description: '',
                        logo_text: '', logo_bg: 'bg-purpleAccent', gpa: '', eprt: '', tak: '', final_grade: '', nim: '', angkatan: '', dosen_wali: ''
                    };
                }
                this.activeModal = 'education';
            },

            openCertificationModal(mode, item = null) {
                this.errors = {};
                this.modalMode = mode;
                if (mode === 'edit' && item) {
                    this.certificationForm = { ...item };
                    this.certificationForm.skills_input = (item.skills || []).join(', ');
                    if (this.certificationForm.start_date) {
                        this.certificationForm.start_date = this.certificationForm.start_date.split('T')[0];
                    }
                    if (this.certificationForm.end_date) {
                        this.certificationForm.end_date = this.certificationForm.end_date.split('T')[0];
                    }
                } else {
                    this.certificationForm = {
                        id: null, title: '', sub_title: '', issuer: '', credential_url: '', start_date: '', end_date: '', description: '', skills_input: '', skills: []
                    };
                }
                this.activeModal = 'certification';
            },

            openProjectModal(mode, item = null) {
                this.errors = {};
                this.modalMode = mode;
                if (mode === 'edit' && item) {
                    this.projectForm = {
                        ...item,
                        tech_stack_input: (item.tech_stack || []).join(', ')
                    };
                    const fileInput = document.getElementById('project_thumbnail_input');
                    if (fileInput) fileInput.value = '';
                } else {
                    this.projectForm = { id: null, project_name: '', description: '', thumbnail: null, project_url: '', github_url: '', tech_stack_input: '', category: 'Graphic Design' };
                }
                this.activeModal = 'project';
            },

            openSkillModal(mode, item = null) {
                this.errors = {};
                this.modalMode = mode;
                if (mode === 'edit' && item) {
                    this.skillForm = { ...item };
                } else {
                    this.skillForm = { id: null, skill_name: '', level: 'Intermediate', category: 'Backend' };
                }
                this.activeModal = 'skill';
            },

            // Form Submit methods using AJAX
            async submitProfile() {
                this.errors = {};
                this.isSubmitting = true;
                const formData = new FormData();

                Object.keys(this.profileForm).forEach(key => {
                    if (key === 'photo') {
                        const fileInput = document.getElementById('profile_photo_input');
                        if (fileInput && fileInput.files[0]) {
                            formData.append('photo', fileInput.files[0]);
                        }
                    } else if (this.profileForm[key] !== null) {
                        formData.append(key, this.profileForm[key]);
                    }
                });

                try {
                    const response = await fetch(`/profile/${this.profile.id}`, {
                        method: 'POST', // POST with file
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    const result = await response.json();
                    if (response.ok) {
                        this.profile = result.profile;
                        this.profile.photo_url = this.profile.photo ? `/storage/${this.profile.photo}` : null;
                        this.activeModal = null;
                        setTimeout(() => lucide.createIcons(), 50);
                    } else if (response.status === 422) {
                        this.errors = result.errors;
                    } else {
                        alert(result.message || 'Error occurred');
                    }
                } catch (e) {
                    console.error(e);
                    alert('Connection failed');
                } finally {
                    this.isSubmitting = false;
                }
            },

            async submitExperience() {
                this.errors = {};
                this.isSubmitting = true;
                const isEdit = this.modalMode === 'edit';
                const url = isEdit ? `/experiences/${this.experienceForm.id}` : '/experiences';
                const method = isEdit ? 'PUT' : 'POST';

                try {
                    const response = await fetch(url, {
                        method: method,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(this.experienceForm)
                    });

                    const result = await response.json();
                    if (response.ok) {
                        if (isEdit) {
                            const idx = this.experiences.findIndex(e => e.id === result.experience.id);
                            if (idx !== -1) this.experiences[idx] = result.experience;
                        } else {
                            this.experiences.push(result.experience);
                        }
                        // Sort experiences newest first
                        this.experiences.sort((a, b) => new Date(b.start_date) - new Date(a.start_date));
                        this.activeModal = null;
                        setTimeout(() => lucide.createIcons(), 50);
                    } else if (response.status === 422) {
                        this.errors = result.errors;
                    } else {
                        alert(result.message || 'Error occurred');
                    }
                } catch (e) {
                    console.error(e);
                    alert('Connection failed');
                } finally {
                    this.isSubmitting = false;
                }
            },

            async submitEducation() {
                this.errors = {};
                this.isSubmitting = true;
                const isEdit = this.modalMode === 'edit';
                const url = isEdit ? `/educations/${this.educationForm.id}` : '/educations';
                const method = isEdit ? 'PUT' : 'POST';

                try {
                    const response = await fetch(url, {
                        method: method,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(this.educationForm)
                    });

                    const result = await response.json();
                    if (response.ok) {
                        if (isEdit) {
                            const idx = this.educations.findIndex(e => e.id === result.education.id);
                            if (idx !== -1) this.educations[idx] = result.education;
                        } else {
                            this.educations.push(result.education);
                        }
                        this.educations.sort((a, b) => new Date(b.start_date) - new Date(a.start_date));
                        this.activeModal = null;
                        setTimeout(() => lucide.createIcons(), 50);
                    } else if (response.status === 422) {
                        this.errors = result.errors;
                    } else {
                        alert(result.message || 'Error occurred');
                    }
                } catch (e) {
                    console.error(e);
                    alert('Connection failed');
                } finally {
                    this.isSubmitting = false;
                }
            },

            async submitProject() {
                this.errors = {};
                this.isSubmitting = true;
                const isEdit = this.modalMode === 'edit';
                const url = isEdit ? `/projects/${this.projectForm.id}` : '/projects';
                
                const formData = new FormData();
                formData.append('project_name', this.projectForm.project_name || '');
                formData.append('description', this.projectForm.description || '');
                formData.append('project_url', this.projectForm.project_url || '');
                formData.append('github_url', this.projectForm.github_url || '');
                formData.append('category', this.projectForm.category || 'Graphic Design');
                
                // Parse tech stack input to array tags
                const tags = (this.projectForm.tech_stack_input || '')
                    .split(',')
                    .map(t => t.trim())
                    .filter(t => t !== '');
                tags.forEach(tag => formData.append('tech_stack[]', tag));

                // Append thumbnail if selected
                const fileInput = document.getElementById('project_thumbnail_input');
                if (fileInput && fileInput.files[0]) {
                    formData.append('thumbnail', fileInput.files[0]);
                }

                try {
                    const response = await fetch(url, {
                        method: 'POST', // POST due to upload support
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    const result = await response.json();
                    if (response.ok) {
                        const updatedProject = result.project;
                        updatedProject.thumbnail_url = updatedProject.thumbnail ? `/storage/${updatedProject.thumbnail}` : null;
                        
                        if (isEdit) {
                            const idx = this.projects.findIndex(p => p.id === updatedProject.id);
                            if (idx !== -1) this.projects[idx] = updatedProject;
                        } else {
                            this.projects.unshift(updatedProject);
                        }
                        this.activeModal = null;
                        setTimeout(() => lucide.createIcons(), 50);
                    } else if (response.status === 422) {
                        this.errors = result.errors;
                    } else {
                        alert(result.message || 'Error occurred');
                    }
                } catch (e) {
                    console.error(e);
                    alert('Connection failed');
                } finally {
                    this.isSubmitting = false;
                }
            },

            async submitCertification() {
                this.errors = {};
                this.isSubmitting = true;
                
                // Parse comma-separated skills into array
                const inputSkills = this.certificationForm.skills_input || '';
                this.certificationForm.skills = inputSkills.split(',').map(s => s.trim()).filter(s => s.length > 0);

                const isEdit = this.modalMode === 'edit';
                const url = isEdit ? `/certifications/${this.certificationForm.id}` : '/certifications';
                const method = isEdit ? 'PUT' : 'POST';

                try {
                    const response = await fetch(url, {
                        method: method,
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(this.certificationForm)
                    });

                    const result = await response.json();
                    if (response.ok) {
                        if (isEdit) {
                            const idx = this.certifications.findIndex(c => c.id === result.certification.id);
                            if (idx !== -1) this.certifications[idx] = result.certification;
                        } else {
                            this.certifications.push(result.certification);
                        }
                        this.certifications.sort((a, b) => new Date(b.start_date) - new Date(a.start_date));
                        this.activeModal = null;
                        setTimeout(() => lucide.createIcons(), 50);
                    } else if (response.status === 422) {
                        this.errors = result.errors;
                    } else {
                        alert(result.message || 'Error occurred');
                    }
                } catch (e) {
                    console.error(e);
                    alert('Connection failed');
                } finally {
                    this.isSubmitting = false;
                }
            },

            async submitSkill() {
                this.errors = {};
                this.isSubmitting = true;
                const isEdit = this.modalMode === 'edit';
                const url = isEdit ? `/skills/${this.skillForm.id}` : '/skills';
                const method = isEdit ? 'PUT' : 'POST';

                try {
                    const response = await fetch(url, {
                        method: method,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(this.skillForm)
                    });

                    const result = await response.json();
                    if (response.ok) {
                        if (isEdit) {
                            const idx = this.skills.findIndex(s => s.id === result.skill.id);
                            if (idx !== -1) this.skills[idx] = result.skill;
                        } else {
                            this.skills.push(result.skill);
                        }
                        this.activeModal = null;
                        setTimeout(() => lucide.createIcons(), 50);
                    } else if (response.status === 422) {
                        this.errors = result.errors;
                    } else {
                        alert(result.message || 'Error occurred');
                    }
                } catch (e) {
                    console.error(e);
                    alert('Connection failed');
                } finally {
                    this.isSubmitting = false;
                }
            },

            // General Delete method
            async deleteItem(type, id) {
                if (!confirm(`Are you sure you want to delete this ${type}?`)) {
                    return;
                }

                let url = '';
                if (type === 'experience') url = `/experiences/${id}`;
                if (type === 'education') url = `/educations/${id}`;
                if (type === 'project') url = `/projects/${id}`;
                if (type === 'skill') url = `/skills/${id}`;
                if (type === 'certification') url = `/certifications/${id}`;

                try {
                    const response = await fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        }
                    });

                    const result = await response.json();
                    if (response.ok) {
                        if (type === 'experience') this.experiences = this.experiences.filter(item => item.id !== id);
                        if (type === 'education') this.educations = this.educations.filter(item => item.id !== id);
                        if (type === 'project') this.projects = this.projects.filter(item => item.id !== id);
                        if (type === 'skill') this.skills = this.skills.filter(item => item.id !== id);
                        if (type === 'certification') this.certifications = this.certifications.filter(item => item.id !== id);
                    } else {
                        alert(result.message || 'Error occurred during deletion.');
                    }
                } catch (e) {
                    console.error(e);
                    alert('Connection failed');
                }
            }
        }
    }
</script>
@endsection
