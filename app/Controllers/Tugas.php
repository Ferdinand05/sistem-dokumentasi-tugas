<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelDTTugas;
use App\Models\ModelPelajaran;
use App\Models\ModelSemester;
use App\Models\ModelTugas;
use PHPUnit\Framework\MockObject\Stub\ReturnReference;
use Config\Services;

class Tugas extends BaseController
{
    protected $modelTugas;

    public function __construct()
    {
        $this->modelTugas = new ModelTugas();
    }

    public function index()
    {

        return view('tugas/vw_tugas');
    }

    public function modalAddTugas()
    {
        if ($this->request->isAJAX()) {

            $modelPelajaran = new ModelPelajaran();
            $data = [
                'pelajaran' => $modelPelajaran->findAll()
            ];

            $json = [
                'data' => view('tugas/modalAdd', $data)
            ];

            return $this->response->setJSON($json);
        }
    }

    public function listDataTugas()
    {

        $request = Services::request();
        $datamodel = new ModelDTTugas($request);
        if ($request->getPost()) {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $btnDelete = '<button type="button" class="btn btn-danger" onclick="deleteTugas(\'' . $list->id_tugas . '\')"><i class="fa fa-trash"></i></button>';
                $btnDetail = '<button type="button" class="btn btn-info" onclick="detailTugas(\'' . $list->id_tugas . '\')"><i class="fa fa-info-circle"></i></button>';
                $btnLink = '<a href=' . $list->link_tugas . ' class="btn btn-primary" title="Link Tugas" target="_blank"><i class="fas fa-link fa-lg"></i></a>';
                $row[] = $no;
                $row[] = $list->nama_tugas;
                $row[] =  $list->nama_pelajaran;
                $row[] =  $btnLink;
                $row[] =  $list->semester;
                $row[] =    $btnDetail . " " . $btnDelete;
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

    public function addTugas()
    {
        if ($this->request->isAJAX()) {
            $id_pelajaran = $this->request->getPost('nama_pelajaran');
            $nama_tugas = $this->request->getPost('nama_tugas');
            $deskripsi_tugas = $this->request->getPost('deskripsi_tugas');
            $link_tugas = $this->request->getPost('link_tugas');


            $validation = \Config\Services::validation();
            $validation->setRules([
                'nama_pelajaran' => [
                    'label' => 'Nama Pelajaran',
                    'rules' => 'required'
                ],
                'nama_tugas' => [
                    'label' => 'Nama Tugas',
                    'rules' => 'required'
                ],
                'deskripsi_tugas' => [
                    'label' => 'Keterangan Tugas',
                    'rules' => 'required'
                ],
                'link_tugas' => [
                    'label' => 'Link Tugas',
                    'rules' => 'required|is_unique[tugas.link_tugas]'
                ]
            ]);

            $data = [
                'nama_pelajaran' => $id_pelajaran,
                'nama_tugas' => $nama_tugas,
                'deskripsi_tugas' => $deskripsi_tugas,
                'link_tugas' => $link_tugas
            ];


            if (!$validation->run($data)) {
                $json = [
                    'error' => $validation->listErrors('list')
                ];
            } else {

                $this->modelTugas->insert([
                    'nama_tugas' => $nama_tugas,
                    'deskripsi_tugas' => $deskripsi_tugas,
                    'link_tugas' => $link_tugas,
                    'id_pelajaran' => $id_pelajaran
                ]);

                $json = [
                    'success' => 'Tugas Berhasil Disimpan!'
                ];
            }

            return $this->response->setJSON($json);
        } else {
            exit('tidak bisa diakses');
        }
    }
}
