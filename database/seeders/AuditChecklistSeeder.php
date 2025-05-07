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
        $this->hrga();
        $this->purchasing();
    }

    public function hrga(): void
    {
        $hrgaA = $this->createHeading('hrga', 'A. Sumber Daya Manusia');
        $subHrgaA = $this->createSubHeading($hrgaA->id, '');
        $pertanyaanSDM = [
            [
                'teks' => 'Perusahaan tidak memiliki program recruitment karyawan untuk memastikan karyawan mendapatkan penjelasan awal mengenai pekerjaannya saat akan dipekerjakan',
                'nomor_urutan' => 1
            ],
            [
                'teks' => 'Perusahaan tidak memiliki program pelatihan karyawan nsebagai peunjang dalam menjalankan tugas pekerjaan',
                'nomor_urutan' => 2
            ],
            [
                'teks' => 'Perusahaan tidak memiliki program evaluasi kinerja karyawan tahunan Sebagai Langkah menyelidiki kebutuhan peningkatan skill karyawan',
                'nomor_urutan' => 3
            ],
            [
                'teks' => 'Perusahaan tidak memiliki program pemeriksaan kseshatan Sebagai Langkah pencegahan untuk mendeteksi potensi sumber kontaminasi yang bisa terbawa dari manusia',
                'nomor_urutan' => 4
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $hrgaA = $this->createHeading('hrga', 'B. Sanitasi Lokasi dan Lingkungan : Fisik');
        $subHrgaA = $this->createSubHeading($hrgaA->id, '');
        $pertanyaanSDM = [
            [
                'teks' => 'Lingkungan tidak bebas dari semak belukar/ rumput liar',
                'nomor_urutan' => 1
            ],
            [
                'teks' => 'Lingkungan tidak bebas dari sampah dan barang-barang tidak berguna di area pabrik maupun luarnya',
                'nomor_urutan' => 2
            ],
            [
                'teks' => 'Tidak ada tempat sampah disekitar lingkungan pabrik atau tempat sampah ada tetapi tidak dirawat dengan baik',
                'nomor_urutan' => 3
            ],
            [
                'teks' => 'Bangunan yang digunakan untuk menyimpan perlengkapan tidak teratur, tidak terawat dan tidak mudah dibersihkan',
                'nomor_urutan' => 4
            ],
            [
                'teks' => 'Ada tempat pemeliharaan hewan yang memungkinkan menjadi sumber kontaminasi',
                'nomor_urutan' => 5
            ],
            [
                'teks' => 'Terdapat debu, asap, bau yang berlebihan dijalanan, tempat parkir atau sekeliling pabrik',
                'nomor_urutan' => 6
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $hrgaA = $this->createHeading('hrga', 'C. Sanitasi Lingkungan : Pembuangan Limbah');
        $subHrgaA = $this->createSubHeading($hrgaA->id, '');
        $pertanyaanSDM = [
            [
                'teks' => 'Sistem pembuangan limbah cair/ salluran disekitar lingkungan pabrik kurang baik',
                'nomor_urutan' => 1
            ],
            [
                'teks' => 'Kapasitas saluran dilingkungan pabrik tidak mencukupi',
                'nomor_urutan' => 2
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Pembuangan limbah : Cair, Padat, Sampah disekitar lingkungan pabrik');
        $pertanyaanSDM = [
            [
                'teks' => 'Limbah cair disekitar lingkungan tidak ditangani dengan baik',
                'nomor_urutan' => 1
            ],
            [
                'teks' => 'Konstruksi tempat pembuangan limbah tidak selayaknya',
                'nomor_urutan' => 2
            ],
            [
                'teks' => 'Tempat dan wadah sampah tidak ada penutupnya',
                'nomor_urutan' => 3
            ],
            [
                'teks' => 'Tidak terdapat identifikasi sampah (organic dan anorganik)',
                'nomor_urutan' => 4
            ],
            [
                'teks' => 'Ada akumulasi limbah di area produksi dan gudang',
                'nomor_urutan' => 5
            ],
            [
                'teks' => 'Arah drainase mengalir kembali dari area yang terkontaminasi ke area bersih',
                'nomor_urutan' => 6
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $hrgaA = $this->createHeading('hrga', 'D. Sanitasi Lingkungan : Investasi burung, Serangga dan Binatang lain ');
        $subHrgaA = $this->createSubHeading($hrgaA->id, '');
        $pertanyaanSDM = [
            [
                'teks' => 'Tidak ada pengendalian untuk mencegah serangga, tikus dan binatang pengganggu lainnya dilingkungan pabrik',
                'nomor_urutan' => 1
            ],
            [
                'teks' => 'Pencegahan serangga, burung, tikus dan binatang lain tidak efektif',
                'nomor_urutan' => 2
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $hrgaA = $this->createHeading('hrga', 'E. Pabrik – Umum');
        $subHrgaA = $this->createSubHeading($hrgaA->id, '');
        $pertanyaanSDM = [
            [
                'teks' => 'Rancang bangun, bahan-bahan atau konstruksinya menghambat program sanitasi',
                'nomor_urutan' => 1
            ],
            [
                'teks' => 'Rancang bangun tidak sesuai dengan jenis pangan yang diproduksi',
                'nomor_urutan' => 2
            ],
            [
                'teks' => 'Luas pabrik tidak sesuai dengan kapasitas produksi',
                'nomor_urutan' => 3
            ],
            [
                'teks' => 'Bangunan dalam kondisi tidak terawat ',
                'nomor_urutan' => 4
            ],
            [
                'teks' => 'Tidak ada fasilitas atau usaha lain untuk mencegah binatang atau serangga masuk ke dalam pabrik (kisi-kisi, kasa penutup lubang angin, air curtain, tirai plastik, kalaupun ada tidak efektif',
                'nomor_urutan' => 5
            ],
            [
                'teks' => 'Tata ruang tidak sesuai alur proses produksi',
                'nomor_urutan' => 6
            ],
            [
                'teks' => 'Tidak ada ruang istirahat, jika ada tidak memenuhi persyaratan kesehatan',
                'nomor_urutan' => 7
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $hrgaA = $this->createHeading('hrga', 'F. Pabrik - Ruang Pengolahan');
        $subHrgaA = $this->createSubHeading($hrgaA->id, '');
        $pertanyaanSDM = [
            [
                'teks' => 'Ruang pengolahan berhubungan langsung/terbuka dengan tempat tinggal, garasi dan bengkel',
                'nomor_urutan' => 1
            ],

        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $subHrgaA = $this->createSubHeading($hrgaA->id, 'lantai');
        $pertanyaanSDM = [
            [
                'teks' => 'Terbuat dari bahan yang tidak mudah diperbaiki/ dicuci atau rusak',
                'nomor_urutan' => 2
            ],
            [
                'teks' => 'Konstruksi tidak sesuai persyaratan teknik sanitasi dan hygiene (tidak rata, tidak kuat, retak atau licin)',
                'nomor_urutan' => 3
            ],
            [
                'teks' => 'Pertemuan antara lantai dan dinding tidak mudah dibersihkan (tidak ada lengkungan)',
                'nomor_urutan' => 4
            ],
            [
                'teks' => 'Kemiringan lantai tidak sesuai',
                'nomor_urutan' => 5
            ],
            [
                'teks' => 'Tidak kedap air',
                'nomor_urutan' => 6
            ],


        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $subHrgaA = $this->createSubHeading($hrgaA->id, 'dinding');
        $pertanyaanSDM = [
            [
                'teks' => 'Dinding tidak kedap air ',
                'nomor_urutan' => 7
            ],
            [
                'teks' => 'Terbuat dari bahan yang tidak mudah diperbaiki/ dicuci',
                'nomor_urutan' => 8
            ],
            [
                'teks' => 'Konstruksi tidak sesuai persyaratan teknis sanitasi dan hygiene (tidak halus, tidak kuat, retak, cat mudah mengelupas)',
                'nomor_urutan' => 9
            ],
            [
                'teks' => 'Pertemuan antara dinding dan dinding tidak mudah dibersihkan (tidak ada lengkungan)',
                'nomor_urutan' => 10
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Langit-langit');
        $pertanyaanSDM = [
            [
                'teks' => 'Tidak ada langit-langit atau plavon ditempat tertentu yang diperlukan',
                'nomor_urutan' => 11
            ],
            [
                'teks' => 'Langit-langit/ plavon tidak bebas dari kemungkinan catnya mengelupas/ rontok atau ada kondensasi',
                'nomor_urutan' => 12
            ],
            [
                'teks' => 'Tidak kedap air dan tidak mudah dibersihkan',
                'nomor_urutan' => 13
            ],
            [
                'teks' => 'Tidak rata, retak, bocor, berlubang',
                'nomor_urutan' => 14
            ],
            [
                'teks' => 'Ketinggian kurang dari 2,4 m',
                'nomor_urutan' => 15
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $hrgaA = $this->createHeading('hrga', 'G. Fasilitas Pabrik');
        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Fasilitas cuci tangan dan kaki');
        $pertanyaanSDM = [
            [
                'teks' => 'Tidak ada tempat cuci tangan maupun bak cuci kaki, kalau ada tidak mencukupi',
                'nomor_urutan' => 1
            ],
            [
                'teks' => 'Tempat cuci tangan dan bak cuci kaki tidak mudah dijangkau atau tidak ditempatkan secara layak',
                'nomor_urutan' => 2
            ],
            [
                'teks' => 'Fasilitas pencucian tidak disediakan (sabun, pengering, dll)',
                'nomor_urutan' => 3
            ],
            [
                'teks' => 'Tidak ada peringatan pencucian tangan sebelum bekerja atau setelah ke toilet',
                'nomor_urutan' => 4
            ],
            [
                'teks' => 'Peralatan pencucian tangan tidak cukup/ tidak lengkap',
                'nomor_urutan' => 5
            ],

        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Toilet Karyawan');
        $pertanyaanSDM = [
            [
                'teks' => 'Tidak ada fasilitas/bahan untuk pencucian seperti tissu, sabun cair dan pengering atau tidak  ada peringatan agar karyawan mencuci tangan mereka setelah menggunakan toilet',
                'nomor_urutan' => 6
            ],
            [
                'teks' => 'Peralatan toilet tidak lengkap',
                'nomor_urutan' => 7
            ],
            [
                'teks' => 'Jumlah toilet tidak mencukupi sebagaimana yang dipersyaratkan 1 -  9 org  1 toilet',
                'nomor_urutan' => 8,
                'keterangan' => '10 - 25 org 2 toilet
                                26 - 50 org 3 toilet
                                50- 100 org 4 toilet
                                Setiap kelebihan 50 orang tambah 1 toilet
                                '
            ],
            [
                'teks' => 'Pintu toilet berhubungan langsung dengan ruang pengolahan',
                'nomor_urutan' => 9
            ],
            [
                'teks' => 'Konstruksi toilet tidak layak (lantai, dinding, langit-langit, pintu, ventilasi, dll)',
                'nomor_urutan' => 10
            ],
            [
                'teks' => 'Tidak dilengkapi dengan saluran pembuangan',
                'nomor_urutan' => 11
            ],
            [
                'teks' => 'Toilet tidak terawat atau digunakan untuk keperluan lain',
                'nomor_urutan' => 12
            ],

        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Penerangan ');
        $pertanyaanSDM = [
            [
                'teks' => 'Intensitas cahaya penerangan tidak cukup atau menyilaukan',
                'nomor_urutan' => 13,
                'keterangan' => 'Ruang pengolahan : 20 fc (220 flux)
                                Tempat pemeriksaan : 50 fc (540 flux)
                                Tempat lain : 10 fc (110 flux)
                                '
            ],
            [
                'teks' => 'Lampu diruang pengolahan, penyimpanan material dan pengemasan tidak aman (tanpa pelindung)',
                'nomor_urutan' => 14
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Ventilasi  ');
        $pertanyaanSDM = [
            [
                'teks' => 'Terjadi akumulasi kondensasi di atas ruang pengolahan, pengemasan dan penyimpanan bahan',
                'nomor_urutan' => 15
            ],
            [
                'teks' => 'Terdapat kapang (mold), asap dan bau yang mengganggu diruang pengolahan',
                'nomor_urutan' => 16
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $subHrgaA = $this->createSubHeading($hrgaA->id, 'PPPK/Klinik/Fasilitas Keamanan Kerja  ');
        $pertanyaanSDM = [
            [
                'teks' => 'Tidak tersedia PPPK atau fasilitas keamanan/kesehatan kerja (klinik) yang memadai',
                'nomor_urutan' => 17
            ],
            [
                'teks' => 'Fasilitas klinik pabrik tidak digunakan untuk cek up rutin seluruh karyawan khususnya di bagian produksi',
                'nomor_urutan' => 18
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $hrgaA = $this->createHeading('hrga', 'H. PEMBUANGAN LIMBAH PABRIK ');
        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Sistem Pembuangan Limbah dalam Pabrik (Cair, sisa produk, padat/kering)');
        $pertanyaanSDM = [
            [
                'teks' => 'Limbah cair tidak ditangani dengan baik',
                'nomor_urutan' => 1
            ],
            [
                'teks' => 'Limbah produksi atau sisa-sisa produksi tidak dikumpulkan dan tidak ditangani dengan baik',
                'nomor_urutan' => 2
            ],
            [
                'teks' => 'Limbah kering/ padat tidak ditangani dan dikumpulkan pada wadah yang baik dan mencukupi jumlahnya untuk seluruh pabrik',
                'nomor_urutan' => 3
            ],
            [
                'teks' => 'Tidak ada peringatan pencucian tangan sebelum bekerja atau setelah ke toilet',
                'nomor_urutan' => 4
            ],
            [
                'teks' => 'Peralatan pencucian tangan tidak cukup/ tidak lengkap',
                'nomor_urutan' => 5
            ],

        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Tempat sampah dalam pabrik');
        $pertanyaanSDM = [
            [
                'teks' => 'Konstruksi tempat pembuangan limbah tidak selayaknya',
                'nomor_urutan' => 4
            ],
            [
                'teks' => 'Tempat/wadah sampah tidak ada penutupnya',
                'nomor_urutan' => 5
            ],

        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Saluran/pembuangan dalam pabrik');
        $pertanyaanSDM = [
            [
                'teks' => 'Sistem pembuangan limbah cair/ saluran dalam pabrik kurang baik',
                'nomor_urutan' => 6
            ],
            [
                'teks' => 'Kapasitas saluran dalam pabrik tidak mencukupi',
                'nomor_urutan' => 7
            ],
            [
                'teks' => 'Dinding saluran air tidak halus dan tidak kedap airah',
                'nomor_urutan' => 8
            ],
            [
                'teks' => 'Saluran pembuangan tidak tertutup dan tidak dilengkapi bak kontrol dan alirannya terhambat oleh kotoran fisik',
                'nomor_urutan' => 9
            ],
            [
                'teks' => 'Tidak dilengkapi dengan alat yang mempunyai katup untuk mencegah masuknya air ke dalam pabrik',
                'nomor_urutan' => 10
            ],

        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $hrgaA = $this->createHeading('hrga', 'I. PASOKAN AIR ');
        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Sumber air ');
        $pertanyaanSDM = [
            [
                'teks' => 'Pasokan air panas atau dingin tidak cukup',
                'nomor_urutan' => 1
            ],
            [
                'teks' => 'Air tidak mudah dijangkau/ disediakan',
                'nomor_urutan' => 2
            ],
            [
                'teks' => 'Air dapat terkontaminasi, misalnya hubungan silang antar air kotor dengan air bersih, sanitasi lingkungan',
                'nomor_urutan' => 3
            ],

        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Treatment Air ');
        $pertanyaanSDM = [
            [
                'teks' => 'Air baku tidak layak digunakan (potable), tidak dilakukan pengujian secara berkala',
                'nomor_urutan' => 4
            ],
            [
                'teks' => 'Air tidak mendapat persetujuan dari pihak berwenang untuk digunakan sebagai bahan untuk pengolahan (tidak ada hasil uji)',
                'nomor_urutan' => 5
            ],

        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Es (apabila digunakan)');
        $pertanyaanSDM = [
            [
                'teks' => 'Tidak terbuat dari air yang memenuhi persyaratan (potable)',
                'nomor_urutan' => 6
            ],
            [
                'teks' => 'Tidak terbuat dari air yang telah diijinkan',
                'nomor_urutan' => 7
            ],
            [
                'teks' => 'Tidak dibuat, ditangani dan digunakan sesuai persyaratan sanitasi',
                'nomor_urutan' => 8
            ],
            [
                'teks' => 'Digunakan kembali untuk bahan baku yang diproses berikutnya',
                'nomor_urutan' => 9
            ],

        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $hrgaA = $this->createHeading('hrga', 'J. SARANA PENGOLAHAN DAN PENGAWETAN ');
        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Pendinginan, Pembekuan, Pengalengan, Pengeringan dan Pengolahan lainnya');
        $pertanyaanSDM = [
            [
                'teks' => 'Sarana pengolahan/ pengawetan tidak mencukupi',
                'nomor_urutan' => 1
            ],
            [
                'teks' => 'Suhu dan waktu pengolahan/ pengawetan tidak sesuai',
                'nomor_urutan' => 2
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $hrgaA = $this->createHeading('hrga', 'K. PENGGUNAAN BAHAN KIMIA ');
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
                'teks' => 'Bahan kimia tidak digunakan sesuai metode yang dipersyaratkan',
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

        $hrgaA = $this->createHeading('hrga', 'L. BAHAN, PENANGANAN DAN PENGOLAHAN ');
        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Bahan baku ');
        $pertanyaanSDM = [
            [
                'teks' => 'Tidak sesuai dengan standar sehingga membahayakan kesehatan manusia',
                'nomor_urutan' => 1
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Bahan Tambahan  ');
        $pertanyaanSDM = [
            [
                'teks' => 'Tidak sesuai dengan standar dan pemakaiannya tidak sesuai dengan persyaratan',
                'nomor_urutan' => 2
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Penanganan bahan baku ');
        $pertanyaanSDM = [
            [
                'teks' => 'Penerimaan bahan baku tidak dilakukan dengan baik, dan tidak terlindung dari kontaminan atau pengaruh lingkungan yang tidak sehat',
                'nomor_urutan' => 3
            ],
            [
                'teks' => 'Suhu produk yang diolah di dalam ruang pengolahan tidak sesuai',
                'nomor_urutan' => 4
            ],
            [
                'teks' => 'Bahan  baku yang datang terlebih dahulu tidak diproses lebih dulu (FIFO)',
                'nomor_urutan' => 5
            ],
            [
                'teks' => 'Penanganan bahan baku ataupun produk dari tahap satu ke tahap berikutnya tidak dilakukan secara hati-hati, higienis dan saniter',
                'nomor_urutan' => 6
            ],
            [
                'teks' => 'Penanganan produk yang sedang menunggu giliran untuk diproses tidak disimpan/dikumpulkan ditempat yang saniter',
                'nomor_urutan' => 7
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Pengolahan ');
        $pertanyaanSDM = [
            [
                'teks' => 'Proses pengolahan/pengawetan dilakukan tidak sesuai dengan jenis produk, suhu serta waktunya tidak sesuai',
                'nomor_urutan' => 8
            ],
            [
                'teks' => 'Produk akhir tidak mempunyai ukuran dan bentuk yang teratur',
                'nomor_urutan' => 9
            ],
            [
                'teks' => 'Sistem pemberian etiket/ kode-kode tidak dilakukan pada waktu memproses bahan baku yang tidak membantu identifikasi produk',
                'nomor_urutan' => 10
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Pewadahan dan atau pengemasan ');
        $pertanyaanSDM = [
            [
                'teks' => 'Produk akhir tidak dikemas dengan cepat, tepat dan saniter',
                'nomor_urutan' => 11
            ],
            [
                'teks' => 'Produk akhir tidak diberi label yang memuat : jenis produk, nama perusahaan pembuat, ukuran, tipe, grade ( tingkatan mutu), tanggal kadaluwarsa, berat bersih, nama bahan tambahan makanan yang dipakai, kode produksi atau persyaratan lain',
                'nomor_urutan' => 12
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Penyimpanan ');
        $pertanyaanSDM = [
            [
                'teks' => 'Produk akhir yang disimpan dalam gudang tidak dipisahkan dengan  barang lain (mentah)',
                'nomor_urutan' => 13
            ],
            [
                'teks' => 'Susunan produk akhir tidak memungkinkan mempengaruhi kondisi masing-masing kemasan dan tidak memungkinkan produk akhir yang lebih lama disimpan dikeluarkan terlebih dahulu (tidak mengikuti FIFO)',
                'nomor_urutan' => 14
            ],
            [
                'teks' => 'Forklift solar masih digunakan',
                'nomor_urutan' => 15,
                'keterangan' => 'TB (tdk punya forklift)',
            ],
            [
                'teks' => 'Tidak tersendiri dan dapat terhindar dari hal-hal yang dapat membahayakan',
                'nomor_urutan' => 16
            ],
            [
                'teks' => 'Tidak ada tanda peringatan',
                'nomor_urutan' => 17
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);

        $subHrgaA = $this->createSubHeading($hrgaA->id, 'Pengangkutan dan Distribusi');
        $pertanyaanSDM = [
            [
                'teks' => 'Kendaraan (kontainer) yang dipakai untuk mengangkut produk akhir tidak mampu mempertahankan kondisi produk',
                'nomor_urutan' => 18
            ],
            [
                'teks' => 'Pembongkaran tidak dilakukan dengan cepat, cermat dan terhindar dari pengaruh yang menyebabkan kemunduran mutu',
                'nomor_urutan' => 19
            ],
        ];
        $this->createPertanyaan($pertanyaanSDM, $subHrgaA);
    }

    public function purchasing()
    {
        $hrgaA = $this->createHeading('purchasing', 'A. Sumber Daya Manusia');
        $subHrgaA = $this->createSubHeading($hrgaA->id, '');
        $pertanyaanSDM = [
            [
                'teks' => 'Perusahaan tidak memiliki program recruitment karyawan untuk memastikan karyawan mendapatkan penjelasan awal mengenai pekerjaannya saat akan dipekerjakan',
                'nomor_urutan' => 1
            ],
            [
                'teks' => 'Perusahaan tidak memiliki program pelatihan karyawan nsebagai peunjang dalam menjalankan tugas pekerjaan',
                'nomor_urutan' => 2
            ],
            [
                'teks' => 'Perusahaan tidak memiliki program evaluasi kinerja karyawan tahunan Sebagai Langkah menyelidiki kebutuhan peningkatan skill karyawan',
                'nomor_urutan' => 3
            ],
            [
                'teks' => 'Perusahaan tidak memiliki program pemeriksaan kseshatan Sebagai Langkah pencegahan untuk mendeteksi potensi sumber kontaminasi yang bisa terbawa dari manusia',
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
