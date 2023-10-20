<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelModul extends Model
{
    protected $table            = 'modul';
    protected $primaryKey       = 'id_modul';
    protected $allowedFields    = ['id_modul', 'nama_modul', 'file', 'id_pelajaran', 'id_semester'];
}
