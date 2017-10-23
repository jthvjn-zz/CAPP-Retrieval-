<?php
session_start();
include_once 'connect.php';
//************Retrieval Module**********************//
//The fixed code length is 10 characters stored in $length
//The process first assign a degree of similarity to each of the codes in master database.
//The code in master database is then sorted according to the degree of similarity.
//The required number of items from the sorted list is retrieved
//The retrieved items act as a hyperlink to Process Plan document stored in disk.
//A more apt design includes development of a hashing function and using the same for retrieval
//Currently Process Plans are stored in same directory
//***********Error and exception handling modules not included*****************//

class co
{
    public $deg;
    public $code;
}
$arr[] = '';
$length = 14;

$no = $conn->real_escape_string($_POST['no']);
$code = $conn->real_escape_string($_POST['code']);
//print_r($_POST);
if(strlen($code) == $length) {

    $code_array = str_split($code, 1);
//print_r($code_array);
    $sql = 'SELECT Code FROM CODE;';
    $result = $conn->query($sql) or die($conn->error);


    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //print_r($row);
            foreach ($row as $c) {
                $code_arrayR = str_split($c, 1);
                //print_r($code_arrayR);
                $degree = 0;
                for ($i = 0; $i < $length; $i++) {
                    if ($code_arrayR[$i] == $code_array[$i]) {
                        $degree++;
                    }

                }
                //echo "degree".$degree;
                $myco = new co();
                $myco->code = $row;
                $myco->deg = $degree;

                array_push($arr, $myco);
                //print_r($arr);

            }
            unset($c);
        }
        $i = 1;
        foreach ($arr as $key) {
            $j = $i - 1;
            while ($j >= 0 && ($arr[$j]->deg) < ($key->deg)) {
                $arr[$j + 1] = $arr[$j];
                $j = $j - 1;
            }
            $arr[$j + 1] = $key;
            $i++;
        }
        $data .= "<table class=\"table\"><thead><tr><th>Sl.No</th><th>Code</th><th>DoS</th></tr></thead><tbody>";

        for ($i = 0, $slNo = 1; $i < $no && (!empty($arr[$i])) && ($arr[$i]->deg) > 0; $i++, $slNo++) {
            $data .= "<tr><td>" . $slNo . "</td><td><a href=\"" . ($arr[$i]->code["Code"]) . ".txt\">"
                . ($arr[$i]->code["Code"]) . "</a></td><td>" . $arr[$i]->deg . "/" . $length . "</td></tr>";

        }
        $data .= "</tbody></table>";
        if ($i == 0)
            $data .= "<div  style='color: red'><h4>**ZERO similar items found</h4></div>";
        else
            if ($i < $no)
                $data .= "<div  style='color: red'><h4>**Only " . $i . " similar items found</h4></div>";
        echo $data;
    } else {
        echo "<h1 style='color: red'>0 results from master db</h1>";
    }
}//code length less than $length
else
echo "<script>
      alert(\"Code Length =".$length." REQUIRED\");
      </script>";
?>
