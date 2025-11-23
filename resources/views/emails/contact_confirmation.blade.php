<!DOCTYPE html>
<html>
<head>
    <title>Terima Kasih telah Menghubungi Kami</title>
</head>
<body>
    <h2>Halo {{ $contact['nama'] }},</h2>
    <p>Terima kasih telah menghubungi <strong>Filia Interior</strong>. Kami telah menerima pesan Anda dan tim kami akan segera menghubungi Anda kembali.</p>
    
    <p>Berikut adalah salinan pesan yang Anda kirimkan:</p>
    <hr>
    <p><strong>Nama:</strong> {{ $contact['nama'] }}</p>
    <p><strong>Email:</strong> {{ $contact['email'] }}</p>
    <p><strong>Telepon:</strong> {{ $contact['telepon'] }}</p>
    <p><strong>Subjek:</strong> {{ $contact['subject'] }}</p>
    <p><strong>Pesan:</strong></p>
    <p>{{ $contact['pesan'] }}</p>
    <hr>
    
    <p>Salam hangat,</p>
    <p><strong>Tim Filia Interior</strong></p>
</body>
</html>
