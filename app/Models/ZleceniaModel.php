<?php

namespace App\Models;

use CodeIgniter\Model;

class ZleceniaModel extends Model
{
    protected $table      = 'zlecenia';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['serial', 'nazwa', 'czy_ekspres'];

    protected $useTimestamps = false;
    protected $createdField  = 'data_przyjecia';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}