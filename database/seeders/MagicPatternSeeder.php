<?php

namespace Database\Seeders;

use App\Enums\CssAttribute;
use App\Models\CssSetting;
use App\Models\User;
use Illuminate\Database\Seeder;

class MagicPatternSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $u = User::first();
        CssSetting::create(['user_id' => $u->id, 'value' => '10s', 'type' => CssAttribute::AnimationDuration]);

        CssSetting::create(['user_id' => $u->id, 'value' => '#fffbd6', 'type' => CssAttribute::BackgroundColor, 'order' => 0]);
        CssSetting::create(['user_id' => $u->id, 'value' => '#9cd4b0', 'type' => CssAttribute::BackgroundColor, 'order' => 1]);
        CssSetting::create(['user_id' => $u->id, 'value' => '#f9ac90', 'type' => CssAttribute::BackgroundColor, 'order' => 2]);
        CssSetting::create(['user_id' => $u->id, 'value' => '#ccc3c0', 'type' => CssAttribute::BackgroundColor, 'order' => 3]);
        CssSetting::create(['user_id' => $u->id, 'value' => '#abe1fa', 'type' => CssAttribute::BackgroundColor, 'order' => 4]);

        CssSetting::create(['user_id' => $u->id, 'value' => '120px', 'type' => CssAttribute::MarginLeft, 'order' => 0]);
        CssSetting::create(['user_id' => $u->id, 'value' => '20px', 'type' => CssAttribute::MarginLeft, 'order' => 1]);
        CssSetting::create(['user_id' => $u->id, 'value' => '80px', 'type' => CssAttribute::MarginLeft, 'order' => 2]);
        CssSetting::create(['user_id' => $u->id, 'value' => '160px', 'type' => CssAttribute::MarginLeft, 'order' => 3]);
        CssSetting::create(['user_id' => $u->id, 'value' => '220px', 'type' => CssAttribute::MarginLeft, 'order' => 4]);

        CssSetting::create(['user_id' => $u->id, 'value' => '0px', 'type' => CssAttribute::MarginTop, 'order' => 0]);
        CssSetting::create(['user_id' => $u->id, 'value' => '80px', 'type' => CssAttribute::MarginTop, 'order' => 1]);
        CssSetting::create(['user_id' => $u->id, 'value' => '160px', 'type' => CssAttribute::MarginTop, 'order' => 2]);
        CssSetting::create(['user_id' => $u->id, 'value' => '160px', 'type' => CssAttribute::MarginTop, 'order' => 3]);
        CssSetting::create(['user_id' => $u->id, 'value' => '80px', 'type' => CssAttribute::MarginTop, 'order' => 4]);
    }
}
