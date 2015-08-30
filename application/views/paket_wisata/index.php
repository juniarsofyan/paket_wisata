 <!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <ul class="nav nav-tabs">
          <li role="paket_wisata" class="active"><a href="<?=base_url() . 'admin/paket_wisata';?>">Daftar</a></li>
          <li role="paket_wisata"><a href="<?=base_url() . 'admin/paket_wisata/create';?>">Tambah</a></li>
        </ul>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-12">
    <br/>
    <h3>
        <?=$title;?>
    </h3>
    <br/>
	
	
	 <div class="col-lg-12">
                        
                        <div class="table-responsive">
                            <table  id="DaftarPaketWisata"  class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>No. </th>
										<th>Judul Wisata</th>
										<th>Kategori</th>
										<th>Jumlah Hari</th>
										<th>Tanggal Keberangkatan</th>
										<th>Tanggal Kembali</th>
										<th>Harga</th>
										<th>Detail</th>
										<th>Status</th>
                                    </tr>
                                </thead>
                              
                            </table>
                        </div>
                    </div>
    
   
    </div>
</div>
<!-- /.row -->