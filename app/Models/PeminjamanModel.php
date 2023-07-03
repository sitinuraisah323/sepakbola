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
class PeminjamanModel extends Model
{
    public $table = 'peminjaman';

    protected $primaryKey = 'id';

    protected $returnType     = 'object';

    protected $useSoftDeletes = false;

    protected $allowedFields = ['id','peminjam', 'buku','jumlah', 'tanggal_pinjam', 'tanggal_kembali', 'nomor_hp','alamat', 'created_at', 'update_at'];

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}