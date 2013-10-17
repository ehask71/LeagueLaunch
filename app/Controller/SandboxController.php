<?php

/**
 * CakePHP SandboxController
 * @author Eric
 */
App::uses('AppController', 'Controller');

class SandboxController extends AppController {

    public $name = 'Sandbox';
    public $components = array('RoundRobin');
    public $uses = array('Divisions', 'Team', 'Season', 'PlayersToSeasons', 'RandomTeamPicks');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }

    public function index() {
        
    }

    public function testiframe() {
        
    }

    public function testschedule($id) {
        $this->autoRender = false;
        $divisions = $this->Divisions->find('all', array(
            'conditions' => array(
                'Divisions.active' => 1,
                'Divisions.site_id' => Configure::read('Settings.site_id'),
                'Divisions.season_id' => $id,
                'Divisions.name NOT LIKE' => '%Softball%'
            )
        ));
        $overallgames = array();
        foreach ($divisions AS $div) {
            if (strpos($div, 'softball')) {
                continue;
            }
            $teams = $this->Team->find('all', array(
                'conditions' => array(
                    'Team.division_id' => $div['Divisions']['division_id'],
                    'Team.active' => 1,
                    'Team.site_id' => Configure::read('Settings.site_id')
                )
            ));

            $team_array = array();
            foreach ($teams AS $team) {
                $team_array[] = $team['Team']['name'];
            }
            //print_r($team_array);
            //$this->RoundRobin->gameday_count = 10;
            /* $this->RoundRobin->roundrobin($team_array);
              $this->RoundRobin->gameday_count = 10;
              $this->RoundRobin->create_games(); */
            $games = $this->RoundRobin->getFixtures($team_array, '2013-09-28', array('Eric', 'Rob', 'Scott'));
            //$games = $this->RoundRobin->round_robin($team_array,10);
            //$this->RoundRobin->create_raw_games();
            echo '<table>';
            echo '<thead>';
            echo '<tr><th colspan="100">';
            echo '<b>' . $div['Divisions']['name'] . '</b>';
            echo '</th></tr></thead><tbody>';
            //echo '<pre>';
            /* echo '<tr><td>Teams:<ol>';
              foreach($team_array AS $ta){
              echo '<li>'.$ta.'</li>';
              }
              echo '</ol></td></tr>'; */
            //print_r($team_array);

            /* $games = $this->RoundRobin->games;
              $this->RoundRobin->create_games();
              $games2 = $this->RoundRobin->games;
              $games = array_merge($games,$games2);
              //$secondgames = array_reverse($this->RoundRobin->games); */
            //print_r($games[counts]);
            $overallgames[$div['Divisions']['division_id']] = array('games' => $games, 'name' => $div['Divisions']['name'], 'id' => $div['Divisions']['division_id']);

            echo '<tr><td colspan="100">Teams:<ol>';
            foreach ($games[counts] AS $k => $v) {
                echo '<li>' . $k . ' ~ Games (' . $v . ')</li>';
            }
            echo '</ol></td></tr>';
            unset($games[counts]);
            //echo '</pre>';
            $i = 1;
            foreach ($games AS $game) {
                //echo '<tr><td>'.$i.'</td></tr>';
                foreach ($game AS $g) {
                    echo '<tr>';
                    echo '<td>' . $i . '</td><td>[H] ' . $g[Home] . ' vs ' . $g[Away] . "</td>";
                    echo '</tr>';
                }
                echo '<tr><td colspan="2">&nbsp;</td></tr>';
                //echo '<br>';
                $i++;
            }
            //exit();
            echo '</tbody>';
            echo '</table>';
            echo '<br><br>';
        }

        /*  $data = array(
          'site_id' => Configure::read('Settings.site_id'),
          'season_id' => $id,
          'key' => 'schedule',
          'data' => serialize($overallgames)
          );
          if ($rand) {
          $data['id'] = $rand;
          }
          if ($this->RandomTeamPicks->save($data)) {
          $this->Session->setFlash(__('Schedule Stored'), 'default', array('class' => 'alert succes_msg'));
          $randdb = $this->RandomTeamPicks->getLastInsertId();
          } */
    }

    public function viewschedule($id) {
        $this->autoRender = false;
        $schedule = $this->RandomTeamPicks->find('first', array(
            'conditions' => array(
                'RandomTeamPicks.site_id' => Configure::read('Settings.site_id'),
                'RandomTeamPicks.key' => 'schedule',
                'RandomTeamPicks.season_id' => $id
            )
        ));

        $divisions = unserialize($schedule[RandomTeamPicks][data]);
        foreach ($divisions AS $division) {
            echo '<table>';
            echo '<thead>';
            echo '<tr><th colspan="100">';
            echo '<b>' . $division['name'] . '</b>';
            echo '</th></tr></thead><tbody>';
            echo '<tr><td colspan="100">Teams:<ol>';
            foreach ($division[games][counts] AS $k => $v) {
                echo '<li>' . $k . ' ~ Games (' . $v . ')</li>';
            }
            echo '</ol></td></tr>';
            unset($division[games][counts]);
            //echo '</pre>';
            $i = 1;
            foreach ($division[games] AS $game) {
                //echo '<tr><td>'.$i.'</td></tr>';
                foreach ($game AS $g) {
                    echo '<tr>';
                    echo '<td>' . $i . '</td><td>[H] ' . $g[Home] . ' vs ' . $g[Away] . "</td>";
                    echo '</tr>';
                }
                echo '<tr><td colspan="2">&nbsp;</td></tr>';
                //echo '<br>';
                $i++;
            }
            //exit();
            echo '</tbody>';
            echo '</table>';
            echo '<br><br>';
        }
    }

    public function create_pdf() {
        //$posts = $this->Post->find('all');
        //$this->set(compact('posts'));
        $this->set('ticket', '111011101110111');
        $this->set('purchaser', 'Eric Haskins');
        $this->layout = '/pdf/default';
        $this->render('/Pdf/raffle_ticket_3');
    }

    public function generate_pdf() {
       
        $this->autoRender = false;
        
        $ticket = 111011101110111;
        $purchaser = 'Eric Haskins';
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
//$pdf->setPrintFooter(false);
        //for($i=0;$i<50;$i++){
        $pdf->AddPage();
        $html = '
<table cellspacing="0" cellpadding="0" width="675px" align="center">
    <tr>
        <td align="left">
	    BuddyBall.Org Fall Raffle<br><br>
            Purchased By: <b>' . $purchaser . '</b><br>
            Generated: ' . date('Y-m-d H:m:i') . '<br>
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
        //}
        $pdf->lastPage();
        //echo $pdf->Output(APP . WEBROOT_DIR . '/content/' . Configure::read('Settings.site_id') . '/pdf' . DS . 'test.pdf', 'F');
        $pdfstr = $pdf->Output('raffle.pdf','S');
        
        //App::uses('CakeEmail', 'Network/Email');
        App::uses('EmailLib','Tools.Lib');
        $Email = new EmailLib();
        $Email->from(array('do-not-reply@leaguelaunch.com' => $site['Sites']['leaguename']))
            ->to('ehask71@gmail.com')
            //->addCc('easlar@yahoo.com', 'Scott')
            //->addCc('ehask71@gmail.com')
            //->addCc('bobpeters@gmail.com')
            ->subject('Attach test new')
            ->addAttachments(array('raffletickets.pdf'=>array('content'=>$pdfstr,'mimetype'=>'application/pdf')))
            ->send('Testing Attachment from LeagueLaunch and Sending Example to Collette');
    }
    
    public function testfor(){
        $this->autoRender = false;
        $total = 1;
        for($i=1;$i<$total;$i++){
            echo $i.'<br/>';
        }
    }

}

