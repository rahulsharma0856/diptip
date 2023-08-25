<?php $this->load->view('user/profile/top_section');?>


<div class="container">
	<div class="row">

		<!-- Main Content -->

		<div class="col-xl-9 push-xl-3 col-lg-12 push-lg-0 col-md-12 col-sm-12 col-xs-12">
        
        
            
				<div class="ui-block">
        <div class="ui-block-title">
          <h6 class="title">Personal Info</h6>
          
          
        </div>
         	
        <div class="ui-block-content">
          <div class="row">
         
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
              <ul class="widget w-personal-info item-block">
                <li> <span class="title">About Me:</span> <span class="text"><?=filter_message(member['about_desc'])?></span> </li>
             <li> <span class="title">Joined:</span> <span class="text"><?=date('M d, Y',strtotime($member['create_date']))?></span> </li> 
              
              
              </ul>
            </div>
            
          </div>
        </div>
      </div>

			
		</div>

		<!-- ... end Main Content -->



		<?php $this->load->view('user/profile/bar_left2');?>





	</div>
</div>




