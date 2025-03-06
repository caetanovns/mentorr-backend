<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $habilidades = ["PHP",
            "JavaScript",
            "MySQL",
            "PostgreSQL",
            "Linux",
            "Redes",
            "Segurança",
            "APIs REST",
            "Cloud",
            "DevOps",
            "CI/CD",
            "Docker",
            "Kubernetes",
            "Laravel",
            "Scrum",
            "Big Data",
            "Análise Dados",
            "Frontend",
            "Backend",
            "Mobile"];

        foreach ($habilidades as $habilidade)
            DB::table('skills')->updateOrInsert(['name' => $habilidade]);
    }
}
