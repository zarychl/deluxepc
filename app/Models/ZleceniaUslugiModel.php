<?php

namespace App\Models;

use CodeIgniter\Model;

class ZleceniaUslugiModel extends Model
{
    protected $table      = 'zleceniauslugi';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id_uslugi', 'id_zlecenia', 'ilosc', 'customPrice'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'edited_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;
}