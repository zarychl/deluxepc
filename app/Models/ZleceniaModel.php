<?php

namespace App\Models;

use CodeIgniter\Model;

class ZleceniaModel extends Model
{
    protected $table      = 'zlecenia';
    protected $primaryKey = 'id';
    protected $dateFormat = 'datetime';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ["nazwa","data_odbioru", "serial", "opis_usterki", "data_przyjecia", "dni_naprawy", "czy_gwarancja", "czy_ekspres", "czy_zewn", "czy_opak", "czy_kable", "czy_zasilacz", "czy_plyty", "wyp_inne", "data_naprawy", "uwagi", "id_klient", "id_serwisant", "updated_at", "deleted_at", "status", "opis_naprawy"];

    protected $useTimestamps = true;
    protected $createdField  = 'data_przyjecia';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;
}