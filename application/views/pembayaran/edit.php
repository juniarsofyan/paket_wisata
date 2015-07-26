<?php
  // echo "wisata id : " . print_r($paket_wisata_detail['wisata_id']) . "<br/><br/>";
  // print_r($paket_wisata_detail['wisata_id']);
  // echo "<pre>";
  // print_r($paket_wisata);
  // echo "</pre>";
  // print_r($paket_wisata_detail['wisata_id'])
?>



<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
<!--         <h1 class="page-header">
            <?=$title;?>
        </h1> -->
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-edit"></i> Forms
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-lg-6">

      <?php echo validation_errors(); ?>

      <form class="form-horizontal" method="POST" action="<?=base_url();?>paket_wisata_detail/save">
      <fieldset>

      <!-- Form Name -->
      <legend>Form Name</legend>
      <input type="hidden" name="id" value="<?=$paket_wisata_detail['id'];?>">

      <!-- Select Basic -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="wisata_id">Paket Wisata</label>
        <div class="col-md-6">
          <select id="wisata_id" name="wisata_id" class="form-control">
            <?php 
              foreach ($paket_wisata as $row) :       
                if ($row['id'] == $paket_wisata_detail['wisata_id']) :
            ?>
                  <option value="<?=$row['id'];?>" selected="selected"><?=$row['judul_wisata'];?></option>
            <?php 
                else : 
            ?>
                  <option value="<?=$row['id'];?>"><?=$row['judul_wisata'];?></option>
            <?php
                endif;
              endforeach; 
            ?>            
          </select>
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="rute">Rute</label>  
        <div class="col-md-6">
        <input id="rute" name="rute" type="text" placeholder="" class="form-control input-md" required="" value="<?=$paket_wisata_detail['rute'];?>">
          
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="hari_ke">Hari ke</label>  
        <div class="col-md-6">
        <input id="hari_ke" name="hari_ke" type="text" placeholder="" class="form-control input-md" required=""  value="<?=$paket_wisata_detail['hari_ke'];?>">
          
        </div>
      </div>

      <!-- Textarea -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="deskripsi">Deskripsi</label>
        <div class="col-md-4">                     
          <textarea class="form-control" id="deskripsi" name="deskripsi"><?=$paket_wisata_detail['deskripsi'];?></textarea>
        </div>
      </div>

      <!-- Button (Double) -->
      <div class="form-group">
        <label class="col-md-4 control-label" for="submit"></label>
        <div class="col-md-8">
          <button id="submit" name="submit" class="btn btn-success">Submit</button>
          <button id="cancel" name="cancel" class="btn btn-danger">Cancel</button>
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