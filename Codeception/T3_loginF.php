<?php 
	date_default_timezone_set('UTC');
	$I = new AcceptanceTester($scenario);
	$I->wantTo('ensure that frontpage works');
	$I->amOnPage('/');
	$I->fillField('username', 'U0002');
	$I->wait(1);
	$I->fillField('password', 'nimnimp68');
	$I->wait(1);
	$I->click('Login');
	$I->wait(1);
	$I->click('div#Logout.menuAdmin');
	$I->wait(2);
?>