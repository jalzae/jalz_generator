<?php


namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class Customer
{
    use ResponseTrait;
    public function __construct()
    {
        $this->customer = new Modelhere;
    }

    public function add()
    {
        return view("");
    }

    public function create()
    {
        $name_customer = $this->request->getVar("name_customer");
        $kode = $this->request->getVar("kode");
        $no_telp_customer = $this->request->getVar("no_telp_customer");
        $address_customer = $this->request->getVar("address_customer");
        $entry_date = date("Y-m-d H:i:s");
        $entry_user = $this->request->getVar("entry_user");
        $update_date = date("Y-m-d H:i:s");
        $update_user = $this->request->getVar("update_user");

        $data = [
            "name_customer" => $name_customer,
            "kode" => $kode,
            "no_telp_customer" => $no_telp_customer,
            "address_customer" => $address_customer,
            "entry_date" => $entry_date,
            "entry_user" => $entry_user,
            "update_date" => $update_date,
            "update_user" => $update_user,
        ];
        if ($this->validation->run($data, "customer") == false) {
            $response = [
                "message" =>  $this->validation->getErrors(),
            ];
            return $this->respond($response, 400);
        } else {
            $save = $this->customer->table()->insert($data);
            if ($save) {
                $message = [
                    "message" => "Sukses",
                    "data" => $data,
                ];
                return $this->respond($message, 200);
            } else {
                $message = [
                    "message" => "Gagal",
                    "data" => $data,
                ];
                return $this->respond($message, 400);
            }
        }
    }
    public function read()
    {
        $data["customer"] = $this->customer->getall();

        if (count($data["customer"]) != 0) {
            $message = [
                "message" => "Sukses",
                "data" => $data,
            ];
            return $this->respond($data, 200);
        } else if (count($data["customer"]) == 0) {
            $message = [
                "message" => "Sukses, but no data here",
                "data" => "No Data",
            ];
            return $this->respond($message, 201);
        } else {
            $message = [
                "message" => "Gagal",
                "data" => "No Data",
            ];
            return $this->respond($message, 400);
        }
    }
    public function update()
    {
        $id_customer = $this->request->getVar("id_customer");
        $name_customer = $this->request->getVar("name_customer");
        $kode = $this->request->getVar("kode");
        $no_telp_customer = $this->request->getVar("no_telp_customer");
        $address_customer = $this->request->getVar("address_customer");
        $entry_date = date("Y-m-d H:i:s");
        $entry_user = $this->request->getVar("entry_user");
        $update_date = date("Y-m-d H:i:s");
        $update_user = $this->request->getVar("update_user");

        $data = [
            "name_customer" => $name_customer,
            "kode" => $kode,
            "no_telp_customer" => $no_telp_customer,
            "address_customer" => $address_customer,
            "entry_date" => $entry_date,
            "entry_user" => $entry_user,
            "update_date" => $update_date,
            "update_user" => $update_user,
        ];
        if ($this->validation->run($data, "customer") == false) {
            $response = [
                "message" =>  $this->validation->getErrors(),
            ];
            return $this->respond($response, 400);
        } else {
            $save = $this->customer->table()->update($data, ["id_customer" => $id_customer]);
            if ($save) {
                $message = [
                    "message" => "Sukses",
                    "data" => $data,
                ];
                return $this->respond($message, 200);
            } else {
                $message = [
                    "message" => "Gagal",
                    "data" => $data,
                ];
                return $this->respond($message, 400);
            }
        }
    }
    public function delete()
    {
        $id_customer = $this->request->getVar("id_customer");

        $save = $this->customer->table()->delete(["id_customer" => $id_customer]);
        if ($save) {
            $message = [
                "message" => "Sukses Delete",
            ];
            return $this->respond($message, 200);
        } else {
            $message = [
                "message" => "Gagal Delete",
            ];
            return $this->respond($message, 400);
        }
    }
    public function detail()
    {
        $id_customer = $this->request->getVar("id_customer");

        $data = $this->customer->getrow(["id_customer" => $id]);

        if (count($data) != 0) {
            $message = [
                "message" => "Sukses",
                "data" => $data,
            ];
            return $this->respond($data, 200);
        } else if (count($data) == 0) {
            $message = [
                "message" => "Sukses, but no data here",
                "data" => "No Data",
            ];
            return $this->respond($message, 201);
        } else {
            $message = [
                "message" => "Gagal",
                "data" => "No Data",
            ];
            return $this->respond($message, 400);
        }
    }
}
