<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_model extends CI_Model {

	public function __construct() {

		parent::__construct();
		
		$this->load->library('email');
		$this->load->model('Member_module', 'Member_module');	
	
	}
	
	
	
	
	
	public function send_email2($recepient, $subject, $body, $footer_text){
		
	
		echo $email_body = $this->email_body(array('body'=>$body,'subject'=>$subject,'footer_text'=>$footer_text));
		
		exit;
		
	}
	
	public function send_email($recepient, $subject, $body, $footer_text){
		
	
		$email_body = $this->email_body(array('body'=>$body,'subject'=>$subject,'footer_text'=>$footer_text));
	
	
	
		$this->email->to($recepient);
		
    	$this->email->from('phoenix8155@gmail.com');
		
    	$this->email->subject($subject);
		
    	$this->email->message($email_body);
    	$p = $this->email->send();
		
		
	
		 
		//return true;
		
	
			
		// $headers   = array();

  //       $headers[] = 'MIME-Version: 1.0';

  //       $headers[] = 'Content-Type: text/html; charset="UTF-8";';

  //       $headers[] = 'From: Coinxion <mayurlimbasiya46@gmail.com>';

  //      $p =  mail($recepient, strip_tags($subject), $email_body, implode("\r\n", $headers));
		
				
		return true;
		
		
		
		
		// require dirname(__FILE__).'/../libraries/phpmailer/PHPMailerAutoload.php';
		
		// $mail = new PHPMailer;
		
		// $mail->isSMTP();
		
		// $mail->SMTPDebug = 0;
		
		// $mail->Host = 'smtp.mandrillapp.com'; //smtp server
		
		// $mail->Port = 587; //smtp host
		
		// $mail->SMTPSecure = 'tls';
		
		// $mail->SMTPAuth = true;
		
		// $mail->Username = ""; //smtp username
		
		
		// $mail->Password = ""; //smtp password
		
		// $mail->setFrom('info@globalgcch.com', 'SocialMediaReward');
		
		// $mail->addAddress($recepient, '');
		
		// $mail->Subject = $subject;
		
		// $mail->msgHTML($email_body);
		
		// if (!$mail->send()) {
			
		// 	echo "Mailer Error: " . $mail->ErrorInfo;
			
		// } else {
			
		// 	echo "Message sent!";
			
		// }
	
	}
	
	
	
	
	
	
	function email_body($arr){
		
		
		
		$email_text= $this->get_header();
		
		
		$email_text.=$this->get_body($arr);
		
		
		$email_text.= $this->get_footer($arr['footer_text']);
		
		
		return $email_text;
		
	}
	
	function get_body($arr){
		
			$html='';
			
			$html.='   <tr>
			
			<td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; color:#525252;"><div style="color:#3482ad; font-size:19px;"> <span style="border-bottom: 1px dotted rgb(96, 177, 224);padding-bottom:5px;">'.$arr['subject'].'</span> </div>
			
			<br>
			
			<p style="min-height:200px;line-height:25px;font-size:15px;">'.$arr['body'].'
			
			<p> <br>
			
			<br>
			
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			
			<tr>
			
			<td width="10%"><b><img src="'.base_url('asset/').'img/facebook.gif" alt="" width="24" height="23"></b></td>
			
			<td width="90%" style="font-size:11px; color:#525252; font-family:Arial, Helvetica, sans-serif;"><b>Facebook   Like Us on <br>
			
			Support: socialmediareward@gmail.com</b></td>
			
			</tr>
			
			</table></td>
			
			</tr>';
			
			return $html;
	}
	
	function get_header(){
		
				$html='<body marginwidth="0px" topmargin="0px">
				
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				
				<tr>
				
				<td align="center" valign="top" style="background-color:#53636e;" bgcolor="#53636e;"><br>
				
				<br>
				
				<table width="583" border="0" cellspacing="0" cellpadding="0">
				
				
				
				<tr>
				
				<td align="left" valign="top" bgcolor="#FFFFFF" style="background-color:#FFFFFF;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
				
				<tr>
				
				<td width="35" align="left" valign="top">&nbsp;</td>
				
				<td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
				
				<tr>
				
				<td align="center" valign="top"><br><br>
				
				<div style="color:#245da5; font-family:Times New Roman, Times, serif; font-size:33px;">Social Media Reward</div>
				
				<div style="font-family: Verdana, Geneva, sans-serif; color:#898989; font-size:12px;">&nbsp;</div></td>
				
				</tr>';
				
				return $html;
	}
	
	function get_footer($footer_text){
			
			
				$html='  
				
				<tr>
				
				<td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#525252;">&nbsp;</td>
				
				</tr>
				
				</table></td>
				
				<td width="35" align="left" valign="top">&nbsp;</td>
				
				</tr>
				
				</table></td>
				
				</tr>
				
				<tr>
				
				<td align="left" valign="top" bgcolor="#3d90bd" style="background-color:#3d90bd;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
				
				<tr>
				
				<td width="35">&nbsp;</td>
				
				<td height="50" valign="middle" style="color:#FFFFFF; font-size:11px; font-family:Arial, Helvetica, sans-serif;"><b>Web:</b><br>
				
				<a href="http://phoenixdepo.com/SocialMediaReward/" style="color:#FFF;">http://phoenixdepo.com/SocialMediaReward/</a></td>
				
				<td width="35">&nbsp;</td>
				
				</tr>
				
				</table></td>
				
				</tr>
				
				</table>
				
				<br>
				
				<br></td>
				
				</tr>
				
				</table>
				
				</body>';
			
		return $html;
	
	}
	
	
	
		
		
		
		
		function login_notification($member_id){
			
				
				$member = $this->Member_module->get_member_by_id($member_id);
				
				//Body Update//
				
				$payment_option				=	$this->comman_fun->get_table_data('payment_option',array('id'=>$_POST['option_code']));
				
				
				$verification_code 	=	rand(1111,9999);
				
	
				$body 		= 	'Hello '.$member['fname'].' '.$member['lname'].' <br><br>
				
				A login attempt was made to your SocialMediaReward account. Please confirm the following details are correct.<br><br>
				
				IP : '.$_SERVER['REMOTE_ADDR'].'<br><br>
				
				Use agent : '.$_SERVER['HTTP_USER_AGENT'].'<br><br>
				
				Social Media Reward Admin';
				
				
				//Subject Update//
				
				
				$subject 	= 	'SocialMediaReward Login';
				
			
				$this->send_email($member['emailid'],$subject,$body,'1');
				
		}
		
		
		
		function twofa_email($member_id){
			
			$member 				= $this->Member_module->get_member_by_id($member_id);
			
			$verification_code 		=	rand(1111,9999);
			
			$body					=	'HI, '.$member['fname'].' '.$member['lname'].' <br><br> 2FA Verification Code: '.$verification_code.'<br>';
			
			$subject 	= 	'2FA Verification';
			
			$this->send_email($member['emailid'],$subject,$body,'1');
			
			return $verification_code;
		
		}
		
		
		
		function forgot_password($member_id){
			
				
				$member = $this->Member_module->get_member_by_id($member_id);
				
				//Body Update//
				
			
				
				
				$verification_code 	=	rand(1111,9999);
				
	
		
			
				$body='Hi '.$member['fname'].' '.$member['lname'].'<br><br>
				
				Username:'.$member['username'].'<br>
				
				Password:'.$member['password'].'<br>
				
				Login : <a href="'.file_path().'login/">Click Hear To Login</a><br>
				
				Social Media Reward Admin';
				
				
				//Subject Update//
				
				
				$subject 	= 	'SMR Forgot Password';
				
			
				$this->send_email($member['emailid'],$subject,$body,'1');
				
		}
		
		function send_email_free($emailid,$subject,$body){
		
			$this->send_email($emailid,$subject,$body,'1');	
		
		}
		
		
		function registration_email($member_id){
			
			$member = $this->Member_module->get_member_by_id($member_id);
			
			$verification_code 	=	$this->insert_verification($member_id,$member['emailid']);
			
			$body='Hi '.$member['fname'].' '.$member['lname'].'<br><br>
			
			You are successfully registered <br><br>
			
			Email Varification : <a href="'.file_path().'Email_verification/verify/'.$verification_code.'">Click Here To Verify Email</a><br><br>
			
			SocialMediaReward Admin';
			
			
			
		
			//Subject Update//
			
			
			$subject 	= 	'Registration Successfully';
			
			
			$this->send_email($member['emailid'],$subject,$body,'1');
		
		
		}
		
	
		
		function send_email_varification($member_id){
			
				$member = $this->Member_module->get_member_by_id($member_id);
				
				$verification_code 	=	$this->insert_verification($member_id,$member['emailid']);
				
				
				
				$body='Hi '.$member['fname'].' '.$member['lname'].'<br><br>
				
				Email Varification : <a href="'.file_path().'Email_verification/verify/'.$verification_code.'">Click Hear To Varify Email</a><br><br>
				
				SocialMediaReward Admin';
				
				$subject 	= 	'Email Varification';
				
		
				$this->send_email($member['emailid'],$subject,$body,'1');
				
		}
		
		
		function after_varification_email_verify($member_id){
		
				$member = $this->Member_module->get_member_by_id($member_id);
				
				
				$body='Hi. '.$member['fname'].' '.$member['lname'].'<br><br>
				
				Thank you for email verification,<br>
				
				Welcome to Global Coin Community Help.<br>
				
				Your Acccount is now Active and you can login to your Back office. <br><br>
				
				SocialMediaReward Admin';
				
				
				$subject 	= 	'Email Verification Successfully';
				
				
				$this->send_email($member['emailid'],$subject,$body,'1');
				
					
		}
		
		
		
	
		
		
		
		
		function test_email(){
			
		
				$text='test Emial';
				
				//Subject Update//
				
				
				$subject 	= 	'GCC';
				
				
				$this->send_email('jitendra8155@gmail.com',$subject,$body,'1');
				
		}
		
		
		protected function insert_verification($member_id,$emailid){
		
			$randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
			
			$randomNumber = time();
			
			$v_key		  =	$randomNumber.$randomString;
			
			$data['usercode']		=	$member_id; 
			
			$data['emailid']		=	$emailid; 
			
			$data['v_key']			=	$v_key;  
			
			$data['send_date']		=	date('Y-m-d H:i:s'); 
			
			$data['send_ip']		=	$_SERVER['REMOTE_ADDR']; 
			
			$data['status']			=	'N'; 
			
			$this->comman_fun->addItem($data,'email_verification');
			
			return	$v_key; 
		} 
		
		
		
		function replace_member_text($html,$result){
				
				$ref 		= 	$this->Member_module->get_member_by_id($result['referralid']);
				
				$rep_arr=array();
				
				$rep_arr['{first-name}']		 = 		$result['first_name'];
								
				$rep_arr['{last-name}']		 	 = 		$result['last_name'];
				
				$rep_arr['{email-id}']   		 = 		$result['email'];
				
				$rep_arr['{username}']   		 = 		$result['username'];
				
				$rep_arr['{member-first-name}']  = 		$result['first_name'];
				
				$rep_arr['{member-last-name}']   = 		$result['last_name'];
				
				$rep_arr['{member-email-id}']    = 		$result['email'];
				
				$rep_arr['{login-link}']  		 = 		'<a href="'.base_url().'">Login</a>';
				
				$rep_arr['{referral-link}']  		 = 	'<a href="'.base_url('/'.$result['id'].'').'">'.base_url('/'.$result['id'].'').'</a>';
				
				
				
				$rep_arr['{first-name}']		 = 		$result['fname'];
				
				$rep_arr['{last-name}']		 	 = 		$result['lname'];
				
				$rep_arr['{sponsor-fname}'] 	 =	 	$ref['lname'];
				
				$rep_arr['{sponsor-lname}'] 	 = 		$ref['ref_lname'];
				
				$rep_arr['{sponsor-username}']   = 		$ref['username'];
				
				$rep_arr['{sponsor-email}']      = 		$ref['email'];
				
				
				$rep_arr['{registration-link}']  = '<a href="'.base_url().'registration/view/'.$result['username'].'">Join Now</a>';
				
				$rep_arr['{join-link}']  = 		'<a href="'.base_url().'registration/view/'.$result['username'].'">Join Now</a>';
				
			
				$find       = array_keys($rep_arr);
				
				$replace    = array_values($rep_arr);
				
				$new_string = str_ireplace($find, $replace, $html);
				
				return $new_string;	
			
		}
		
		
		function replace_verify_verify_link($html,$result){
			
				$rep_arr=array();
				
				$code = $this->Member_model->verify_account_insert($result['id']);
				
				$reset_link = "".base_url()."home/verify_account/" . $code;
				
				$rep_arr['{verify-link}']    	 = 		$reset_link;
				$find       = array_keys($rep_arr);
				
				$replace    = array_values($rep_arr);
				
				$new_string = str_ireplace($find, $replace, $html);
				
				return $new_string;	
			
		}
		
	function email_preview($data){
			
	
			return $email_body = $this->Email_model->email_body(array('body'=>$data['msg'],'subject'=>$data['subject']));
			
	}
		
	function email_contain_replace($email_text,$result){
		
		$rep_arr=array();
		
		$rep_arr['{first-name}']		 = 		$result['fname'];
		
		$rep_arr['{last-name}']		 	 = 		$result['lname'];
		
		$rep_arr['{sponsor-fname}'] 	 =	 	$result['ref_fname'];
		
		$rep_arr['{sponsor-lname}'] 	 = 		$result['ref_lname'];
		
		$rep_arr['{sponsor-username}']   = 		$result['ref_username'];
		
		$rep_arr['{sponsor-email}']      = 		$result['ref_emailid'];
		
		$rep_arr['{skype-id}']      	 = 		$result['ref_skype'];
		
		$rep_arr['{sponsor-city}']       = 		$result['ref_city'];
		
		$rep_arr['{sponsor-state}']      = 		$result['ref_state'];
		
		$rep_arr['{sponsor-country}']    = 		$result['ref_country'];
		
		$rep_arr['{registration-link}']  = '<a href="'.base_url().'registration/view/'.$result['ref_username'].'">Join Now</a>';
		
		$rep_arr['{join-link}']  = 		'<a href="'.base_url().'registration/view/'.$result['ref_username'].'">Join Now</a>';
		
		$find       = array_keys($rep_arr);
		
		$replace    = array_values($rep_arr);
		
		$new_string = str_ireplace($find, $replace, $email_text);
		
		return $new_string;	
		
	}	
		
	
		
		
	
		
	
		
		
		
		
		
		
		
		
		
		
		
		


}