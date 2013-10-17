<?php

/**
 * CakePHP FundraisingController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class FundraisingController extends AppController {

    public $name = 'Fundraising';
    public $uses = array('Fundraiser', 'Raffleticket');
    public $helpers = array('Media.Media');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index');
    }

    public function index() {
        $fundraisers = $this->Fundraiser->find('all', array(
            'conditions' => array(
                'Fundraiser.site_id' => Configure::read('Settings.site_id'),
                'and' => array(
                    'Fundraiser.start_date <= NOW()',
                    'Fundraiser.end_date >= NOW()'
                ),
                'Fundraiser.is_active' => 'yes')
        ));

        $this->set('fundraisers', $fundraisers);
    }

    public function admin_index() {
        $fundraisers = $this->Fundraiser->find('all', array(
            'conditions' => array('Fundraiser.site_id' => Configure::read('Settings.site_id'))
        ));

        $this->set('fundraisers', $fundraisers);
    }

    public function admin_new() {
        if ($this->request->is('post')) {
            if ($this->Fundraiser->validateFundraiser()) {
                $this->request->data['Fundraiser']['site_id'] = Configure::read('Settings.site_id');
                if ($this->Fundraiser->save($this->request->data)) {
                    $this->Session->setFlash(__('New Fundraiser Added'), 'default', array('class' => 'alert succes_msg'));
                    $this->redirect('/admin/fundraising');
                }
            }
        }
    }

    public function admin_buyraffle($id) {
        $this->loadModel('Products');
        if ($this->request->is('post')) {
            if ($this->Raffleticket->validateBuyraffle()) {
                $product = $this->Products->getProductById($this->request->data['Raffle']['product_id']);
                if (is_array($product)) {
                    unset($this->request->data['Raffle']['product_id']);
                    $total = 0;
                    switch($product['Products']['id']){
                        case 12:
                            $total = 1;
                        case 13:
                            $total = 2;
                            break;
                        case 14:
                            $total = 10;
                            break;
                        case 15:
                            $total = 50;
                            break;
                    }

                    $purchaser = $this->request->data['Raffle']['firstname'] . ' ' . $this->request->data['Raffle']['lastname'];
                    $title = 'Buddyball-Harley Davidson Raffle';
                    $location = '"The Alley" hwy 301 and Big Bend';
                    $date = '2014-05-04';
                    
                    App::import('Vendor', 'xtcpdf');
                    $pdf = new XTCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
                    $pdf->SetMargins(PDF_MARGIN_LEFT, 25, PDF_MARGIN_RIGHT);
                    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
                    $pdf->SetCreator('LeagueLaunch.com');
                    $pdf->SetAuthor('LeagueLaunch.com');
                    $pdf->SetTitle('BuddyBall.Org Fall Raffle');
                    $pdf->SetSubject('Fall Raffle');
                    $pdf->setHeaderData('logo-medium.png', 30, '', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
                    $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
                    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
                    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
                    $pdf->SetFont('dejavusans', '', 10);
                    
                    for($i=0;$i<$total;$i++){
                        $pdf->AddPage();
                        $html = '
<table cellspacing="0" cellpadding="0" width="675px" align="center">
    <tr>
        <td align="left">
	    <font size="+2">'.$title.'</font><br>
            '.$date.' '.$location.'<br>
            Purchased By: <b>' . $purchaser . '</b><br>
            <small>Generated: ' . date('Y-m-d H:m:i') . '</small><br>
	    Ticket #: <b>' . $ticket . '</b><br>
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
                            'fgcolor' => array(0, 0, 0),
                            'bgcolor' => false, //array(255,255,255),
                            'text' => true,
                            'font' => 'helvetica',
                            'fontsize' => 8,
                            'stretchtext' => 4
                        );
                        $pdf->write1DBarcode($ticket, 'C128', 18, 58, '', 18, 0.4, $style, 'N');
                        //$pdf->write2DBarcode('http://buddyball.org', 'QRCODE,H', 138, 27, 50, 50, $style, 'N');
                        $pdf->Image(APP . WEBROOT_DIR . '/content/' . Configure::read('Settings.site_id') . '/pdf/images/logoforraffle.jpg', 138, 27, 50, 50, 'JPG', 'http://www.buddyball.org', '', true, 150, '', false, false, 1, false, false, false);
// set JPEG quality
                        $pdf->setJPEGQuality(75);
// Ad Space 1
                        $pdf->Image(APP . WEBROOT_DIR . '/content/' . Configure::read('Settings.site_id') . '/pdf/images/HO728x90.jpg', 15, 85, 180, 28, 'JPG', 'http://www.highoctanebrands.com', '', true, 150, '', false, false, 1, false, false, false);
// Ad Space 2
                        $pdf->Image(APP . WEBROOT_DIR . '/content/' . Configure::read('Settings.site_id') . '/pdf/images/Ad300x250_1.jpg', 15, 115, 88, 65, 'JPG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);
// Ad Space 3
                        $pdf->Image(APP . WEBROOT_DIR . '/content/' . Configure::read('Settings.site_id') . '/pdf/images/Ad300x250_2.jpg', 107, 115, 88, 65, 'JPG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);
// Ad Space 4
                        $pdf->Image(APP . WEBROOT_DIR . '/content/' . Configure::read('Settings.site_id') . '/pdf/images/Ad300x250_1.jpg', 15, 185, 88, 65, 'JPG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);
// Ad Space 5
                        $pdf->Image(APP . WEBROOT_DIR . '/content/' . Configure::read('Settings.site_id') . '/pdf/images/Ad300x250_2.jpg', 107, 185, 88, 65, 'JPG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);
                        $ticket++;
                    }
                    $pdf->lastPage();

                    $pdfstr = $pdf->Output('raffle.pdf', 'S');
                    App::uses('EmailLib', 'Tools.Lib');
                    $Email = new EmailLib();
                    $Email->from(array('do-not-reply@leaguelaunch.com' => $site['Sites']['leaguename']))
                            ->to('ehask71@gmail.com')
                            ->subject('Attach test new')
                            ->addAttachments(array('raffletickets.pdf' => array('content' => $pdfstr, 'mimetype' => 'application/pdf')))
                            ->send('Testing Attachment from LeagueLaunch and Sending Example to Collette');
                }
            }
        }
        $this->set('products', $this->Products->getProductsByCat(7, true));
    }

    public function admin_pokerrun() {
        
    }

}

