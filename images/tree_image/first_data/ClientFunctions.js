/*
***************************************************
File Name:ClientFunctions.js
Developed on: 23rd September 2003
Author: M.Satish Kumar
***************************************************
*/

/*
Function Name:funDelRow
Return type:true/false
Function for Marking The Rows For Deletion
Arguments:
Argument 1 --> Obj:this
Argument 2 -->tblId: id of the table for which row is to be deleted
*/


function funDelRow(obj,tblId)
{
var retval;
retval=true;
		obj1=obj;
		while (obj.tagName !=  'TR')
			{
				obj = obj.parentNode;
			}	
				var lRowNumber = obj.rowIndex;
				
				if(lRowNumber==1)
					{
					retval=false;
					
					}
					else
					{
						if(tblId.rows[lRowNumber].bgColor=="#ff0000")
						{
							if((lRowNumber%2)==0)
								{
									tblId.rows[lRowNumber].bgColor="#D3D3D3";
								}
							else
								{
									tblId.rows[lRowNumber].bgColor="#F5F5F5";
								}	
						}
					else
						{
							tblId.rows[lRowNumber].bgColor="#ff0000";
						}	
					}
return retval;
}

/* Function for Adding Rows to Table Dynamically

 Function Should be called in Keydown event
 Adds a row to the Table On pressing Enter Key
 Deletes a row of the table on pressing Del Key

Add hidden field Hrowcount for holding number of rows

Arguments:
Argument 1 --> Obj:this
Argument 2 -->tblId: id of the table for which row is to be added.
Argument 3 -->hfld : hidden field id  [Hidden for holding number of rows]
Example:The Table on Which this function is to be applied should have
a Heading row which contains column headings and a row with controls.
The second row is treated as template for dynamically creating other rows.

Example  :
onKeydown=addRow(this,tblTypofInv,'hRowcount')
argument1:this
argument2: tblTypofInv
argument3:hRowcount

*/

function addRow(obj,tblId,hfld)
{
	//Display help Message on the status bar
//alert("Checking");
	window.status="Press Enter Key To Add a Row/Delete Key to Delete a Row";
	var newRow,newCell,rowCount;
		//Code to Delete a Cell 46-Delete key Code	
	var retFlag;
	if (event.keyCode==46)
	{
	retFlag=funDelRow(obj,tblId)
	var numOfRows,conform;
		numOfRows=tblId.rows.length;
					for(var i=0;i<tblId.rows.length;i++)
						{
						if (retFlag==false)
						{
						alert("First Row Cannot Be Deleted!!!");
						break;
						}
							if(tblId.rows[i].bgColor=="#ff0000")
								{
								conform=window.confirm("Are U Sure You want Delete the selected Row"+""+i);	
									if(conform==true)
									{
									tblId.deleteRow(i);
										i--;
										
										for(rowcnt=2;rowcnt<tblId.rows.length;rowcnt++)
										{
											for(x=0;x<tblId.rows(rowcnt).cells.length;x++)
												{		
												tblId.rows(rowcnt).cells(x).firstChild.name=tblId.rows(1).cells(x).firstChild.name+rowcnt;
												}		
										}
												
									}	
									else
									{
									tblId.rows[i].bgColor="#ffffff";
									}
								}					
						}
								
		document.getElementById(hfld).value--;
	}
if(event.keyCode==13)
	{
		while (obj.tagName!='TR')
			{
				var obj = obj.parentNode;
			}	
			var lRowNumber = obj.rowIndex;
			 rowCount=tblId.rows.length;
			 var rowCount1=rowCount-1;    
			 
			if(lRowNumber<rowCount1)
				{
				newRow=tblId.insertRow(rowCount);
						for(x=0;x<tblId.rows(1).cells.length;x++)
						{		newCell=newRow.insertCell(x);
								newCell.vAlign="top";
								newCell.innerHTML=tblId.rows(1).cells(x).innerHTML;
							newCell.firstChild.id=newCell.firstChild.id+ newRow.rowIndex
							newCell.firstChild.name=newCell.firstChild.name+ newRow.rowIndex
						//alert(newCell.firstChild.name)
							newCell.firstChild.value="";
						}		
						for(var i=tblId.rows.length-1;i>lRowNumber+1;i--)
						{
							tblId.moveRow(i-1,i);
						}				
													
				}
				else
					{
						lRowNumber=lRowNumber+1;			
						newRow=tblId.insertRow(lRowNumber);
						for(x=0;x<tblId.rows(1).cells.length;x++)
						{
							newCell=newRow.insertCell(x);
							newCell.vAlign="top";
							newCell.innerHTML=tblId.rows(1).cells(x).innerHTML;
							newCell.firstChild.id=newCell.firstChild.id+ newRow.rowIndex
							newCell.firstChild.name=newCell.firstChild.name+ newRow.rowIndex
						//	alert(newCell.firstChild.name)
							newCell.firstChild.value="";
						}
					}	
document.getElementById(hfld).value++;											
	}
}

