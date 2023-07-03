<?php namespace App\Controllers\Api;
use App\Controllers\Api\BaseApiController;
use App\Models\Peminjaman;

use CodeIgniter\Format\JSONFormatter;
use DateTime;
use CodeIgniter\Database\Postgre\Connection;

use App\Middleware\Authenticated;

use Prophecy\Doubler\ClassPatch\DisableConstructorPatch;


/**
* Class Users
* @package App\Controllers\Api
* @author Bagus Aditia Setiawan
* @contact 081214069289
* @copyright saeapplication.com
*/

class Dashboard extends BaseApiController
 {
   public function __construct()
    {
        $db =  \Config\Database::connect(); // default database group
        $this->dbtests      = \Config\Database::connect('tests');
		$this->dbaccounting = \Config\Database::connect('accounting');
		
        
        

    }
    public $modelName = '\App\Models\Products';

    /**
    * @var array
    * column of name table database
    * name of param post
    */
    //    [
    //        'column'    => 'value'
    // ]

    public $fillSearch = [
        // 'title'            => 'title',
        // 'url'              => 'url',
        // 'embedded'         => 'embedded',
    ];

    /**
    * @var array
    * column of name table database
    * name of param post
    */
    //    [
    //        'column'    => 'value'
    // ]
    public $fillWhere = [
        // 'name'              => 'name',
    ];

    //    [
    //        'name' => [
    //        'label'  => 'Name',
    //        'rules'  => 'required',
    //        'errors' => [
    //        'required' => 'Required Name '
    // ]
    // ],
    public $validateInsert = [
        // 'title' => [
        //     'label'  => 'title',
        //     'rules'  => 'required',
        //     'errors' => [
        //         'required' => 'Judul harus di isi'
        // ]
        // ],
        // 'embedded' => [
        //     'label'  => 'embedded',
        //     'rules'  => 'required',
        //     'errors' => [
        //         'required' => 'Embedded harus di isi'
        // ]
        // ]
    ];

    public $validateUpdate = [
        // 'id' => [
        //     'label'  => 'id',
        //     'rules'  => 'required',
        //     'errors' => [
        //         'required' => 'Id harus di isi'
        // ]
        // ],
        // 'title' => [
        //     'label'  => 'title',
        //     'rules'  => 'required',
        //     'errors' => [
        //         'required' => 'title harus di isi'
        // ]
        // ],
        // 'embedded' => [
        //     'label'  => 'embedded',
        //     'rules'  => 'required',
        //     'errors' => [
        //         'required' => 'embedded harus di isi'
        // ]
        // ]
    ];

    /**
    * @var array
    * column of name table database
    * name of param post
    */
    //    [
    //        'column'    => 'value'
    // ]
    public $fillableInsert = [
        // 'title'              => 'title',
        // 'url'                => 'url',
        // 'embedded'           => 'embedded'
    ];

    /**
    * @var array
    * column of name table database
    * name of param post
    */
    //    [
    //        'column'    => 'value'
    // ]

    public $fillableIupdate = [
        // 'title'              => 'title',
        // 'url'                => 'url',
        // 'embedded'           => 'embedded'
    ];

    //    product
    public $content = 'Devicelog';

    public function index()
 {

        if ( $this->model ) {
            $peminjaman = ( new \App\Models\Peminjaman )->countAllResults();
            $buyback = ( new \App\Models\Buyback )->where( 'type', 'Buy Back' )->countAllResults();
            $excange = ( new \App\Models\Buyback )->where( 'type', 'Online Exchange' )->countAllResults();
            $data = [
                'peminjaman'  => $peminjaman,
                'buyback'  => $buyback,
                'exchange'  => $excange,
                'visitor'  => $sumScan,
            ];
            return $this->sendResponse( $data, 200 );
        }
        return $this->sendResponse( 'Model Not Found', 400, 'Model Not Found '.$this->model );

    }
  
    

}