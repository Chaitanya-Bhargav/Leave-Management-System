function nameValidation()
{      
	let id=document.getElementById("eid").value;
	if(id=="")
    {
        document.getElementById("textMessageEid").innerHTML="<font color='red'>Please Enter your Id</font>";
        document.getElementById("eid").focus();
        return false;
    }
    if(id!="")
    {
        document.getElementById("textMessageEid").innerHTML="";
        return true;
    }
}
function teamleadValidation()
{      
	let name=document.getElementById("ename").value;
	if(name=="")
    {
        document.getElementById("textMessageEname").innerHTML="<font color='red'>Please Enter your name</font>";
        document.getElementById("ename").focus();
        return false;
    }
    if(name!="")
    {
        document.getElementById("textMessageEname").innerHTML="";
        return true;
    }
}
function teamnameValidation()
{   
	let tlead=document.getElementById("teamLead").value;
	if(tlead=="")
    {
        document.getElementById("textMessageLead").innerHTML="<font color='red'>Please Enter the Team lead</font>";
        document.getElementById("teamLead").focus();
        return false;
    }
    if(tlead!="")
    {
        document.getElementById("textMessageLead").innerHTML="";
        return true;
    }
}

function leavetypeValidation()
{   
	let tname=document.getElementById("teamName").value;
	if(tname=="")
    {
        document.getElementById("textMessageTeam").innerHTML="<font color='red'>Please Select Team Name</font>";
        document.getElementById("teamName").focus();
        return false;
    }
    if(tname!="")
    {
        document.getElementById("textMessageTeam").innerHTML="";
        return true;
    }
}
function descriptionValidation()
{   
	let ltype=document.getElementById("ltype").value;
	if(ltype=="")
    {
        document.getElementById("textMessageLeaveType").innerHTML="<font color='red'>Please Select Leave Type</font>";
        document.getElementById("ltype").focus();
        return false;
    }
    if(ltype!="")
    {
        document.getElementById("textMessageLeaveType").innerHTML="";
        return true;
    }
}
function fdateValidation()
{   
	let desc=document.getElementById("description").value;
	if(desc=="")
    {
        document.getElementById("textMessageReason").innerHTML="<font color='red'>Please Enter the description</font>";
        document.getElementById("description").focus();
        return false;
    }
    if(desc!="")
    {
        document.getElementById("textMessageReason").innerHTML="";
        return true;
    }
}
function tdateValidation()
{   
	let fdate=document.getElementById("fdate").value;
	if(fdate=="")
    {
        document.getElementById("textMessagefDate").innerHTML="<font color='red'>Please enter the From date</font>";
        document.getElementById("fdate").focus();
        return false;
    }
    if(fdate!="")
    {
        document.getElementById("textMessagefDate").innerHTML="";
        return true;
    }
}

function submitValidation()
{
	let id=document.getElementById("eid").value;
	let name=document.getElementById("ename").value;
	let tlead=document.getElementById("teamLead").value;
	let tname=document.getElementById("teamName").value;
	let ltype=document.getElementById("ltype").value;
	let desc=document.getElementById("description").value;
	let fdate=document.getElementById("fdate").value;
	let tdate=document.getElementById("tdate").value;
	if(tdate=="")
    {
        document.getElementById("textMessagetDate").innerHTML="<font color='red'>Please enter the To date</font>";
        document.getElementById("tdate").focus();
        return false;
    }
    if(tdate!="")
    {
        if(fdate>tdate)
        {
            document.getElementById("textMessagetDate").innerHTML="<font color='red'>invalid</font>";
            document.getElementById("fdate").focus();
			return false;
        }
        
	}
	if(id!=""&& name!=""&& tlead!=""&& tname!=""&& ltype!="" &&desc!=""&& fdate!="" &&tdate!="")
    {
        document.getElementById("displayName").innerHTML=name;
        document.getElementById("nameBelowRegards").innerHTML=name;
		if(fdate==tdate)
		{
			document.getElementById("singledate").innerHTML="on";
			document.getElementById("displayTo").innerHTML=tdate;	
		}
		else
		{	
            document.getElementById("displayFrom").innerHTML=fdate;
            document.getElementById("displayTo").innerHTML=tdate;
		}
            document.getElementById("displayReason").innerHTML=desc;
            document.getElementById("confirmMessage").style.display="block";
            return false;
    }
}
function clickcancle()
{
    document.getElementById("confirmMessage").style.display="none";
    return false;
}