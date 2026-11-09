<?= $this->extend('layout/template') ?>
<?= $this->section('konten') ?>
<div class='d-flex justify-content-between align-items-center mb-3'>
    <h4 class='mb-0'>Data Mahasiswa</h4>
    <a href='<?= base_url('mahasiswa/tambah') ?>' class='btn btn-primary'>+ Tambah Data</a>
</div>
<?php if (session()->getFlashdata('pesan')): ?>
    <div class='alert alert-success'>
        <?= esc(session()->getFlashdata('pesan')) ?>
    </div>
<?php endif; ?>
<div class='card shadow-sm'>
    <div class='table-responsive'>
        <table class='table table-striped table-hover align-middle mb-0'>
            <thead class='table-primary'>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Prodi</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($mahasiswa)): ?>
                    <tr>
                        <td colspan='6' class='text-center text-muted py-4'>
                            Belum ada data mahasiswa. Klik + Tambah Data.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($mahasiswa as $i => $m): ?>
                        <tr>
                            <td>
                                <?= $i + 1 ?>
                            </td>
                            <td>
                                <?= esc($m['nim']) ?>
                            </td>
                            <td>
                                <?= esc($m['nama']) ?>
                            </td>
                            <td>
                                <?= esc($m['prodi']) ?>
                            </td>
                            <td>
                                <?= esc($m['email']) ?>
                            </td>
                            <td class='text-nowrap'>
                                <a href='<?= base_url('mahasiswa/ubah/' . $m['id']) ?>'
                                    class='btn btn-sm btn-warning'>Ubah</a>
                                <form action='<?= base_url('mahasiswa/hapus/' . $m['id']) ?>'
                                    method='post' class='d-inline'
                                    data-pesan='Yakin ingin menghapus
                            <?= esc($m['nama']) ?>?'
                                    onsubmit='return confirm(this.dataset.pesan)'>
                                    <?= csrf_field() ?>
                                    <button type='submit' class='btn btn-sm btn-danger'>Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>