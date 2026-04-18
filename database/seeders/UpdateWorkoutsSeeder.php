<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Workout;

class UpdateWorkoutsSeeder extends Seeder
{
    public function run(): void
    {
        $workouts = [
            [
                'id' => 1,
                'video_url' => 'https://www.youtube.com/watch?v=ml6cT4AZdqI',
                'image' => 'images/karsten-winegeart-0Wra5YYVQJE-unsplash.jpg'
            ],
            [
                'id' => 2,
                'video_url' => 'https://www.youtube.com/watch?v=UBMk30rjy0o',
                'image' => 'images/katie-smith-uQs1802D0CQ-unsplash.jpg'
            ],
            [
                'id' => 3,
                'video_url' => 'https://www.youtube.com/watch?v=v7AYKMP6rOE',
                'image' => 'images/scottwebb-training-828726.jpg'
            ],
            [
                'id' => 4,
                'video_url' => 'https://www.youtube.com/watch?v=IODxDxX7oi4',
                'image' => 'images/ani-augustine-9TogNg01qzI-unsplash.jpg'
            ],
            [
                'id' => 5,
                'video_url' => 'https://www.youtube.com/watch?v=DHD1-2P94DI',
                'image' => 'images/andrew-molyneaux-X00aKdald68-unsplash.jpg'
            ],
            [
                'id' => 6,
                'video_url' => 'https://www.youtube.com/watch?v=g_tea8ZNk5A',
                'image' => 'images/banner.jpg'
            ],
        ];

        foreach ($workouts as $workoutData) {
            Workout::where('id', $workoutData['id'])->update([
                'video_url' => $workoutData['video_url'],
                'image' => $workoutData['image']
            ]);
        }

        echo "Updated " . count($workouts) . " workouts with videos and images\n";
    }
}
