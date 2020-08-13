<?php

	require_once('model/dao.php');
	require_once('Bcrypt.php');
	session_start();

	//////////////////////
	/// Login Back End///
	////////////////////

	function confirmEmail($uname,$token){
		$con = dbConnection();
		$status = 0;

		$getTempPWSQL = "SELECT tempPW FROM students WHERE stuUserName = '$uname' ";
		$getTempPWResults =  mysqli_query($con,$getTempPWSQL);
		if($tempPWrow = mysqli_fetch_assoc($getTempPWResults)){
			$getTempPW = $tempPWrow["tempPW"];

			if(empty($tempPWrow["tempPW"]) || $tempPWrow["tempPW"] == ""){
				$status = -1;
			}
			else{
				if(Bcrypt::checkPassword($token, $getTempPW)){
					$status = 1; 
				}else{
					$status = 0;
				}
			}
		}

		return $status;
	}


	function getnewuID($username){
		$uid=0; 
		$con = dbConnection();
		$getnewuIDSQL = "SELECT * FROM students WHERE stuUserName = '$username'";
		$getnewuIDResults = $con->query($getnewuIDSQL);

		if($getPQRow = $getnewuIDResults->fetch_assoc()){
			$uid = $getPQRow["stuID"];
		}
		return $uid;
	}
	

	//////////////////////
	/// Paper Back End///
	////////////////////

	function getAllAvialableSubjects(){
		$con = dbConnection();
		$getSubjectsSQL = "SELECT * FROM subjects WHERE subjectStatus = 1";
		$GLOBALS['$getSubjectsResults'] = $con->query($getSubjectsSQL);
	}
	
	function getAllAvailableSubjectsByID($id){
		$con = dbConnection();
		$getSubjectsByIDSQL = "SELECT * FROM subjects WHERE subjectStatus = 1 ";
		$GLOBALS['$getSubjectsResultsbyID'] = $con->query($getSubjectsByIDSQL);
	}

	function getLatestPapers($limit1,$limit2){
		$con = dbConnection();
		$getLatestPapersSql = "SELECT * FROM paper p, subjects s WHERE s.subjectID = p.subjectID AND p.paperStatus=1 ORDER BY p.paperID DESC LIMIT $limit1,$limit2 ";
		$GLOBALS['$getLatestPapersResults'] = $con->query($getLatestPapersSql);
	}

	function getPaperByID($id){
		$con = dbConnection();
		$getpaperByIDSql = "SELECT * FROM paper p, subjects s WHERE s.subjectID = p.subjectID AND p.paperStatus=1 AND p.subjectID = '$id' ORDER BY p.paperID DESC";
		$GLOBALS['$getPaperByIDResults'] =  $con->query($getpaperByIDSql);
	}

	function getPaperNameByID($id){
		$con = dbConnection();
		$getPaperNameByIDSql = "SELECT * FROM paper WHERE paperID = '$id'";
		$GLOBALS['$getPaperNameByIDResults'] =  $con->query($getPaperNameByIDSql);
	}

	function getPapers(){
		$con = dbConnection();
		$getPapersSql = "SELECT * FROM paper p, subjects s WHERE s.subjectID = p.subjectID AND p.paperStatus=1 ORDER BY p.paperID DESC";
		$GLOBALS['$getPapersResults'] =  $con->query($getPapersSql);
	}

	function getPaperByID2($id1,$id2){
		$con = dbConnection();
		$getpaperByIDSql = "SELECT * FROM paper p, subjects s WHERE s.subjectID = p.subjectID AND p.paperStatus=1 AND p.subjectID = $id1 AND p.subSubjectID =$id2 ORDER BY p.paperID DESC";
		$GLOBALS['$getPaperByIDResults'] =  $con->query($getpaperByIDSql);
	}

	function getAvailableSubCategoriesByID($id){
		$con = dbConnection();
		$getAvailableSubCategoriesByIDSQL = "SELECT * FROM subcategory WHERE subID = $id AND subSubStatus =1 ORDER BY subSubID ASC";
		$GLOBALS['$getAvailableSubCategoriesByIDResults'] =  $con->query($getAvailableSubCategoriesByIDSQL);
	}

	

	//////////////////////
	/// Admin Back End///
	////////////////////

	function getAllStudents(){
		$con = dbConnection();
		$getAllStudentsSQL = "SELECT * FROM students WHERE stuStatus <2 ORDER BY stuID DESC";
		$GLOBALS['$getAllStudentsSQLResults'] =  $con->query($getAllStudentsSQL);
	}

	function getAllAdmings(){
		$con = dbConnection();
		$getAllAdminsSQL = "SELECT * FROM students WHERE stuStatus =2 ORDER BY stuID DESC";
		$GLOBALS['$getAllAdminsSQLResults'] =  $con->query($getAllAdminsSQL);
	}

	function getAllMainCategories(){
		$con = dbConnection();
		$getAllMainCategoriesSQL = "SELECT * FROM subjects ORDER BY subjectID DESC";
		$GLOBALS['$getAllMainCategoriesResults'] =  $con->query($getAllMainCategoriesSQL);
	}

	function getAllSubjects(){
		$con = dbConnection();
		$getAllSubjectsSQL = "SELECT * FROM subjects s,subcategory sc WHERE s.subjectStatus != 0 AND s.subjectID = sc.subID ORDER BY sc.subSubID DESC";
		$GLOBALS['$getAllSubjectsResults'] =  $con->query($getAllSubjectsSQL);
	}



	function getAllInvitations(){
		$con = dbConnection();
		$getAllInvitationsSQL = "SELECT * FROM invitations ORDER BY inviteID DESC";
		$GLOBALS['$getAllInvitationsResults'] =  $con->query($getAllInvitationsSQL);
	}

	function getMainByID($ID){
		$con = dbConnection();
		$getMainByIDSQL = "SELECT subjectName FROM subjects WHERE subjectID = '$ID'";
		$GLOBALS['$getMainByIDResults'] =  $con->query($getMainByIDSQL);
	}

	function getSubByID($ID){
		$con = dbConnection();
		$getSubByIDSQL = "SELECT * FROM subcategory WHERE subSubID = '$ID'";
		$GLOBALS['$getSubByIDResults'] =  $con->query($getSubByIDSQL);
	}

	function checkSubAvailable($subID){
		$status =0;
		$conn = dbConnection();
		$checkSQL = "SELECT * FROM subjects WHERE subjectID ='$subID'";
		$checkSQLResults = mysqli_query($conn,$checkSQL);

		if(mysqli_num_rows($checkSQLResults)>0){
			$status = 1;
		}else{
			$status = 0;
		}
		return $status;
		$conn->close();
	}

	function checkSubCategory($subID){
		$status =0;
		$conn = dbConnection();
		$checkSQL2 = "SELECT * FROM subcategory WHERE subSubID ='$subID'";
		$checkSQL2Results = mysqli_query($conn,$checkSQL2);

		if(mysqli_num_rows($checkSQL2Results)>0){
			$status = 1;
		}else{
			$status = 0;
		}
		return $status;
		$conn->close();
	}

	function getSearchResults($SearchWord){
		$con = dbConnection();
		$getSearchResultsSQL = "SELECT * FROM paper p,subjects s,subcategory sb WHERE p.paperName LIKE '%$SearchWord%' AND p.subjectID=s.subjectID AND p.subSubjectID = sb.subSubID AND p.paperStatus =1 AND s.subjectStatus =1 AND sb.subSubStatus =1";
		$GLOBALS['$getSearchResults'] =  $con->query($getSearchResultsSQL);
	}

	function getRecentDonePapers($ID){
		$con = dbConnection();
		$getRecentDonePapersSQL = "SELECT * FROM answers a,paper p,subjects s,subcategory sb WHERE a.stuID = '$ID' AND a.paperID = p.paperID AND p.subjectID = s.subjectID AND p.subSubjectID = sb.subSubID AND p.paperStatus =1 AND s.subjectStatus =1 AND sb.subSubStatus =1 LIMIT 0,4";
		$GLOBALS['$getRecentDonePapersResults'] =  $con->query($getRecentDonePapersSQL);
	}

	function getAnswerdPapersbyID($ID){
		$con = dbConnection();
		$getAnswerdPapersbyIDSQL = "SELECT * FROM answers a,paper p WHERE a.stuID = '$ID' AND a.paperID = p.paperID ORDER BY a.ID DESC";
		$GLOBALS['$getAnswerdPapersbyIDResults'] =  $con->query($getAnswerdPapersbyIDSQL);
	}

	function getAllAPaperCount(){
		$con = dbConnection();
		$getAllAPaperCountSQL = "SELECT COUNT(*) AS totalP FROM paper WHERE paperStatus =1 ";
		$rs = $con->query($getAllAPaperCountSQL);
		$row = mysqli_fetch_assoc($rs);
		return $row["totalP"];
	}

	function completePapersCount($ID){
		$con = dbConnection();
		$getAllCPaperCountSQL = "SELECT COUNT(*) AS totalC FROM answers WHERE stuID = '$ID'";
		$rs = $con->query($getAllCPaperCountSQL);
		$row = mysqli_fetch_assoc($rs);
		return $row["totalC"];
	}

	function totalMarks($ID){
		$con = dbConnection();
		$getAllMPaperCountSQL = "SELECT SUM(Marks) AS totalM FROM answers WHERE stuID = '$ID'";
		$rs = $con->query($getAllMPaperCountSQL);
		$row = mysqli_fetch_assoc($rs);
		return $row["totalM"];
	}

	function calTotalCompleteQ($ID){
		$con = dbConnection();
		$calTotalCompleteQ = "SELECT COUNT(questionID) AS totalCT FROM questions q,answers a WHERE a.paperID = q.paperID AND a.stuID = '$ID'";
		$rs = $con->query($calTotalCompleteQ);
		$row = mysqli_fetch_assoc($rs);
		return $row["totalCT"];
	}

	function getStuDetails($ID){
		$con = dbConnection();
		$getStuDetailsSQL = "SELECT * FROM students WHERE stuID ='$ID'";
		$GLOBALS['$getStuDetailsResults'] =  $con->query($getStuDetailsSQL);
	}

	function getFaq(){
		$con = dbConnection();
		$getFAQSQL = "SELECT * FROM faq WHERE status =1";
		$GLOBALS['$getFaqResults'] =  $con->query($getFAQSQL);
	}



	/////////////////////
	//////Paper/////////
	///////////////////

	function getpaperQCount($ID){
		$con = dbConnection();
		$getAllAPaperCountSQL = "SELECT COUNT(*) AS totalQ FROM questions WHERE paperID = '$ID' AND questionStatus =1 ";
		$rs = $con->query($getAllAPaperCountSQL);
		$row = mysqli_fetch_assoc($rs);
		return $row["totalQ"];
	}


	function getpaperQuestions($ID,$limit1){
		$con = dbConnection();
		$getpaperQuestionsSQL = "SELECT * FROM questions WHERE paperID = '$ID' AND questionStatus = 1 ORDER BY questionID ASC LIMIT 10 OFFSET $limit1 ";
		$GLOBALS['$getpaperQuestionsResults'] =  $con->query($getpaperQuestionsSQL);
	}

	function getsubImage($pid){
		$con = dbConnection();
		$getsubImageSQL = "SELECT * FROM paper p, subjects s WHERE p.paperID = '$pid' AND p.subjectID = s.subjectID ";
		$GLOBALS['$getsubImageResults'] =  $con->query($getsubImageSQL);
	}
	
	function getmainBanner(){
		$con = dbConnection();
		$getmainBannerSQL = "SELECT * FROM mainbanner WHERE imageStatus = 1 ORDER BY id DESC";
		$GLOBALS['$getmainBannerResults'] =  $con->query($getmainBannerSQL);
	}

	function getAd(){
		$con = dbConnection();
		$getAdSQL = "SELECT * FROM adver WHERE adStatus = 1 ORDER BY adID DESC LIMIT 0,3";
		$GLOBALS['$getAdResults'] =  $con->query($getAdSQL);
	}
?>