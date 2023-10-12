<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTugas extends Model
{
    protected $table            = 'tugas';
    protected $primaryKey       = 'id_tugas';
    protected $allowedFields    = ['id_tugas', 'nama_tugas', 'deskripsi_tugas', 'id_pelajaran'];
}
