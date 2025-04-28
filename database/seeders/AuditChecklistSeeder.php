<?php

namespace Database\Seeders;

use App\Models\HasilChecklist;
use App\Models\Heading;
use App\Models\Pertanyaan;
use App\Models\SubHeading;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuditChecklistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // E. BAHAN, PENANGANAN DAN PENGOLAHAN
        $hrgaA = $this->createHeading('purchasing', 'A. Menejemen Pengadaan Material');
        $subHrgaA = $this->createSubHeading($hrgaA->id, '');
        $pertanyaanSDM = [
            [
                'teks' => 'Perusahaan tidak memiliki meknaisme dan bukti pelaksanaan dalam melakukan seleksi bahan baku, bahan kemas, bahan pembantu, Vendor Jasa, dll',
                'nomor_urutan' => 1
            ],
            [
                'teks' => 'Perusahaan tidak memiliki mekanisme dan bukti pelaksanaan untuk melakukan pengadaan / pembelian yang memperhatikan kesesuaian barang sebelum dibeli',
                'nomor_urutan' => 2
            ],
            [
                'teks' => 'Perusahaan tidak memiliki mekanisme dan bukti pelaksanaan untuk melakukan evaluasi seluruh vendor dengan memperhatikan kualitas barang dan jasa yang disuplai',
                'nomor_urutan' => 3
            ],
            [
                'teks' => 'Perusahaan tidak memiliki list vendor tetap guna Sebagai list data internal perusahaan',
                'nomor_urutan' => 4
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $hrgaA = $this->createHeading('qa/qc', 'A. SANITASI DAN HYGIENE KARYAWAN');
        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Pembinaan Karyawan');
        $pertanyaanSDM = [
            [
                'teks' => 'Manajemen unit pengolahan tidak memiliki tindakan-tindakan efektif untuk mencegah karyawan yang diketahui mengidap penyakit yang dapat mengkontaminasi produk (luka,TBC,Hepatits, Tipus, dsb)',
                'nomor_urutan' => 1
            ],
            [
                'teks' => 'Pelatihan pekerja dalam hal sanitasi dan hygiene tidak cukup',
                'nomor_urutan' => 2
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Perilaku Karyawan');
        $pertanyaanSDM = [
            [
                'teks' => 'Kebersihan karyawan tidak dijaga dengan baik dan tidak memperhatikan aspek sanitasi dan hygiene ( seperti pakaian kurang lengkap dan kotor,meludah diruang pengolahan,merokok dan lain-lain)',
                'nomor_urutan' => 3
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $hrgaA = $this->createHeading('qa/qc', 'B. ASPEK YANG DINILAI');
        $subHrgaA = $this->createSubHeading($hrgaA->id, '');
        $pertanyaanSDM = [
            [
                'teks' => 'Tindakan  karyawan tidak mampu mengurangi dan mencegah kontaminasi baik dari mikroba maupun dari benda asing lainnya.',
                'nomor_urutan' => 1
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Sanitasi Karyawan');
        $pertanyaanSDM = [
            [
                'teks' => 'Pakaian kerja tidak dipakai dengan benar dan tidak bersih',
                'nomor_urutan' => 2
            ],
            [
                'teks' => 'Tidak ada pengawasan dalam sanitasi,pencucian tangan dan kaki sebelum masuk ruang pengolahan dan setelah keluar dari toilet',
                'nomor_urutan' => 3
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Sumber Infeksi');
        $pertanyaanSDM = [
            [
                'teks' => 'Karyawan tidak bebas dari penyakit kulit,atau penyakit menular lainnya.',
                'nomor_urutan' => 4
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $hrgaA = $this->createHeading('qa/qc', 'C. TINDAKAN PENGAWASAN QC');
        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Bahan baku/mentah');
        $pertanyaanSDM = [
            [
                'teks' => 'Tidak dilakukan pengujian mutu sebelum diolah.',
                'nomor_urutan' => 1
            ],
            [
                'teks' => 'Campuran bahan baku tidak disesuaikan spesiflkasi',
                'nomor_urutan' => 2
            ],
            [
                'teks' => 'Bahan Tambahan Pangan tidak sesuai dengan peraturan.',
                'nomor_urutan' => 3
            ],
            [
                'teks' => 'Proses produksi tidak dilakukan pengawasan setiap tahap.',
                'nomor_urutan' => 4
            ],
            [
                'teks' => 'Produk akhir tidak diakukan pengujian mutu sebelum diedarkan.',
                'nomor_urutan' => 5
            ],
            [
                'teks' => 'Penyimpanan bahan baku dan produk akhir tidak dipisahkan.',
                'nomor_urutan' => 6
            ],
            [
                'teks' => 'Penyimpanan dan penyerahan tidak dilakukan secara FIFO',
                'nomor_urutan' => 7
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        // 
        $hrgaA = $this->createHeading('qa/qc', 'D. HASIL UJI');
        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Pengujian bahan baku dan produk akhir');
        $pertanyaanSDM = [
            [
                'teks' => 'Tidak dilakukan pengujian',
                'nomor_urutan' => 1
            ],
            [
                'teks' => 'Tidak memiliki laboratorium yang sekurang-kurangnya dilengkapi dengan peralatan dan media untuk pengujian organoleptik dan mikrobiologi',
                'nomor_urutan' => 2
            ],
            [
                'teks' => 'Jumlah tenaga laboratorium tidak mencukupi dan atau kualifikasi tenaganya tidak memadai',
                'nomor_urutan' => 3
            ],
            [
                'teks' => 'Tidak aktif melaksanakan monitoring terhadap bahan baku, bahan pembantu, kebersihan peralatan dan produk akhir',
                'nomor_urutan' => 4
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Hasil uji tidak memenuhi syarat');
        $pertanyaanSDM = [
            [
                'teks' => 'Angka lLempeng Total (ALT)',
                'nomor_urutan' => 5
            ],
            [
                'teks' => 'E. Coli',
                'nomor_urutan' => 6
            ],
            [
                'teks' => 'Coliform',
                'nomor_urutan' => 7
            ],
            [
                'teks' => 'Salmonella',
                'nomor_urutan' => 8
            ],
            [
                'teks' => 'Staphylococcus aureus',
                'nomor_urutan' => 9
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        // 
        $hrgaA = $this->createHeading('qa/qc', 'E. TINDAKAN PENGAWASAN');
        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Jaminan Mutu');
        $pertanyaanSDM = [
            [
                'teks' => 'Tidak dilakukan sistem jaminan mutu pada keseluruhan proses (in-process)',
                'nomor_urutan' => 1
            ],
            [
                'teks' => 'Tidak tersedia bti pemantauan jaminan mutu',
                'nomor_urutan' => 2
            ],
            [
                'teks' => 'Tidak tersedia program pengendalian bahaya kritis berbahasi HACCP',
                'nomor_urutan' => 3
            ],
            [
                'teks' => 'Tidak tersedia validasi CCP ',
                'nomor_urutan' => 4
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Prosedur Pelacakan dan Penarikan (Recall Procedure)');
        $pertanyaanSDM = [
            [
                'teks' => 'Tidak dilakukan dengan baik, teratur dan continue',
                'nomor_urutan' => 2
            ],
            [
                'teks' => 'Prosedur recall tidak berisi key contact (Badan Karantina, CB dll)',
                'nomor_urutan' => 3
            ],
            [
                'teks' => 'Tidak dilakukan mock recall per tahun',
                'nomor_urutan' => 4
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        // 
        $hrgaA = $this->createHeading('qa/qc', 'F. PENGGUNAAN BAHAN KIMIA');
        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Insektisida/Rodentisida/Peptisida');
        $pertanyaanSDM = [
            [
                'teks' => 'Insektisida/rodentisida tidak sesuai dengan persyaratan',
                'nomor_urutan' => 1
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Bahan kimia/sanitizer/deterjen, dll');
        $pertanyaanSDM = [
            [
                'teks' => 'Bahan kimia/sanitizer/deterjen, dll :',
                'nomor_urutan' => 2
            ],
            [
                'teks' => 'Bahan kimia, sanitizer dan bahan tambahan tidak diberi label dan disimpan dengan baik',
                'nomor_urutan' => 3
            ],
            [
                'teks' => 'Penggunaan bahan kimia yabg tidak diijinkan',
                'nomor_urutan' => 4
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);
    }

    public static function createHeading($departemen, $nama)
    {
        return Heading::create([
            'departemen' => $departemen,
            'nama' => $nama,
        ]);
    }

    public static function createSubHeading($heading_id, $nama = '')
    {
        return SubHeading::create([
            'heading_id' => $heading_id,
            'nama' => $nama,
        ]);
    }

    public static function createPertanyaan($pertanyaanSDM, $subHrgaA)
    {
        foreach ($pertanyaanSDM as $data) {
            $pertanyaan = Pertanyaan::create([
                'sub_heading_id' => $subHrgaA->id,
                'teks' => $data['teks'],
                'nomor_urutan' => $data['nomor_urutan']
            ]);

            // Tambah hasil checklist (OK untuk semua)
            HasilChecklist::create([
                'pertanyaan_id' => $pertanyaan->id,
                'min' => false,
                'maj' => false,
                'sr' => false,
                'kt' => false,
                'ok' => true, // Status OK
                'keterangan' => $data['keterangan'] ?? null,
                'tanggal_audit' => now()
            ]);
        }
    }
}
