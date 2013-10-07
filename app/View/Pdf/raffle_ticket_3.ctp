<?php

App::import('Vendor', 'xtcpdf');
$pdf = new XTCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);
$pdf->AddPage();
$html = '<h1>hello world</h1>';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->lastPage();
echo $pdf->Output(APP . WEBROOT_DIR . '/content/'.Configure::read('Settings.site_id').'/pdf' . DS . 'test.pdf', 'F');
?>