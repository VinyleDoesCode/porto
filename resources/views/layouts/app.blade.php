<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Developer Portfolio')</title>
    <meta name="description" content="Personal Portfolio Website showcasing multimedia design, 3D art, and creative development experience, education, projects, and skills.">
    
    <!-- Google Fonts: Outfit & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        outfit: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        darkBg: '#0A0A0F',
                        darkCard: '#111118',
                        darkCard2: '#16161E',
                        darkBorder: '#1E1E2E',
                        purpleAccent: '#7C3AED',
                        purpleHover: '#6D28D9',
                        purpleLight: '#A78BFA',
                        purpleDim: '#3B1F6E',
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s ease-in-out infinite',
                        'shimmer': 'shimmer 2s linear infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-12px)' },
                        },
                        shimmer: {
                            '0%': { backgroundPosition: '-200% center' },
                            '100%': { backgroundPosition: '200% center' },
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        * { box-sizing: border-box; }

        body {
            background-color: #0A0A0F;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }

        /* ========== SCROLLBAR ========== */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0A0A0F; }
        ::-webkit-scrollbar-thumb { background: #2D2D44; border-radius: 99px; }
        ::-webkit-scrollbar-thumb:hover { background: #7C3AED; }

        /* ========== ANIMATED GRADIENT TEXT ========== */
        .gradient-text {
            background: linear-gradient(135deg, #A78BFA 0%, #7C3AED 40%, #C084FC 70%, #818CF8 100%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: shimmer 3s linear infinite;
        }

        @keyframes shimmer {
            0% { background-position: 0% center; }
            100% { background-position: 200% center; }
        }

        /* ========== GLOW EFFECTS ========== */
        .glow-purple { box-shadow: 0 0 20px rgba(124,58,237,0.25), 0 0 60px rgba(124,58,237,0.08); }
        .glow-purple-sm { box-shadow: 0 0 10px rgba(124,58,237,0.3); }
        .glow-amber { box-shadow: 0 0 20px rgba(245,158,11,0.2); }

        /* ========== NOISE TEXTURE OVERLAY ========== */
        .noise::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
            opacity: 0.04;
            pointer-events: none;
            border-radius: inherit;
        }

        /* ========== CARD HOVER ========== */
        .card-hover {
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            border-color: #1E1E2E;
        }
        .card-hover:hover {
            border-color: rgba(124,58,237,0.4);
            box-shadow: 0 8px 40px rgba(124,58,237,0.12), 0 0 0 1px rgba(124,58,237,0.08);
            transform: translateY(-2px);
        }

        /* ========== NAV LINK HOVER UNDERLINE ========== */
        .nav-link {
            position: relative;
            transition: color 0.2s;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1.5px;
            background: linear-gradient(90deg, #7C3AED, #A78BFA);
            border-radius: 99px;
            transition: width 0.3s ease;
        }
        .nav-link:hover::after { width: 100%; }

        /* ========== SECTION ENTRANCE ========== */
        .section-tag {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: #7C3AED;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-bottom: 12px;
        }
        .section-tag::before {
            content: '';
            display: inline-block;
            width: 20px;
            height: 1.5px;
            background: #7C3AED;
            border-radius: 99px;
        }

        /* ========== BUTTON STYLES ========== */
        .btn-primary {
            background: linear-gradient(135deg, #7C3AED, #6D28D9);
            color: white;
            font-weight: 600;
            border-radius: 12px;
            padding: 10px 20px;
            font-size: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.25s;
            border: 1px solid rgba(167,139,250,0.2);
            letter-spacing: 0.02em;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #8B5CF6, #7C3AED);
            box-shadow: 0 4px 20px rgba(124,58,237,0.4);
            transform: translateY(-1px);
        }
        .btn-ghost {
            background: transparent;
            color: #9CA3AF;
            font-weight: 600;
            border-radius: 10px;
            padding: 8px 16px;
            font-size: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.2s;
            border: 1px solid #1E1E2E;
        }
        .btn-ghost:hover {
            color: white;
            border-color: rgba(124,58,237,0.4);
            background: rgba(124,58,237,0.06);
        }
        .btn-icon-yellow {
            padding: 6px;
            background: rgba(234,179,8,0.08);
            color: #EAB308;
            border: 1px solid rgba(234,179,8,0.2);
            border-radius: 8px;
            transition: all 0.2s;
        }
        .btn-icon-yellow:hover { background: #EAB308; color: white; border-color: #EAB308; }
        .btn-icon-red {
            padding: 6px;
            background: rgba(239,68,68,0.08);
            color: #EF4444;
            border: 1px solid rgba(239,68,68,0.2);
            border-radius: 8px;
            transition: all 0.2s;
        }
        .btn-icon-red:hover { background: #EF4444; color: white; border-color: #EF4444; }

        /* ========== SKILL TAG ========== */
        .skill-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            background: rgba(255,255,255,0.03);
            border: 1px solid #1E1E2E;
            border-radius: 99px;
            font-size: 0.7rem;
            font-weight: 500;
            color: #D1D5DB;
            transition: all 0.2s;
            cursor: default;
        }
        .skill-tag:hover { border-color: rgba(124,58,237,0.5); color: #A78BFA; background: rgba(124,58,237,0.06); }

        /* ========== TIMELINE LINE ========== */
        .timeline-line { background: linear-gradient(to bottom, #7C3AED33, #7C3AED88, #7C3AED33); }

        /* ========== GRID BG DOTS ========== */
        .dot-grid {
            background-image: radial-gradient(circle, #1E1E2E 1px, transparent 1px);
            background-size: 28px 28px;
        }

        /* ========== MODAL BACKDROP ========== */
        [x-show="activeModal === 'profile'"],
        [x-show="activeModal === 'experience'"],
        [x-show="activeModal === 'education'"],
        [x-show="activeModal === 'certification'"],
        [x-show="activeModal === 'project'"],
        [x-show="activeModal === 'skill'"] {
            backdrop-filter: blur(12px);
        }

        /* ========== FLOAT ANIMATION ========== */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .animate-float { animation: float 5s ease-in-out infinite; }

        /* ========== BADGE PULSE ========== */
        @keyframes badge-pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        .badge-live { animation: badge-pulse 2s ease-in-out infinite; }

        /* ========== SECTION FADE IN ========== */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="text-gray-100 min-h-screen flex flex-col selection:bg-purpleAccent selection:text-white">

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t border-darkBorder py-8 bg-darkBg relative overflow-hidden">
        <div class="absolute inset-0 dot-grid opacity-30"></div>
        <div class="max-w-6xl mx-auto px-4 flex flex-col sm:flex-row justify-between items-center gap-3 relative z-10">
            <div class="flex items-center gap-2">
                <span class="font-outfit font-bold text-sm text-white"><span class="text-purpleAccent">PORT</span>FOLIO.</span>
                <span class="text-darkBorder">•</span>
                <p class="text-xs text-gray-500">&copy; {{ date('Y') }} All rights reserved.</p>
            </div>
            <p class="text-xs text-gray-600">Built by Muhammad Zhari Ramadhan</p>
        </div>
    </footer>

    <!-- Initialize Lucide Icons -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
        });
    </script>
</body>
</html>
