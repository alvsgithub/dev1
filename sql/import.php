<?php

include "config.php";

/**

BACKUP DATABASE FIRST AT LOG FOLDER

*/

function ExportDatabase($Host, $Username, $Password, $DatabaseName, $LocalComputer, $Tables = '*') {

	//CONNECT TO DATABASE
    $Link = mysql_connect($Host, $Username, $Password);

    mysql_select_db($DatabaseName, $Link);

    mysql_query("SET NAMES 'utf8'");


    //GET ALL OF THE TABLES
    if($Tables == '*') {

        $Tables = array();

        $Result = mysql_query('SHOW TABLES');

        while($row = mysql_fetch_row($Result))
        {
            $Tables[] = $row[0];
        }
    }else{

        $Tables = is_array($Tables) ? $Tables : explode(',', $Tables);
    }

    $return = '';

    //CYCLE THROUGH
    foreach($Tables as $Table) {

        $Result = mysql_query('SELECT * FROM ' . $Table);

        $NumFields = mysql_num_fields($Result);

        $return .= 'DROP TABLE ' . $Table . ';';

        $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE ' . $Table));

        $return .= "\n\n" . $row2[1] . ";\n\n";

        for ($i = 0; $i < $NumFields; $i++)  {

            while($row = mysql_fetch_row($Result)) {

                $return .= 'INSERT INTO ' . $Table . ' VALUES(';

                for($j=0; $j<$NumFields; $j++) {

                    $row[$j] = addslashes($row[$j]);

                    $row[$j] = str_replace("\n", "\n", $row[$j]);

                    if (isset($row[$j])) {

                    	$return .= '"' . $row[$j] . '"'; 
					}else{

						$return .= '""'; 
					}

                    if ($j<($NumFields-1)) {

                    	$return .= ','; 
                	}

                }

                $return .= ");\n";
            }
        }

        $return .= "\n\n\n";
    }

    //SAVE FILE

    $Time = date("[j-F-Y]-[H-i-s]");

    $Path = 'Log/' . $LocalComputer . '-' . $DatabaseName . '-' . $Time . '.sql';

    $handle = fopen($Path, 'w+');

    fwrite($handle, $return);

    fclose($handle);
}

$i = 1;

ExportDatabase($Host, $Username, $Password, $DatabaseName, $LocalComputer);

/**

IMPORT DATABASE

*/

//CONNECT TO MYSQL SERVER
mysql_connect($Host, $Username, $Password) or die('Error connecting to MySQL server: ' . mysql_error());

//SELECT DATABASE
mysql_select_db($DatabaseName) or die('Error selecting MySQL database: ' . mysql_error());

mysql_query("SET NAMES 'utf8'");

//TEMPORARY VARIABLE, USED TO STORE CURRENT QUERY
$templine = '';

//READ IN ENTIRE FILE
$Lines = file($FileName);

//LOOP THROUGH EACH LINE
foreach ($Lines as $line) {

	//SKIP IT IF IT'S A COMMENT
	if (substr($line, 0, 2) == '--' || $line == '') {

	    continue;
	}

	//ADD THIS LINE TO THE CURRENT SEGMENT
	$templine .= $line;

	//IF IT HAS A SEMICOLON AT THE END, IT'S THE END OF THE QUERY
	if (substr(trim($line), -1, 1) == ';') {

	    //PERFORM THE QUERY
	    mysql_query($templine);

	    //RESET TEMP VARIABLE TO EMPTY
	    $templine = '';
	}
}

echo "Tables imported successfully";

?>