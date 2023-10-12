<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelDTSemester;
use App\Models\ModelSemester;
use Config\Services;

class Semester extends BaseController
{
    protected $modelSemester;

    public function __construct()
    {
        $this->modelSemester = new ModelSemester();
    }

    public function index()
    {

        return view('semester/vw_semester');
    }

    public function modalAddSemester()
    {
        if ($this->request->isAJAX()) {


            $json = [
                'data' => view('semester/modalAdd')
            ];

            return $this->response->setJSON($json);
        }
    }

    public function addSemester()
    {
        if ($this->request->isAJAX()) {
            $semester = $this->request->getPost('semester');

            $validation = \Config\Services::validation();

            $validation->setRules([
                'semester' => [
                    'label' => 'Semester',
                    'rules' => 'required|is_unique[semester.semester]',
                ]
            ]);

            $data = [
                'semester' => $semester
            ];

            if (!$validation->run($data)) {
                $json = [
                    'error' => $validation->listErrors('list')
                ];
            } else {
                $this->modelSemester->insert([
                    'semester' => $semester
                ]);

                $json = [
                    'success' => 'Semester Berhasil Ditambahkan!'
                ];
            }

            return $this->response->setJSON($json);
        }
    }

    public function listDataSemester()
    {

        $request = Services::request();
        $datamodel = new ModelDTSemester($request);
        if ($request->getPost()) {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $btnDelete = '<button type="button" class="btn btn-danger" onclick="deleterSemester(\'' . $list->id_semester . '\')"><i class="fa fa-trash"></i></button>';
                $row[] = $no;
                $row[] = $list->semester;
                $row[] =  $btnDelete;
                $data[] = $row;
            }
            $output = [
                "draw" => $request->getPost('draw'),
                "recordsTotal" => $datamodel->count_all(),
                "recordsFiltered" => $datamodel->count_filtered(),
                "data" => $data
            ];
            echo json_encode($output);
        }
    }
}
