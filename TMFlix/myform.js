//myform.js
function validateform()
{
  if(document.myform.username.value == "")
  {
   alert("Please enter username!");
   document.myform.username.focus();
   return false;
  }
  
  if(document.myform.phone.value == "")
  {
   alert("Please enter the phone!");
   document.myform.phone.focus();
   return false;
  }

  if(document.myform.email.value == "")
  {
   alert("Please enter the email!");
   document.myform.email.focus();
   return false;
  }

  if(document.myform.password.value == "")
  {
   alert("Please enter the password!");
   document.myform.password.focus();
   return false;
  }
  
  if(document.myform.package.value == "")
  {
   alert("Please enter the package!");
   document.myform.package.focus();
   return false;
  }
}