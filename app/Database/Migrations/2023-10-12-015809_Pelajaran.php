<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pelajaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pelajaran' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_pelajaran' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'id_semester' => [
                'type' => 'INT',
                'constraint' => 10
            ],
        ]);
        $this->forge->addPrimaryKey('id_pelajaran');
        $this->forge->createTable('pelajaran');
    }

    public function down()
    {
        $this->forge->dropTable('pelajaran');
    }
}
