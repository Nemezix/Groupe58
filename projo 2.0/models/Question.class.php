<?php

class Question{
	
	public $questionid;
	public $title;
	public $subject;
	public $categoryid;
	public $ownerid;
	public $creationdate;
	public $state;
	public $likes;

	public function __construct($questionid, $title, $subject, $categoryid, $ownerid, $creationdate, $state, $likes){
		
		$this->questionid = $questionid;
		$this->title = $title;
		$this->subject = $subject;
		$this->categoryid = $categoryid;
		$this->ownerid = $ownerid;
		$this->creationdate = $creationdate;
		$this->state = $state;
		$this->likes = $likes;
	}

	public function setTitle($title){
		$this->title = $title;
		return $this->title;
	}

	public function setSubject($subject){
		$this->subject = $subject;
		return $this->subject;
	}

	public function setCategory($categoryid){
		$this->categoryid = $categoryid;
		return $this->categoryid;
	}

	public function setState($state){
		$this->state = $state;
		return $this->state;
	}

	public function likesInc(){
		$this->likes = $this->likes++;
		return $this->likes;
	}

	public function likesDec(){
		$this->likes = $this->likes--;
		return $this->likes;
	}

	#getters
	public function getQuestionid(){
		return $this->questionid;
	}
	public function getTitle(){
		return $this->title;
	}
	public function getSubject(){
		return $this->subject;
	}
	

}