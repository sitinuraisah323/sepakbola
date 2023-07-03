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
class KlubModel extends Model
{
    public $table = 'klub';

    protected $primaryKey = 'id';

    protected $returnType     = 'object';

    protected $useSoftDeletes = false;

    protected $allowedFields = ['id','nama','kota','created_at', 'update_at'];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}