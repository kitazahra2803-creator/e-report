<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Desa;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ==================== BUAT 10 DESA ====================
        $desas = [
            ['nama_desa' => 'Desa Sindang', 'slug' => 'sindang', 'email_admin' => 'sindang@desa.com'],
            ['nama_desa' => 'Desa Terusan', 'slug' => 'terusan', 'email_admin' => 'terusan@desa.com'],
            ['nama_desa' => 'Desa Wanantara', 'slug' => 'wanantara', 'email_admin' => 'wanantara@desa.com'],
            ['nama_desa' => 'Desa Panyindangan Kulon', 'slug' => 'panyindangan_kulon', 'email_admin' => 'panyindangan_kulon@desa.com'],
            ['nama_desa' => 'Desa Rambatan Wetan', 'slug' => 'rambatan_wetan', 'email_admin' => 'rambatan_wetan@desa.com'],
            ['nama_desa' => 'Desa Panyindangan Wetan', 'slug' => 'panyindangan_wetan', 'email_admin' => 'panyindangan_wetan@desa.com'],
            ['nama_desa' => 'Desa Kenanga', 'slug' => 'kenanga', 'email_admin' => 'kenanga@desa.com'],
            ['nama_desa' => 'Desa Babadan', 'slug' => 'babadan', 'email_admin' => 'babadan@desa.com'],
            ['nama_desa' => 'Desa Dermayu', 'slug' => 'dermayu', 'email_admin' => 'dermayu@desa.com'],
            ['nama_desa' => 'Desa Rambatan Kulon', 'slug' => 'rambatan_kulon', 'email_admin' => 'rambatan_kulon@desa.com'],
        ];

        foreach ($desas as $data) {
            $desa = Desa::create($data);
            
            User::create([
                'username' => 'admin_' . $desa->slug,
                'name' => 'Admin ' . $desa->nama_desa,
                'email' => $desa->email_admin,
                'phone' => '081234567890',
                'village' => $desa->nama_desa,
                'district' => 'Kecamatan Sindang',
                'province' => 'Jawa Barat',
                'password' => bcrypt('password'),
                'role' => 'admin_desa',
                'desa_id' => $desa->id
            ]);
        }

        // ==================== ADMIN KECAMATAN ====================
        User::create([
            'username' => 'admin_kecamatan',
            'name' => 'Admin Kecamatan Sindang',
            'email' => 'admin@ereport.com',
            'phone' => '081234567890',
            'village' => 'Kecamatan Sindang',
            'district' => 'Kecamatan Sindang',
            'province' => 'Jawa Barat',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        // ==================== CONTOH WARGA (Opsional) ====================
        User::create([
            'username' => 'warga',
            'name' => 'Warga Sindang',
            'email' => 'warga@example.com',
            'phone' => '081234567891',
            'village' => 'Desa Sindang',
            'district' => 'Kecamatan Sindang',
            'province' => 'Jawa Barat',
            'password' => bcrypt('password'),
            'role' => 'user',
            'desa_id' => 1,
        ]);
    }
}