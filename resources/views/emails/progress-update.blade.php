<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Progress Project</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4A5568;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 30px;
            border: 1px solid #ddd;
        }
        .footer {
            background-color: #4A5568;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 12px;
            border-radius: 0 0 5px 5px;
        }
        .detail-box {
            background-color: white;
            padding: 15px;
            margin: 15px 0;
            border-left: 4px solid #4A5568;
        }
        .label {
            font-weight: bold;
            color: #4A5568;
        }
        .image-container {
            text-align: center;
            margin: 20px 0;
        }
        .image-container img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🏗️ Update Progress Project</h1>
    </div>
    
    <div class="content">
        <p>Halo <strong>{{ $customerName }}</strong>,</p>
        
        <p>Kami dengan senang hati memberitahu bahwa ada update terbaru untuk project Anda!</p>
        
        <div class="detail-box">
            <p><span class="label">ID Project:</span> {{ $progressUpdate->id_project }}</p>
            <p><span class="label">Tanggal Update:</span> {{ \Carbon\Carbon::parse($progressUpdate->tanggal_update)->format('d F Y') }}</p>
            <p><span class="label">Status:</span> 
                @if($progressUpdate->status == 'in_progress')
                    Sedang Dikerjakan
                @elseif($progressUpdate->status == 'completed')
                    Selesai
                @elseif($progressUpdate->status == 'on_hold')
                    Ditunda
                @else
                    Sedang Dikerjakan
                @endif
            </p>
        </div>
        
        <div class="detail-box">
            <p class="label">Deskripsi Update:</p>
            <p>{{ $progressUpdate->deskripsi }}</p>
        </div>
        
        @if($progressUpdate->foto)
        <div class="detail-box" style="background-color: #EBF8FF; border-left-color: #3182CE;">
            <p class="label">📷 Foto Progress:</p>
            @if(str_starts_with($progressUpdate->foto, 'data:'))
                {{-- Base64 image from Vercel - shown as attachment --}}
                <p style="color: #2C5282; margin: 10px 0;">
                    ✅ Foto progress terlampir sebagai attachment di email ini.<br>
                    Silakan buka attachment untuk melihat foto.
                </p>
            @else
                {{-- File path from local - show inline image --}}
                <div class="image-container">
                    <img src="{{ url($progressUpdate->foto) }}" alt="Progress Update" style="max-width: 100%; height: auto; border-radius: 8px; margin-top: 10px;">
                </div>
            @endif
        </div>
        @endif
        
        <p style="margin-top: 30px;">Untuk melihat detail lebih lanjut, silakan login ke dashboard Anda.</p>
        
        <p>Terima kasih atas kepercayaan Anda menggunakan layanan kami!</p>
    </div>
    
    <div class="footer">
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        <p>Email ini dikirim otomatis, mohon tidak membalas email ini.</p>
    </div>
</body>
</html>
