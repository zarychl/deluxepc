<?php

namespace App\Models;

use CodeIgniter\Model;

class KlientModel extends Model
{
    protected $table      = 'klienci';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['nazwa', 'nip', 'ulica', 'kod', 'miasto', 'tel1', 'tel2', 'mail', 'uwagi'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'edited_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}