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
$pdf->setFooterData(array(0,64,0), array(0,64,128));
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//$pdf->setPrintFooter(false);
$pdf->AddPage();
$html = '
<table cellspacing="0" cellpadding="0" width="675px" align="center">
    <tr>
        <td align="left">
	    BuddyBall.Org Fall Raffle<br><br>
            Purchased By: <b>'.$purchaser.'</b><br>
            Generated: '.date('Y-m-d H:m:i').'<br>
	    Ticket #: <b>'.$ticket.'</b><br>
	</td>
	<td width="25%" height="150px"></td>
    </tr>
    <tr>
	<td colspan="2" align="center" height="70px">
	    <!--<b>AD SPACE 1</b>-->
	</td>
    </tr>
    <tr>
	<td colspan="2" align="center" cellpadding="1">
	<table cellspacing="2" cellpadding="1">
	<tr>
        <td align="center" height="450px">
	    <!--<b>Ad Space 2</b>-->
	</td>
        <td align="center">
	    <!--<b>Ad Space 3</b>-->
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
    'position' => '',
    'align' => 'C',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => true,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255),
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 8,
    'stretchtext' => 4
);
$pdf->write1DBarcode($ticket, 'C128', 18, 58, '', 18, 0.4, $style, 'N');
$pdf->write2DBarcode('http://buddyball.org', 'QRCODE,H', 138, 27, 50, 50, $style, 'N');
// set JPEG quality
$pdf->setJPEGQuality(75);
// Ad Space 1
$pdf->Image(APP . WEBROOT_DIR . '/content/'.Configure::read('Settings.site_id').'/pdf/images/HO728x90.jpg', 15, 85, 180, 25, 'JPG', 'http://www.highoctanebrands.com', '', true, 150, '', false, false, 1, false, false, false);
// Ad Space 2
$pdf->Image(APP . WEBROOT_DIR . '/content/'.Configure::read('Settings.site_id').'/pdf/images/Ad300x250_1.jpg', 15, 115, 88, 65, 'JPG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);
// Ad Space 3
$pdf->Image(APP . WEBROOT_DIR . '/content/'.Configure::read('Settings.site_id').'/pdf/images/Ad300x250_2.jpg', 107, 115, 88, 65, 'JPG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);
// Ad Space 4
$pdf->Image(APP . WEBROOT_DIR . '/content/'.Configure::read('Settings.site_id').'/pdf/images/Ad300x250_1.jpg', 15, 183, 88, 65, 'JPG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);
// Ad Space 5
$pdf->Image(APP . WEBROOT_DIR . '/content/'.Configure::read('Settings.site_id').'/pdf/images/Ad300x250_2.jpg', 107, 183, 88, 65, 'JPG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);


$pdf->lastPage();
echo $pdf->Output(APP . WEBROOT_DIR . '/content/'.Configure::read('Settings.site_id').'/pdf' . DS . 'test.pdf', 'F');
?>