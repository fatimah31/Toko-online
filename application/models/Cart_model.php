<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cart_model extends MY_Model 
{
    //diperlukan untuk mengakses table cart untuk diambil datanya
    //kemudian di override di controller
    public $table = 'cart';

}

/* End of file Cart_model.php */
