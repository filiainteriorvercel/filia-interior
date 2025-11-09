<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - {{ config('app.name') }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }
        .header p {
            margin: 10px 0 0;
            font-size: 14px;
            opacity: 0.95;
        }
        .lock-icon {
            width: 70px;
            height: 70px;
            background-color: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 20px;
        }
        .message {
            color: #4a5568;
            font-size: 15px;
            line-height: 1.8;
            margin-bottom: 30px;
        }
        .button-container {
            text-align: center;
            margin: 35px 0;
        }
        .reset-button {
            display: inline-block;
            padding: 16px 40px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            transition: transform 0.2s;
        }
        .reset-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.5);
        }
        .info-box {
            background-color: #fef3cd;
            border-left: 4px solid #ffc107;
            padding: 15px 20px;
            margin: 25px 0;
            border-radius: 4px;
        }
        .info-box p {
            margin: 0;
            color: #856404;
            font-size: 14px;
        }
        .alternative-link {
            background-color: #f7fafc;
            padding: 20px;
            border-radius: 8px;
            margin-top: 30px;
        }
        .alternative-link p {
            margin: 0 0 10px;
            font-size: 13px;
            color: #718096;
        }
        .alternative-link a {
            color: #667eea;
            word-break: break-all;
            font-size: 12px;
        }
        .footer {
            background-color: #2d3748;
            color: #cbd5e0;
            padding: 25px 30px;
            text-align: center;
            font-size: 13px;
        }
        .footer p {
            margin: 5px 0;
        }
        .footer a {
            color: #90cdf4;
            text-decoration: none;
        }
        .security-notice {
            background-color: #e6fffa;
            border-left: 4px solid #38b2ac;
            padding: 15px 20px;
            margin: 25px 0;
            border-radius: 4px;
        }
        .security-notice p {
            margin: 0;
            color: #234e52;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <div class="lock-icon">
                <svg width="35" height="35" fill="white" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                </svg>
            </div>
            <h1>Reset Password</h1>
            <p>{{ config('app.name') }}</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Halo, {{ $user->name }}!
            </div>

            <div class="message">
                <p>Kami menerima permintaan untuk mereset password akun Anda.</p>
                <p>Klik tombol di bawah ini untuk membuat password baru:</p>
            </div>

            <!-- Reset Button -->
            <div class="button-container">
                <a href="{{ $url }}" class="reset-button">Reset Password Saya</a>
            </div>

            <!-- Info Box -->
            <div class="info-box">
                <p><strong>⏰ Link ini akan kadaluarsa dalam 60 menit</strong></p>
            </div>

            <!-- Security Notice -->
            <div class="security-notice">
                <p>
                    <strong>🔒 Keamanan Akun Anda</strong><br>
                    Jika Anda tidak meminta reset password, mohon abaikan email ini. Password Anda tidak akan berubah.
                </p>
            </div>

            <!-- Alternative Link -->
            <div class="alternative-link">
                <p><strong>Kesulitan mengklik tombol?</strong></p>
                <p>Copy dan paste link berikut ke browser Anda:</p>
                <a href="{{ $url }}">{{ $url }}</a>
            </div>

            <div class="message" style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e2e8f0;">
                <p style="margin: 0; color: #718096; font-size: 14px;">
                    Jika Anda memiliki pertanyaan, silakan hubungi tim support kami.
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>&copy; {{ date('Y') }} {{ config('app.name') }}</strong></p>
            <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
            <p style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #4a5568;">
                Butuh bantuan? <a href="{{ route('contact') }}">Hubungi Kami</a>
            </p>
        </div>
    </div>
</body>
</html>
