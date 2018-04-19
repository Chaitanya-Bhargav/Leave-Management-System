function passwordOnfocus()
{
	let name=document.getElementById("name").value;
	if(name=="")
	{
		document.getElementById("errName").innerHTML="<font color='red'>Please enter username</font>";
		document.getElementById("name").focus();
		return false;
	}
	else
	{
		document.getElementById("errName").innerHTML="";
		return true;
	}
}
function adminLoginvalid()
{
	let pwd=document.getElementById("pwd").value;
	if(pwd=="")
	{
		document.getElementById("errPwd").innerHTML="<font color='red'>Please enter password</font>";
		document.getElementById("pwd").focus();
		return false;
	}
	else
	{
		document.getElementById("errName").innerHTML="";
		document.getElementById("errPwd").innerHTML="";
		return true;
	}	
	
}
		