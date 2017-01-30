function CreateTimer(e,t){
	Timer=document.getElementById(e);
	//if(Cookies.get('time')==undefined){
		TotalSeconds=t;
	//} else {
		//TotalSeconds=Cookies.get("time");
	//}
	UpdateTimer();
	window.setTimeout("Tick()",1e3);
}
function Tick(){
	if(TotalSeconds<=0){
		//Cookies.remove("time");
		window.form.submit();
		return true;
	}
	TotalSeconds-=1;
	UpdateTimer();
	window.setTimeout("Tick()",1e3)
}
function UpdateTimer(){
	var e=TotalSeconds;
	var t=Math.floor(e/86400);
	e-=t*86400;
	var n=Math.floor(e/3600);
	e-=n*3600;
	var r=Math.floor(e/60);
	e-=r*60;
	var i=(t>0?t+" days ":"")+LeadingZero(n)+":"+LeadingZero(r)+":"+LeadingZero(e);
	Timer.innerHTML=i;
	//Cookies.set("time", TotalSeconds);
}
function LeadingZero(e){
	return e<10?"0"+e:+e
}
var Timer;var TotalSeconds