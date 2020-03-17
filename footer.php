<?php
	if(!defined('ACCESS')) die('Access Denied!');

	$config = select_one('config');
	include './views/footer.html';
