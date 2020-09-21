<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>{{ $filename }}</title>
<link rel="shortcut icon" href="{{ $companyinfo->logo }}" />
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/js.js"></script>
<style>
pre span{color:#999999}
pre font{color:blue}
table {
  border-spacing: 0;
  border-collapse: collapse;
}
</style>
<script>
var fileext ='{{ $fileext }}';
function initbody(){
	var hei = winHb()-40;
	$('#lineheihtss').css('height',''+hei+'px');
	$('#content').scroll(scrollss);
	
	$('#content').css('height',''+(hei-10)+'px');
	$('#content').css('width',''+(winWb()-62)+'px');

	var cont = get('content').innerHTML;
	var arr = cont.split("\n"),i,s1='';
	for(i=0;i<arr.length;i++){
		if(i>0)s1+='<br>';
		s1+=''+(i+1)+'';
	}
	$('#lineheiht').html(s1+'<br>&nbsp;');
	
	var sphe = ',php,js,java,';

	if(sphe.indexOf(','+fileext+',')>-1){
		var rNote = /(\/\*(.|\s)*?\*\/)/g;
		var emu		= cont.match(rNote),st1;
		if(emu != null){
			for(i=0;i<emu.length; i++){
				st1=emu[i];
				cont = cont.replace(st1,'<span>'+st1+'</span>');
			}
		}
		get('content').innerHTML=phpjcq(cont,fileext);
	}
	if(fileext=='conf')confini(cont,'#');
	if(fileext=='ini')confini(cont,';');
}
function phpjcq(cont, lx){
	if(lx=='php'){
		var jcz = 'include_once,$_GET,isset,unset,explode,foreach,isempt,if,else,extends,require,public,function,protected,array,return,echo,private,exit,is_numeric,property_exists,this'.split(','),i,reg;
		for(i=0;i<jcz.length;i++){
			reg = new RegExp(jcz[i], 'g');
			cont = cont.replace(reg,'<font>'+jcz[i]+'</font>');
		}
	}
	if(cont.indexOf('\/\/')==-1)return cont;
	var arr = cont.split("\n"),i,s1='',xu,s2;
	for(i=0;i<arr.length;i++){
		if(i>0)s1+='\n';
		s2 = arr[i]
		xu = s2.indexOf('\/\/');
		if(xu>-1 && s2.indexOf(':\/\/')==-1){
			s1+=s2.substr(0, xu)+'<span>'+s2.substr(xu)+'</span>';
		}else{
			s1+=s2;
		}
	}
	return s1;
}
function confini(cont, lx){
	var arr = cont.split("\n"),i,s1='';
	for(i=0;i<arr.length;i++){
		if(i>0)s1+='\n';
		if(arr[i].indexOf(lx)==0 || arr[i].indexOf('    '+lx)==0){
			s1+='<span>'+arr[i]+'</span>';
		}else{
			s1+=arr[i];
		}
	}
	get('content').innerHTML=s1;
	//contenteditable="plaintext-only"
}
function scrollss(){
	get('lineheihtss').scrollTop=get('content').scrollTop;
}
</script>
</head>

<body style="background:white;padding:0px;margin:0px;overflow:hidden">
<table style="width:100%;height:100%" border=0><tr>
<td valign="top" style="background:#e4e4e4;"><div id="lineheihtss" style="width:50px;height:300px;overflow:hidden"><div style="line-height:20px;padding-top:5px;text-align:right;padding-right:3px;font-size:14px" id="lineheiht">1<br>2<br></div></div></td>
<td valign="top" style="width:100%;height:100%;padding:0px">
<div id="contentdiv" style="overflow:hidden;background:#caeccb;">
<pre id="content"  style="height:100%;width:100%;border:0px #aaaaaa solid;background:none;line-height:20px;font-size:14px;overflow:auto;padding:5px;margin:0px;outline:none">{{ $content }}</pre></div>
</td>
</tr>
<tr>
<td></td>
<td style="height:40px;overflow:hidden">

<div ><!--&nbsp;&nbsp;<input type="button" onclick="save(this)" style="border-radius:10px;background-color:#800000" class="webbtn" value="保存">&nbsp;&nbsp;--><span id="msgview">大小：{{ $filesizecn }}，查找请用Ctrl+F</span></div>
</td>
</tr>
</table>


</body>
</html>