/* Function for Displaying Help Messages on the window Status bar
Arguments:
Argument 1 --> arg1 : 
			It Takes two values :- 0--> For Displaying Message to Call Help File
								   1--> For Displaying Message to Add or Delete a Row
Argument 2 --> arg2 : This argument can be used to display Details of Help.				   
				
Example:
To Call Help file for list of Employees the function can be called 
as : showStatus(0,"Employees")
To add or Delete a Row :
showStatus(1,"")
*/


function showStatus(arg1,arg2)
{
if(arg1==0)
{
window.status="Press F2 key To Get List of "+arg2;
}
else
{
window.status="Press Enter Key To Add a Row/Delete Key to Delete a Row";
}

}

/* Function for Clearing the window Status bar
*/

function clearStatus()
{
window.status="";
}

function delRow(obj,tblId,hfld)
{
//Display help Message on the status bar
	
	window.status="Press Delete Key to Delete a Row";
	var newRow,newCell,rowCount;
	
	//Code to Delete a Cell 46-Delete key Code	
	
	var retFlag;
	if (event.keyCode==46)
	{
	retFlag=funDelRow(obj,tblId)
	var numOfRows,conform;
		numOfRows=tblId.rows.length;
					for(var i=0;i<tblId.rows.length;i++)
						{
							if (retFlag==false)
							{
							alert("First Row Cannot Be Deleted!!!");
							break;
							}
							
							if(tblId.rows[i].bgColor=="#ff0000")
								{
								
									conform=window.confirm("Are U Sure You want Delete the selected Row"+""+i);	
										if(conform==true)
										{
											tblId.deleteRow(i);
											i--;
													
										}	
										else
										{
										tblId.rows[i].bgColor="#ffffff";
										}
								}					
						}
								
		document.getElementById(hfld).value--;
	
	}
}


/*
Function Name:funPrint
Return type:

Usage: Function for Printing 

Arguments:
Argument 1 --> argfile:name of the Text file 
Argument 2 --> argUser:UserName
Argument 3 --> argLoc:Shared Print Folder Name 
Example funPrintPreview("Sample","admin","PrintFolder")
Sample-->FileName
admin-->Username
PrintFolder-->Shared Folder Name

*/

function funPrint(argfileName,argUser,argLoc)
{	
	
	var fileName,filePath,loc,t2
	filePath=argLoc+"\\"+argfileName+argUser
	loc=new String(window.document.location)
	t2=loc.split("/")
	fileName="\\"+"\\"+t2[2]+"\\"+filePath+".txt"
	//fileName="c:"+"\\"+filePath+".txt"
	var oShell,exitcode,regpath
	oShell=new ActiveXObject("WScript.Shell")
	regpath="print " + fileName	
	var msg
	msg=window.confirm("Are you sure you want to print the report?")
	if(msg==true)
	{
		exitcode = oShell.Run(regpath);
	}
}


/*
Function Name:funPrintPreview
Return type:true/false
Usage : Function for Print Preview
Arguments:
Argument 1 --> argfile:name of the Text file 
Argument 2 --> argUser:UserName 
Argument 3 --> argLoc:Shared Folder Name
Example funPrintPreview("Sample","admin","PrintFolder")
Sample-->FileName
admin-->Username
PrintFolder-->Shared Folder Name
*/

function funPrintPreview(argfileName,argUser,argLoc)
{

	var fileName,filePath,loc,t2;
	filePath=argLoc+"\\"+argfileName+argUser
	loc=new String(window.document.location)
	t2=loc.split("/")
	fileName="\\"+"\\"+t2[2]+"\\"+filePath+".txt"
    //fileName="c:"+"\\"+filePath+".txt"
	var oShell,exitcode,regpath
	oShell=new ActiveXObject("WScript.Shell")
	regpath=fileName
	oShell.Run(regpath)
}


/*
Function Name:funGetFile
Return type:true/false
Usage : Function for geting file
Arguments:
Argument 1 --> argfile:name of the Text file 
Argument 2 --> argUser:UserName 
Argument 3 --> argLoc:Shared Folder Name
Example funGetFile("Sample","admin","PrintFolder")
Sample-->FileName
admin-->Username
PrintFolder-->Shared Folder Name
*/
function  funGetFile(argfileName,argUser,argLoc)
 {
   
    var fileName,filePath,loc,t2;
    filePath=argLoc+"\\"+argfileName+argUser
         loc=new String(window.document.location)
	t2=loc.split("/")
	fileName="\\"+"\\"+t2[2]+"\\"+filePath+".txt"
	
       //fileName="c:"+"\\"+filePath+".txt"
	var oShell,exitcode,regpath
	oShell=new ActiveXObject("WScript.Shell")
	regpath=fileName
	oShell.Run(regpath)
}

                                                                                     