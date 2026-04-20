<?php

namespace Database\Seeders;

use App\Models\Desa;
use Illuminate\Database\Seeder;

class DesaSeeder extends Seeder
{
    public function run(): void
    {
        $desas = [
            'Sindang', 'Terusan', 'Wanantara',
            'Panyindangan Kulon', 'Rambatan Wetan',
            'Panyindangan Wetan', 'Kenanga', 'Babadan',
            'Dermayu', 'Rambatan Kulon'
        ];

        foreach ($desas as $desa) {
            Desa::create([
                'nama_desa' => 'Desa ' . $desa,
                'slug' => strtolower(str_replace(' ', '_', $desa)),
                'email_admin' => strtolower(str_replace(' ', '_', $desa)) . '@desa.com'
            ]);
        }
    }
}