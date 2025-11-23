<!DOCTYPE html>
<html>
<head>
    <title>Pesan Baru dari Website</title>
</head>
<body>
    <h2>Halo Admin,</h2>
    <p>Anda telah menerima pesan baru dari formulir kontak website Filia Interior:</p>
    
    <p><strong>Nama:</strong> {{ $contact['nama'] }}</p>
    <p><strong>Email:</strong> {{ $contact['email'] }}</p>
    <p><strong>Telepon:</strong> {{ $contact['telepon'] }}</p>
    <p><strong>Subjek:</strong> {{ $contact['subject'] }}</p>
    <p><strong>Pesan:</strong></p>
    <p>{{ $contact['pesan'] }}</p>
    
    <br>
    <p>Mohon segera ditindaklanjuti.</p>
    <p>Terima kasih.</p>
</body>
</html>
