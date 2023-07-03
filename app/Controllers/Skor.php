<?php 
namespace App\Controllers;

use App\Middleware\Authenticated;
use CodeIgniter\Database\Postgre\Connection;


// use  CodeIgniter\Database\BaseConnection();
class Skor extends Authenticated
{


    public function __construct()
    {
		$session = \Config\Services::session();
		if (!$session) {
            redirect('');
        }
    }
	
	
	public function index()
	{	
		return view('skor/index');
	}

}

	
	