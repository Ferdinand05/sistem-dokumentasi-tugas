<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSemester extends Model
{
    protected $table            = 'semester';
    protected $primaryKey       = 'id_semester';
    protected $allowedFields    = ['id_semester', 'semester'];
}
