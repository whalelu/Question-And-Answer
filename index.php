<!DOCTYPE HTML>
<html>
<head>
	<title>Question and Answer</title>
	<link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
	<br>
	<h1>Question and Answer</h1>
	<br><br>
	<div class="searchDiv">
		<input type="text" name="searchInput" id="searchInput" placeholder="Please type in at most 3 key words" maxlength="60">
		<button id="searchButton">Search</button>
	</div>
	<p id="errorMessage"></p>
	<div class="searchRadio">
		<span>Answered Yet?</span>
		<input type="radio" name="answeredYet" value="yes" checked>Yes
		<input type="radio" name="answeredYet" value="no">No
		<input type="radio" name="answeredYet" value="all">All
	</div>
	<br><br>
	<hr id="cuttingLine">
	<br><br>
	<div class="AskandEdit">
		<button id="askButton">Ask</button>
		<button id="editButton">Edit</button>
	</div>
	<br>
	<div id="searchResult" class="container">
		
	</div>

	<script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/load.js"></script>
</body>
</html>
