$(document).ready(function(){
	$("#cancelQ").click(function(){ backHome() });
	$("#askButton").click(function(){ jumpAsk() });
	$("#searchButton").click(function(){ validation() });
	$("#askInput").keyup(function(){ checkInput()} );
	$("#askInput").keydown(function(){ checkInput()} );
    $(".upButton").click(function(){ scoreUp(this) });
    $(".downButton").click(function(){ scoreDown(this) });
    $("#editButton").click(function(){ changeHandler() });
    $("#cancelEdit").click(function(){ cancelEdit() });
    $("#deleteButton").click(function(){ deleteFromDetail() });
    $("#backButton").click(function(){ deleteBack() });
    $("#answerButton").click(function(){ answerQuestion() });
});

//全局变量，用来记录搜索结果的数量，以此生成checkbox
var resultLength;
var questionChoice = new Array();

//剩余字符个数
function checkInput(){
	$("#num").text(500-$("#askInput").val().length);
}

//ask页面返回主页
function backHome(){
	if(confirm("Whether to discard the current content of the input field?"))
	{
		window.location.href='index.php';
	}
	else
		return false;
}

//跳转到ask页面，附带is_ask参数判断是ask还是answer
function jumpAsk(){
	window.location.href = 'ask.php?is_ask=1';
}

//合法则执行search
function validation(){
	var reg = /^[0-9a-zA-Z ]+$/;
	var cont = $("#searchInput").val();
	$("#errorMessage").text("");
	$("#searchResult").html("");
	if(!reg.test(cont) && cont!="")
	{
		$("#errorMessage").text("Contains illegal characters! Only letters,digits and blanks are permitted.");
	}
	else
	{
		search(cont);
	}
}


function search(cont)
{
	//获取关键字
	var keyWords = cont.split(" ");
	
	//生成cookie
	var message1 = cont;
	var message2 = $('input:radio:checked').val()
	var str = message1 + ',' + message2;
	document.cookie="message="+str;

	
	//-1代表radio为all
	if($('input:radio:checked').val() == 'yes')
		var radio = 1;
	else if($('input:radio:checked').val() == 'no')
		var radio = 0;
	else
		var radio = -1;
	
	$.ajax({
		type:"POST",
		url:'database/searchQuestion.php',
		data:{
			"searchCondition":keyWords,
			"searchRadio":radio
		},
		dataType:"json",
		
		//查询失败
		error: function(){   
                 $("#searchResult").html("<h4>No Matching Questions!</h4>");   
             },   
		
		//成功则生成表格
		success: function(data){
			var createTable = "";
			createTable += "<table class='table table-bordered'>"
			resultLength = data.length;
			for(var i=0; i<data.length; i++)
			{
				questionChoice[i] = data[i].pk_questions;
				
				//回答与否图标
				if(data[i].is_answered == 1)
					var answerIcon = 'glyphicon glyphicon-ok-sign';
				else
					var answerIcon = 'glyphicon glyphicon-question-sign';

				//动态生成 
				//第一列序号的id为问题的主码，用来生成checkbox和唯一的value
				//第二列链接通过链接末尾添加id参数，即问题的主码，detail界面通过此参数决定显示的问题
				//第三列class设置为小屏幕隐藏
				//第四列为回答与否图标
				createTable += "<tr><td class='col-sm-1' id='question"+ data[i].pk_questions + "'>#" + (i+1) + 
				"</td><td class='col-sm-7'><div class='link' title='"+ data[i].question +"'><a href='detail.php?id=" + 
				data[i].pk_questions + "'>" + data[i].question + "</a></td><td class='hidden-xs'>" + data[i].createTime + 
				"</td><td class='col-sm-1'><span class='"+ answerIcon + "'></span</td></tr>";
			}
			createTable += "</table>";
			$("#searchResult").html(createTable);
		}
	});
}

