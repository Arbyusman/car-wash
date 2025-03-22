<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'title' => 'car washing ',
                'description' => '<p>Lorem ipsum dolor sit amet elit. In vitae turpis. Donec in hendre dui, vel blandit massa. Ut vestibu suscipi cursus. Cras quis porta nulla, ut placerat risus. Aliquam nec magna eget velit luctus dictum<br><br>&nbsp;</p><ul><li>Seats washing</li><li>Vacuum cleaning</li><li>Interior wet cleaning</li><li>Window wiping</li></ul><p>&nbsp;</p>',
                'image' => 'default_image.png',
            ],
        ];

        AboutUs::insert($data);
    }
}
