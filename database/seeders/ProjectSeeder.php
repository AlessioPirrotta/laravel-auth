<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;
use App\Models\Project;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 10; $i++) {
            $project = new Project();

            $project->title = $faker->sentence(4);
            $project->slug = Str::slug($project->title, '-');
            $project->img = 'https://picsum.photos/200';
            $project->description = $faker->text(500);
            $project->software = $faker->randomElement(['Vite', 'Laravel', 'Bootstrap', 'Tailwin', 'Vue', 'HTML', 'CSS', 'JS']);
            $project->save();
        }
    }
}
