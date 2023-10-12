<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPelajaran;
use App\Models\ModelSemester;
use App\Models\ModelTugas;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;

class Tugas extends BaseController
{
    protected $modalTugas;

    public function __construct()
    {
        $this->modalTugas = new ModelTugas();
    }

    public function index()
    {

        return view('tugas/vw_tugas');
    }

    public function modalAddTugas()
    {
        if ($this->request->isAJAX()) {

            $modelPelajaran = new ModelPelajaran();
            $modelSemester = new ModelSemester();
            $data = [
                'pelajaran' => $modelPelajaran->findAll(),
                'semester' => $modelSemester->findAll()
            ];

            $json = [
                'data' => view('tugas/modalAdd', $data)
            ];

            return $this->response->setJSON($json);
        }
    }
}
