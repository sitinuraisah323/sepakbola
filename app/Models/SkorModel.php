<?php
namespace App\Models;


use CodeIgniter\Model;

/**
 * Class Users
 * @package App\Models
 * @author Bagus Aditia Setiawan
 * @contact 081214069289
 * @copyright saeapplication.com
 */
class SkorModel extends Model
{
    public $table = 'skor';

    protected $primaryKey = 'id';

    protected $returnType     = 'object';

    protected $useSoftDeletes = false;

    protected $allowedFields = ['id','id_klub_1', 'skor_klub_1','id_klub_2', 'skor_klub_2', 'created_at', 'update_at'];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}