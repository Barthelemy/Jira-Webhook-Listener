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

// The variable defined here must be called "email_configurations". 
// It is made of an array of <template_name> => <email_parameters>.
// Each template must specify the fields: from, to, body and subject. 
// In case one wants to send an HTML email the extra field "content_type" 
// must be set to "text/html".
$email_configurations = array(
		'datesupport' => array(
				'from' => 'alice.jira@cern.ch',
				'to' => 'bvonhall@cern.ch', //alice-datesupport@cern.ch
		  		'body' => "   Project:   " . $this->request->getIssueProject() .
				"\r\nReporter:  " . $this->request->getIssueReporter() .
				"\r\nAssignee:  " . $this->request->getIssueAssignee() .
				"\r\nCreated:   " . $this->request->getIssueCreated() .
				"\r\nDetails:   https://alice.its.cern.ch/jira/browse/" . $this->request->getIssueKey() .
				"\r\n" .
				"\r\n###########" .
				"\r\n# TITLE" .
				"\r\n###########" .
				"\r\n" . $this->request->getIssueTitle() .
				"\r\n" .
				"\r\n###########" .
				"\r\n# BODY" .
				"\r\n###########" .
				"\r\n" . $this->request->getIssueDescription() .
				"\r\n",
				'subject' => "(" . $this->request->getIssueKey() . ")" . $this->request->getIssueTitle()//,
				//   		'content_type' => ""
		),
		'daq_intervention' => array(
				'from' => 'alice.jira@cern.ch',
				'to' => 'bvonhall@cern.ch', //alice-datesupport@cern.ch
				'body' => "   Project:    " . $this->request->getIssueProject() .
				"\r\nReporter:   " . $this->request->getIssueReporter() .
				"\r\nAssignee:   " . $this->request->getIssueAssignee() .
				"\r\nCreated:    " . $this->request->getIssueCreated() .
				"\r\nSubsystems: " . $this->request->issue->field->subsystems .
				"\r\nDetails:    https://alice.its.cern.ch/jira/browse/" . $this->request->getIssueKey() .
				"\r\nResolved:   " . $this->request->getIssueCreated() .
				"\r\n" .
				"\r\n###########" .
				"\r\n# TITLE" .
				"\r\n###########" .
				"\r\n" . $this->request->getIssueTitle() .
				"\r\n" .
				"\r\n###########" .
				"\r\n# BODY" .
				"\r\n###########" .
				"\r\n" . $this->request->getIssueDescription() .
				"\r\n",
				'subject' => "New Intervention: " . $this->request->getIssueTitle()
		)
);
