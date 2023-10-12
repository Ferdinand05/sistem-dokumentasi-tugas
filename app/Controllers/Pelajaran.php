<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelDTPelajaran;
use App\Models\ModelPelajaran;
use App\Models\ModelSemester;
use Config\Services;

class Pelajaran extends BaseController
{
    protected $modelPelajaran;

    public function __construct()
    {
        $this->modelPelajaran = new ModelPelajaran();
    }

    public function index()
    {

        return view('pelajaran/vw_pelajaran');
    }




    public function modalAddPelajaran()
    {
        if ($this->request->isAJAX()) {

            $modelSemester = new ModelSemester();
            $data = [
                'semester' => $modelSemester->findAll()
            ];

            $json = [
                'data' => view('pelajaran/modalAdd', $data)
            ];

            return $this->response->setJSON($json);
        }
    }

    public function addPelajaran()
    {
        if ($this->request->isAJAX()) {
            $nama_pelajaran = $this->request->getPost('nama_pelajaran');
            $id_semester = $this->request->getPost('id_semester');
            $validation = \Config\Services::validation();

            $validation->setRules([
                'nama_pelajaran' => [
                    'label' => 'Nama Pelajaran',
                    'rules' => 'required|is_unique[pelajaran.nama_pelajaran]',
                ]
            ]);

            $data = [
                'nama_pelajaran' => $nama_pelajaran,
                'id_semester' => $id_semester
            ];

            if (!$validation->run($data)) {
                $json = [
                    'error' => $validation->listErrors('list')
                ];
            } else {
                $this->modelPelajaran->insert([
                    'nama_pelajaran' => $nama_pelajaran,
                    'id_semester' => $id_semester
                ]);

                $json = [
                    'success' => 'Pelajaran Berhasil Ditambahkan!'
                ];
            }

            return $this->response->setJSON($json);
        }
    }

    public function listDataPelajaran()
    {

        $request = Services::request();
        $datamodel = new ModelDTPelajaran($request);
        if ($request->getPost()) {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $btnDelete = '<button type="button" class="btn btn-danger" onclick="deletePelajaran(\'' . $list->id_pelajaran . '\')"><i class="fa fa-trash"></i></button>';
                $row[] = $no;
                $row[] = $list->nama_pelajaran;
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
