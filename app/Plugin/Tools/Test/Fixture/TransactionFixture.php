<?php
/* Transaction Fixture generated on: 2011-11-20 21:59:40 : 1321822780 */

/**
 * TransactionFixture
 *
 */
class TransactionFixture extends CakeTestFixture {

	/**
	 * Fields
	 *
	 * @var array
	 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary', 'collate' => null, 'comment' => ''),
		'title' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'charset' => 'utf8'),
		'token' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'charset' => 'utf8'),
		'foreign_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'charset' => 'utf8'),
		'model' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 30, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'charset' => 'utf8'),
		'type' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 30, 'collate' => 'utf8_unicode_ci', 'comment' => 'paypal, ...', 'charset' => 'utf8'),
		'transaction_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'charset' => 'utf8'),
		'transaction_type' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 30, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'charset' => 'utf8'),
		'note' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'charset' => 'utf8'),
		'amount' => array('type' => 'float', 'null' => false, 'default' => '0.00', 'length' => '9,2', 'collate' => null, 'comment' => ''),
		'fee_amount' => array('type' => 'float', 'null' => false, 'default' => '0.00', 'length' => '9,2', 'collate' => null, 'comment' => ''),
		'tax_amount' => array('type' => 'float', 'null' => false, 'default' => '0.00', 'length' => '9,2', 'collate' => null, 'comment' => ''),
		'currency_code' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 3, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'charset' => 'utf8'),
		'payment_type' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 30, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'charset' => 'utf8'),
		'payment_status' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 30, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'charset' => 'utf8'),
		'pending_reason' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'charset' => 'utf8'),
		'reason_code' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 30, 'collate' => 'utf8_unicode_ci', 'comment' => '', 'charset' => 'utf8'),
		'order_time' => array('type' => 'datetime', 'null' => false, 'default' => null, 'collate' => null, 'comment' => ''),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null, 'collate' => null, 'comment' => ''),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array()
	);

	/**
	 * Records
	 *
	 * @var array
	 */
	public $records = array(
		array(
			'id' => '1',
			'title' => 'Paypal-Bezahlung von admin@admin.de',
			'token' => 'EC-0P828508TM680313G',
			'foreign_id' => '4e7c7592-648c-47a2-bec7-00947cb063f2',
			'model' => 'Order',
			'type' => 'paypal',
			'transaction_id' => '',
			'transaction_type' => '',
			'note' => '',
			'amount' => '9.90',
			'fee_amount' => '0.00',
			'tax_amount' => '0.00',
			'currency_code' => 'EUR',
			'payment_type' => '',
			'payment_status' => '',
			'pending_reason' => '',
			'reason_code' => '',
			'order_time' => '0000-00-00 00:00:00',
			'created' => '2011-09-23 14:58:38'
		),
		array(
			'id' => '2',
			'title' => 'Paypal-Bezahlung von admin@admin.de',
			'token' => 'EC-48H402745D559663N',
			'foreign_id' => '4e7c8767-0580-41c2-8f23-00947cb063f2',
			'model' => 'Order',
			'type' => 'paypal',
			'transaction_id' => '',
			'transaction_type' => '',
			'note' => '',
			'amount' => '9.90',
			'fee_amount' => '0.00',
			'tax_amount' => '0.00',
			'currency_code' => 'EUR',
			'payment_type' => '',
			'payment_status' => '',
			'pending_reason' => '',
			'reason_code' => '',
			'order_time' => '0000-00-00 00:00:00',
			'created' => '2011-09-23 15:19:42'
		),
		array(
			'id' => '5',
			'title' => 'Test-Konto-Einzahlung von user@user.de',
			'token' => 'EC-0MA508270G1912621',
			'foreign_id' => '1',
			'model' => 'PrepaidAccount',
			'type' => 'paypal',
			'transaction_id' => '',
			'transaction_type' => '',
			'note' => '',
			'amount' => '15.00',
			'fee_amount' => '0.00',
			'tax_amount' => '0.00',
			'currency_code' => 'EUR',
			'payment_type' => '',
			'payment_status' => '',
			'pending_reason' => '',
			'reason_code' => '',
			'order_time' => '0000-00-00 00:00:00',
			'created' => '2011-09-23 17:13:59'
		),
		array(
			'id' => '4',
			'title' => 'Test-Konto-Einzahlung von user@user.de',
			'token' => 'EC-89F71804C0644512T',
			'foreign_id' => '1',
			'model' => 'PrepaidAccount',
			'type' => 'paypal',
			'transaction_id' => '',
			'transaction_type' => '',
			'note' => '',
			'amount' => '2.00',
			'fee_amount' => '0.00',
			'tax_amount' => '0.00',
			'currency_code' => 'EUR',
			'payment_type' => '',
			'payment_status' => '',
			'pending_reason' => '',
			'reason_code' => '',
			'order_time' => '0000-00-00 00:00:00',
			'created' => '2011-09-23 17:07:40'
		),
		array(
			'id' => '6',
			'title' => '',
			'token' => '',
			'foreign_id' => '',
			'model' => '',
			'type' => '',
			'transaction_id' => '5BX58234B37950023',
			'transaction_type' => 'expresscheckout',
			'note' => 'super!!!!!!!',
			'amount' => '15.00',
			'fee_amount' => '0.64',
			'tax_amount' => '0.00',
			'currency_code' => 'EUR',
			'payment_type' => 'instant',
			'payment_status' => 'Completed',
			'pending_reason' => 'None',
			'reason_code' => 'None',
			'order_time' => '2011-09-23 15:14:42',
			'created' => '2011-09-23 17:14:57'
		),
		array(
			'id' => '7',
			'title' => 'Test-Konto-Einzahlung von user@user.de',
			'token' => 'EC-5SH71547J6537800X',
			'foreign_id' => '1',
			'model' => 'PrepaidAccount',
			'type' => 'paypal',
			'transaction_id' => '2KA31398DU2919545',
			'transaction_type' => 'expresscheckout',
			'note' => '',
			'amount' => '15.00',
			'fee_amount' => '0.64',
			'tax_amount' => '0.00',
			'currency_code' => 'EUR',
			'payment_type' => 'instant',
			'payment_status' => 'Completed',
			'pending_reason' => 'None',
			'reason_code' => 'None',
			'order_time' => '2011-09-23 15:17:45',
			'created' => '2011-09-23 17:17:32'
		),
		array(
			'id' => '8',
			'title' => 'Paypal-Bezahlung von admin@admin.de',
			'token' => 'EC-1YA81486XV646422E',
			'foreign_id' => '4e7cb285-6c5c-4de6-883b-00947cb063f2',
			'model' => 'Order',
			'type' => 'paypal',
			'transaction_id' => '0L406448G9145332Y',
			'transaction_type' => 'expresscheckout',
			'note' => '',
			'amount' => '9.90',
			'fee_amount' => '0.54',
			'tax_amount' => '0.00',
			'currency_code' => 'EUR',
			'payment_type' => 'instant',
			'payment_status' => 'Completed',
			'pending_reason' => 'None',
			'reason_code' => 'None',
			'order_time' => '2011-09-23 19:45:34',
			'created' => '2011-09-23 21:45:01'
		),
		array(
			'id' => '9',
			'title' => 'Test-Konto-Einzahlung von admin@admin.de',
			'token' => 'EC-89362070VF0669840',
			'foreign_id' => '5',
			'model' => 'PrepaidAccount',
			'type' => 'paypal',
			'transaction_id' => '',
			'transaction_type' => '',
			'note' => '',
			'amount' => '25.00',
			'fee_amount' => '0.00',
			'tax_amount' => '0.00',
			'currency_code' => 'EUR',
			'payment_type' => '',
			'payment_status' => '',
			'pending_reason' => '',
			'reason_code' => '',
			'order_time' => '0000-00-00 00:00:00',
			'created' => '2011-09-29 23:40:48'
		),
		array(
			'id' => '10',
			'title' => 'Test-Konto-Einzahlung von admin@admin.de',
			'token' => 'EC-3UH10864KV965382X',
			'foreign_id' => '5',
			'model' => 'PrepaidAccount',
			'type' => 'paypal',
			'transaction_id' => '',
			'transaction_type' => '',
			'note' => '',
			'amount' => '25.00',
			'fee_amount' => '0.00',
			'tax_amount' => '0.00',
			'currency_code' => 'EUR',
			'payment_type' => '',
			'payment_status' => '',
			'pending_reason' => '',
			'reason_code' => '',
			'order_time' => '0000-00-00 00:00:00',
			'created' => '2011-10-03 16:35:08'
		),
		array(
			'id' => '11',
			'title' => 'Paypal-Bezahlung von admin@admin.de',
			'token' => 'EC-7TD59178A43867932',
			'foreign_id' => '4ea8ab36-0f54-4e35-86ff-410c7cb063f2',
			'model' => 'Order',
			'type' => 'paypal',
			'transaction_id' => '',
			'transaction_type' => '',
			'note' => '',
			'amount' => '9.90',
			'fee_amount' => '0.00',
			'tax_amount' => '0.00',
			'currency_code' => 'EUR',
			'payment_type' => '',
			'payment_status' => '',
			'pending_reason' => '',
			'reason_code' => '',
			'order_time' => '0000-00-00 00:00:00',
			'created' => '2011-10-27 02:58:50'
		),
	);
}