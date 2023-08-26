<?php
Class Share_link_module extends App_model{
	
	
	function get_info_api($url = NULL)
	{
		
		$target = urlencode($url);
		
		$key = "5c35bc50c142f070349261f23248ee28a2fd0978252b5";
		
		$ret = file_get_contents("http://api.linkpreview.net?key={$key}&q={$target}");
		
		$url_desc =json_decode($ret,true);
		
		
		
		$item_parts                 = 		array();
		
		$item_parts['description']  = 		$url_desc['description'];
		
		$item_parts['image']  		= 		$url_desc['image'];
		
		if($item_parts['image']==""){
			
			$item_parts['image'] = base_url('upload/default/default_b.png');
			
		}
		
		$item_parts['title'] 		= 		$url_desc['title'];
		
		$item_parts['host']			=	 	$this->url_to_domain($url);
		
		if(!isset($item_parts['title'])){
			
			$item_parts['title'] = $url;	
			
		}
		
		return $item_parts;
	}
	function get_info($url = NULL){
	
		require_once APPPATH .'third_party/simple_html_dom.php';
		
        $agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
		
        $ch    = curl_init();
		
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		
        curl_setopt($ch, CURLOPT_URL, $url);
		
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
        //curl_setopt($ch, CURLOPT_USERAGENT, $agent); 
		
        $output = curl_exec($ch);
		
        $debug  = curl_getinfo($ch);
		
        curl_close($ch);
		
        //try on https if response status is Object Moved
		
        if ($debug['http_code'] == 302) {
			
            $url = str_replace("http://", "https://", $url);
			
            $ch  = curl_init();
			
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			
            curl_setopt($ch, CURLOPT_URL, $url);
			
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			
            curl_setopt($ch, CURLOPT_USERAGENT, $agent);
			
            $output = curl_exec($ch);
			
            $debug  = curl_getinfo($ch);
			
            curl_close($ch);
			
        }
		
	
        $html           			= 		str_get_html($output);
		
		$item_parts                 = 		array();
		
		$item_parts['description']  = 		$this->find_description($html);
		
		$item_parts['image']  		= 		$this->find_image($html,$output);
		
		if($item_parts['image']==""){
			
			$item_parts['image'] = base_url('upload/default/default_b.png');
			
		}
		
		$item_parts['title'] 		= 		$this->get_title($html);
		
		$item_parts['host']			=	 	$this->url_to_domain($url);
		
		if(!isset($item_parts['title'])){
			
			$item_parts['title'] = $url;	
			
		}
		
		return $item_parts;
	
	}
	
	function find_description($html=NULL){
			
			$arr = array('meta[name=description]','meta[property=og:description]','meta[name=twitter:description]');
			
			for($i=0;$i<count($arr);$i++){
			
				$obj = $html->find($arr[$i],false);
				
				if($obj != NULL){
				
					return $obj->attr['content'];
			
				}
			
			}
			
			return false;
			
		}
		
		function find_image($html=NULL, $output=NULL){
			
			$arr = array('meta[property=og:image]','meta[property=og:image:src]','meta[name=twitter:image]','meta[twitter:image:src]');
			
			
			$img_url = "";
			
			for($i=0;$i<count($arr);$i++){
			
				$obj = $html->find($arr[$i],false);
				
				if($obj != NULL){
				
					$img_url =  $obj->attr['content'];
			
				}
			
			}
			
			
			if($img_url == ""){
			
				////
			
				$img_pattern = '/<img[^>]*'.'src=[\"|\'](.*)[\"|\']/Ui';
				
				$images = '';
				
				preg_match_all($img_pattern,$output,$images,PREG_PATTERN_ORDER);
				
				$total_images = count($images[1]);
				
				if( $total_images > 0 )
				
					$images = $images[1];
				
				for($i=0; $i<$total_images; $i++){
				
					if(getimagesize($images[$i])){
					
						list($width,$height,$type,$attr) = getimagesize($images[$i]);
						
							if( $width > 350 ){
							
								$img_url = $images[$i];
								
								break;
							
							}
					
					}
				
				}
				
				////
				
			}
			
			return $img_url;
			
		}
		
		
		function get_title($html = NULL){
			
			$title = "";
			
			foreach ($html->find('head') as $element1) {
				
				foreach ($element1->find('title') as $element) {
					
					$title    = trim(strip_tags($element));
					
				}
			}
			
			
			if($title==""){
				
				$arr = array('meta[property=og:description]','meta[property=twitter:description]');
				
				for($i=0;$i<count($arr);$i++){
				
					$obj = $html->find($arr[$i],false);
					
					if($obj != NULL){
					
						$title =  $obj->attr['content'];
					
					}
				
				}
				
			}
		
			
			
			return $title;
		
		}
		
		
	function url_to_domain($url = NULL){
		
			$host = @parse_url($url, PHP_URL_HOST);
			
	
			if (!$host)
			
			$host = $url;
			
			
			
			if (substr($host, 0, 4) == "www.")
			
				$host = substr($host, 4);
			
			
			if (strlen($host) > 50)
			
				$host = substr($host, 0, 47) . '...';
			
			return $host;
	
	}
	
	
}
?>
