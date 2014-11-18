<?php
define('TYPE','binary'); //possible values: binary,path
$s = curl_init(); 
curl_setopt($s,CURLOPT_URL,'http://localhost/index.php?type='.TYPE); 
curl_setopt($s,CURLOPT_RETURNTRANSFER,true); 
curl_setopt($s,CURLOPT_POST,true); 
curl_setopt($s,CURLOPT_POSTFIELDS,array(
                                    'file'=>'@'.realpath(dirname(__FILE__).DIRECTORY_SEPARATOR.'example.pdf'),
                                    'name' => 'Aaron Lozier',
                                    'email' => 'aaron@informationarchitech.com',
                                    'checkbox 1' => 'Yes',
                                    'checkbox 2' => 0,
                                    'radio 1' => 2,
                                    ));
$resp = (curl_exec($s));
$binary = $resp;
curl_close($s); 

switch(TYPE){
    case 'path':
        echo '<a href="'.$binary.'" target="_blank">'.$binary.'</a>';
        break;
    default:
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="pdf_'.time().'.pdf"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        echo $binary;    
        break;
}