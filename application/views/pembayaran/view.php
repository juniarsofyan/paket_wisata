<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?=$title;?>
        </h1>
    </div>
</div>
<!-- /.row -->

 <div class="col-lg-6">
                        
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                 <tbody>
                                    <tr>
                                        <th>No Faktur</th>
                                        <td> <?=$pembayaran['no_faktur'];?></td>
                                        
                                    </tr>
                                
                               
                                    <tr>
                                        <th>Nama Customer</th>
                                        <td> <?=$pembayaran['customer_nama'];?></td>
                                        
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td> Rp. <?=$pembayaran['total'];?></td>
                                       
                                    </tr>
                                    <tr>
                                        <th>Angsuran ke</th>
                                        <td><?=$pembayaran['angsuran_ke'];?></td>
                                       
                                    </tr>
                                    <tr>
                                        <th>Pembayaran</th>
                                        <td> Rp. <?=$pembayaran['pembayaran'];?></td>
                                        
                                    </tr>
                                   
                                </tbody>
                            </table>
                        </div>
						<div class="row">
    <!-- Button (Double) -->
    <div class="form-group">
      <label class="col-md-4 control-label" for="submit"></label>
      <div class="col-md-12">
        <a href="<?php echo base_url() . 'admin/pembayaran/edit/' . $pembayaran['id']; ?>" id="edit" class="btn btn-primary">Edit</a>
        <!-- <button name="delete" class="btn btn-danger" onclick="confirmDelete(<?=$pembayaran['id'];?>)">Delete</button> -->
        <a href="<?php echo base_url() . 'admin/pembayaran/delete/' . $pembayaran['id']; ?>" id="delete" class="btn btn-danger">Delete</a>
        <a href="<?php echo base_url() . 'admin/pembayaran'; ?>" id="cancel" class="btn btn-primary">Back</a>
      </div>
    </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
</div>
<!-- /.row
						
                    </div>


<div class="row">
