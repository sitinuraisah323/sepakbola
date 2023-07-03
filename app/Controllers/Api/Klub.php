<?php namespace App\Controllers\Api;
use App\Controllers\Api\BaseApiController;

/**
 * Class Users
 * @package App\Controllers\Api
 * @author Bagus Aditia Setiawan
 * @contact 081214069289
 * @copyright saeapplication.com
 */
class Klub extends BaseApiController
{
    public $modelName = '\App\Models\KlubModel';

       /**
     * @var array
     * column of name table database
     * name of param post
     */
//    [
//        'column'    => 'value'
//    ]

    public $fillSearch = [
        'nama'              => 'nama',
    ];

    public $searchValue = 'nama';

    /**
     * @var array
     * column of name table database
     * name of param post
     */
//    [
//        'column'    => 'value'
//    ]
    public $fillWhere = [
        'nama'              => 'nama',
    ];

//    [
//        'name' => [
//        'label'  => 'Name',
//        'rules'  => 'required',
//        'errors' => [
//        'required' => 'Required Name '
//        ]
//    ],
    public $validateInsert = [
        'nama' => [
            'label'  => 'nama',
            'rules'  => 'required|is_unique[klub.nama]',
        ],
        'kota' => [
            'label'  => 'kota',
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
        'nama' => [
            'label'  => 'nama',
            'rules'  => 'required',
            'errors' => [
                'required' => 'nama harus di isi'
            ]
        ],
        'kota' => [
            'label'  => 'kota',
            'rules'  => 'required',
            'errors' => [
                'required' => 'kota harus di isi'
            ]
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
        'nama' => 'nama',
        'kota' => 'kota',
        
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
        'nama' => 'nama',
        'kota' => 'kota',
        
    ];

//    product
    public $content = 'Data Kategori';
    //--------------------------------------------------------------------

    

}