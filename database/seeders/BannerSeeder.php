<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'description' => 'banner 1',
                'order' => 1
            ],
            [
                'description' => 'banner 2',
                'order' => 2
            ],
            [
                'description' => 'banner 3',
                'order' => 3
            ],
            [
                'description' => 'banner 4',
                'order' => 4
            ],
            [
                'description' => 'banner 5',
                'order' => 5
            ],
        ];

        Banner::query()->forceDelete();

        foreach ($data as $key => $banner) {
            $model = Banner::create($banner);
            $model->image()->create([
                'path' => '',
                'filename' => '',
                'mime_type' => '',
                'size_in_bytes' => '',
            ]);
        }
    }
}
