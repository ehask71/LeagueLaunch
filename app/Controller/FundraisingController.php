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

    public function admin_buyraffle() {
        $this->loadModel('Products');
        if ($this->request->is('post')) {
            $this->loadModel('Order');
            $this->loadModel('OrderItem');
            $product = $this->Products->getProductById($this->request->data['Raffleticket']['product_id']);
            if (is_array($product)) {
                unset($this->request->data['Raffleticket']['product_id']);
                $total = 0;
                switch ($product['Products']['id']) {
                    case 12:
                        $total = 1;
                        break;
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

                $order['Order']['status'] = 2;
                $order['Order']['site_id'] = Configure::read('Settings.site_id');
                $order['Order']['first_name'] = $this->request->data['Raffleticket']['firstname'];
                $order['Order']['last_name'] = $this->request->data['Raffleticket']['lastname'];
                $order['Order']['email'] = $this->request->data['Raffleticket']['email'];
                $order['Order']['phone'] = $this->request->data['Raffleticket']['phone'];
                $order['Order']['billing_address'] = $this->request->data['Raffleticket']['address'];
                $order['Order']['billing_address2'] = $this->request->data['Raffleticket']['address2'];
                $order['Order']['billing_city'] = $this->request->data['Raffleticket']['city'];
                $order['Order']['billing_zip'] = $this->request->data['Raffleticket']['zip'];
                $order['Order']['billing_state'] = $this->request->data['Raffleticket']['state'];
                $order['Order']['billing_country'] = 'US';
                $order['Order']['shipping_address'] = $this->request->data['Raffleticket']['address'];
                $order['Order']['shipping_address2'] = $this->request->data['Raffleticket']['address2'];
                $order['Order']['shipping_city'] = $this->request->data['Raffleticket']['city'];
                $order['Order']['shipping_zip'] = $this->request->data['Raffleticket']['zip'];
                $order['Order']['shipping_state'] = $this->request->data['Raffleticket']['state'];
                $order['Order']['shipping_country'] = 'US';
                $order['Order']['order_item_count'] = 1;
                $order['Order']['subtotal'] = $product['Products']['price'];
                $order['Order']['total'] = $product['Products']['price'];
                $order['Order']['ip_address'] = '';
                if ($this->Order->save($order)) {
                    $orderid = $this->Order->getLastInsertID();
                    $item = array(
                        //'OrderItem' => array(
                        'order_id' => $orderid,
                        'product_id' => $product['Products']['id'],
                        'name' => $product['Products']['name'],
                        'quantity' => 1,
                        'weight' => 0.00,
                        'price' => $product['Products']['price'],
                        'subtotal' => $product['Products']['price'],
                        'player_id' => '',
                        'season_id' => 0
                            //)
                    );
                    $this->OrderItem->save($item);
                }

                $purchaser = $this->request->data['Raffleticket']['firstname'] . ' ' . $this->request->data['Raffleticket']['lastname'];
                $this->request->data['Raffleticket']['raffle_id'] = 2;
                $this->request->data['Raffleticket']['site_id'] = Configure::read('Settings.site_id');
                $this->request->data['Raffleticket']['order_id'] = $orderid;
                $title = 'Buddyball-Harley Davidson Raffle';
                $location = '"The Alley" hwy 301 and Big Bend';
                $date = '2014-05-04';
                $site = Configure::read('Settings.site_id');

                App::import('Vendor', 'xtcpdf');
                $pdf = new XTCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
                $pdf->SetMargins(PDF_MARGIN_LEFT, 25, PDF_MARGIN_RIGHT);
                $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
                $pdf->SetCreator('LeagueLaunch.com');
                $pdf->SetAuthor('LeagueLaunch.com');
                $pdf->SetTitle($title);
                $pdf->SetSubject($title);
                $pdf->setHeaderData('logo-medium.png', 30, '', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
                $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
                $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
                $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
                $pdf->SetFont('dejavusans', '', 10);

                for ($i = 0; $i < $total; $i++) {

                    $this->Raffleticket->create();
                    if ($this->Raffleticket->validateBuyraffle()) {
                        //mail('ehask71@gmail.com', 'Raffle', 'Validate');
                        if ($this->Raffleticket->save($this->request->data)) {
                            $tid = $this->Raffleticket->getLastInsertID();
                            $ticket = md5($tid . $this->request->data['Raffleticket']['firstname'] . $this->request->data['Raffleticket']['lastname'] . $site);
                            $this->Raffleticket->create();
                            $upd = array('id' => $tid, 'ticket' => $ticket);
                            $this->Raffleticket->save($upd);
                        }
                    }

                    $pdf->AddPage();
                    $html = '
<table cellspacing="0" cellpadding="0" width="675px" align="center">
    <tr>
        <td align="left">
	    <font size="+2">' . $title . '</font><br><br>
            <u>Drawing Date & Location</u><br>
            ' . $date . ' ' . $location . '<br>
            Purchased By: <b>' . $purchaser . '</b><br>
	    Ticket #: <b>' . $ticket . '</b><br>
            <small>Generated: ' . date('Y-m-d H:m:i') . '</small><br>
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
        <td align="center" height="420px">
	    <!--<b>Ad Space 2</b>-->
	</td>
        <td align="center">
	    <!--<b>Ad Space 3</b>-->
	</td>
	</tr>
        <tr>
            <td colspan="2" valign="top"><small>
            <b>Disclaimer:</b>
            No purchase necessary. A Free entry may be obtained by sending a self addressed envelope with your name, age, address, phone number and email address for notification purposes to 6004 Adagio lane apollo beach FL 33572.  Drawing to be held at 1:30 May 4th at the Alley 10221 Big Bend Blvd Riverview Florida.  High Octane Brands LLC, League Launch and its subsidiaries are in no way affilited with this raffle.</small></td>
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
                    $pdf->write1DBarcode($ticket, 'C128', 18, 60, '', 18, 0.4, $style, 'N');
                    //$pdf->write2DBarcode('http://buddyball.org', 'QRCODE,H', 138, 27, 50, 50, $style, 'N');
                    $pdf->Image(APP . WEBROOT_DIR . '/content/' . Configure::read('Settings.site_id') . '/pdf/images/logoforraffle.jpg', 138, 20, 35, 35, 'JPG', 'http://www.buddyball.org', '', true, 150, '', false, false, 1, false, false, false);
// set JPEG quality
                    $pdf->setJPEGQuality(75);
// Ad Space 1
                    $pdf->Image(APP . WEBROOT_DIR . '/content/' . Configure::read('Settings.site_id') . '/pdf/images/HO728x90.jpg', 15, 85, 180, 28, 'JPG', 'http://www.highoctanebrands.com', '', true, 150, '', false, false, 1, false, false, false);
// Ad Space 2
                    $pdf->Image(APP . WEBROOT_DIR . '/content/' . Configure::read('Settings.site_id') . '/pdf/images/BrandonAreaPrimaryCareLOGO.jpg', 15, 115, 88, 65, 'JPG', 'http://www.brandondocs.com', '', true, 150, '', false, false, 1, false, false, false);
// Ad Space 3
                    $pdf->Image(APP . WEBROOT_DIR . '/content/' . Configure::read('Settings.site_id') . '/pdf/images/ButlerBoydLOGO.jpg', 107, 115, 88, 65, 'JPG', 'http://www.butlerboyd.com', '', true, 150, '', false, false, 1, false, false, false);
// Ad Space 4
                    $pdf->Image(APP . WEBROOT_DIR . '/content/' . Configure::read('Settings.site_id') . '/pdf/images/Circles.jpg', 15, 185, 88, 65, 'JPG', 'http://www.circleswaterfront.com', '', true, 150, '', false, false, 1, false, false, false);
// Ad Space 5
                    $pdf->Image(APP . WEBROOT_DIR . '/content/' . Configure::read('Settings.site_id') . '/pdf/images/creativelogo.jpg', 107, 185, 88, 65, 'JPG', 'http://www.creativeconvenience.com', '', true, 150, '', false, false, 1, false, false, false);
                }
                $pdf->lastPage();

                //Body
                $body = $title . "\r\n
Drawing Date & Location: " . $date . " - " . $location . "\r\n\r\nDisclaimer:\r\n";

                $pdfstr = $pdf->Output('raffle.pdf', 'S');
                App::uses('EmailLib', 'Tools.Lib');
                $Email = new EmailLib();
                $Email->from(array('do-not-reply@leaguelaunch.com' => Configure::read('Settings.leaguename')))
                        ->to($this->request->data['Raffleticket']['email'])
                        ->subject($title . ' ticket(s) attached')
                        ->addAttachments(array('raffletickets.pdf' => array('content' => $pdfstr, 'mimetype' => 'application/pdf')))
                        ->send($body);
                // Redirect
                $this->Session->setFlash('Raffle Ticket(s) Sent!!!', 'default', array('class' => 'alert succes_msg'));
                $this->redirect('/admin/fundraising/buyraffle');
            } else {
                $this->Session->setFlash('No Product', 'default', array('class' => 'alert succes_msg'));
                $this->redirect('/admin/fundraising/buyraffle');
            }
        }
        $this->set('products', $this->Products->getProductsByCat(7, true));
    }

    public function admin_rafflehardcopy($id) {
        if ($this->request->is('post')) {
            $tickets = $this->Raffleticket->find('all', array(
                'conditions' => array(
                    'Raffleticket.raffle_id' => 2,
                    'Raffleticket.site_id' => 4,
                    'Raffleticket.email' => $this->request->data['Raffleticket']['email']
                )
            ));

            if (count($tickets) > 0) {
                $purchaser = $this->request->data['Raffleticket']['firstname'] . ' ' . $this->request->data['Raffleticket']['lastname'];
                $title = 'Buddyball-Harley Davidson Raffle';
                $location = '"The Alley" hwy 301 and Big Bend';
                $date = '2014-05-04';
                $site = Configure::read('Settings.site_id');
                App::import('Vendor', 'xtcpdf');
                $pdf = new XTCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
                $pdf->SetMargins(PDF_MARGIN_LEFT, 25, PDF_MARGIN_RIGHT);
                $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
                $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
                $pdf->SetCreator('LeagueLaunch.com');
                $pdf->SetAuthor('LeagueLaunch.com');
                $pdf->SetTitle($title);
                $pdf->SetSubject($title);
                $pdf->setHeaderData('logo-medium.png', 30, '', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
                $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));
                $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
                $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
                $pdf->SetFont('dejavusans', '', 10);

                foreach ($tickets AS $tic) {
                    $pdf->AddPage();
                    $html = '
<table cellspacing="0" cellpadding="0" width="675px" align="center">
    <tr>
        <td align="left">
	    <font size="+2">' . $title . '</font><br><br>
            <u>Drawing Date & Location</u><br>
            ' . $date . ' ' . $location . '<br>
            Purchased By: <b>' . $tic['Raffleticket']['firstname'].' '.$tic['Raffleticket']['lastname'] . '</b><br>
	    Ticket #: <b>' . $tic['Raffleticket']['ticket'] . '</b><br>
            <small>Generated: ' . date('Y-m-d H:m:i') . '</small><br>
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
        <td align="center" height="420px">
	    <!--<b>Ad Space 2</b>-->
	</td>
        <td align="center">
	    <!--<b>Ad Space 3</b>-->
	</td>
	</tr>
        <tr>
            <td colspan="2" valign="top"><small>
            <b>Disclaimer:</b>
            No purchase necessary. A Free entry may be obtained by sending a self addressed envelope with your name, age, address, phone number and email address for notification purposes to 6004 Adagio lane apollo beach FL 33572.  Drawing to be held at 1:30 May 4th at the Alley 10221 Big Bend Blvd Riverview Florida.  High Octane Brands LLC, League Launch and its subsidiaries are in no way affilited with this raffle.</small></td>
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
                    $pdf->write1DBarcode($tic['Raffleticket']['ticket'], 'C128', 18, 60, '', 18, 0.4, $style, 'N');
                    //$pdf->write2DBarcode('http://buddyball.org', 'QRCODE,H', 138, 27, 50, 50, $style, 'N');
                    $pdf->Image(APP . WEBROOT_DIR . '/content/' . Configure::read('Settings.site_id') . '/pdf/images/logoforraffle.jpg', 138, 20, 35, 35, 'JPG', 'http://www.buddyball.org', '', true, 150, '', false, false, 1, false, false, false);
// set JPEG quality
                    $pdf->setJPEGQuality(75);
// Ad Space 1
                    $pdf->Image(APP . WEBROOT_DIR . '/content/' . Configure::read('Settings.site_id') . '/pdf/images/HO728x90.jpg', 15, 85, 180, 28, 'JPG', 'http://www.highoctanebrands.com', '', true, 150, '', false, false, 1, false, false, false);
// Ad Space 2
                    $pdf->Image(APP . WEBROOT_DIR . '/content/' . Configure::read('Settings.site_id') . '/pdf/images/BrandonAreaPrimaryCareLOGO.jpg', 15, 115, 88, 65, 'JPG', 'http://www.brandondocs.com', '', true, 150, '', false, false, 1, false, false, false);
// Ad Space 3
                    $pdf->Image(APP . WEBROOT_DIR . '/content/' . Configure::read('Settings.site_id') . '/pdf/images/ButlerBoydLOGO.jpg', 107, 115, 88, 65, 'JPG', 'http://www.butlerboyd.com', '', true, 150, '', false, false, 1, false, false, false);
// Ad Space 4
                    $pdf->Image(APP . WEBROOT_DIR . '/content/' . Configure::read('Settings.site_id') . '/pdf/images/Circles.jpg', 15, 185, 88, 65, 'JPG', 'http://www.circleswaterfront.com', '', true, 150, '', false, false, 1, false, false, false);
// Ad Space 5
                    $pdf->Image(APP . WEBROOT_DIR . '/content/' . Configure::read('Settings.site_id') . '/pdf/images/creativelogo.jpg', 107, 185, 88, 65, 'JPG', 'http://www.creativeconvenience.com', '', true, 150, '', false, false, 1, false, false, false);
                }
                $pdf->lastPage();
                
                // Now what are we doing with it
                if($this->request->data['Raffleticket']['type'] == 'hardcopy'){
                    $link = '/content/' . Configure::read('Settings.site_id') . '/pdf' . DS . $tic['Raffleticket']['firstname'].'_'.$tic['Raffleticket']['lastname'].'_'.$tic['Raffleticket']['raffle_id'].$tic['Raffleticket']['site_id'].'.pdf';
                    echo $pdf->Output(APP . WEBROOT_DIR . $link, 'F');
                    $this->set('link',$link);
                } else {
                    // Email
                    $body = $title . "\r\n
Drawing Date & Location: " . $date . " - " . $location . "\r\n\r\nDisclaimer:\r\n";

                $pdfstr = $pdf->Output('raffle.pdf', 'S');
                App::uses('EmailLib', 'Tools.Lib');
                $Email = new EmailLib();
                $Email->from(array('do-not-reply@leaguelaunch.com' => Configure::read('Settings.leaguename')))
                        ->to($tic['Raffleticket']['email'])
                        ->subject($title . ' ticket(s) attached')
                        ->addAttachments(array('raffletickets.pdf' => array('content' => $pdfstr, 'mimetype' => 'application/pdf')))
                        ->send($body);
                
                
                    $this->Session->setFlash('Tickets Sent!!!', 'default', array('class' => 'alert succes_msg'));  
                    $this->redirect('/admin/fundraising/viewraffle/'.$id);
                }
                
            } else {
                $this->Session->setFlash('No Tickets Found for that email!!', 'default', array('class' => 'alert error_msg'));
            }
        }
    }

    public function admin_viewraffle($id){
	$raffletickets = $this->Raffleticket->find('all',array(
	    'fields' => array(
		'DISTINCT(Raffleticket.order_id)',
		'Raffleticket.firstname',
		'Raffleticket.lastname',
                'Raffleticket.email',
		'Raffleticket.created'
	    ),
	    'conditions' => array(
		'Raffleticket.raffle_id' => $id,
		'Raffleticket.site_id' => Configure::read('Settings.site_id')
	    ),
	    'group' => array('Raffleticket.order_id'),
	    'order' => 'Raffleticket.lastname'));
	
	if(!$raffletickets){
	    throw new NotFoundException('Unable to Locate this Raffle!');
	}
	
	$this->set('raffle',  compact('raffletickets'));
    }
    
    public function admin_pokerrun() {
        
    }
    
    public function buytickets($id){
	$raffle = $this->Fundraiser->findById($id);
	
	if(!$raffle){
	    throw new NotFoundException('Unable To Locate That Fundraiser');
	}
	
	$this->set('raffle',$raffle);
    }

}