//回答加分，通过id区分当前选择了哪个回答，ajax更新数据库并通过返回的data更新score
function scoreUp(obj)
{
	var currentButtonId = $(obj).attr("id");
	var currentAnswerId = "answer" + currentButtonId.charAt(currentButtonId.length - 1);
	var currentAnswer = $("#" + currentAnswerId).text();
	var is_increase = 1;
	$.ajax({
		type:"POST",
		url:"database/scoreChange.php",
		data:{"currentAnswer":currentAnswer,
		      "is_increase":is_increase
	    },
		dataType:"json",
		error: function(){
			alert("ERROR!");
		},
		success: function(data){
			$("#score"+ currentButtonId.charAt(currentButtonId.length - 1)).text(data[0]);
		}
	});
}

//回答扣分，同上
function scoreDown(obj)
{
	var currentButtonId = $(obj).attr("id");
	var currentAnswerId = "answer" + currentButtonId.charAt(currentButtonId.length - 1);
	var currentAnswer = $("#" + currentAnswerId).text();
	var is_increase = 0;
	$.ajax({
		type:"POST",
		url:"database/scoreChange.php",
		data:{"currentAnswer":currentAnswer,
		      "is_increase":is_increase
	    },
		dataType:"json",
		error: function(){
			alert("ERROR!");
		},
		success: function(data){
			$("#score"+ currentButtonId.charAt(currentButtonId.length - 1)).text(data[0]);
		}
	});
}

//点击edit按钮，更换按钮名称和对应的handler，首列变为checkbox
function changeHandler()
{
	$("#askButton").text("Cancel");
	$("#askButton").unbind();
	$("#askButton").click(function(){ cancelEdit() });
	$("#editButton").text("Delete");
	$("#editButton").unbind();
	$("#editButton").click(function(){ deleteQuestion() });
	for(var i=0; i<resultLength; i++)
	{
		$("#question" + questionChoice[i]).html("<input type = 'checkbox' value = '"+ questionChoice[i] +"'>");
	}
}

//返回原来的ask和edit
function cancelEdit()
{
	$("#askButton").text("Ask");
	$("#askButton").unbind();
	$("#askButton").click(function(){ jumpAsk() });
	$("#editButton").text("Edit");
	$("#editButton").unbind();
	$("#editButton").click(function(){ changeHandler() });
	for(var i=0; i<resultLength; i++)
	{
		$("#question" + questionChoice[i]).html("#" + (i+1));
	}
}

//通过checkbox删除问题，ajax更新数据库
function deleteQuestion()
{
	if($("input:checkbox:checked").attr("value") == null)
		alert("Choose one question at least !");
	else
	{
		if(confirm("Are you sure you want to delete these questions?"))
		{
			$("input:checkbox:checked").each(function(){
				var questionID = $(this).attr("value");
				$.ajax({
					type:"POST",
					url:"database/deleteQuestion.php",
					data:{"questionID":questionID},
					error: function(){
						alert("ERROR!");
					},
					success: function(){				
					}
				});
			})
			validation();
			$("#askButton").text("Ask");
			$("#askButton").unbind();
			$("#askButton").click(function(){ jumpAsk() });
			$("#editButton").text("Edit");
			$("#editButton").unbind();
			$("#editButton").click(function(){ changeHandler() });
		}
	}	
}

//从detail界面删除
function deleteFromDetail()
{
	if(confirm("Are you sure you want to delete the question and its answers?"))
	{
		var linkParameter = window.location.search;
		var questionID = linkParameter.substring(linkParameter.lastIndexOf('=')+1, linkParameter.length);
		$.ajax({
			type:"POST",
			url:"database/deleteQuestion.php",
			data:{"questionID":questionID},
			error: function(){
				alert("ERROR!");
			},
			//返回index，并且标记
			success: function(){
				window.location.href='index.php?mark';
			}
		});
	}
}

//detail页面的返回
function deleteBack()
{
	window.location.href='index.php';
}

//回答问题，is_ask = 0
function answerQuestion()
{
	var linkParameter = window.location.search;
	var questionID = linkParameter.substring(linkParameter.lastIndexOf('=')+1, linkParameter.length);
	window.location.href="ask.php?is_ask=0&id="+ questionID ;
}



