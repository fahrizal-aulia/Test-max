<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ujian;
use App\Models\Siswa;
use App\Models\PesertaUjian;

class LaporanController extends Controller
{
    /**
     * 3.a. Menampilkan Ujian berdasarkan TANGGAL
     */
    public function ujianByTanggal(Request $request)
    {
        // Validasi input tanggal
        $request->validate(['tanggal' => 'sometimes|date']);

        $tanggal = $request->input('tanggal');
        $ujian = [];

        // Hanya cari jika tanggal diisi
        if ($tanggal) {
            $ujian = Ujian::whereDate('tanggal', $tanggal)->with('matpel')->get();
        }

        return view('laporan.by_tanggal', [
            'ujian' => $ujian,
            'tanggalDipilih' => $tanggal
        ]);
    }

    /**
     * 3.b. Menampilkan NAMA_UJIAN, NAMA_MATPEL, TANGGAL, JUMLAH_PESERTA
     */
    public function jumlahPeserta()
    {
        // Eager load 'matpel' dan hitung relasi 'peserta'
        $laporan = Ujian::with('matpel')
                        ->withCount('peserta as jumlah_peserta')
                        ->get();

        $hasil = $laporan->map(function ($item) {
            // Pastikan matpel ada untuk menghindari error
            $nama_matpel = $item->matpel ? $item->matpel->nama_matpel : 'N/A';

            return [
                'nama_ujian' => $item->nama,
                'nama_matpel' => $nama_matpel,
                'tanggal' => $item->tanggal,
                'jumlah_peserta' => $item->jumlah_peserta, // Hasil dari withCount
            ];
        });

        return view('laporan.jumlah_peserta', ['hasil' => $hasil]);
    }

    /**
     * 3.c & 3.d (Laporan Kelulusan)
     */
    public function statusKelulusan()
    {
        // Gunakan model PesertaUjian yang sudah kita buat Accessor-nya
        $semuaHasil = PesertaUjian::with('siswa', 'ujian.matpel')->get();

        $siswaGagalList = [];
        $nisSiswaGagal = [];

        foreach ($semuaHasil as $hasil) {
            // Panggil accessor $hasil->status_lulus
            if ($hasil->status_lulus == false) {

                // Pastikan relasi tidak null
                if ($hasil->siswa && $hasil->ujian && $hasil->ujian->matpel) {
                    $siswaGagalList[] = [
                        'nama_siswa' => $hasil->siswa->nama,
                        'nis' => $hasil->siswa->nis,
                        'gagal_di_matpel' => $hasil->ujian->matpel->nama_matpel,
                        'pada_ujian' => $hasil->ujian->nama,
                        'nilai' => $hasil->nilai,
                        'kkm' => $hasil->ujian->matpel->kkm,
                    ];
                    $nisSiswaGagal[$hasil->siswa->nis] = true;
                }
            }
        }

        // Ambil semua NIS unik siswa yang pernah ikut ujian
        $semuaSiswaNis = $semuaHasil->pluck('nis')->unique();

        // Filter siswa yang NIS-nya TIDAK ADA di $nisSiswaGagal
        $nisLulusSemua = $semuaSiswaNis->filter(function ($nis) use ($nisSiswaGagal) {
            return !isset($nisSiswaGagal[$nis]);
        });

        $jumlahLulusSemua = $nisLulusSemua->count();

        return view('laporan.status_kelulusan', [
            'jumlahLulusSemua' => $jumlahLulusSemua,
            'siswaGagalList' => $siswaGagalList
        ]);
    }
}