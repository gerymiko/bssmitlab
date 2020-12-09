<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_karir_sms extends CI_Model {

		private $sms;

		function __construct(){
	        parent::__construct();
	        $this->sms = $this->load->database('sendsms', TRUE);
	        $this->load->database();
	    }

	   	function sendsms($content){
			$this->sms->insert('TSMSSend', $content);
			return ($this->sms->affected_rows() != 1 ) ? false:true;
		}
	}
?>