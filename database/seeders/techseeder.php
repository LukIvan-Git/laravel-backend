<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\TechStackItem;
class techseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();
        try{
            TechStackItem::create([
                'name'=>'Frontend',
                'icon_path'=>'html.png',
                'details'=>[
                    [
                        'name'=>'JavaScript',
                        'proficiency'=>'5',   
                    ],
                    [
                        'name'=>'CSS',
                        'proficiency'=>'4',   
                    ],
                    [
                        'name'=>'Bootstrap',
                        'proficiency'=>'5',   
                    ],
                ]
            ]);

            TechStackItem::create([
                'name'=>'Vue.js',
                'icon_path'=>'vue.png',
                'details'=>[
                    [
                        'name'=>'Vue 2',
                        'proficiency'=>'5',   
                    ],
                    [
                        'name'=>'Vue 3',
                        'proficiency'=>'3',   
                    ],
                ]
            ]);

            TechStackItem::create([
                'name'=>'Laravel',
                'icon_path'=>'laravel.png',
                'details'=>[
                    [
                        'name'=>'Eloquent ORM',
                        'proficiency'=>'3',   
                    ],
                    [
                        'name'=>'Database Management',
                        'proficiency'=>'4',   
                    ],
                    [
                        'name'=>'CMS Development',
                        'proficiency'=>'4',   
                    ],
                ]
            ]);

            TechStackItem::create([
                'name'=>'API',
                'icon_path'=>'api.png',
                'details'=>[
                    [
                        'name'=>'Payment Gateway',
                        'proficiency'=>'4',   
                    ],
                    [
                        'name'=>'SMTP',
                        'proficiency'=>'4',   
                    ],
                ]
            ]);

        }catch(\Exception $e){
            DB::rollBack();
            throw $e;
        }

        DB::commit();

    }
}
