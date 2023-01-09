<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cekongkir extends CI_Controller {

    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->load->library('session');
    // }


	public function index()
	{
        $data['title'] = 'Cek Ongkos Pengiriman';
        $data['ongkir'] = ''; 
        if(count($_POST))
        {      
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=".$this->input->post('kota')."&destination=".$this->input->post('kota_penerima')."&weight=".$this->input->post('berat')."&courier=".$this->input->post('ekspedisi'),
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: 11a4a2da15cd190a02b0e07bf56e8394"
            ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
            echo "cURL Error #:" . $err;
            } else {
                $data['ongkir'] = $response;
            }
            echo '<script>document.getElementById("alert").classList.add("d-block");</script>';
            echo '<script>document.getElementById("button").classList.remove("d-block");</script>';
        }

		$this->load->view('header', $data);
		$this->load->view('index', $data);
		$this->load->view('footer');
	}

    public function kota($provinsi)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/city?&province=".$provinsi,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: 11a4a2da15cd190a02b0e07bf56e8394"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
           $kota = json_decode($response, true);

            if ($kota['rajaongkir']['status']['code'] == '200') {
                foreach ($kota['rajaongkir']['results'] as $kt) {
                    echo "<option value='$kt[city_id]'>$kt[city_name]</option>";
                }
            }
        }
    }
}
