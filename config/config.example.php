<?php
/** Jira Webhook Listener
*
* A small set of scripts to catch Webhook notifications from JIRA and run custom commands on a per-project basis
*
* Copyright (c) 2014 B Tasker
* Modified by B von Haller (2016)
* Released under GNU GPL V2, see LICENSE
*
* Configuration File example
* Copy this file and remove the "example" from its name to use it. 
*/




$configuration_array = array(

  'EXAMPLE' => array(

	      'fireon' => 'newissue,updatedissue',
	      'actions' => array(
		  'email' => 'foo@example.com,bar@example.com',
		  'urlrequest' => 'refreshIndex'
	      ),
	      'ProjectURLBase' => 'http://example.com/projects', // No trailing slash
	      'ProjectURLSuffix' => '.html'
	  )



);