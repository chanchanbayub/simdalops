<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LaporanPenindakan extends Migration
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
            'ukpd_id' => [
                'type'      => 'INT',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true
            ],
            'bap_id'       => [
                'type'      => 'INT',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true
            ],
            'penindakan_id'       => [
                'type'      => 'INT',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true,
            ],
            'klasifikasi_id'       => [
                'type'      => 'INT',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true,
            ],
            'kendaraan_id'       => [
                'type'      => 'INT',
                'constraint' => 11,
                'null' => false,
                'unsigned' => true,
            ],
            'tanggal_penindakan' => [
                'type'      => 'date',
                'null' => false,
            ],
            'tanggal_sidang' => [
                'type'      => 'date',
                'null' => false,
            ],
            'lokasi_sidang_id' => [
                'type' => 'INT',
                'null' => false,
                'constraint' => 11,
                'unsigned' => true
            ],
            'jam_penindakan' => [
                'type'      => 'time',
                'null' => true,
            ],
            'tanggal_masuk_bap' => [
                'type'      => 'date',
                'null' => false,
            ],
            'nopol' => [
                'type'      => 'VARCHAR',
                'constraint' => 100,
                'null' => false,
            ],
            'pasal_pelanggaran_id' => [
                'type'      => 'INT',
                'constraint' => 11,
                'null' => true,
                'unsigned' => true
            ],
            'jenis_pelanggaran' => [
                'type'      => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],

            'lokasi_pelanggaran' => [
                'type'      => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'barang_bukti' => [
                'type'      => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'pool_id' => [
                'type'      => 'INT',
                'constraint' => 11,
                'null' => true,
                'unsigned' => true,
            ],
            'nama_pelanggar' => [
                'type'      => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'alamat_pelanggar' => [
                'type'      => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'warna_tnkb' => [
                'type'      => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'tahun_perakitan' => [
                'type'      => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'nomor_rangka' => [
                'type'      => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'nama_pemilik' => [
                'type'      => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'alamat_pemilik' => [
                'type'      => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
            ],
            'foto' => [
                'type'      => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'catatan' => [
                'type'      => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
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
        $this->forge->addForeignKey('bap_id', 'bap', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('penindakan_id', 'jenispenindakan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('klasifikasi_id', 'klasifikasi_kendaraan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('kendaraan_id', 'type_kendaraan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('pool_id', 'poolpenyimpanan', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('lokasi_sidang_id', 'lokasi_sidang', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('pasal_pelanggaran_id', 'pasal_pelanggaran', 'id', 'CASCADE', 'CASCADE');
        $attributes = ['ENGINE' => 'InnoDB'];
        $this->forge->createTable('laporan_penindakan', false, $attributes);
    }

    public function down()
    {
        $this->forge->dropTable('laporan_penidakan');
    }
}
