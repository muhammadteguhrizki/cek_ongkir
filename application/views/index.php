  <?php
    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
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
       $provinsi = json_decode($response, true);
    }
 ?>

<body>
    
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
  <div class="container">
    <a class="navbar-brand" href="<?= base_url(); ?>">Cek Ongkir</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url(); ?>">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://wa.me/6287825400060?text=Halo%20%20Admin%20Cek%20Ongkir" target="_blank">Kontak</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Alert -->
<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="alert alert-success" role="alert">
               <strong>Hallo,</strong> selamat datang di sistem cek ongkos pengiriman paket.
            </div>
        </div>
        <div class="col-md-12">
            <p class="fst-italic"><span class="text-danger">*</span> Form wajib di isi</p>
        </div>
    </div>
</div>

<!-- Form -->
<div class="container">
    <div class="row mt-3 mb-3 justify-content-start align-items-center">
        
        <div class="col-md-6 mb-3">
            <form id="cekongkirForm" action="" method="post">
                <!-- Alamat Pengirim -->
                <h4 class="display-6 fw-bold">Alamat Pengirim</h4>
                <div class="mb-3">
                    <label for="provinsi" class="form-label">provinsi asal <span class="text-danger">*</span></label>
                    <select id="provinsi" name="provinsi" class="form-select">
                    <option value="">-- pilih provinsi --</option>
                    <?php
                    if ($provinsi['rajaongkir']['status']['code'] == '200') 
                    {
                        foreach ($provinsi['rajaongkir']['results'] as $prov)
                        {
                            echo "<option value='$prov[province_id]' ".($prov['province_id'] == $this->input->post('provinsi') ? "selected" : "").">$prov[province]</option>";
                        }
                    }
                    ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="kota" class="form-label">kota asal <span class="text-danger">*</span></label>
                    <select id="kota" name="kota" class="form-select">
                    <!-- <option value="">-- --</option> -->
                    <?php
                    if(count($_POST)) {
                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                        CURLOPT_URL => "https://api.rajaongkir.com/starter/city?&province=".$this->input->post('provinsi'),
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
                                    echo "<option value='$kt[city_id]' ".($kt['city_id'] == $this->input->post('kota') ? "selected" : "" ).">$kt[city_name]</option>";
                                }
                            }
                        }
                    } else {
                        echo"<option>pilih provinsi dulu</option>";
                    }
                    ?>
                    </select>
                </div>
            </div>
            
        <!-- Alamat Penerima -->
        <div class="col-md-6 mb-3">
            <h4 class="display-6 fw-bold">Alamat Penerima</h4>
                <div class="mb-3">
                    <label for="provinsi_penerima" class="form-label">provinsi penerima <span class="text-danger">*</span></label>
                    <select id="provinsi_penerima" name="provinsi_penerima" class="form-select">
                    <option value="">-- pilih provinsi --</option>
                    <?php
                    if ($provinsi['rajaongkir']['status']['code'] == '200') 
                    {
                        foreach ($provinsi['rajaongkir']['results'] as $prov)
                        {
                            echo "<option value='$prov[province_id]' ".($prov['province_id'] == $this->input->post('provinsi_penerima') ? "selected" : "").">$prov[province]</option>";
                        }
                    }
                    ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="kota-penerima" class="form-label">kota asal <span class="text-danger">*</span></label>
                    <select id="kota_penerima" name="kota_penerima" class="form-select">
                    <!-- <option>-- --</option> -->
                    <?php
                    if(count($_POST)) {
                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                        CURLOPT_URL => "https://api.rajaongkir.com/starter/city?&province=".$this->input->post('provinsi_penerima'),
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
                                    echo "<option value='$kt[city_id]' ".($kt['city_id'] == $this->input->post('kota_penerima') ? "selected" : "").">$kt[city_name]</option>";
                                }
                            }
                        }
                    } else {
                        echo "<option>pilih provinsi dulu</option>";
                    }
                    ?>
                    </select>
                </div>
            </div>

        <!-- Espedisi Pengiriman -->
        <div class="row justify-content-center aling-items-center">
            <h4 class="display-6 fw-bold">Ekspedisi</h4>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="ekspedisi" class="form-label">pilih ekspedisi <span class="text-danger">*</span></label>
                        <select id="ekspedisi" name="ekspedisi" class="form-select">
                        <option value="">-- ekspedisi --</option>
                        <?php
                        $ekspedisi = ['jne' => 'JNE','pos' => 'POS','tiki' => 'TIKI'];
                            foreach ($ekspedisi as $key => $value)
                            {
                                echo "<option value='$key' ".($key == $this->input->post('ekspedisi') ? "selected" : "").">$value</option>";
                            }
                        ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="berat" class="form-label">berat (gram) <span class="text-danger">*</span></label>
                        <input type="number" class="form-control berat" id="berat" name="berat" value="<?= $this->input->post('berat') ?>" placeholder="berat" required>
                    </div>
                </div>
            </div>
        
            <div class="text-center mb-3 d-flex justify-content-center">
                <button id="button" type="submit" class="btn btn-primary px-5 d-block">Cek</button>
                <button id="alert" class="btn btn-primary d-none" type="button" disabled>
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                Loading...
                </button>
            </div>
        </form>

            <!-- Card hasil -->
            <div class="container">
                <div class="row mb-3 justify-content-center align-items-center">
                    <?php
                        $biaya = json_decode($ongkir, true);

                        if(empty($biaya['rajaongkir']['results'][0]['costs']))
                        { 
                            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">Ekspedisi belum tersedia.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>';    

                        } else {
                            foreach($biaya['rajaongkir']['results'][0]['costs'] as $byy)
                            {
                                if(isset($byy['service']) && isset($byy['description']) && isset($byy['cost'][0]['value']) && isset($byy['cost'][0]['etd'])) {
                                ?>
                                <div class="col-md-4 mb-3 mt-2">
                                    <div class="card shadow">
                                        <div class="card-body">
                                        <h5 class="card-title"><?= $byy['service'] ;?></h5>
                                        <p class="card-text"><?= $byy['description'] ;?></p>
                                        <p class="card-text">Rp<?= number_format($byy['cost'][0]['value'],0,',',',') ;?></p>
                                        <p class="card-text"><small class="text-muted">estimasi pengiriman <?= $byy['cost'][0]['etd'] ;?> hari</small></p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                } 
                            }
                        } 
                    ?>                   
                </div>
          </div>

    </div>
</div>


