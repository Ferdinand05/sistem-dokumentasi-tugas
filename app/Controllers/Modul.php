<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelDTModul;
use App\Models\ModelModul;
use App\Models\ModelPelajaran;
use App\Models\ModelSemester;
use Config\Services;
use PHPUnit\Util\Json;

class Modul extends BaseController
{
    protected $modelModul;
    public function __construct()
    {
        $this->modelModul = new ModelModul();
    }

    public function index()
    {
        return view('modul/vw_modul');
    }


    public function modalUpload()
    {
        if ($this->request->isAJAX()) {

            $modelPelajaran = new ModelPelajaran();
            $modelSemester = new ModelSemester();
            $data = [
                'pelajaran' => $modelPelajaran->findAll(),
                'semester' => $modelSemester->findAll()
            ];

            $json = [
                'data' => view('modul/modalUpload', $data)
            ];

            return $this->response->setJSON($json);
        }
    }

    public function listDataModul()
    {

        $request = Services::request();
        $datamodel = new ModelDTModul($request);
        if ($request->getPost()) {
            $lists = $datamodel->get_datatables();
            $data = [];
            $no = $request->getPost("start");
            foreach ($lists as $list) {
                $no++;
                $row = [];
                $btnUploadFile = '<button type="button" class="btn btn-primary" onclick="uploadModul(\'' . $list->id_modul . '\')" title="Upload File"><i class="fa fa-file-upload"></i></button>';
                $btnDelete = '<button type="button" class="btn btn-danger" onclick="deleteModul(\'' . $list->id_modul . '\')"><i class="fa fa-trash-alt"></i></button>';
                $btnDownload = '<button type="button" class="btn btn-info" onclick="downloadModul(\'' . $list->file . '\')" title="Download Modul"><i class="fas fa-download"></i></button>';
                $row[] = $no;
                $row[] =   strtoupper($list->nama_modul);
                $row[] =  $list->nama_pelajaran;
                $row[] =  $list->semester;
                $row[] =  $btnDownload;
                $row[] =   $btnUploadFile . " " . $btnDelete;
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


    public function addModul()
    {
        if ($this->request->isAJAX()) {

            $namaModul = $this->request->getPost('nama_modul');
            $semester = $this->request->getPost('modul_semester');
            $pelajaran = $this->request->getPost('modul_pelajaran');


            $validation = \Config\Services::validation();
            $validation->setRules([
                'nama_modul' => [
                    'label' => 'Nama Modul',
                    'rules' => 'required',
                ],
                'modul_semester' => [
                    'label' => 'Modul Semester',
                    'rules' => 'required'
                ],
                'modul_pelajaran' => [
                    'label' => 'Pelajaran',
                    'rules' => 'required'
                ]
            ]);

            $data = [
                'nama_modul' => $namaModul,
                'modul_semester' => $semester,
                'modul_pelajaran' => $pelajaran,
            ];


            if (!$validation->run($data)) {
                $json = [
                    'error' => $validation->listErrors('list')
                ];
            } else {
                $modelModul = new ModelModul();
                $modelModul->insert([
                    'nama_modul' => $namaModul,
                    'id_pelajaran' => $pelajaran,
                    'id_semester' => $semester
                ]);

                $json = [
                    'success' => 'Modul Berhasil Ditambahkan!'
                ];
            }

            return $this->response->setJSON($json);
        }
    }

    public function modalUploadFile()
    {
        if ($this->request->isAJAX()) {
            $id_modul = $this->request->getPost('id_modul');

            $data = [
                'idmodul' => $id_modul
            ];
            $json = [
                'data' => view('modul/modalUploadFile', $data)
            ];


            return $this->response->setJSON($json);
        }
    }

    public function uploadFile()
    {
        if ($this->request->isAJAX()) {
            $id_modul = $this->request->getVar('idModul');
            $dataModul = $this->modelModul->find($id_modul);

            $validation = \Config\Services::validation();

            $validation->setRules([
                'fileModul' => [
                    'label' => 'File Modul',
                    'rules' => 'uploaded[fileModul]'
                ]
            ]);

            $fileModul = $this->request->getFile('fileModul');
            $data = [
                'fileModul' => $fileModul
            ];

            if (!$validation->run($data)) {
                // invalid
                $json = [
                    'error' => $validation->listErrors('list')

                ];
            } else {
                // valid
                $oldFile = $dataModul['file'];
                $namaFile = $dataModul['nama_modul'] . '.' . $fileModul->getExtension();
                if ($namaFile == $oldFile) {
                    unlink('modulFiles/' . $oldFile);
                    $fileModul->move('modulFiles', $namaFile);
                    $file = $fileModul->getName();
                } else {
                    $fileModul->move('modulFiles', $namaFile);
                    $file = $fileModul->getName();
                }


                $this->modelModul->update($id_modul, [
                    'file' => $file
                ]);

                $json = [
                    'success' => 'Modul berhasil di Upload!',
                ];
            }
            return $this->response->setJSON($json);
        }
    }
}
