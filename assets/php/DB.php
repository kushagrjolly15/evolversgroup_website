<?
function OnError($mysqli, $theSubject)
{
		die ($theSubject."<br>".strval($mysqli -> errno).": ".strval($mysqli -> error));
}

class Database
{
    var $db;
    function __construct()
    {
        $this->db = new mysqli("localhost", "evolvers_614009","B2F74FAE") or OnError("The Connection is not established");
				if (!$this->db){
					error_log('The Connection is not established');
				}
#        $this->db = mysql_connect("maindb", "evolversadmin","Data2Sbs") or OnError("The Connection is not established");
        //echo " got connected <BR>" ;
    }
    function getConnection()
    {
        $this->db->select_db("evolvers_maindb") or OnError("The Connection to the database is not made <br> Server may be down");
#        mysql_select_db("methodologists",$this->db) or OnError("The Connection to the database is not made <br> Server may be down");
        //echo " got connected to Evolvers <BR>";
        return $this->db;
    }
}
?>
