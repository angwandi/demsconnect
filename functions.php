<!--Project work flow: -->
<!--todo 1. A sign up process -->
<!--todo A login form-->
<!--todo A logout facility-->
<!--todo Session control-->
<!--todo User profile with upload thumbnails-->
<!--todo A member directory-->
<!--todo Adding members as friends-->
<!--todo Public and private messaging between members-->
<!--todo Style the project-->

<?php //include file of the main functions
$dbhost = 'localhost';
$dbname = 'demssocial';
$dbuser = 'dems';
$dbpass = '367421iidema2ms';
$appname = "2ms Connect";

$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($connection->connect_error) die("Fatal Error"); //todo : better error messaging later on
//Check whether a table already exists and, if not, create it.
function createTable($name, $query)
{
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table '$name' created or already exists.<br>";
}

//Issues a query to MySQL outputting an error message if it fails
function queryMysql($query)
{
    global $connection;
    $result = $connection->query($query);
    if (!$result) die("Fatal Error");
    return $result;
}

//Destroy PHP session and clear all its data to log users out
function destroySession()
{
    $_SESSION = array();

    if (session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time() - 2592000, '/');

    session_destroy();
}

//Removes potentially malicious code or tags from user input
function sanitizeString($var)
{
    global $connection;
    $var = strip_tags($var);
    $var = htmlentities($var);
    if (get_magic_quotes_gpc())
        $var = stripslashes($var);
    return $connection->real_escape_string($var);
}

//Displays a user's image and "about me" message if he has one
function showProfile($user)
{
    if (file_exists("$user.jpg"))
        echo "<img src='$user.jpg' style='float:left;'>";

    $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");

    if ($result->num_rows) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        echo stripslashes($row['text']) . "<br style='clear:left;'><br>";
    } else echo "<p>Nothing to see here, yet</p><br>";
}

?>
