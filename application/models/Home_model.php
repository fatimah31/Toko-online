<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends MY_Model 
{
    protected $table = 'product'; //karena nama tabel yg digunakan berbeda dgn nama class
    protected $perPage = 2; //override $perPage yg di MY_Model

}

/* End of file Home_model.php */
