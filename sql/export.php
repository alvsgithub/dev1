<?php

include "config.php";

/**

EXPORT DATABASE

*/

function ExportDatabase($Host, $Username, $Password, $DatabaseName, $Tables = '*') {

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

    $Path = $DatabaseName . '.sql';

    $handle = fopen($Path, 'w+');

    fwrite($handle, $return);

    fclose($handle);
}

ExportDatabase($Host, $Username, $Password, $DatabaseName);

echo "Tables exported successfully";

?>