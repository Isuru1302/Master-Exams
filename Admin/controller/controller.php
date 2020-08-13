<?php

	require_once('model/dao.php');
	function adminGetSubByID($ID){

		$con = dbConnection();
		$getSubByIDSQL = "SELECT * FROM subcategory WHERE subSubID = '$ID'";
		$GLOBALS['$getSubByIDResults'] =  $con->query($getSubByIDSQL);

	}

	function getMainSubByID($ID){

		$con = dbConnection();
		$getMainSubByIDSQL = "SELECT * FROM subjects WHERE subjectID = '$ID'";
		$GLOBALS['$getMainSubByIDResults'] =  $con->query($getMainSubByIDSQL);

	}

	function getAllMessages(){
		$con = dbConnection();
		$getAllMessagesSQL = "SELECT * FROM messages  ORDER BY messageStatus DESC, messageID DESC";
		$GLOBALS['$getALlMessagesResults'] =  $con->query($getAllMessagesSQL);
	}

	function getUnreadMessages(){
		$con = dbConnection();
		$getUnreadMessagesSQL = "SELECT * FROM messages WHERE messageStatus = 1 ORDER BY messageID DESC LIMIT 0,5";
		$GLOBALS['$getUnreadMessagesResults'] =  $con->query($getUnreadMessagesSQL);

	}

	function getMessageByID($id){
		$con = dbConnection();
		$getMessageByIDSQL = "SELECT * FROM messages WHERE messageID = $id";
		$GLOBALS['$getMessageByIDResults'] =  $con->query($getMessageByIDSQL);
	}

	function getUnreadMessagesCount(){
		$con = dbConnection();
		$getUnreadMessagesCountSQL = "SELECT COUNT(*) AS total FROM messages WHERE messageStatus = 1";
		$rs = $con->query($getUnreadMessagesCountSQL);
		$row = mysqli_fetch_assoc($rs);
		return $row["total"];
	}

	function getALLPapers(){
		$con = dbConnection();
		$getALLPapersSQL = "SELECT * FROM paper p, subjects s,subcategory sc WHERE p.subjectID = s.subjectID AND p.subSubjectID = sc.subSubID ORDER BY p.paperID DeSC";
		$GLOBALS['$getALLPapersResults'] =  $con->query($getALLPapersSQL);
	}

	function adminGetPaperByID($ID){
		$con = dbConnection();
		$getPaperByIDSQL = "SELECT * FROM paper WHERE paperID = '$ID'";
		$GLOBALS['$getPaperByIDResults2'] =  $con->query($getPaperByIDSQL);
	}

	function getALlAvailableSub(){
		$con = dbConnection();
		$getALlAvailableSubSQL = "SELECT * FROM subcategory WHERE subSubStatus =1";
		$GLOBALS['$getALlAvailableSubResults'] =  $con->query($getALlAvailableSubSQL);
	}

	function getALlAvailableMainSub(){
		$con = dbConnection();
		$getALlAvailableMainSubSQL = "SELECT * FROM subjects WHERE subjectStatus =1";
		$GLOBALS['$getALlAvailableMainSubResults'] =  $con->query($getALlAvailableMainSubSQL);
	}

	function getQuestionByPaperID($ID){
		$con = dbConnection();
		$getQuestionByPaperIDSQL = "SELECT * FROM questions WHERE paperID = '$ID'";
		$GLOBALS['$getQuestionByPaperIDResults'] =  $con->query($getQuestionByPaperIDSQL);
	}

	function getQbyQID($ID){
		$con = dbConnection();
		$getQbyQIDSQL = "SELECT * FROM questions WHERE questionID = '$ID'";
		$GLOBALS['$getQbyQIDResults'] =  $con->query($getQbyQIDSQL);
	}

	function getAllAnswers(){
		$con = dbConnection();
		$getAllAnswersSQL = "SELECT * FROM answers  ORDER BY ID DESC";
		$GLOBALS['$getAllAnswersResults'] =  $con->query($getAllAnswersSQL);
	}

	function adgetFaq(){
		$con = dbConnection();
		$adgetFaqSQL = "SELECT * FROM faq";
		$GLOBALS['$adgetFaqResults'] =  $con->query($adgetFaqSQL);
	}


	function mainBanner(){
		$con = dbConnection();
		$mainBannerSQL = "SELECT * FROM mainbanner ORDER BY id DESC";
		$GLOBALS['$mainBannerResults'] =  $con->query($mainBannerSQL);
	}

	function Adver(){
		$con = dbConnection();
		$AdverSQL = "SELECT * FROM adver ORDER BY adID DESC";
		$GLOBALS['$AdverResults'] =  $con->query($AdverSQL);
	}


	

?>