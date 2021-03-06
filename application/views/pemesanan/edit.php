<div class="row">
    <div class="col-lg-6">
      <br/>
      <h3>
          <?=$title;?>
          <hr/>
      </h3>
      <br/>
      
      <?php echo validation_errors(); ?>

      <form class="form-horizontal" method="POST" action="<?=base_url();?>admin/pemesanan/update">
      <fieldset>

      <!-- Form Name -->
      <legend>Edit Data Pemesanan</legend>
      <input id="id" type="hidden" name="id" value="<?=$pemesanan['id'];?>">
      <input id="wisata_id" type="hidden" name="wisata_id" value="<?=$pemesanan['wisata_id'];?>">

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="customer_nama">Nama Customer</label>  
        <div class="col-md-6">
        <input id="customer_nama" name="customer_nama" type="text" placeholder="" class="form-control input-md" value="<?=$pemesanan['customer_nama'];?>" readonly/>
          
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="wisata_nama">Nama Wisata</label>  
        <div class="col-md-6">
        <input id="wisata_nama" name="wisata_nama" type="text" placeholder="" class="form-control input-md" value="<?=$pemesanan['judul_wisata'];?>" readonly/>
          
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="no_faktur">Nomor Faktur</label>  
        <div class="col-md-6">
        <input id="no_faktur" name="no_faktur" type="text" placeholder="" class="form-control input-md" value="<?=$pemesanan['no_faktur'];?>" readonly/>
          
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="tgl_pemesanan">Tanggal Pemesanan</label>  
        <div class="col-md-6">
        <input id="tgl_pemesanan" name="tgl_pemesanan" type="date" placeholder="" class="form-control input-md" value="<?=$pemesanan['tgl_pemesanan'];?>"/>
          
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="jml_orang_dewasa">Jumlah Orang Dewasa</label>  
        <div class="col-md-6">
        <input id="jml_orang_dewasa" name="jml_orang_dewasa" type="number" placeholder="" class="form-control input-md" value="<?=$pemesanan['jumlah_orang_dewasa'];?>" required />          
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="jml_orang_anak">Jumlah Orang Anak</label>  
        <div class="col-md-6">
        <input id="jml_orang_anak" name="jml_orang_anak" type="number" placeholder="" class="form-control input-md" value="<?=$pemesanan['jumlah_orang_anak'];?>"/>
          
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="total">Total</label>  
        <div class="col-md-6">
        <input id="total" name="total" type="text" placeholder="" class="form-control input-md" value="<?=$pemesanan['total'];?>" readonly />
          
        </div>
      </div>

      <!-- Button (Double) -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="submit"></label>
        <div class="col-md-8">
          <button id="submit" name="submit" class="btn btn-primary">Submit</button>
          <a href="<?php echo base_url() . 'admin/pemesanan/view/' . $pemesanan['id']; ?>" id="cancel" name="cancel" class="btn btn-danger">Cancel</a>
          <a href="<?php echo (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url() . 'admin/pemesanan/view/' . $pemesanan['id']); ?>" id="cancel" class="btn btn-primary">Back</a>
        </div>
      </div>

      </fieldset>
      </form>



    </div>

    <?php 
      for ($i=0; $i < 40; $i++) { 
        echo "<br/>";
      }
    ?>
</div>
<!-- /.row -->