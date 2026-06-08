<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Status Laporan Berubah</title>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .header {
            background: #7fc8c6;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            color: white;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            color: white;
            margin: 5px 0 0;
            opacity: 0.9;
        }
        .content {
            padding: 24px;
        }
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
        }
        .status-old {
            background: #e5e7eb;
            color: #374151;
        }
        .status-new {
            background: #10b981;
            color: white;
        }
        .info-box {
            background: #f3f4f6;
            padding: 16px;
            border-radius: 8px;
            margin: 16px 0;
        }
        .footer {
            background: #f3f4f6;
            padding: 16px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
        }
        .note {
            margin-top: 16px;
            font-size: 12px;
            color: #6b7280;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>E-Report</h1>
            <p>Kecamatan Sindang</p>
        </div>

        <div class="content">
            <h2>Halo, {{ $report->user->name }}!</h2>

            <p>Status laporan Anda dengan judul <strong>"{{ $report->judul }}"</strong> telah mengalami perubahan.</p>

            <div class="info-box">
                <p><strong>📋 Detail Laporan:</strong></p>
                <p>📌 Judul: {{ $report->judul }}</p>
                <p>📍 Lokasi: {{ $report->lokasi }}</p>
                <p>📅 Tanggal: {{ $report->created_at->format('d M Y H:i') }}</p>
            </div>

            <div style="text-align: center; margin: 20px 0;">
                <span class="status-badge status-old">Sebelum: {{ ucfirst($oldStatus) }}</span>
                <span style="margin: 0 10px;">→</span>
                <span class="status-badge status-new">Sesudah: {{ ucfirst($newStatus) }}</span>
            </div>

            @if($report->catatan && $newStatus != 'menunggu')
                <div class="info-box">
                    <p><strong>📝 Catatan dari Admin:</strong></p>
                    <p>{{ $report->catatan }}</p>
                </div>
            @endif

            @if($report->alasan_tolak && $newStatus == 'ditolak')
                <div class="info-box">
                    <p><strong>❌ Alasan Penolakan:</strong></p>
                    <p>{{ $report->alasan_tolak }}</p>
                </div>
            @endif

            <p>Terima kasih telah menggunakan E-Report untuk melaporkan kerusakan fasilitas umum.</p>

            <div class="note">
                <p>📌 Catatan: Email ini dikirim secara otomatis sebagai notifikasi perubahan status.</p>
                <p>Silakan login ke aplikasi E-Report untuk melihat detail lengkap laporan Anda.</p>
            </div>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} E-Report Kecamatan Sindang. All rights reserved.</p>
            <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
        </div>
    </div>
</body>
</html>
