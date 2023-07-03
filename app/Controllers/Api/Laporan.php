<?php namespace App\Controllers\Api;
use App\Controllers\Api\BaseApiController;

/**
 * Class Users
 * @package App\Controllers\Api
 * @author Bagus Aditia Setiawan
 * @contact 081214069289
 * @copyright saeapplication.com
 */
class Laporan extends BaseApiController
{
    public $modelName = '\App\Models\PeminjamanModel';

       /**
     * @var array
     * column of name table database
     * name of param post
     */
//    [
//        'column'    => 'value'
//    ]

    public $fillSearch = [
        'peminjam'              => 'peminjam',
    ];

    public $searchValue = 'peminjam';

    /**
     * @var array
     * column of name table database
     * name of param post
     */
//    [
//        'column'    => 'value'
//    ]
    public $fillWhere = [
        'peminjam'              => 'peminjam',
    ];

    public $validateInsert = [
        'tanggal_pinjam' => [
            'label'  => 'tanggal_pinjam',
            'rules'  => 'required',
        ],
        'tanggal_kembali' => [
            'label'  => 'tanggal_kembali',
            'rules'  => 'required',
        ],
        'peminjam' => [
            'label'  => 'peminjam',
            'rules'  => 'required',
        ],
        'buku' => [
            'label'  => 'buku',
            'rules'  => 'required',
        ],
        'jumlah' => [
            'label'  => 'jumlah',
            'rules'  => 'required',
        ],
        'nomor_hp' => [
            'label'  => 'nomor_hp',
            'rules'  => 'required',
        ],
        'alamat' => [
            'label'  => 'alamat',
            'rules'  => 'required',
        ],
    ];

    public $validateUpdate = [
        'id' => [
            'label'  => 'id',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Id harus di isi'
            ]
        ],
         'tanggal_pinjam' => [
            'label'  => 'tanggal_pinjam',
            'rules'  => 'required',
        ],
        'tanggal_kembali' => [
            'label'  => 'tanggal_kembali',
            'rules'  => 'required',
        ],
        'peminjam' => [
            'label'  => 'peminjam',
            'rules'  => 'required',
        ],
        'buku' => [
            'label'  => 'buku',
            'rules'  => 'required',
        ],
        'jumlah' => [
            'label'  => 'jumlah',
            'rules'  => 'required',
        ],
        
        'nomor_hp' => [
            'label'  => 'nomor_hp',
            'rules'  => 'required',
        ],
        'alamat' => [
            'label'  => 'alamat',
            'rules'  => 'required',
        ],
    ];

    /**
     * @var array
     * column of name table database
     * name of param post
     */
//    [
//        'column'    => 'value'
//    ]
    public $fillableInsert = [
        'tanggal_pinjam' => 'tanggal_pinjam',
        'tanggal_kembali' => 'tanggal_kembali',
        'peminjam' => 'peminjam',
        'buku' => 'buku',
        'jumlah' => 'jumlah',
        'nomor_hp' => 'nomor_hp',
        'alamat' => 'alamat'
    ];


    /**
     * @var array
     * column of name table database
     * name of param post
     */
//    [
//        'column'    => 'value'
//    ]


    public $fillableIupdate = [
        'tanggal_pinjam' => 'tanggal_pinjam',
        'tanggal_kembali' => 'tanggal_kembali',
        'peminjam' => 'peminjam',
        'buku' => 'buku',
        'jumlah' => 'jumlah',
        'nomor_hp' => 'nomor_hp',
        'alamat' => 'alamat'
    ];

//    product
    public $content = 'Data Buku';
    //--------------------------------------------------------------------

    public function dashboard ()
    {
        
        $data = (new \App\Models\PeminjamanModel())
                        ->select('buku.judul, buku.stok, peminjaman.*, kategori.nama')
                        ->join('buku','buku.id = peminjaman.buku')
                        ->join('kategori','kategori.id = buku.kategori')
                        ->orderby('peminjaman.id', 'desc')
                        ->findAll();
        return $this->sendResponse( $data, 200 );
    }

    

}