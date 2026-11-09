<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Mahasiswa extends BaseController
{

    protected MahasiswaModel $model;
    public function __construct()
    {
        $this->model = new MahasiswaModel();
    }
    // READ: tampilkan semua data
    public function index()
    {
        return view('mahasiswa/index', [
            'judul' => 'Data Mahasiswa',
            'mahasiswa' => $this->model->orderBy('id', 'DESC')->findAll(),
        ]);
    }
    // Form tambah (mhs = null berarti mode tambah)
    public function tambah()
    {
        return view('mahasiswa/form', [
            'judul' => 'Tambah Mahasiswa',
            'mhs' => null,
        ]);
    }
    // CREATE: simpan data baru
    public function simpan()
    {
        if (!$this->validate($this->aturan())) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }
        $this->model->insert($this->dataForm());
        return redirect()->to('/mahasiswa')
            ->with('pesan', 'Data mahasiswa berhasil ditambahkan');
    }
    // Form ubah (terisi data lama)
    public function ubah(int $id)
    {
        return view('mahasiswa/form', [
            'judul' => 'Ubah Mahasiswa',
            'mhs' => $this->cari($id),
        ]);
    }
    // UPDATE: simpan perubahan
    public function perbarui(int $id)
    {
        $this->cari($id);
        if (!$this->validate($this->aturan($id))) {
            return redirect()->back()->withInput()
                ->with('errors', $this->validator->getErrors());
        }
        $this->model->update($id, $this->dataForm());
        return redirect()->to('/mahasiswa')
            ->with('pesan', 'Data mahasiswa berhasil diperbarui');
    }
    // DELETE: hapus data
    public function hapus(int $id)
    {
        $this->cari($id);
        $this->model->delete($id);
        return redirect()->to('/mahasiswa')
            ->with('pesan', 'Data mahasiswa berhasil dihapus');
    }
    // Ambil satu data, tampilkan 404 jika tidak ada
    private function cari(int $id): array
    {
        $mhs = $this->model->find($id);
        if ($mhs === null) {
            throw PageNotFoundException::forPageNotFound(
                'Data mahasiswa tidak ditemukan'
            );
        }
        return $mhs;
    }
    // Ambil isian form
    private function dataForm(): array
    {
        return [
            'nim' => trim((string) $this->request->getPost('nim')),
            'nama' => trim((string) $this->request->getPost('nama')),
            'prodi' => trim((string) $this->request->getPost('prodi')),
            'email' => trim((string) $this->request->getPost('email')),
        ];
    }
    // Aturan validasi. Saat ubah, NIM milik data itu sendiri dikecualikan
// dari pengecekan unik.
    private function aturan(?int $id = null): array
    {
        $unik = $id
            ? 'is_unique[mahasiswa.nim,id,' . $id . ']'
            : 'is_unique[mahasiswa.nim]';
        return [
            'nim' => [
                'label' => 'NIM',
                'rules' => 'required|numeric|min_length[8]|max_length[15]|' . $unik,
            ],
            'nama' => [
                'label' => 'Nama',
                'rules' => 'required|min_length[3]|max_length[100]',
            ],
            'prodi' => [
                'label' => 'Prodi',
                'rules' => 'required|max_length[50]',
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'permit_empty|valid_email|max_length[100]',
            ],
        ];
    }
}
