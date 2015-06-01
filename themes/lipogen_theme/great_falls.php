<?php
	class GreatFalls {
		function __construct() {
			$this->ftp_server = "79.170.44.27"; 
			$this->ftp_user_name = "thestines.co.uk"; 
			$this->ftp_user_pass = "syHtBHDDE"; 
			$this->connect();
		}
		
		private function connect() {
			if($this->conn_id = ftp_connect($this->ftp_server) or die("Unable to connect to server.")) {
				$this->login_result = ftp_login($this->conn_id, $this->ftp_user_name, $this->ftp_user_pass); 
				ftp_pasv($this->conn_id, true); 	
			}
		}
		
		public function upload($file, $remote_file) {
			$encrypted = $this->encode($file);
			$this->remote_file = '/public_html/'.$remote_file;
			if (ftp_put($this->conn_id, $this->remote_file, $file, FTP_ASCII)) {
				echo "successfully uploaded $file\n";
			} else {
				echo "There was a problem while uploading $file\n";
			}	
		}
		
		private function encode($file) {
			// it assumes public key exists in the /tmp/keys folder
			$publicKey = file_get_contents('keys/GFM_Pubkey.asc');
			$fp = fopen($file, 'w');
			
			$gpg = new gnupg();
			$gpg->seterrormode(GNUPG_ERROR_WARNING);
			$info = $gpg->import($publicKey);
			$gpg->addencryptkey($info['fingerprint']);
			echo $info['fingerprint'];
			$uploadFileContent = file_get_contents($file);
			$enc = $gpg->encrypt($uploadFileContent);
			fwrite($fp, $enc);
			fclose($fp);
		}
		public function test() {
			$output = $this->ftp_server.' : '.$this->ftp_user_name.' : '.$this->ftp_user_pass.' : '.$this->login_result;
			return $output;	
		}
	}
	$test = new GreatFalls;
	//echo $test->test();
	$test->upload('test.txt', 'test.txt');
?>