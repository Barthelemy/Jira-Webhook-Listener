<?php
/** Jira Webhook Listener
 *
 * A small set of scripts to catch Webhook notifications from JIRA and run custom commands on a per-project basis
 *
 * Copyright (c) 2014 B Tasker
 * Modified by B von Haller (2016)
 * Released under GNU GPL V2, see LICENSE
 *
 * Notification Email Action
 *
 */

defined('_FWLRUN') or die();

class FWLemailAction {
	public function fire($event, $plugin_config, $request, $project_config) {
		$this->request = $request;
		$this->project_config = $project_config;
		$this->plugin_config = $plugin_config;
		$this->template = $_GET [template];
		
		$this->loadPluginConfig();
		
		// check whether the template is available
		if (! isset($this->email_configurations [$this->template])) {
			return;
		}
		
		$this->sendmail($this->email_configurations [$this->template]);
	}
	
	/**
	 * Load the plugin configuration
	 *
	 * TODO
	 */
	private function loadPluginConfig() {
 		require_once 'config/email.action.config.php';
		$this->email_configurations = $email_configurations;
	}
	
	/**
	 * Build an email notification specific to a new issue being raised
	 * @arg email_config - the configuration of the email to send (see email.action.config.php)
	 */
	private function sendmail($email_config) {
		$headers = "From: " . $email_config[from] . "\r\n";
		if(isset($email_config[content_type])) {
			$headers = "Content-Type: " . $email_config[content_type] . "\r\n";
		}
		
		// DEBUG
		$fh = fopen('/tmp/emailacttest.txt', 'w');
		fwrite($fh, $headers . $email_config[subject] . $email_config[body]);
		fclose($fh);
		
		mail($email_config[to], $email_config[subject], $email_config[body], $headers);
	}
}