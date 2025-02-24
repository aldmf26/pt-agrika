<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kode_bahan_baku', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('nama');
            $table->timestamps();
        });

        $datas = [
            ['kode' => '01', 'nama' => 'Kemasan PVC'],
            ['kode' => '02', 'nama' => 'Karton'],
            ['kode' => '03', 'nama' => 'Label'],
            ['kode' => '04', 'nama' => 'Wash Sanitiser'],
            ['kode' => '05', 'nama' => 'Vek K12'],
            ['kode' => '06', 'nama' => 'Protik'],
            ['kode' => '07', 'nama' => 'Bowl Cide'],
            ['kode' => '08', 'nama' => 'GP Clean'],
            ['kode' => '09', 'nama' => 'Vision'],
            ['kode' => '10', 'nama' => 'Plastik Wrap'],
            ['kode' => '11', 'nama' => 'Grade S56'],
            ['kode' => '12', 'nama' => 'Grade S34'],
            ['kode' => '13', 'nama' => 'Grade V'],
            ['kode' => '14', 'nama' => 'Grade DRVR'],
            ['kode' => '15', 'nama' => 'Grade PTH'],
            ['kode' => '16', 'nama' => 'SBW Kotor'],
        ];

        foreach ($datas as $data) {
            DB::table('kode_bahan_baku')->insert($data);
        }

        Schema::create('identitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
        });

        $datas = [
            'baku sbw', 'kemas', 'lainnya'
        ];

        foreach ($datas as $data) {
            DB::table('identitas')->insert([
                'nama' => $data
            ]);
        }

        Schema::create('label_identitas_bahan_baku', function (Blueprint $table) {
            $table->id();
            // bahan baku sbw, bahan kemas, bahan lainnya.
            $table->string('identitas');

            $table->integer('id_barang');
            $table->string('noregrbw_nmprodusen');
            $table->date('tgl_kedatangan');
            
            // diambil dari wi.ik.02.02
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_label_identitas');
    }
};
