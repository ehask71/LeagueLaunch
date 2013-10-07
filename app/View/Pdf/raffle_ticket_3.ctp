<?php

App::import('Vendor', 'xtcpdf');
$pdf = new XTCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
$pdf->SetMargins(20, 5, 20);
$pdf->AddPage();
$html = '
<table border="1" cellspacing="0" cellpadding="0" width="650px">
    <tr>
        <td>
	    BuddyBall.Org Fall Raffle<br><br>
	    Ticket #:<b>'.$ticket.'</b><br>
	    Purchased By:'.$purchaser.'<br>
	</td>
	<td width="25%" height="150px"></td>
    </tr>
    <tr>
	<td colspan="2" align="center" height="70px">
	    <b>AD SPACE 1</b>
	</td>
    </tr>
    <tr>
	<td colspan="2" align="center">
	<table cellspacing="1" cellpadding="1" width="98%">
	<tr>
        <td align="center" bgcolor="#FFFF00" height="500px">
	    <b>Ad Space 2</b>
	</td>
        <td bgcolor="#cccccc" align="center">
	    <b>Ad Space 3</b>
	</td>
	</tr>
	</table>
	</td>
    </tr>
</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');
// set style for barcode
$style = array(
    'border' => 2,
    'vpadding' => 'auto',
    'hpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);
$pdf->write2DBarcode('http://buddyball.org', 'QRCODE,H', 150, 10, 50, 50, $style, 'N');
//$pdf->Text(20, 205, 'QRCODE H');

$pdf->lastPage();
echo $pdf->Output(APP . WEBROOT_DIR . '/content/'.Configure::read('Settings.site_id').'/pdf' . DS . 'test.pdf', 'F');
?>