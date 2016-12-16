Jira Webhook Listener
=========================

A small set of scripts to capture JIRA Webhook events and run custom actions (such as sending a notification email to a non JIRA user, or running a command to refresh a HTML mirror of the project)

This project has been forked and is used as base for another setup. As a consequence a number of changes have been made, in particular regarding the configuration. 

#### License

GNU GPL V2

## Installation

Clone the code on your webserver. Start adding actions or using existing ones as described below.

## Email Action

#### Motivation

JIRA does not allow to send different type of emails depending on the project or event. Moreover, the emails can't be send to non JIRA users.

#### Description

This action sends a custom (template) email to an address that is not 
necesserally a JIRA user. 

#### Configuration

###### Events

It is advised to define the events which trigger the action in JIRA itself rather 
than in the PHP configuration (config.php / config.example.php).

In JIRA : 

1. Go to Administration -> System -> WebHooks
2. Click "Create a WebHook"
3. Give it a name. 
4. Add a URL : `http://my.server.com/path/to/JWL/index.php?template=<template_name>`
5. Specify which type of events should trigger the call to the webhook. Feel free to let it blank and to add an event in a workflow.
6. Do not exclude the body.
7. Save

In PHP : 

1. Copy config.example.php to config.php if not already done. 
2. Add a catch-all rule (advised) or a specific rule : 
```
$configuration_array = array (
		'*' => array ( 					// catch-all
				'fireon' => '*',		// catch-all
				'actions' => array (
						'email' => '' 	// no option here
				),
				'ProjectURLBase' => 'http://example.com/jira/projects', // No trailing slash
				'ProjectURLSuffix' => '.html'
		)
)
```
 
###### Email templates
 
When the webhook we just created is called it passes a template name (see above). This template name will be matched to the ones defined in the configuration file `email.action.config.php`. 

To add a new template, copy `email.action.config.example.php` to `email.action.config.php` 
if not already done. Modify the example to your needs. It is made of an array 
of <template_name> => <email_parameters>. Each template must specify the fields: 
from, to, body and subject. In case one wants to send an HTML email the extra field 
`content_type` must be set to "text/html". 

Several JIRA webhooks can use the same templates, they just have to call the URL of the hook with the same parameter `template`. 

## Addition of an action (plugin)

In the folder "actions" copy one of the existing actions and modify it. It is pretty straightforward. Then add a configuration in `config/config.php` to handle it. 

## Debug

One can easily debug the webhooks by adding to the URL called by JIRA the parameter 
`XDEBUG_SESSION_START=ECLIPSE_DBGP` and by installing XDebug on the server as well as Eclipse PDT. 

## Troubleshooting

###### My webhook is not triggered by the workflow, why ? 
Move the post-function that triggers the webhook at the end of the list of post-functions.