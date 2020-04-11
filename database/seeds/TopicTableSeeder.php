<?php

use App\Topic;
use Illuminate\Database\Seeder;

class TopicTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $topics = [
            'จี้สร้อยคอทองคำ',
            'สร้อยคอทองคำ',
            'สร้อยข้อมือทองคำ',
            'ทองคำแท่ง',
            'กำไลทองคำ',
            'แหวนทองคำ',
            'ต่างหูทองคำ',
            'พระเลี่ยมทอง',
            'เชือกร่ม',
            'ทองคำฮ่วงป้อ',
            'สั่งทำทองคำ',
        ];
        foreach ($topics as $value) {
            Topic::create([
                'name' => $value,
            ]);
        }
    }
}
