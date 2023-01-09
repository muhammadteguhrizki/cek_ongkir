<footer class="container">
        <div class="row text-center mb-3 justify-content-center align-items-center">
            <div class="col-md-3 mb-3">
                <img src="<?= base_url('assets/JNE_Express.png') ;?>" class="img-fluid" style="width: 12rem;" alt="JNE">
            </div>
            <div class="col-md-3 mb-3">
                <img src="<?= base_url('assets/POS.png') ;?>" class="img-fluid" style="width: 12rem; alt="POS-Indonesia">
            </div>
            <div class="col-md-3 mb-3">
                <img src="<?= base_url('assets/TIKI.png') ;?>" class="img-fluid" style="width: 12rem; alt="TIKI">
            </div>
            <small class="fs-6 mt-3">&copy build by <a href="https://www.instagram.com/teguhrik/" target="_blank">teguh rizki</a> <span class="text-danger"><i class="bi bi-arrow-through-heart-fill"></i></span></small>
        </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>

<!-- ambil id provinsi untuk mendapatkan data kota response dari controller -->
<script type="text/javascript">
    // kota pengirim
    document.getElementById('provinsi').addEventListener('change', function() { 
        fetch('<?= base_url('Cekongkir/kota/'); ?>'+this.value,{
            method:'GET',
        } )
        .then((response) => response.text() )
        .then((data) => {
            document.getElementById('kota').innerHTML = data
        })
    })
    // kota penerima
    document.getElementById('provinsi_penerima').addEventListener('change', function() { 
        fetch('<?= base_url('Cekongkir/kota/'); ?>'+this.value,{
            method:'GET',
        } )
        .then((response) => response.text() )
        .then((data) => {
            console.log(data)
            document.getElementById('kota_penerima').innerHTML = data
        })
    })

    // saat tombol cek dengan id "button" diklik
    document.getElementById('button').onclick = function() {
    // hilangkan class d-none dan tampilkan class d-block di controller 
    document.getElementById('alert').classList.remove('d-none');
    // tampilkan class di none saat tombol di klik
    document.getElementById('button').classList.add('d-none');
    } 
</script>

  </body>
</html>