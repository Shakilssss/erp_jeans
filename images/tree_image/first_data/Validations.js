
function isValid(pattern, str)
{
	return pattern.test(str)
}	

//*******************


//************Checking whether some option is selected in the dropdwon****************
function isSelected(obj,text)
{	
	if(obj.value != 0 || obj.value != "")
	{
		return true;
	}
	else
	{	
		alert("Please select an option from the "+text+" field");
		obj.focus();
		return false;
		
	}
}	

function isSelected1(obj,text)
{	
	if(obj.value != 0 || obj.value != "")
	{
		return true;
	}
	else
	{	
	
		alert("Please press F2 to select an option in the "+text+" field");
		obj.focus();
		return false;
		
	}
}	

// ************Empty field validation***********************//
// ************It checks whether the field is empty.
// It returns "true" if it is empty ***********************//

function isEmpty(obj,text)
{ 
  var chkString = obj.value;
  if( (chkString ==null) || (chkString == 0) )
  {
    alert("Please enter "+ text );
	obj.select();
	
      return true;
  }
  else
  {
	return false;
  } 
}
// ************Empty field validation ends here***********************//

function isNotEmptyNotZero(obj,text)
{ 
  var chkString = obj.value;
  if( (chkString ==null))
  {
    alert("Please enter "+ text);
	obj.select();
	
      return true;
  }
  else
  {
	return false;
  } 
}

//****************Numeric Validation*************************//
function isNumeric1(obj,text)
{
  var numericExp = /^[0-9\.]+$/;
  var chkString = obj.value
  var chkLength = chkString.length
  
  if( chkLength > 0 )
  {
		if (isValid(numericExp,chkString))
		 {
				return true;
		 }
		else
		 {
				alert("Please enter numeric value in "+text+" field");
				obj.select();
				return false;
		 }	
  }
  else
  {
	 return true;
  }
 }
//****************It allows only numbers from 0-9 *************************//

function isNumeric(obj,text)
{
  var numericExp = /^[0-9]+$/;
  var chkString = obj.value
  var chkLength = chkString.length
  
  if( chkLength > 0 )
  {
		if (isValid(numericExp,chkString))
		 {
				return true;
		 }
		else
		 {
				alert("Please enter numeric value in "+text+" field");
				obj.select();
				return false;
		 }	
  }
  else
  {
	 return true;
  }
 }
 //****************Numeric Validation ends here*************************//



//****************Currency Validation*************************//

function isCurrency(obj,text)
{
	
  var currencyExp = /^\d+(\.\d{2})?$/;
  var chkString = obj.value
  var chkLength = chkString.length
  
  if( chkLength > 0 )
  {
  		if (isValid(currencyExp,chkString))
		 {
				return true;
		 }
		else
		 {
				alert("Please enter numeric value in "+text+" field");
				obj.select();
				return false;
		 }	
   }
  else
  {
			return true;
  }
 }
 //****************Currency Validation ends here*************************//



//****************Alphabet Validation*************************//
//It allows only English alphabets A-Z, a-z to be printed
//Returns true if alphabet is entered and false  otherwise.


function isAlphabet(obj,text)
{
  var ptn = /^[a-zA-Z\s\.]+$/;
  var chkString = obj.value
  var chkLength = chkString.length
  
   if( chkLength > 0 )
	{	
		if (isValid(ptn,chkString))
		 {
			return true;
		 }
		 else
		 {
			alert("Please enter alphabetic value in "+text+" field");
			obj.select();
			return false;
		 }
	 }
	else
     {
		return true;
     }	
}


//****************Alphabet Validation which also allows ,*************************//
//It allows only English alphabets A-Z, a-z and ,to be printed
//Returns true if alphabet is entered and false  otherwise.


function isAlphabetComma(obj,text)
{
  var ptn = /^[a-zA-Z\s\,\.]+$/;

  var chkString = obj.value
  var chkLength = chkString.length
  
   if( chkLength > 0 )
	{	
		if (isValid(ptn,chkString))
		 {
			return true;
		 }
		 else
		 {
			alert("Please enter alphabetic value in "+text+" field");
			obj.select();
			return false;
		 }
	 }
	else
     {
		return true;
     }	
}



//****************AlphabetswithComma Validation ends here*************************//




//****************AlphaiNumeric Validation*************************//
//It allows only Alphabets A-Z, a-z and numbers 0-9 to be printed


function isAlphaNumeric(obj,text)
{   
	var ptn = /^[A-Za-z0-9\s\.\ \-\_]+$/;
	var chkString = obj.value
  var chkLength = chkString.length
  
  if( chkLength > 0 )
  {
		if (isValid(ptn,chkString))
		 {
				return true;
		 }
		else
		 {
				alert("Please enter alphanumeric value in "+text+" field");
				obj.select();
				return false;
		 }
   }
   else
    {
		return true;
    }	
}
//****************AlphaiNumeric Validation ends here*************************//



//****************E-mail Validation*************************//
function isEmail(obj,text)
{
	var emailexp = /^[a-z][a-z_0-9\.]+@[a-z_0-9\.]+\.[a-z]{3}$/i;
	var chkString = obj.value
	var chkLength = chkString.length
	
 if( chkLength > 0 )
  {	
		if (isValid(emailexp,chkString))
		 {
				return true;
		 }
		else
		 {
			alert("Please enter proper E-Mail ID in "+text+" field");
			obj.select();
			return false;
		  }	
   }
   else
	{
		return true;
	}
}
//****************E-mail Validation ends here*************************//



//****************Phone Number Validation**********************************//

function isPhone(obj,text)
{
	var phoneExp = /^[\d]+[-]*[\d]+$/;
	var chkString = obj.value;
	var chkLength = chkString.length;
	
	 if( chkLength > 0 )
	 {	
		if (isValid(phoneExp,chkString))
		{
			return true;
		}
		else
		{
			alert("Please enter proper phone number in "+text+" field");
			obj.select();
			return false;
		}	
	}
	else
     {
		return true;
     }	
}


//****************Phone Number Validation ends here*************************//

//****************Date Validation*************************//
function isDateSelected(dt,str)
	{
		if(dt.value=="")
		{
			alert(str + " can't be empty");
			dt.focus();
			return false;
		}
	}
	// ************Date Comparision***********************//
	function isDt1GTDt2(dt1,dt2)
	{
		if(dt1 > dt2)
		{
			alert("Starting date shold be less than Ending date")
			return false;
		}

	}


//****************PinCode Validation*************************//

function isPincode(obj,text)
{
	//var zipexp = /^\d{5}$|^\d{5}[\-\s]?\d{4}$/
	var pincodeExp = /^\d{6}$/;
	var chkString = obj.value
	var chkLength = chkString.length
	
 if( chkLength > 0 )
  {
	
		if (isValid(pincodeExp,chkString))
		 {
				return true;
		 }
		else
		 {
				alert("Please enter proper PinCode in "+text+" field");
				obj.select();
		 }
	}
	else
	{
		return true;
	}	
}
//****************PinCode Validation ends here*************************//
//***************alphanumeric with Dot symbol************************//
function isAlphaNumericDot() 
 {        
          var key;
          key=window.event.keyCode;
          if((key>=48 && key<=57)||(key==8)||(key>=97 && key<=122)||(key>=65 && key<=90)||(key==46)||(key==32)) 
            {
            }
           else
              {
                window.event.keyCode=0;
                alert("Enter Alphanumeric Value");               
                return false
              }
        
 }		
//*************************************************************************// 

                                                                                     