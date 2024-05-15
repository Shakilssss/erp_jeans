<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>MSH ERP Login</title>
<style type="text/css">
  html {
    background: url("<?=base_url('images/mn.jpg')?>");
}

input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=password], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=submit] {
  width: 100%;
  background-color: #427d44;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;}


  div.transbox {
  margin: 50px auto;
  background-color:rgb(216 167 66 / 30%);
  border: 1px solid black;
  border-color: #9c950b;
  width: 400px;
  padding-bottom: 0px;

}

</style>
</head>

<body>
  <!-- <div align="right" style="font-size: 20px; font-weight: bold;"><a href="<?php echo base_url() ?>images/erp_um.pdf" target="_blank">User Manual</a></div> -->
 <div class="transbox" align="right">
<div align="center" style="padding:15px; "> <img src="<?php echo base_url();?>images/mysoft-logo.png" /> <br>
<h2 style="color:red; margin: 0px; padding: 0px; text-align: center; margin: 9px;">Mysoftheaven ERP Systems</h2>

     <?php  echo form_open('user_autentication');  ?>
        <table width="380" border="0" align="center" cellpadding="0" cellspacing="5">
          <tr>
            <td style="color: black; font-size:20px;"><b>Username :</b></td>
           <tr> <td><input type="text" name="username" value="" /></td></tr>
          </tr>
          <tr>
            <td colspan="2"></td>
          </tr>
          <tr>
            <td style="color: black; font-size:20px;"><b>Password :</b></td>
           <tr>
            <td><input type="password" name="password" value="" /></td></tr>
          </tr>
      
      <tr>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td colspan="2"></td>
          </tr>
          <tr>
            
            <td align="center"><input style ="font-size:20px; font-weight: bolder;" type="submit" name="login" value="Login" /></td>
           
          </tr>
        </table>

      </form>

</div>

<div align="center">
<p style="font-size: 15px;font-weight: 800;background-color:rgba(192,192,192,0.6);padding: 10px;
  margin-bottom: 0px !important;">Phone : +88-02-55020230, +88-02-58154393 <br> Cell : +88-01970-776609</p> 
</div>
</div>
</body>
</html>