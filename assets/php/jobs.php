<?
include("DB.php");
class Job
{
var $db;
var $results;
var $result;
var $dbObject;
var $title;
var $location ;
var $id ;
var $responsibility ;
var $qualification;
var $date_posted;
// var $activated;
// var $message;
// function __construct($db)
// {
//     // $this->dbObject = new Database;
//     // $this->db=$this->dbObject->getConnection();
//     $this->db=$db;
//     // $this->message="The";
// }
function __construct($line)
{
    // $this->dbObject = new Database;
    // $this->db=$this->dbObject->getConnection();
    $this->title = $line["title"];
    $this->id=$line["id"];
    $this->responsibility=$line["responsibility"];
    $this->location=$line["location"];
    $this->qualification=$line["qualification"];
    $this->date_posted=$line["date_posted"];
        // $this->message="The";
}
function setTitle($title)
{
	// if(isset($this->title)&&$this->title!=$title)
	// {
	// 	$this->message=$this->message." user name";
	// }
	$this->title=$title;
}

function getTitle()
{
	return $this->title;
}

function setLocation($location)
{
	// if(isset($this->location)&&$this->location!=$location)
	// {
	// 	if($this->message=="The")
	// 		$this->message=$this->message." email id";
	// 	else
	// 		$this->message=$this->message.", email id";
	// }
	$this->location=$location;

}

function getLocation()
{
	return $this->location;
}

function setId($id)
{
	$this->id=$id;
}
function getId()
{
	return $this->id;
}

function setResponsibility($responsibility)
{
	// if(isset($this->responsibility)&&$this->responsibility!=$responsibility)
	// {
	// 	if($this->message=="The")
	// 		$this->message=$this->message." password";
	// 	else
	// 		$this->message=$this->message.", password";
  //
	// }
	$this->responsibility=$responsibility;
}
function getResponsibility()
{
	return $this->responsibility;
}

function setQualification($qualification)
{
	// if(isset($this->qualification)&& $this->qualification!=$qualification)
	// {
	// 	if($this->message=="The")
	// 		$this->message=$this->message." qualification";
	// 	else
	// 		$this->message=$this->message.", qualification";
	// }
	$this->qualification=$qualification;
}
function getQualification()
{
	return $this->qualification;
}

function setDate_posted($date_posted)
{
	$this->date_posted=$date_posted;
}
function getDate_posted()
{
	return $this->date_posted;
}

// function setActivated($activated)
// {
// 	if($activated != $this->activated)
// 	{
// 		if($activated=="Y")
// 			$this->message="activation";
// 		else
// 			$this->message="deactivation";
// 	}
// 	else
// 	{
// 		$this->message="";
// 	}
// 	$this->activated=$activated;
// }
// function getActivated()
// {
// 	return $this->activated;
// }

function add()
{
	$this->results = mysql_query("SELECT * FROM jobs where id='$this->id'",$this->db) or onError ("User Detail Selection to check any details are existing is Aborted");
	if($this->result=mysql_fetch_array($this->results))
	{
		//echo "Exectuted query <BR>" ;
		return "The  ".$this->id." already exists";
	}
	else
	{
		mysql_query("insert into jobs values ('$this->title','$this->responsibility','$this->location','$this->qualification','Y')",$this->db) or onError ("User Detail insertion is Aborted");
		//echo mysql_errno().": ".mysql_error()."<BR>";
		return "Registration Succesful";
	}

}

function delete($list)
{
	mysql_query("delete from jobs  where id in ($list)",$this->db) or onError ("User Detail deletion is Aborted");
	//echo mysql_errno().": ".mysql_error()."<BR>".$list;
	return "Deleted Sucessfully";
}
function getJob($line)
{
	$this->title = $line["title"];
	$this->id=$line["id"];
	$this->responsibility=$line["responsibility"];
	$this->location=$line["location"];
	$this->qualification=$line["qualification"];
  $this->date_posted=$line["date_posted"];
	return $this;
}

function getJobForId($id)
{
	$this->results = mysql_query("SELECT * FROM jobs where id='$id'",$this->db) or onError ("Getting records from job Detail is Aborted");
	if($line=mysql_fetch_array($this->results))
	{
    return getJob($line);
	}
	else
	{
		return false;
	}
}

function getJobForAllId()
{
	$this->results = mysql_query("SELECT * FROM jobs",$this->db) or onError ("Getting records from job Detail is Aborted");
	// if($line=mysql_fetch_array($this->results))
	// {
  //   return getJob($line);
	// }
	// else
	// {
	// 	return false;
	// }
}

}


?>
