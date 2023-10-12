<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPelajaran extends Model
{
    protected $table            = 'pelajaran';
    protected $primaryKey       = 'id_pelajaran';
    protected $allowedFields    = ['id_pelajaran', 'nama_pelajaran', 'id_semester'];
}
