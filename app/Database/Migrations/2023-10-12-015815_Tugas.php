<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tugas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_tugas' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_tugas' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'deskripsi_tugas' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
                'null' => true,
            ],
            'id_pelajaran' => [
                'type' => 'INT',
                'constraint' => 10,
            ],
            'id_semester' => [
                'type' => 'INT',
                'constraint' => 10
            ],
        ]);
        $this->forge->addPrimaryKey('id_tugas');
        $this->forge->createTable('tugas');
    }

    public function down()
    {
        $this->forge->dropTable('tugas');
    }
}
