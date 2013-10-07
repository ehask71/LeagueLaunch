<?php

App::import('Vendor', 'xtcpdf');
$pdf = new XTCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
$pdf->SetMargins(PDF_MARGIN_LEFT, 25, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetCreator('LeagueLaunch.com');
$pdf->SetAuthor('LeagueLaunch.com');
$pdf->SetTitle('BuddyBall.Org Fall Raffle');
$pdf->SetSubject('Fall Raffle');
$pdf->setHeaderData('logo-medium.png', 30, '', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setPrintFooter(false);
$pdf->AddPage();
$html = '
<table border="1" cellspacing="0" cellpadding="0" width="675px" align="center">
    <tr>
        <td align="left">
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
	<td colspan="2" align="center" cellpadding="1">
	<table cellspacing="2" cellpadding="1">
	<tr>
        <td align="center" bgcolor="#FFFF00" height="450px">
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
$pdf->write1DBarcode($ticket, 'C128', 18, 58);
$pdf->write2DBarcode('http://buddyball.org', 'QRCODE,H', 138, 27, 50, 50, $style, 'N');
//$pdf->Text(20, 205, 'QRCODE H');

$pdf->lastPage();
echo $pdf->Output(APP . WEBROOT_DIR . '/content/'.Configure::read('Settings.site_id').'/pdf' . DS . 'test.pdf', 'F');
?>