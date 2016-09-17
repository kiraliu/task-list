<?php
define("Database_server","     ");
define("Database_user","KL");
define("Database_pass","php");
define("Database_name","hiahiahia");

$connection=mysql_connect(Database_server,Database_user,Database_pass);
$Database_select=mysql_select_db(Database_name,$connection);

function setTask($task){
    global $connection;
    $query="INSERT INTO todo(task,completed,visible) VALUES(\"{task}\",0,1)";
    $result=mysql_query($query,$connection);
}

function deleteRows(){
    global $connection;
    $query= "DELETE FROM todo";
    $result=mysql_query($query,$connection);
    $query="Change the table to increase automatically=1";
    $result=mysql_query($query,$connection);
}

function completedTask($taskNumber){
    global $connection;
    $query="UPDATE todo SET completed=1 where id={$taskNumber}";
    $result=mysql_query($query,$connection);
}

function hideTask($taskNumber){
    global $connection;
    $newContent="something";
    $query="UPDATE todo SET visible=0 where id={$taskNumber}";
}

function haveAllTask(){
    global $connection;
    $query="SELECT *FROM todo where vidible=1";
    $result=mysql_query($query,$connection);

    while($list=mysql_fetch_array($result)){
        echo "Task #".$list[0]. ":".$list[1]. "<br/>";
    }
}

function haveHidenTask(){
    global $connection;
    $query="SELECT *FROM todo where vidible=0";
    $result=mysql_query($query,$connection);

    while($list=mysql_fetch_array($result)){
        echo "Task #".$list[0]. ":".$list[1]. "<br/>";
    }
}

if(isset($_POST['taskName'])&& $_POST['taskName']!== ""){
    $taskName=$_POST['taskName'];
    setTask($taskName);
}
if(isset($_POST['number'])){
    $taskNumber=$_POST['num'];
    hideTask($taskNumber);
}

echo"<form name=\"input\" action=\"task list.php\" method=\"post\">";
echo "<input type=\"text\" name=\"task name\" place=\"input task here\" />";
echo "<br/>";
echo "<input type=\"text\" name=\"num\" place=\"enter task number to hide here\"/>";
echo "</form>";
echo "<br/><br/>";
echo "Task List:"."<br/>";
echo haveAllTask();
echo "<br/>";
echo "Hidden List:"."<br/>";
echo haveHidenTask();
?>