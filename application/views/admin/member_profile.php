

<script type="text/javascript" nonce=<?=SC_NONCE?>>



$(document).ready(function(e) {

	

		$('#demo-dt-basic').dataTable( {

			

			"responsive": true

			

		});   

});	

</script>

<?php if($panel=='profile'){ ?>



<div class="row">

  <div class="col-sm-6">

    <div class="panel">

      <div class="panel-heading">

        <h3 class="panel-title">Personal-info</h3>

      </div>

      

      <!--Block Styled Form --> 

      <!--===================================================-->

      

      <div class="panel-body">

        <table class="table table-bordered">

          <tr>

            <td width="30%"><font class="font-3">Name</font></td>

            <td width="1%">:</td>

            <td width="69%"><font class="font-4">

              <?=$member['fname']?>

              <?=$member['lname']?>

              </font></td>

          </tr>

          <tr>

            <td><font class="font-3">Usercode</font></td>

            <td>:</td>

            <td><font class="font-4">

              <?=$member['usercode']?>

              </font></td>

          </tr>

          <tr>

            <td><font class="font-3">Username</font></td>

            <td>:</td>

            <td><font class="font-4">

              <?=$member['username']?>

              </font></td>

          </tr>

          <tr>

            <td><font class="font-3">Email Id</font></td>

            <td>:</td>

            <td><font class="font-4">

              <?=$member['emailid']?>

              </font></td>

          </tr>

        

          <tr>

            <td><font class="font-3">Ref. Name</font></td>

            <td>:</td>

            <td><font class="font-4"> <a href="<?=file_path('admin')?>member_profile/view/<?=$ref['ref_usercode']?>">

              <?=$ref['fname']?>

              <?=$ref['lname']?>

              </a> </font></td>

          </tr>

          <tr>

            <td><font class="font-3">Ref. Code</font></td>

            <td>:</td>

            <td><font class="font-4">

              <?=$ref['usercode']?>

              </font></td>

          </tr>

          <tr>

            <td><font class="font-3">Ref. Usercode</font></td>

            <td>:</td>

            <td><font class="font-4">

              <?=$ref['username']?>

              </font></td>

          </tr>

          <?php /*?><tr>

            <td><font class="font-3">Wallet Balance (VITAE)</font></td>

            <td>:</td>

            <td><font class="font-4">

              <?=$getBalance?>

              </font></td>

          </tr><?php */?>

          <tr>

            <td colspan="3">

			
              <a class="link-1" href="<?=file_path('admin')?>dashboard/profile_edit/<?=$member['usercode']?>">

              <button type="button" class="btn btn-primary btn_c1 btn-block">Edit Member Profile</button>

              </a> <br />

           </td>

          </tr>

        </table>

      </div>

      

      <!--===================================================--> 

      <!--End Block Styled Form --> 

      

    </div>

  </div>

  

</div>



<?php } ?>




<style>

table.dataTable > tbody > tr.child span.dtr-title {

	min-width: 130px!important;

}

</style>

