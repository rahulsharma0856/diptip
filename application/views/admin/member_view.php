<style>

h3{

		color: #259076!important;

	}

</style>

<script type="text/javascript" nonce=<?=SC_NONCE?>>



$(document).ready(function(e) {

	

		$('#demo-dt-basic').dataTable( {

			

			"responsive": true,

			

			"bProcessing": true,

			

			"bServerSide": true,

			

			"bSort": true,

			

			"sAjaxSource": "<?=file_path('admin/member/listing')?>",

			

			"order": [[ 1, "desc" ]], // start from 0 index

			

			"language": {

				

				"paginate": {

					

					"previous": '<i class="demo-psi-arrow-left"></i>',

					

					"next": '<i class="demo-psi-arrow-right"></i>'

				

				}

				

			}

		

		});  



});	



</script>



<div class="panel">

  <div class="panel-body">

    <h3>Member</h3>

   

    <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">

            <thead>

              <tr>

                <th>Usercode</th>

                <th>Name</th>

                <th>Username</th>

                <th>Email Id</th>

                <th>Join Date</th>

                <th>#</th>

              </tr>

            </thead>

            <tbody>
			</tbody>

    </table>

   

   

  </div>

</div>



