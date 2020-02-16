<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Controller {

    private $id;

    public function __construct()
    {
        parent::__construct();
        $is_login = $this->session->userdata('is_login');
        $this->id = $this->session->userdata('id');

        if(! $is_login){
            redirect(base_url());
            return;
        }
    }

    public function index()
    {
        $data['title']  = 'Keranjang Belanja';
        $data['content'] = $this->cart->select([
            'cart.id', 'cart.qty', 'cart.subtotal',
            'product.title', 'product.image', 'product.price'
        ])
        ->join('product')
        ->where('cart.id_user', $this->id)
        ->get();

        $data['page'] = 'pages/cart/index';

        return $this->view($data);
    }

    public function add()
    {
        if(!$_POST || $this->input->post('qty') < 1) {
            $this->session->set_flashdata('error', 'Kuantitas produk tidak boleh kosong.');
            
            redirect(base_url());
        } else {
            $input = (object) $this->input->post(null, true); //memasukkan data ke $input

            $this->cart->table = 'product';
            $product = $this->cart->where('id',$input->id_product)->first(); //mencari data di produk sesuai id

            $subtotal = $product->price * $input->qty; //menghitung harga qty

            //mevalidasi apakah ada produk yg sama di cart user
            $this->cart->table = 'cart'; 
            $cart = $this->cart->where('id_user', $this->id)->where('id_product', $input->id_product)->first();    

            //jika ada maka update data cart
            if($cart) {
                $data = [
                    'qty' => $cart->qty + $input->qty,
                    'subtotal' => $cart->subtotal + $subtotal
                ];

                    if($this->cart->where('id', $cart->id)->update($data)){
                        $this->session->set_flashdata('success', 'Produk berhasil ditambahkan!');
                    } else {
                        $this->session->set_flashdata('error', 'Ops, terjadi kesalahan!');
                    }

                    redirect(base_url(''));
                }

                //jika tidak ada data maka input data baru
                $data = [
                    'id_user' => $this->id,
                    'id_product' => $input->id_product,
                    'qty' => $input->qty,
                    'subtotal' => $subtotal
                ];

                if($this->cart->create($data)){
                    $this->session->set_flashdata('success', 'Produk berhasil ditambahkan!');
                } else {
                    $this->session->set_flashdata('error', 'Oops! terjadi kesalahan!');
                }

                redirect(base_url(''));

            }
            
        }

        public function update($id)
        {
            //jika bukan method post dan jumlahnya < 1
            if(!$_POST || $this->input->post('qty') < 1) {
                $this->session->set_flashdata('error', 'Kuantitas produk tidak boleh kosong.');
                
                redirect(base_url('cart/index'));
            }

            //jika > 1 dan method post maka cari data di content berdasarkan id
            $data['content']  = $this->cart->where('id', $id)->first();

            //jika data tidak ada muncul pesan warning
            if(!$data['content']) {
                $this->session->set_flashdata('warning', 'Data tidak ditemukan!');
                
                redirect(base_url('cart/index'));
            }

            //jika data ada, masukkan data ke cart berdasarkan id produk
            $data['input']   = (object) $this->input->post(null, true);
            //override variable table jadi product tuk mendapatkan price nya
            $this->cart->table = 'product';
            $product           = $this->cart->where('id', $data['content']->id_product)->first();

            //menghitung subtotal
            $subtotal          = $data['input']->qty * $product->price;
            //masukkan data ke qty dan subtotal
            $data              = [
                'qty'       => $data['input']->qty,
                'subtotal'  => $subtotal
            ];

            //ubah/override data table jadi cart tuk update cart
            $this->cart->table = 'cart';
            if ($this->cart->where('id', $id)->update($data)) {
                $this->session->set_flashdata('success', 'Produk berhasil ditambahkan!');
            } else {
                $this->session->set_flashdata('error', 'Oops! terjadi kesalahan!');
                
            }

            redirect(base_url('/cart/index'));
        }

        public function delete($id)
    {
        if (!$_POST) {
            redirect(base_url('cart/index'));
        }

        if(!$this->cart->where('id', $id)->first()) {
            $this->session->set_flashdata('warning', 'Maaf data tidak ditemukan!');
            redirect(base_url('cart/index'));
        }

        if($this->cart->where('id', $id)->delete()) {
            $this->session->set_flashdata('success', 'Data sudah berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Oops ada yang salah nih!');
        }
        redirect(base_url('cart/index'));
    }
    }


/* End of file Cart.php */

/* CREATE TABLE `code_cishop`.`orders` ( `id` INT NOT NULL AUTO_INCREMENT , 
 *`id_user` INT NOT NULL , `date` DATE NOT NULL , `invoice` VARCHAR(100) NOT NULL , 
 *`total` INT NOT NULL , `name` VARCHAR(255) NOT NULL , `address` VARCHAR(255) NOT NULL , 
 *`phone` VARCHAR(15) NOT NULL , `status` ENUM('waiting', 'paid', 'delivered', 'cancel') NOT NULL , 
 *PRIMARY KEY (`id`)) ENGINE = InnoDB;*/