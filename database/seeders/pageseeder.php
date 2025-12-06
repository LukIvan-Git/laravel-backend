<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;
use Illuminate\Support\Facades\DB;
class pageseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();

            try{
                Page::create([
                    'slug'=>'homepage',
                    'title'=>[
                        'en'=>'Homepage',
                        'zh_hk'=>'首頁'
                    ],
                    'route'=>'homepage',
                    'data'=>[
                        'content'=>[
                            'en'=>'This is Web developer Luk Chung Yin\'s website<br>You can know about me from below!',
                            'zh_hk'=>'這是網頁開發者陸頌賢的網站<br>你可以從下面了解我！'
                        ]
                    ]
                ]);
                
                Page::create([
                    'slug'=>'my-careers',
                    'title'=>[
                        'en'=>'My Careers',
                        'zh_hk'=>'工作經驗'
                    ],
                    'route'=>'my_careers',
                    'data'=>[
                        'content'=>[
                            'en'=>'',
                            'zh_hk'=>''
                        ]
                    ]
                ]);

                Page::create([
                    'slug'=>'contact-me',
                    'title'=>[
                        'en'=>'Contact Me',
                        'zh_hk'=>'聯絡資料'
                    ],
                    'route'=>'contact_me',
                    'data'=>[
                        'content'=>[
                            'en'=>'',
                            'zh_hk'=>''
                        ]
                    ]
                ]);

            }catch(\Exception $e){
                DB::rollBack();
                throw $e;
            }


        DB::commit();
    }
}
