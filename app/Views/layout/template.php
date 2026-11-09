<!DOCTYPE html>
<html lang='id'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>
        <?= esc($judul ?? 'Aplikasi') ?>
    </title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
</head>

<body class='bg-light'>
    <nav class='navbar navbar-dark bg-primary mb-4'>
        <div class='container'>
            <span class='navbar-brand mb-0 h1'>Praktikum CodeIgniter 4</span>
        </div>
    </nav>
    <main class='container'>
        <?= $this->renderSection('konten') ?>
    </main>
</body>

</html>