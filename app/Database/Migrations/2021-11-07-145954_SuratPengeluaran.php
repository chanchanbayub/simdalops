<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SuratPengeluaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nomor_surat' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true
            ],
            'ukpd_id'       => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false,
            ],
            'noBap'       => [
                'type'       => 'INT',
                'constraint' => 11,
                'null' => false,
            ],
            'type_kendaraan_id' => [
                'type' => 'INT',
                'constraint' => 255,
                'unsigned' => true,
                'null' => false
            ],
            'nopol' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],
            'jenis_pelanggaran' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],
            'lokasi_pelanggaran' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'tanggal_pelanggaran' => [
                'type' => 'date',
                'null' => true
            ],
            'pool_id' => [
                'type' => 'INT',
                'constraint' => 255,
                'unsigned' => true,
                'null' => false
            ],
            'tahun_perakitan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'nomor_rangka' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'nama_pemilik' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'alamat_pemilik' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'catatan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'catatan_lain' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'tanggal_pengeluaran' => [
                'type' => 'date',
                'null' => false
            ],
            'rekomendasi_approv' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'status_surat_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false
            ],
            'nomor_skrd' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => false
            ],
            'nominal_skrd' => [
                'type' => 'INT',
                'constraint' => 100,
                'null' => false
            ],

            'scan_kwitansi_sidang' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'scan_pengantar_sidang' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'scan_stuk' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'scan_kartu_pengawasan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'surat_pernyataan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
            ],
            'surat_permohonan' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
            ],
            'scan_stnk' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
            ],
            'scan_ktp' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
            ],
            'lain_lain' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
            ],
            'created_at' => [
                'type' => 'datetime',
                'null' => false
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => false
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('ukpd_id', 'ukpd', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('pool_id', 'poolpenyimpanan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('type_kendaraan_id', 'type_kendaraan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('status_surat_id', 'status_surat', 'id', 'CASCADE', 'CASCADE');
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->createTable('surat_pengeluaran', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('surat_pengeluaran');
    }
}
