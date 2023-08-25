
<style>

h3{

		color: #337ab7!important;

	}

</style>

<script type="text/javascript" nonce=<?=SC_NONCE?>>

$(document).ready(function(e) {

		$('#demo-dt-basic').dataTable( {

		"responsive": true,

		"language": {

		"paginate": {

		"previous": '<i class="demo-psi-arrow-left"></i>',

		"next": '<i class="demo-psi-arrow-right"></i>'

		}

		}

		}); 

		

			$('#demo-dt-basic2').dataTable( {

		"responsive": true,

		"language": {

		"paginate": {

		"previous": '<i class="demo-psi-arrow-left"></i>',

		"next": '<i class="demo-psi-arrow-right"></i>'

		}

		}

		});  

});	



</script>



<div class="row">

  <div class="col-md-6">

    <div class="panel">

      <div class="panel-body">

        <h3>Login Details</h3>

        <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">

          <thead>

            <tr>

              <th>id</th>

              <th>Name</th>

              <th>Username</th>

              <th>Date</th>

              <th>IP</th>

              <?php /*?> <th>Browser Details</th><?php */?>

              <!-- <th>#</th>--> 

            </tr>

          </thead>

          <tbody>

            <?php 

				$no=1;

				for($i=0;$i<count($result12);$i++){ 

				

				?>

            <tr>

              <td><?=$no++;?></td>

              <td><?=$result[$i]['fname']?>

                <?=$result[$i]['lname']?></td>

              <td><?=$result[$i]['username']?></td>

              <td><?=date('d-m-Y H:i:a',strtotime($result[$i]['timedt']))?></td>

              <td><?=$result[$i]['ip']?></td>

              <?php /*?>  <td><?=$result[$i]['browserdt']?></td><?php */?>

              <!--<td><a href="#"><i class="fa fa-eye"></i></a></td>--> 

            </tr>

            <?php } ?>

          </tbody>

        </table>

      </div>

    </div>

  </div>

  <div class="col-md-6">

    <div class="panel">

      <div class="panel-body">

        <h3>New Joining Member</h3>

        <table id="demo-dt-basic2" class="table table-striped table-bordered" cellspacing="0" width="100%">

          <thead>

            <tr>

              <th>Usercode</th>

              <th>Name</th>

              <th>Username</th>

              <th>Join Date</th>

            </tr>

          </thead>

          <tbody>

            <?php 

                           

                            for($i=0;$i<count($result1);$i++){ 

                            

                            ?>

            <tr>

              <td><?=$result1[$i]['usercode']?></td>

              <td><?=$result1[$i]['fname']?>

                <?=$result1[$i]['lname']?></td>

              <td><?=$result1[$i]['username']?></td>

              <td><?=date('d-m-Y',strtotime($result1[$i]['create_date']))?></td>

            </tr>

            <?php } ?>

          </tbody>

        </table>

      </div>

    </div>

  </div>

</div>

