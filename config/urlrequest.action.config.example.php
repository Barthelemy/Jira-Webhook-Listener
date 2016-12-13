<?php
/** Jira Webhook Listener
*
* A small set of scripts to catch Webhook notifications from JIRA and run custom commands on a per-project basis
*
* Copyright (c) 2014 B Tasker
* Modified by B von Haller (2016)
* Released under GNU GPL V2, see LICENSE
*
* Configuration File for the email action
* Copy this file and remove the "example" from its name to use it. 
*/




$conf->defaultprojectserver = 'https://www.example.com/projects';
$conf->headers = array('X-Refresh-Mirror: 1');
$conf->urlsuffix = '.html';
$conf->projectURLS = array("EXAMPLE"=>array("base"=>'http://www.example.com/','suffix'=>'.html'));
