<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Semester extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_semester' => [
                'type'           => 'INT',
                'constraint'     => 10,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'semester' => [
                'type'       => 'VARCHAR',
                'constraint' => '25',
            ],
        ]);
        $this->forge->addPrimaryKey('id_semester');
        $this->forge->createTable('semester');
    }

    public function down()
    {
        $this->forge->dropTable('semester');
    }
}
