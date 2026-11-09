<?= $this->extend('layout/template') ?>
<?= $this->section('konten') ?>
<?php
$errors = session()->getFlashdata('errors') ?? [];
$modeUbah = $mhs !== null;
$aksi = $modeUbah
    ? base_url('mahasiswa/perbarui/' . $mhs['id'])
    : base_url('mahasiswa/simpan');
$kolom = [
    'nim' => 'NIM',
    'nama' => 'Nama Lengkap',
    'prodi' => 'Program Studi',
    'email' => 'Email (opsional)',
];
?>
<div class='card shadow-sm'>
    <div class='card-header'><?= esc($judul) ?></div>
    <div class='card-body'>
        <form action='<?= $aksi ?>' method='post'>
            <?= csrf_field() ?>
            <?php foreach ($kolom as $nama => $label): ?>
                <div class='mb-3'>
                    <label for='<?= $nama ?>' class='form-label'><?= $label ?></label>
                    <input type='<?= $nama === 'email' ? 'email' : 'text' ?>' id='<?= $nama ?>' name='<?= $nama ?>'
                        class='form-control <?= isset($errors[$nama]) ? 'is-invalid' : '' ?>'
                        value='<?= old($nama, $mhs[$nama] ?? '') ?>'>
                    <div class='invalid-feedback'><?= esc($errors[$nama] ?? '') ?></div>
                </div>
            <?php endforeach; ?>
            <button type='submit' class='btn btn-primary'>
                <?= $modeUbah ? 'PERBARUI' : 'SIMPAN' ?>
            </button>
            <a href='<?= base_url('mahasiswa') ?>' class='btn btn-secondary'>Batal</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>