<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_Lang extends CI_Lang {

	function line($line)
	{
        if(parent::line($line) === FALSE)
            return $line;
        
        return parent::line($line);
    }	

}

