<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['group' => 'general', 'key' => 'company_name', 'value' => 'PT Halus Ciptanadi'],
            ['group' => 'general', 'key' => 'tagline', 'value' => 'Kepuasan anda adalah kebahagiaan kami'],
            ['group' => 'general', 'key' => 'email', 'value' => 'info@halusciptanadi.com'],
            ['group' => 'general', 'key' => 'phone', 'value' => '+62 361 123456'],
            ['group' => 'general', 'key' => 'whatsapp', 'value' => '+6281234567890'],
            ['group' => 'social', 'key' => 'facebook', 'value' => 'https://facebook.com/halus.ciptanadi.18'],
            ['group' => 'social', 'key' => 'instagram', 'value' => 'https://instagram.com/halus.marketplace'],
            ['group' => 'address', 'key' => 'address_denpasar', 'value' => 'Jl. Raya Denpasar, Denpasar, Bali'],
            ['group' => 'address', 'key' => 'address_singaraja', 'value' => 'Jl. Raya Singaraja, Singaraja, Bali'],
            ['group' => 'address', 'key' => 'address_negara', 'value' => 'Jl. Raya Negara, Negara, Bali'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
