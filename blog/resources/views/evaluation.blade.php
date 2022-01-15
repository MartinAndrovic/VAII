
<html>



<?php

use Illuminate\Support\Facades\Storage;






echo "co je";
/*
$contents = Storage::disk("local")->get("novy.txt");
    //echo $contents;
*/
  //  echo fgets($file). "<br>";
$file = fopen(storage_path("/app/novy.txt"), "r");
echo "<table border='4' class='stats' cellspacing='0'>";




while(!feof($file)) {



    echo "<tr>";

          echo "<td>",fgets($file). "<br>", "</td>";


         echo   "</tr>";

}

echo "</table>";
fclose($file);









?>



</html>
<script src="{{url('js/main.js')}}"> </script>
