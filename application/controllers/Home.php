<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

    public function index($page = null)
    {
        $data['title'] = 'Homepage';
        $data['content'] = $this->home->select( 
            [
                'product.id', 'product.title AS product_title' ,'product.description', 'product.image', // AS sbg aliasis krn ada nama yg sama, title product dan category
                'product.price', 'product.is_available', 'category.title AS category_title','category.slug AS category_slug'
            ]
        )
        ->join('category')
        ->where('product.is_available', 1)
        ->paginate($page)
        ->get();
        $data['total_rows'] = $this->home->where('product.is_available', 1)->count();
        $data['pagination'] = $this->home->makePagination(
            base_url('home'), 2 /*nilai dr halaman*/, $data['total_rows'] //total yg dibagi tiap hal
        );
        $data['page'] = 'pages/home/index';
        $this->view($data);
    }

}

/* End of file Home.php */