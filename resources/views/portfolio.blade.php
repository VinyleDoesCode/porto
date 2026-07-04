@extends('layouts.app')

@section('title', $profile->full_name . ' | Portfolio')

@section('content')
<div x-data="portfolioApp()" x-init="init()" class="relative">

    <!-- Top Navigation & Mode Toggle -->
    <header class="sticky top-0 z-40 backdrop-blur-md bg-darkBg/90 border-b border-darkBorder transition-all duration-300">
        <div class="max-w-6xl mx-auto px-4 h-16 flex items-center justify-between">
            <a href="#" class="font-outfit font-bold text-xl tracking-wider text-white">
                <span class="text-purpleAccent">PORT</span>FOLIO.
            </a>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center space-x-6 text-sm font-medium text-gray-400">
                <a href="#about" class="hover:text-purpleAccent transition-colors">About</a>
                <a href="#experience" class="hover:text-purpleAccent transition-colors">Experience</a>
                <a href="#education" class="hover:text-purpleAccent transition-colors">Education</a>
                <a href="#projects" class="hover:text-purpleAccent transition-colors">Projects</a>
                <a href="#skills" class="hover:text-purpleAccent transition-colors">Skills</a>
                <a href="#contact" class="hover:text-purpleAccent transition-colors">Contact</a>
            </nav>

            <!-- View / Edit Mode Toggle -->
            <div class="flex items-center space-x-2 bg-darkCard border border-darkBorder rounded-full p-1">
                <button @click="editMode = false" 
                        :class="!editMode ? 'bg-purpleAccent text-white' : 'text-gray-400 hover:text-white'"
                        class="px-4 py-1.5 rounded-full text-xs font-semibold tracking-wider uppercase transition-all duration-200 flex items-center gap-1.5">
                    <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                    View Mode
                </button>
                <button @click="editMode = true" 
                        :class="editMode ? 'bg-purpleAccent text-white' : 'text-gray-400 hover:text-white'"
                        class="px-4 py-1.5 rounded-full text-xs font-semibold tracking-wider uppercase transition-all duration-200 flex items-center gap-1.5">
                    <i data-lucide="edit" class="w-3.5 h-3.5"></i>
                    Edit Mode
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
         class="bg-purpleAccent/10 border-b border-purpleAccent/30 text-purpleAccent py-2 text-center text-xs font-medium tracking-wide">
        <span class="inline-flex items-center gap-1.5">
            <i data-lucide="info" class="w-3.5 h-3.5"></i>
            CMS Edit Mode Active. Click on section buttons to manage portfolio records in place.
        </span>
    </div>

    <!-- HERO SECTION -->
    <section class="py-20 md:py-28 relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_30%_30%,#7C3AED1A,transparent_40%)]"></div>
        <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-12 gap-12 items-center relative z-10">
            <!-- Left Info column -->
            <div class="md:col-span-7 order-2 md:order-1 text-center md:text-left">
                <!-- Edit mode overlay for Hero/Profile -->
                <div x-show="editMode" class="mb-4">
                    <button @click="openProfileModal()" class="px-4 py-2 bg-purpleAccent/20 hover:bg-purpleAccent text-purpleAccent hover:text-white text-xs font-semibold rounded-lg border border-purpleAccent/40 flex items-center gap-2 transition-all duration-200 mx-auto md:mx-0">
                        <i data-lucide="edit" class="w-4 h-4"></i> Edit Profile Information
                    </button>
                </div>

                <span class="inline-block text-purpleAccent font-outfit text-sm font-semibold tracking-widest uppercase mb-3">Hello, Welcome</span>
                <h1 class="font-outfit font-extrabold text-4xl sm:text-5xl lg:text-6xl text-white tracking-tight leading-none mb-4" x-text="profile.full_name"></h1>
                <h2 class="font-outfit text-xl sm:text-2xl font-medium text-gray-400 mb-6" x-text="profile.headline"></h2>
                <p class="text-gray-400 leading-relaxed mb-8 max-w-xl text-base" x-text="profile.short_description"></p>

                <!-- Social links -->
                <div class="flex justify-center md:justify-start items-center gap-4">
                    <template x-if="profile.github">
                        <a :href="profile.github" target="_blank" class="w-10 h-10 rounded-full bg-darkCard border border-darkBorder flex items-center justify-center text-gray-400 hover:text-purpleAccent hover:border-purpleAccent hover:scale-110 transition-all duration-200" title="GitHub">
                            <i data-lucide="github" class="w-5 h-5"></i>
                        </a>
                    </template>
                    <template x-if="profile.linkedin">
                        <a :href="profile.linkedin" target="_blank" class="w-10 h-10 rounded-full bg-darkCard border border-darkBorder flex items-center justify-center text-gray-400 hover:text-purpleAccent hover:border-purpleAccent hover:scale-110 transition-all duration-200" title="LinkedIn">
                            <i data-lucide="linkedin" class="w-5 h-5"></i>
                        </a>
                    </template>
                    <template x-if="profile.instagram">
                        <a :href="profile.instagram" target="_blank" class="w-10 h-10 rounded-full bg-darkCard border border-darkBorder flex items-center justify-center text-gray-400 hover:text-purpleAccent hover:border-purpleAccent hover:scale-110 transition-all duration-200" title="Instagram">
                            <i data-lucide="instagram" class="w-5 h-5"></i>
                        </a>
                    </template>
                    <template x-if="profile.email">
                        <a :href="'mailto:' + profile.email" class="w-10 h-10 rounded-full bg-darkCard border border-darkBorder flex items-center justify-center text-gray-400 hover:text-purpleAccent hover:border-purpleAccent hover:scale-110 transition-all duration-200" title="Email">
                            <i data-lucide="mail" class="w-5 h-5"></i>
                        </a>
                    </template>
                </div>
            </div>

            <!-- Right Photo column -->
            <div class="md:col-span-5 order-1 md:order-2 flex justify-center">
                <div class="relative">
                    <div class="w-64 h-64 md:w-80 md:h-80 rounded-full overflow-hidden border-4 border-purpleAccent shadow-[0_0_30px_rgba(124,58,237,0.3)] transition-all duration-300 hover:scale-105">
                        <template x-if="profile.photo_url">
                            <img :src="profile.photo_url" alt="Profile photo" class="w-full h-full object-cover">
                        </template>
                        <template x-if="!profile.photo_url">
                            <div class="w-full h-full bg-darkCard flex items-center justify-center text-gray-500">
                                <i data-lucide="user" class="w-20 h-20 text-purpleAccent/55"></i>
                            </div>
                        </template>
                    </div>
                    <!-- Photo glow effect background -->
                    <div class="absolute -inset-1 rounded-full bg-gradient-to-tr from-purpleAccent to-pink-500 blur-xl opacity-35 -z-10"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT SECTION -->
    <section id="about" class="py-20 border-t border-darkBorder bg-[#0A0A0A] relative">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="font-outfit font-bold text-3xl text-white mb-2 text-center md:text-left">About Me</h2>
            <div class="w-12 h-1 bg-purpleAccent mb-12 mx-auto md:mx-0"></div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">
                <!-- Description -->
                <div class="md:col-span-7">
                    <h3 class="text-xl font-semibold text-white mb-4">Professional Overview</h3>
                    <p class="text-gray-400 leading-relaxed mb-6" x-text="profile.short_description"></p>
                </div>

                <!-- Info Grid -->
                <div class="md:col-span-5 bg-darkCard border border-darkBorder rounded-2xl p-6">
                    <h3 class="text-lg font-semibold text-white mb-4 border-b border-darkBorder pb-2">Information Details</h3>
                    <div class="space-y-4 text-sm">
                        <div class="flex justify-between items-center py-1">
                            <span class="text-gray-500">Email</span>
                            <span class="text-gray-200" x-text="profile.email"></span>
                        </div>
                        <template x-if="profile.phone_number">
                            <div class="flex justify-between items-center py-1">
                                <span class="text-gray-500">Phone</span>
                                <span class="text-gray-200" x-text="profile.phone_number"></span>
                            </div>
                        </template>
                        <template x-if="profile.location">
                            <div class="flex justify-between items-center py-1">
                                <span class="text-gray-500">Location</span>
                                <span class="text-gray-200" x-text="profile.location"></span>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- EXPERIENCE SECTION -->
    <section id="experience" class="py-20 border-t border-darkBorder relative">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex items-center justify-between mb-2">
                <div>
                    <h2 class="font-outfit font-bold text-3xl text-white">Work Experience</h2>
                    <div class="w-12 h-1 bg-purpleAccent mt-2"></div>
                </div>
                <!-- Add Experience button in Edit Mode -->
                <div x-show="editMode">
                    <button @click="openExperienceModal('add')" class="px-4 py-2 bg-purpleAccent text-white text-xs font-semibold rounded-lg hover:bg-purpleHover flex items-center gap-1.5 transition-all duration-200">
                        <i data-lucide="plus" class="w-4 h-4"></i> Add Experience
                    </button>
                </div>
            </div>

            <!-- Timeline -->
            <div class="mt-12 relative border-l-2 border-darkBorder ml-4 md:ml-6 space-y-12">
                <template x-if="experiences.length === 0">
                    <div class="pl-8 text-gray-500 text-sm">No work experiences added yet.</div>
                </template>
                <template x-for="item in experiences" :key="item.id">
                    <div class="relative pl-8 md:pl-10">
                        <!-- Bullet dot -->
                        <div class="absolute -left-[9px] top-1.5 w-4 h-4 rounded-full bg-purpleAccent border-4 border-darkBg shadow-[0_0_10px_rgba(124,58,237,0.8)]"></div>

                        <!-- Card contents -->
                        <div class="bg-darkCard border border-darkBorder rounded-2xl p-6 hover:border-purpleAccent/50 transition-all duration-300">
                            <!-- Header with Mode Buttons -->
                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 mb-3">
                                <div>
                                    <h3 class="text-lg font-bold text-white" x-text="item.position"></h3>
                                    <span class="text-sm text-purpleAccent font-semibold" x-text="item.institution"></span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-xs text-gray-500 bg-[#0E0E0E] px-3 py-1 rounded-full border border-darkBorder font-medium" 
                                          x-text="formatDate(item.start_date) + ' - ' + formatDate(item.end_date)"></span>
                                    
                                    <!-- Edit/Delete buttons in Edit Mode -->
                                    <div x-show="editMode" class="flex gap-1">
                                        <button @click="openExperienceModal('edit', item)" class="p-1.5 bg-yellow-500/10 hover:bg-yellow-500 text-yellow-500 hover:text-white rounded-md border border-yellow-500/20 transition-all duration-200" title="Edit">
                                            <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                        </button>
                                        <button @click="deleteItem('experience', item.id)" class="p-1.5 bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white rounded-md border border-red-500/20 transition-all duration-200" title="Delete">
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
    </section>

    <!-- EDUCATION SECTION -->
    <section id="education" class="py-20 border-t border-darkBorder bg-[#0A0A0A] relative">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex items-center justify-between mb-2">
                <div>
                    <h2 class="font-outfit font-bold text-3xl text-white">Education History</h2>
                    <div class="w-12 h-1 bg-purpleAccent mt-2"></div>
                </div>
                <!-- Add Education button in Edit Mode -->
                <div x-show="editMode">
                    <button @click="openEducationModal('add')" class="px-4 py-2 bg-purpleAccent text-white text-xs font-semibold rounded-lg hover:bg-purpleHover flex items-center gap-1.5 transition-all duration-200">
                        <i data-lucide="plus" class="w-4 h-4"></i> Add Education
                    </button>
                </div>
            </div>

            <!-- Timeline -->
            <div class="mt-12 relative border-l-2 border-darkBorder ml-4 md:ml-6 space-y-12">
                <template x-if="educations.length === 0">
                    <div class="pl-8 text-gray-500 text-sm">No education records added yet.</div>
                </template>
                <template x-for="item in educations" :key="item.id">
                    <div class="relative pl-8 md:pl-10">
                        <!-- Bullet dot -->
                        <div class="absolute -left-[9px] top-1.5 w-4 h-4 rounded-full bg-purpleAccent border-4 border-darkBg shadow-[0_0_10px_rgba(124,58,237,0.8)]"></div>

                        <!-- Card contents -->
                        <div class="bg-darkCard border border-darkBorder rounded-2xl p-6 hover:border-purpleAccent/50 transition-all duration-300">
                            <!-- Header with Mode Buttons -->
                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 mb-3">
                                <div>
                                    <h3 class="text-lg font-bold text-white" x-text="item.degree"></h3>
                                    <span class="text-sm text-purpleAccent font-semibold" x-text="item.institution"></span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-xs text-gray-500 bg-[#0E0E0E] px-3 py-1 rounded-full border border-darkBorder font-medium" 
                                          x-text="formatDate(item.start_date) + ' - ' + formatDate(item.end_date)"></span>
                                    
                                    <!-- Edit/Delete buttons in Edit Mode -->
                                    <div x-show="editMode" class="flex gap-1">
                                        <button @click="openEducationModal('edit', item)" class="p-1.5 bg-yellow-500/10 hover:bg-yellow-500 text-yellow-500 hover:text-white rounded-md border border-yellow-500/20 transition-all duration-200" title="Edit">
                                            <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                        </button>
                                        <button @click="deleteItem('education', item.id)" class="p-1.5 bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white rounded-md border border-red-500/20 transition-all duration-200" title="Delete">
                                            <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <template x-if="item.description">
                                <p class="text-sm text-gray-400 leading-relaxed whitespace-pre-line" x-text="item.description"></p>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </section>

    <!-- PROJECTS SECTION -->
    <section id="projects" class="py-20 border-t border-darkBorder relative">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-2">
                <div>
                    <h2 class="font-outfit font-bold text-3xl text-white">Projects Showcase</h2>
                    <div class="w-12 h-1 bg-purpleAccent mt-2"></div>
                </div>
                <!-- Add Project button in Edit Mode -->
                <div x-show="editMode">
                    <button @click="openProjectModal('add')" class="px-4 py-2 bg-purpleAccent text-white text-xs font-semibold rounded-lg hover:bg-purpleHover flex items-center gap-1.5 transition-all duration-200">
                        <i data-lucide="plus" class="w-4 h-4"></i> Add Project
                    </button>
                </div>
            </div>

            <!-- Category Filter Tabs -->
            <div class="flex flex-wrap items-center gap-2 mt-8">
                <button @click="categoryFilter = 'all'" :class="categoryFilter === 'all' ? 'bg-purpleAccent text-white border-purpleAccent' : 'bg-darkCard text-gray-400 border-darkBorder hover:text-white'" class="px-5 py-2 text-xs font-bold uppercase tracking-wider rounded-full border transition-all duration-200">
                    All
                </button>
                <button @click="categoryFilter = '3D Art'" :class="categoryFilter === '3D Art' ? 'bg-purpleAccent text-white border-purpleAccent' : 'bg-darkCard text-gray-400 border-darkBorder hover:text-white'" class="px-5 py-2 text-xs font-bold uppercase tracking-wider rounded-full border transition-all duration-200">
                    3D Art
                </button>
                <button @click="categoryFilter = 'Graphic Design'" :class="categoryFilter === 'Graphic Design' ? 'bg-purpleAccent text-white border-purpleAccent' : 'bg-darkCard text-gray-400 border-darkBorder hover:text-white'" class="px-5 py-2 text-xs font-bold uppercase tracking-wider rounded-full border transition-all duration-200">
                    Graphic Design
                </button>
                <button @click="categoryFilter = 'Full Stack Dev'" :class="categoryFilter === 'Full Stack Dev' ? 'bg-purpleAccent text-white border-purpleAccent' : 'bg-darkCard text-gray-400 border-darkBorder hover:text-white'" class="px-5 py-2 text-xs font-bold uppercase tracking-wider rounded-full border transition-all duration-200">
                    Full Stack Dev
                </button>
            </div>

            <!-- Grid of Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
                <template x-if="filteredProjects().length === 0">
                    <div class="col-span-full text-center text-gray-500 text-sm py-12">No projects found in this category.</div>
                </template>
                <template x-for="item in filteredProjects()" :key="item.id">
                    <div class="bg-darkCard border border-darkBorder rounded-2xl overflow-hidden hover:border-purpleAccent/50 transition-all duration-300 flex flex-col justify-between group">
                        
                        <!-- Card top body -->
                        <div>
                            <!-- Thumbnail with default state -->
                            <div class="relative h-48 w-full overflow-hidden bg-zinc-900 border-b border-darkBorder flex items-center justify-center">
                                <template x-if="item.thumbnail_url">
                                    <img :src="item.thumbnail_url" alt="Project thumbnail" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </template>
                                <template x-if="!item.thumbnail_url">
                                    <div class="w-full h-full bg-gradient-to-br from-purpleAccent/20 to-zinc-900 flex flex-col justify-center items-center gap-2 p-6">
                                        <i data-lucide="code-xml" class="w-12 h-12 text-purpleAccent/50"></i>
                                        <span class="font-outfit text-xs font-bold text-gray-400 tracking-widest uppercase" x-text="item.project_name"></span>
                                    </div>
                                </template>

                                <!-- Edit Mode actions overlay -->
                                <div x-show="editMode" class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 flex items-center justify-center gap-2 transition-all duration-200">
                                    <button @click="openProjectModal('edit', item)" class="p-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-all duration-150 flex items-center gap-1.5 text-xs font-semibold">
                                        <i data-lucide="edit-2" class="w-3.5 h-3.5"></i> Edit
                                    </button>
                                    <button @click="deleteItem('project', item.id)" class="p-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-all duration-150 flex items-center gap-1.5 text-xs font-semibold">
                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i> Delete
                                    </button>
                                </div>
                            </div>

                            <div class="p-6">
                                <h3 class="text-xl font-bold text-white mb-2 group-hover:text-purpleAccent transition-colors duration-200" x-text="item.project_name"></h3>
                                <p class="text-sm text-gray-400 leading-relaxed line-clamp-3 mb-4" x-text="item.description"></p>
                                
                                <!-- Tech badges -->
                                <div class="flex flex-wrap gap-1.5 mb-6">
                                    <template x-for="tag in item.tech_stack" :key="tag">
                                        <span class="text-xs text-purpleAccent font-semibold bg-purpleAccent/10 border border-purpleAccent/25 px-2 py-0.5 rounded-md" x-text="tag"></span>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <!-- Card footer actions -->
                        <div class="px-6 pb-6 pt-0 flex gap-4 mt-auto">
                            <template x-if="item.project_url">
                                <a :href="item.project_url" target="_blank" class="flex-1 px-4 py-2 bg-purpleAccent hover:bg-purpleHover text-white text-xs font-bold rounded-lg transition-all duration-200 flex items-center justify-center gap-1.5 shadow-[0_4px_10px_rgba(124,58,237,0.15)]">
                                    <i data-lucide="external-link" class="w-3.5 h-3.5"></i> Visit Project
                                </a>
                            </template>
                            <template x-if="item.github_url">
                                <a :href="item.github_url" target="_blank" class="px-4 py-2 bg-darkCard border border-darkBorder hover:border-purpleAccent hover:text-purpleAccent text-gray-300 text-xs font-bold rounded-lg transition-all duration-200 flex items-center justify-center gap-1.5">
                                    <i data-lucide="github" class="w-3.5 h-3.5"></i> Code
                                </a>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </section>

    <!-- SKILLS SECTION -->
    <section id="skills" class="py-20 border-t border-darkBorder bg-[#0A0A0A] relative">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex items-center justify-between mb-2">
                <div>
                    <h2 class="font-outfit font-bold text-3xl text-white">Skills & Technologies</h2>
                    <div class="w-12 h-1 bg-purpleAccent mt-2"></div>
                </div>
                <!-- Add Skill button in Edit Mode -->
                <div x-show="editMode">
                    <button @click="openSkillModal('add')" class="px-4 py-2 bg-purpleAccent text-white text-xs font-semibold rounded-lg hover:bg-purpleHover flex items-center gap-1.5 transition-all duration-200">
                        <i data-lucide="plus" class="w-4 h-4"></i> Add Skill
                    </button>
                </div>
            </div>

            <!-- Group skills by categories -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">
                <template x-for="category in getSkillCategories()" :key="category">
                    <div class="bg-darkCard border border-darkBorder rounded-2xl p-6">
                        <h3 class="text-lg font-bold text-white mb-4 border-b border-darkBorder pb-2 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-purpleAccent shadow-[0_0_10px_#7C3AED]"></span>
                            <span x-text="category"></span>
                        </h3>
                        
                        <div class="flex flex-wrap gap-2.5">
                            <template x-for="item in getSkillsByCategory(category)" :key="item.id">
                                <div class="relative group">
                                    <div class="bg-[#121212] border border-darkBorder hover:border-purpleAccent/55 px-3 py-1.5 rounded-xl text-sm text-gray-300 font-medium transition-all duration-200 cursor-default flex items-center gap-2">
                                        <span x-text="item.skill_name"></span>
                                        <span class="text-[10px] text-gray-500 bg-darkCard px-1.5 py-0.5 rounded font-bold uppercase" x-text="item.level"></span>
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
    <section id="contact" class="py-20 border-t border-darkBorder relative">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="font-outfit font-bold text-3xl text-white mb-2 text-center">Get In Touch</h2>
            <div class="w-12 h-1 bg-purpleAccent mb-12 mx-auto"></div>

            <div class="max-w-xl mx-auto bg-darkCard border border-darkBorder rounded-3xl p-8 relative overflow-hidden">
                <div class="absolute -right-16 -top-16 w-32 h-32 bg-purpleAccent/10 rounded-full blur-xl"></div>
                <div class="absolute -left-16 -bottom-16 w-32 h-32 bg-purpleAccent/10 rounded-full blur-xl"></div>

                <div class="space-y-6 relative z-10">
                    <!-- Email -->
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-purpleAccent/10 border border-purpleAccent/20 flex items-center justify-center text-purpleAccent">
                            <i data-lucide="mail" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <span class="text-xs text-gray-500 uppercase tracking-widest font-bold">Email Address</span>
                            <a :href="'mailto:' + profile.email" class="block text-gray-200 hover:text-purpleAccent transition-colors text-sm sm:text-base" x-text="profile.email"></a>
                        </div>
                    </div>

                    <!-- Phone -->
                    <template x-if="profile.phone_number">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-purpleAccent/10 border border-purpleAccent/20 flex items-center justify-center text-purpleAccent">
                                <i data-lucide="phone" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <span class="text-xs text-gray-500 uppercase tracking-widest font-bold">Phone Number</span>
                                <span class="block text-gray-200 text-sm sm:text-base" x-text="profile.phone_number"></span>
                            </div>
                        </div>
                    </template>

                    <!-- Location -->
                    <template x-if="profile.location">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-purpleAccent/10 border border-purpleAccent/20 flex items-center justify-center text-purpleAccent">
                                <i data-lucide="map-pin" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <span class="text-xs text-gray-500 uppercase tracking-widest font-bold">Location</span>
                                <span class="block text-gray-200 text-sm sm:text-base" x-text="profile.location"></span>
                            </div>
                        </div>
                    </template>
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
                    <textarea x-model="educationForm.description" rows="4" class="w-full bg-[#121212] border border-darkBorder rounded-xl px-4 py-2.5 text-gray-100 focus:outline-none focus:border-purpleAccent transition-colors"></textarea>
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
                            <option value="Backend">Backend</option>
                            <option value="Frontend">Frontend</option>
                            <option value="Database">Database</option>
                            <option value="Tools">Tools</option>
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
                id: null, institution: '', degree: '', start_date: '', end_date: '', description: ''
            },
            projectForm: {
                id: null, project_name: '', description: '', thumbnail: null, project_url: '', github_url: '', tech_stack_input: '', category: 'Graphic Design'
            },
            skillForm: {
                id: null, skill_name: '', level: 'Intermediate', category: 'Backend'
            },

            init() {
                // Initialize assets correctly
                this.projects = this.projects.map(p => {
                    p.thumbnail_url = p.thumbnail ? `/storage/${p.thumbnail}` : null;
                    return p;
                });
                this.profile.photo_url = this.profile.photo ? `/storage/${this.profile.photo}` : null;
            },

            formatDate(dateStr) {
                if (!dateStr) return 'Present';
                const date = new Date(dateStr);
                return date.toLocaleDateString('en-US', { month: 'short', year: 'numeric' });
            },

            // Skill groupings
            getSkillCategories() {
                const cats = this.skills.map(s => s.category);
                return [...new Set(cats)];
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
                    this.educationForm = { id: null, institution: '', degree: '', start_date: '', end_date: '', description: '' };
                }
                this.activeModal = 'education';
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
