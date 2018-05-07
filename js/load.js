
//只有主页面调用次函数，判断是否从detail页面返回，是则加载cookie并且显示最新结果
window.onload = function(){
	var linkParameter = window.location.search;
	if(linkParameter != "")
	{
		var inputSave = document.cookie.split(",")[0].split("=")[1];
		var radioSave = document.cookie.split(",")[1];
		$("#searchInput").val(inputSave);
		$("input[value=" + radioSave + "]").attr("checked","checked");
		validation();
	}		
}