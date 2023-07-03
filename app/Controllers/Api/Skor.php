<?php namespace App\Controllers\Api;
use App\Controllers\Api\BaseApiController;

/**
 * Class Users
 * @package App\Controllers\Api
 * @author Bagus Aditia Setiawan
 * @contact 081214069289
 * @copyright saeapplication.com
 */
class Skor extends BaseApiController
{
    public $modelName = '\App\Models\SkorModel';

       /**
     * @var array
     * column of name table database
     * name of param post
     */
//    [
//        'column'    => 'value'
//    ]

    public $fillSearch = [
        'id'              => 'id',
    ];

    public $searchValue = 'kode_buku';

    /**
     * @var array
     * column of name table database
     * name of param post
     */
//    [
//        'column'    => 'value'
//    ]
    public $fillWhere = [
        'id'              => 'id',
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
        'klub_1' => [
            'label'  => 'klub_1',
            'rules'  => 'required',
        ],
        'skor_klub_1' => [
            'label'  => 'skor_klub_1',
            'rules'  => 'required',
        ],
        // 'klub_2' => [
        //     'label'  => 'klub_2',
        //     'rules'  => 'required',
        // ],
        'skor_klub_2' => [
            'label'  => 'skor_klub_2',
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
        'klub_1' => [
            'label'  => 'klub_1',
            'rules'  => 'required',
            'errors' => [
                'required' => 'klub_1 harus di isi'
            ]
        ],
        'skor_klub_1'   => [
            'label'  => 'skor_klub_1',
            'rules'  => 'required',
        ],
       'klub_2' => [
            'label'  => 'klub_2',
            'rules'  => 'required',
        ],
        'skor_klub_2' => [
            'label'  => 'skor_klub_2',
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
        'klub_1' => 'klub_1',
        'skor_klub_1' => 'skor_klub_1',
        // 'klub_2' => 'klub_2',
        'skor_klub_2' => 'skor_klub_2',
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
        'klub_1' => 'klub_1',
        'skor_klub_1' => 'skor_klub_1',
        'klub_2' => 'klub_2',
        'skor_klub_2' => 'skor_klub_2',
    ];

//    product
    public $content = 'Data Skor';
    //--------------------------------------------------------------------

    public function custom ()
    {
        $data = (new \App\Models\SkorModel())
                        ->select("skor.*, 'VS' as vs")
                        ->orderby('skor.id', 'desc')
                        ->findAll();
        return $this->sendResponse( $data, 200 );
    }

    public function klasemen ()
    {
        $klub = (new \App\Models\KlubModel())->findAll();
        $a = 0;
        foreach($klub as $data){
            $main_1 = (new \App\Models\SkorModel())
                        ->select('klub.nama, skor.skor_klub_1')
                        ->where('klub_1', $data->id)
                        ->countAllResults();
            $main_2 = (new \App\Models\SkorModel())
                        ->select('klub.nama, skor.skor_klub_1')
                        ->where('klub_2', $data->id)
                        ->countAllResults();
            // echo $main_1; exit;
             $data->$a->main = $main_1 + $main_2;

             $menang_1 = (new \App\Models\SkorModel())
                        ->select('klub.nama, skor.skor_klub_1')
                        ->where('klub_1', $data->id)
                        ->where('skor_klub_1 >', 'skor_klub_2')
                        ->countAllResults();
            $menang_2 = (new \App\Models\SkorModel())
                        ->select('klub.nama, skor.skor_klub_1')
                        ->where('klub_2', $data->id)
                        ->where('skor_klub_2 >', 'skor_klub_1')
                        ->countAllResults();
            // echo $main_1; exit;
             $data->$a->menang = $menang_1 + $menang_2;

             $seri_1 = (new \App\Models\SkorModel())
                        ->select('klub.nama, skor.skor_klub_1')
                        ->where('klub_1', $data->id)
                        ->where('skor_klub_1 ', 'skor_klub_2')
                        ->countAllResults();
            $seri_2 = (new \App\Models\SkorModel())
                        ->select('klub.nama, skor.skor_klub_1')
                        ->where('klub_2', $data->id)
                        ->where('skor_klub_2 ', 'skor_klub_1')
                        ->countAllResults();
            // echo $main_1; exit;
             $data->$a->seri = $seri_1 + $seri_2;

             $kalah_1 = (new \App\Models\SkorModel())
                        ->select('klub.nama, skor.skor_klub_1')
                        ->where('klub_1', $data->id)
                        ->where('skor_klub_1 <', 'skor_klub_2')
                        ->countAllResults();
            $kalah_2 = (new \App\Models\SkorModel())
                        ->select('klub.nama, skor.skor_klub_1')
                        ->where('klub_2', $data->id)
                        ->where('skor_klub_2 <', 'skor_klub_1')
                        ->countAllResults();
            // echo $main_1; exit;
             $data->$a->kalah = $kalah_1 + $kalah_2;

             $gmenang_1 = (new \App\Models\SkorModel())
                        ->select('sum(skor.skor_klub_1) as skor')
                        ->where('klub_1', $data->id)
                        ->where('skor_klub_1 >', 'skor_klub_2')
                        ->first();
            $gmenang_2 = (new \App\Models\SkorModel())
                        ->select('sum(skor.skor_klub_1) as skor')
                        ->where('klub_2', $data->id)
                        ->where('skor_klub_2 >', 'skor_klub_1')
                        ->first();
            // echo $main_1; exit;
             $data->$a->gmenang = $gmenang_1->skor + $gmenang_2->skor;

             $gkalah_1 = (new \App\Models\SkorModel())
                        ->select('sum(skor.skor_klub_1) as skor')
                        ->where('klub_1', $data->id)
                        ->where('skor_klub_1 <', 'skor_klub_2')
                        ->first();
            $gkalah_2 = (new \App\Models\SkorModel())
                        ->select('sum(skor.skor_klub_1) as skor')
                        ->where('klub_2', $data->id)
                        ->where('skor_klub_2 <', 'skor_klub_1')
                        ->first();
            // echo $main_1; exit;
             $data->$a->gkalah = $gkalah_1->skor + $gkalah_2->skor;
            $data->$a->point = $data->main + $data->menang + $data->seri + $data->kalah + $data->gmenang + $data->gkalah;

            $a++;
        }
        return $this->sendResponse( $data, 200 );
    }

     public function kategori ($id){
        $data = (new \App\Models\BukuModel())
                        ->select('kategori.nama, buku.*')
                        
                        ->join('kategori','kategori.id = buku.kategori')
                        ->where('buku.kategori')
                        ->orderby('buku.id', 'desc')
                        ->findAll();
     }
     
    

}