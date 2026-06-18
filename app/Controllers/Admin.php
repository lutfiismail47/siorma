<?php

namespace App\Controllers;

use App\Models\OrmawaModel;
use App\Models\KategoriModel;
use App\Models\DokumentasiModel;

class Admin extends BaseController
{
  protected $ormawaModel, $kategoriModel, $dokumentasiModel;

  public function __construct()
  {
    $this->ormawaModel = new OrmawaModel();
    $this->kategoriModel = new KategoriModel();
    $this->dokumentasiModel = new DokumentasiModel();
  }

  public function index()
  {
    $db = \Config\Database::connect();

    // Query untuk mengambil data ormawa + relasi kategori + 1 foto dokumentasi teratas
    $ormawa = $db->table('ormawa')
      ->select('ormawa.*, kategori.nama_kategori, (SELECT nama_file FROM dokumentasi WHERE dokumentasi.id_ormawa = ormawa.id_ormawa LIMIT 1) as foto_utama')
      ->join('kategori', 'kategori.id_kategori = ormawa.id_kategori')
      ->get()
      ->getResultArray();

    return view('admin/dashboard', ['ormawa' => $ormawa]);
  }

  public function create()
  {
    $data['kategori'] = $this->kategoriModel->findAll();
    return view('admin/create', $data);
  }

  public function store()
  {
    // Validasi Logo
    $logoFile = $this->request->getFile('logo');
    $logoName = null;
    if ($logoFile->isValid() && !$logoFile->hasMoved()) {
      $logoName = $logoFile->getRandomName();
      $logoFile->move('uploads/logo/', $logoName);
    }

    // 1. Lakukan proses insert data teks ormawa ke database
    $this->ormawaModel->insert([
      'nama' => $this->request->getPost('nama'),
      'id_kategori' => $this->request->getPost('id_kategori'),
      'deskripsi' => $this->request->getPost('deskripsi'),
      'visi' => $this->request->getPost('visi'),
      'misi' => $this->request->getPost('misi'),
      'program_kerja' => $this->request->getPost('program_kerja'),
      'struktur_kepengurusan' => $this->request->getPost('struktur_kepengurusan'),
      'logo' => $logoName
    ]);

    // 2. DISISIPKAN DI SINI: Ambil ID Ormawa yang barusan dibuat secara akurat
    $id_ormawa = $this->ormawaModel->getInsertID();

    // Validasi & Simpan Dokumentasi (Maksimal 5)
    $files = $this->request->getFiles();
    if (isset($files['dokumentasi'])) {
      $count = 0;
      foreach ($files['dokumentasi'] as $file) {
        if ($count >= 5) break;
        if ($file->isValid() && !$file->hasMoved()) {
          $newName = $file->getRandomName();
          $file->move('uploads/dokumentasi/', $newName);

          // Sekarang $id_ormawa di bawah ini sudah pasti berisi angka ID yang valid (misal: 1, 2, dst)
          $this->dokumentasiModel->insert([
            'nama_file' => $newName,
            'id_ormawa' => $id_ormawa
          ]);
          $count++;
        }
      }
    }

    return redirect()->to('/admin')->with('success', 'Data Ormawa berhasil ditambahkan.');
  }

  public function edit($id)
  {
    $data['ormawa'] = $this->ormawaModel->find($id);
    $data['kategori'] = $this->kategoriModel->findAll();
    $data['dokumentasi'] = $this->dokumentasiModel->where('id_ormawa', $id)->findAll();
    return view('admin/edit', $data);
  }

  public function update($id)
  {
    $ormawa = $this->ormawaModel->find($id);
    $logoFile = $this->request->getFile('logo');
    $logoName = $ormawa['logo'];

    if ($logoFile->isValid() && !$logoFile->hasMoved()) {
      if ($logoName && file_exists('uploads/logo/' . $logoName)) unlink('uploads/logo/' . $logoName);
      $logoName = $logoFile->getRandomName();
      $logoFile->move('uploads/logo/', $logoName);
    }

    $this->ormawaModel->update($id, [
      'nama' => $this->request->getPost('nama'),
      'id_kategori' => $this->request->getPost('id_kategori'),
      'deskripsi' => $this->request->getPost('deskripsi'),
      'visi' => $this->request->getPost('visi'),
      'misi' => $this->request->getPost('misi'),
      'program_kerja' => $this->request->getPost('program_kerja'),
      'struktur_kepengurusan' => $this->request->getPost('struktur_kepengurusan'),
      'logo' => $logoName
    ]);

    $files = $this->request->getFiles();

    // JIKA ADMIN MENGUNGGAH BARISAN GAMBAR DOKUMENTASI BARU
    if (isset($files['dokumentasi']) && !empty($files['dokumentasi'][0]->getName())) {

      // 1. Ambil dan HAPUS FISIK semua file dokumentasi LAMA di folder server
      $oldDocs = $this->dokumentasiModel->where('id_ormawa', $id)->findAll();
      foreach ($oldDocs as $doc) {
        if (file_exists('uploads/dokumentasi/' . $doc['nama_file'])) {
          unlink('uploads/dokumentasi/' . $doc['nama_file']);
        }
      }

      // 2. HAPUS DATA dokumentasi LAMA dari tabel database agar hitungan reset ke 0
      $this->dokumentasiModel->where('id_ormawa', $id)->delete();

      // 3. Masukkan 5 gambar baru tanpa hambatan limitasi data usang
      $count = 0;
      foreach ($files['dokumentasi'] as $file) {
        if ($count >= 5) break; // Tetap mengunci batas maksimal 5 gambar baru
        if ($file->isValid() && !$file->hasMoved()) {
          $newName = $file->getRandomName();
          $file->move('uploads/dokumentasi/', $newName);

          $this->dokumentasiModel->insert([
            'nama_file' => $newName,
            'id_ormawa' => $id
          ]);
          $count++;
        }
      }
    }

    return redirect()->to('/admin')->with('success', 'Data Ormawa berhasil diperbarui.');
  }

  public function delete($id)
  {
    $ormawa = $this->ormawaModel->find($id);
    if ($ormawa['logo'] && file_exists('uploads/logo/' . $ormawa['logo'])) unlink('uploads/logo/' . $ormawa['logo']);

    // Hapus file dokumentasi fisik
    $docs = $this->dokumentasiModel->where('id_ormawa', $id)->findAll();
    foreach ($docs as $doc) {
      if (file_exists('uploads/dokumentasi/' . $doc['nama_file'])) unlink('uploads/dokumentasi/' . $doc['nama_file']);
    }

    // Pengaman manual jika database phpMyAdmin belum diset CASCADE
    $this->dokumentasiModel->where('id_ormawa', $id)->delete();
    $this->ormawaModel->delete($id); // CASCADE akan mengurus tabel dokumentasi di DB jika diset, jika tidak hapus manual lewat model.
    return redirect()->to('/admin')->with('success', 'Data Ormawa berhasil dihapus.');
  }
}
