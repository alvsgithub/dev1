<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function pdf_create($html, $filename='', $stream=TRUE, $orientation = 'potrait')
{ 
    require_once("dompdf/dompdf_config.inc.php");
    set_time_limit(0);
    $dompdf = new DOMPDF();
    $dompdf->set_paper('A4', $orientation);
    $dompdf->load_html($html);
    $dompdf->render();
    $options['Attachment'] = 0;
    $dompdf->stream($filename.".pdf", $options);
}