<?php
use mikehaertl\pdftk\Pdf;

/**
 * Information ArchiTECH, LLC
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to contact@informationarchitech.com so we can send you a copy immediately.
 *
 *
 * @copyright  Copyright (c) 2013 Information ArchiTECH, LLC (http://www.informationarchitech.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author     Information ArchiTECH <contact@informationarchitech.com>
 */

if(!isset($_FILES['file'])){
   die('File upload is required');
}

$filled_path = dirname(__FILE__).DIRECTORY_SEPARATOR.'tmp'.DIRECTORY_SEPARATOR;

$filename = md5(time().'_'.rand(10000,99999)).'.pdf';

require_once('vendor/autoload.php');

// Fill form with data array
try{
    $pdf = new Pdf($_FILES['file']['tmp_name']);
    $pdf->fillForm($_POST)
    ->needAppearances()
    ->saveAs($filled_path.$filename);
} catch(\Exception $e){
    die('Exception: '.$e->getMessage());
}

$type = (isset($_GET['type'])) ? $_GET['type'] : 'binary';
switch($type){
    case 'path':
        echo 'tmp/'.$filename;
        break;
    default:
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="'.$filename.'"');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($filled_path.$filename));
        header('Accept-Ranges: bytes');
        @readfile($filled_path.$filename);
        break;
}
