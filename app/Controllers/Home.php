<?php

namespace App\Controllers;

use App\Models\OrmawaModel;
use App\Models\KategoriModel;
use App\Models\DokumentasiModel;

class Home extends BaseController
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
        $keyword = $this->request->getVar('search');
        $kategori_filter = $this->request->getVar('kategori');

        $builder = $this->ormawaModel->select('ormawa.*, kategori.nama_kategori, 
(SELECT nama_file FROM dokumentasi WHERE dokumentasi.id_ormawa = ormawa.id_ormawa LIMIT 1) as foto_utama')
            ->join('kategori', 'kategori.id_kategori = ormawa.id_kategori');

        if ($keyword) {
            $builder->like('ormawa.nama', $keyword);
        }

        if ($kategori_filter && $kategori_filter !== 'all') {
            $builder->where('ormawa.id_kategori', $kategori_filter);
        }

        $data['ormawa'] = $builder->findAll();
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['search'] = $keyword;
        $data['kategori_aktif'] = $kategori_filter;

        return view('public/index', $data);
    }

    public function daftar()
    {
        $keyword = $this->request->getVar('search');
        $kategori_filter = $this->request->getVar('kategori');

        $builder = $this->ormawaModel->select('ormawa.*, kategori.nama_kategori, 
(SELECT nama_file FROM dokumentasi WHERE dokumentasi.id_ormawa = ormawa.id_ormawa LIMIT 1) as foto_utama')
            ->join('kategori', 'kategori.id_kategori = ormawa.id_kategori');

        if ($keyword) {
            $builder->like('ormawa.nama', $keyword);
        }
        if ($kategori_filter && $kategori_filter !== 'all') {
            $builder->where('ormawa.id_kategori', $kategori_filter);
        }

        $data['ormawa'] = $builder->findAll();
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['search'] = $keyword;
        $data['kategori_aktif'] = $kategori_filter;

        // Diarahkan ke file view baru khusus daftar ormawa
        return view('public/daftar_ormawa', $data);
    }

    public function detail($id)
    {
        $data['ormawa'] = $this->ormawaModel->select('ormawa.*, kategori.nama_kategori')
            ->join('kategori', 'kategori.id_kategori = ormawa.id_kategori')
            ->find($id);
        $data['dokumentasi'] = $this->dokumentasiModel->where('id_ormawa', $id)->findAll();

        if (!$data['ormawa']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('public/detail', $data);
    }
}
