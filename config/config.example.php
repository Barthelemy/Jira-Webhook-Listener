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

// The variable must be called configuration_array
// It is made of an array <project_name> => <parameters>.
// The parameters themselves are an array specifying the type of event and actions.
// One can use wildcards "*" instead but then no mapping of specific projects can be done.
$configuration_array = array (
		
		'EXAMPLE' => array (
				
				'fireon' => 'newissue,updatedissue',
				'actions' => array (
						'email' => 'foo@example.com,bar@example.com',
						'urlrequest' => 'refreshIndex' 
				),
				'ProjectURLBase' => 'http://example.com/projects', // No trailing slash
				'ProjectURLSuffix' => '.html' 
		)/* , 
		'*' => array ( // this only works if there is no other project defined
				'fireon' => '*',
				'actions' => array (
						'email' => '' // no option here
				),
				'ProjectURLBase' => 'http://dev8.its.cern.ch/jira/projects', // No trailing slash
				'ProjectURLSuffix' => '.html'
		) */
);
