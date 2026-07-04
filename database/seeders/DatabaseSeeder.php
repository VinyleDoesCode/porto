<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Profile (Muhammad Zhari Ramadhan)
        $profile = Profile::create([
            'photo' => 'profile_photos/zhari.png',
            'full_name' => 'Muhammad Zhari Ramadhan',
            'headline' => 'Multimedia Engineering Student | 3D Artist & Graphic Designer',
            'short_description' => 'I am a Terapan Teknologi Rekayasa Multimedia student at Telkom University (Fakultas Ilmu Terapan, Angkatan 2023). I have a strong foundation in 3D modeling, graphic design, and digital art, with practical experience working as a 3D Artist and Graphic Designer at Wannabe Creative. I am passionate about pursuing a career in the Creative and Entertainment Industries.',
            'email' => 'zhariramadhan@student.telkomuniversity.ac.id',
            'phone_number' => '081931268894',
            'location' => 'Kota Bandung, Jawa Barat, Indonesia',
            'linkedin' => 'https://linkedin.com/in/muhammad-zhari-ramadhan',
            'github' => 'https://github.com/muhammad-zhari-ramadhan',
            'instagram' => 'https://www.instagram.com/vinyleart_/',
        ]);

        // 2. Seed 3 Experiences (based on screenshots)
        Experience::create([
            'profile_id' => $profile->id,
            'position' => 'Junior 3D Artist',
            'institution' => 'Wannabe Creative',
            'start_date' => '2024-09-01',
            'end_date' => '2025-09-01',
            'description' => 'Saya pernah menjadi seorang 3D artist di salah satu startup di kampus yang bekerja dalam bidang kreatif.',
        ]);

        Experience::create([
            'profile_id' => $profile->id,
            'position' => 'Junior Graphic Designer',
            'institution' => 'Wannabe Creative',
            'start_date' => '2024-09-01',
            'end_date' => '2025-09-01',
            'description' => 'Saya pernah menjadi Graphic designer di salah satu start up di kampus yang bekerja sama dengan UMKM.',
        ]);

        Experience::create([
            'profile_id' => $profile->id,
            'position' => 'Multimedia Contributor',
            'institution' => 'Telkom University Projects',
            'start_date' => '2023-10-01',
            'end_date' => '2024-06-30',
            'description' => 'Collaborated on campus multimedia events, developing digital graphics, promotional videos, and interactive asset models.',
        ]);

        // 3. Seed 3 Education records
        Education::create([
            'profile_id' => $profile->id,
            'institution' => 'Telkom University',
            'degree' => 'Terapan Teknologi Rekayasa Multimedia (Fakultas Ilmu Terapan)',
            'start_date' => '2023-08-01',
            'end_date' => null, // Present
            'description' => "NIM: 707082330124. Angkatan: 2023.\nIPK: 3.50. EPRT: 520. TAK: 73.\nDosen Wali: MEY | Mindit Eriyadi, S.Pd., M.T.",
        ]);

        Education::create([
            'profile_id' => $profile->id,
            'institution' => 'Fakultas Ilmu Terapan (FIT) Telkom',
            'degree' => 'Academic Training & Seminars',
            'start_date' => '2023-09-01',
            'end_date' => '2023-12-15',
            'description' => 'Participated in core university seminars focusing on multimedia workflow, asset optimization, and game design concepts.',
        ]);

        Education::create([
            'profile_id' => $profile->id,
            'institution' => 'Multimedia Design Certification',
            'degree' => 'Vocational Certification',
            'start_date' => '2022-07-01',
            'end_date' => '2022-12-10',
            'description' => 'Self-paced and group coursework on digital illustration, color theory, graphic styling, and vector design templates.',
        ]);

        // 4. Seed 5 Projects
        Project::create([
            'profile_id' => $profile->id,
            'project_name' => 'Surreal Giant Hands 3D Art',
            'description' => 'A surreal 3D scene depicting massive, weathered metallic hands rising out of the water toward floating islands and a tiny rowboat, conveying epic scale and dreamlike wonder.',
            'thumbnail' => 'project_thumbnails/surreal_hands.jpg',
            'project_url' => 'https://www.instagram.com/vinyleart_/',
            'github_url' => null,
            'tech_stack' => ['Blender', '3D Modeling', 'Cycles Render'],
            'category' => '3D Art',
        ]);

        Project::create([
            'profile_id' => $profile->id,
            'project_name' => 'UNFILTERED Retro Collage Art',
            'description' => 'A retro-futuristic collage combining a vintage television head structure, modern street-fashion visual styling, and noise/grain textures.',
            'thumbnail' => 'project_thumbnails/unfiltered.jpg',
            'project_url' => 'https://www.instagram.com/vinyleart_/',
            'github_url' => null,
            'tech_stack' => ['Photoshop', 'Collage Art', 'Creative Design'],
            'category' => 'Graphic Design',
        ]);

        Project::create([
            'profile_id' => $profile->id,
            'project_name' => 'H2H Cute Aesthetic Poster',
            'description' => 'A vibrant, cute aesthetic poster design utilizing playful typography, custom illustrations, and soft pink elements, tailored for a K-Pop album aesthetic concept.',
            'thumbnail' => 'project_thumbnails/h2h.jpg',
            'project_url' => 'https://www.instagram.com/vinyleart_/',
            'github_url' => null,
            'tech_stack' => ['Photoshop', 'Illustrator', 'Graphic Design'],
            'category' => 'Graphic Design',
        ]);

        Project::create([
            'profile_id' => $profile->id,
            'project_name' => 'Stairs of Life Surreal 3D Art',
            'description' => 'A high-contrast, conceptual 3D scene illustrating a cracked stone figure ascending a set of pristine white stairs next to a dark void, symbolizing human growth and persistence.',
            'thumbnail' => 'project_thumbnails/climbing_stairs.png',
            'project_url' => 'https://www.instagram.com/vinyleart_/',
            'github_url' => null,
            'tech_stack' => ['Blender', '3D Modeling', 'Lighting & Shading'],
            'category' => '3D Art',
        ]);

        Project::create([
            'profile_id' => $profile->id,
            'project_name' => 'OBSESSION Film Poster Design',
            'description' => 'Minimalist, high-contrast film poster design for Curry Barker\'s film OBSESSION, utilizing silhouettes and a bold red and black color palette.',
            'thumbnail' => 'project_thumbnails/obsession.png',
            'project_url' => 'https://www.instagram.com/vinyleart_/',
            'github_url' => null,
            'tech_stack' => ['Photoshop', 'Graphic Design', 'Creative Direction'],
            'category' => 'Graphic Design',
        ]);

        Project::create([
            'profile_id' => $profile->id,
            'project_name' => "Chick N' Spice Food Ordering App",
            'description' => 'A mobile food ordering application that allows users to browse menus, place orders, and make payments easily. Developed as a full-stack project featuring interactive user flows and local databases.',
            'thumbnail' => 'project_thumbnails/chick_n_spice.png',
            'project_url' => null,
            'github_url' => null,
            'tech_stack' => ['Figma', 'Unity', 'C#', 'SQLite'],
            'category' => 'Full Stack Dev',
        ]);

        // 5. Seed 8 Skills
        Skill::create([
            'profile_id' => $profile->id,
            'skill_name' => 'Figma',
            'level' => 'Advanced',
            'category' => 'Frontend',
        ]);

        Skill::create([
            'profile_id' => $profile->id,
            'skill_name' => 'Teamwork',
            'level' => 'Expert',
            'category' => 'Tools',
        ]);

        Skill::create([
            'profile_id' => $profile->id,
            'skill_name' => 'Blender',
            'level' => 'Advanced',
            'category' => 'Tools',
        ]);

        Skill::create([
            'profile_id' => $profile->id,
            'skill_name' => '3D Modeling',
            'level' => 'Advanced',
            'category' => 'Tools',
        ]);

        Skill::create([
            'profile_id' => $profile->id,
            'skill_name' => 'Graphic Design',
            'level' => 'Expert',
            'category' => 'Tools',
        ]);

        Skill::create([
            'profile_id' => $profile->id,
            'skill_name' => 'Photoshop',
            'level' => 'Advanced',
            'category' => 'Tools',
        ]);

        Skill::create([
            'profile_id' => $profile->id,
            'skill_name' => 'Bahasa Indonesia',
            'level' => 'Expert',
            'category' => 'Tools',
        ]);

        Skill::create([
            'profile_id' => $profile->id,
            'skill_name' => 'English',
            'level' => 'Intermediate',
            'category' => 'Tools',
        ]);
    }
}
