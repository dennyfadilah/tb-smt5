<?php

namespace App\Models;

use CodeIgniter\Model;

class SurveyorModel extends Model
{
    protected $table            = 'surveyor';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["marketing_nama", "waktu", "komoditas_id", "lokasi_id", "repeat_order", "hasil_survey"];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // Script

    // Niatnya: ubah dari nilai boolean kolom repeat order jadi string "Iya" dan "Tidak"
    // belum di test.
    function getRepeatOrder($thisID)
    {
        $repeatOrder = $this->where(["id" => $thisID])->findColumn("repeat_order");
        $repeatOrder = ($repeatOrder) ? "Iya" : "Tidak";
        return $repeatOrder;
    }

    // Banyak "kunjungan" (Lokasi yang sering di survey)
    // return: lokasi, kunjungan
    function getLokasiCount($thisMonth = null)
    {
        if ($thisMonth) { // true: SATU BULAN TERAKHIR
            return $this->db->query("SELECT lokasi.nama AS lokasi, COUNT(surveyor.lokasi_id) AS kunjungan
            FROM surveyor
            LEFT JOIN lokasi ON surveyor.lokasi_id = lokasi.id
            WHERE surveyor.waktu BETWEEN DATE(DATE_SUB(CURRENT_DATE, INTERVAL 30 DAY)) AND DATE(CURRENT_DATE) 
            GROUP BY surveyor.lokasi_id
            ORDER BY lokasi.nama")->getResultArray();
        }
        $query = $this->db->query("SELECT lokasi.nama AS lokasi, COUNT(surveyor.lokasi_id) AS kunjungan
        FROM surveyor
        LEFT JOIN lokasi ON surveyor.lokasi_id = lokasi.id
        GROUP BY surveyor.lokasi_id
        ORDER BY lokasi.nama")->getResultArray();
        return $query;
    }

    //Semua Komoditas yang pernah di Survey
    //Return: nama, jumlah
    function getKomoditasCount()
    {
        $query = $this->db->query("SELECT komoditas.nama as komoditas, COUNT(surveyor.komoditas_id) AS jumlah
        FROM surveyor
        LEFT JOIN komoditas ON surveyor.komoditas_id = komoditas.id
        GROUP BY komoditas.nama
        ORDER BY komoditas.nama")->getResultArray();
        return $query;
    }

    //Banyak yang di cari (Komoditas yang sering di Survey di setiap lokasi)
    //return: komoditas, lokasi, jumlah
    function getSpecificCount()
    {
        $query = $this->db->query("SELECT komoditas.nama AS komoditas, lokasi.nama AS lokasi, COUNT(surveyor.komoditas_id) AS jumlah
        FROM surveyor
        LEFT JOIN komoditas ON surveyor.komoditas_id = komoditas.id
        LEFT JOIN lokasi ON surveyor.lokasi_id = lokasi.id
        WHERE surveyor.waktu BETWEEN DATE(DATE_SUB(CURRENT_DATE, INTERVAL 5 MONTH)) AND DATE(CURRENT_DATE)
        GROUP BY komoditas.nama, lokasi.nama
        ORDER BY komoditas.nama")->getResultArray();
        return $query;
    }

    //Banyak komoditas di setiap lokasi (tidak membedakan jenis komoditas)
    // function getLokasiCount(){
    //     $query = $this->db->query("SELECT lokasi.nama AS lokasi, COUNT(surveyor.komoditas_id) AS jumlah
    //     FROM surveyor
    //     LEFT JOIN lokasi ON surveyor.lokasi_id = lokasi.id
    //     GROUP BY lokasi.nama
    //     ORDER BY lokasi.nama")->getResultArray();
    //     return $query;
    // }

    // test 
    // return: nama
    function getTestSelect()
    {
        $query = $this->db->query("SELECT DISTINCT marketing_nama AS nama FROM surveyor")->getResultArray();
        return $query;
    }
}
