<?php
/** Jira Webhook Listener
*
* A small set of scripts to catch Webhook notifications from JIRA and run custom commands on a per-project basis
*
* Copyright (c) 2014 B Tasker
* Modified by B von Haller (2016)
* Released under GNU GPL V2, see LICENSE
*
* Class for JIRA request handling.
*/

defined('_FWLRUN') or die;


class JWLRequest{

	private $request = false;
	private $request_type = false;

	function __construct(){
	      $this->loadRequest(); // Process the request data
	}

	/** 
	* Parse the JSON we should have received in POST
	*/
	function loadRequest(){

	      $str = file_get_contents('php://input');

	      if (!empty($str)){
		    $this->request = json_decode($str);
		    $this->request_type = $this->request->webhookEvent;  
		    return true;
	      }

	      return false;
	}

	function getIssueObj(){
	    return $this->request->issue;
	}

	function getIssueKey(){
	    return $this->request->issue->key;
	}

	function getIssueProject(){
	    return $this->request->issue->fields->project->key;
	}

	function getIssueTitle(){
	      return $this->request->issue->fields->summary;
	}
	function getIssueSummary(){
		return getIssueTitle();
	}

	function getIssueType(){
	    $type = $this->request->issue->fields->issuetype->name;
	    if ($this->request->issue->fields->issuetype->subtask){
		  $type .= ' Subtask';
	    }
	    return $type;
	}

	function getIssueDescription(){
	     return $this->request->issue->fields->description;
	}
	
	function getIssueReporter(){
		return $this->request->issue->fields->reporter->displayName;
	}
	
	function getIssueAssignee(){
		return $this->request->issue->fields->assignee->displayName;
	}
	
	function getIssueCreated(){
		return $this->request->issue->fields->created;
	}
	
	function getIssueResolved(){
		return $this->request->issue->fields->resolved;
	}

	function getCommentBody() {
		return $this->request->comment->body;
	}
	
	function getCommentId() {
		return $this->request->comment->id;
	}

	function getCommentAuthor() {
	  return $this->request->comment->author->displayName;
	}
	
	function getCommentCreated() {
		return $this->request->comment->created;
	}
	
	function getCommentUrl() {
		// https://alice.its.cern.ch/jira/rest/api/2/issue/46609/comment/201903
		// https://alice.its.cern.ch/jira/browse/DATE-343?focusedCommentId=201904&page=com.atlassian.jira.plugin.system.issuetabpanels:comment-tabpanel#comment-201904
		// first part  + browse + issue_key + blabla + comment_id + blabla + comment_id
		$pieces = explode("/rest/api", $this->request->comment->self);
		$url = $pieces[0] . "/browse/" . $_GET["issue_key"] . "?focusedCommentId=" . $this->getCommentId() . "&page=com.atlassian.jira.plugin.system.issuetabpanels:comment-tabpanel#comment-" . $this->getCommentId();
		return $url;
	}
	

	/** 
	* Get the request object
	*/
	function getRequest(){
	      return $this->request;
	}


	/** 
	* Get the event type
	*/
	function getRequestType(){
	      return $this->request_type;
	}
}
