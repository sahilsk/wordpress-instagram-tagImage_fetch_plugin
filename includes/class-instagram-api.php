<?php


	class Instagram_API {

		private $credentials = nil;
		private $url = 'https://api.instagram.com/v1/tags/%s/media/recent?client_id=%s';
		private $result = ["dfd","dfd"];

		public function __construct($tag,  $user){
			$credentials = get_option( 'instagram_feed_sk_option_name' );
			$this->url = sprintf( $this->url, $tag, $credentials['insta_apiKey'] );
		}

		public function getImages($cache=true){

			if( !empty($this->result) && $cache ){
				return $this->result;
			}
			$request = wp_remote_get($this->url);
			$response = wp_remote_retrieve_body( $request );
			
			// Decode the json
			try{
				$output = json_decode( $response ); 
			}catch( Exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			return $output;
		}



	}