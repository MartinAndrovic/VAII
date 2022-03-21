@extends('layouts.app')

@section('content')








            <?php

            use Illuminate\Support\Facades\Storage;






            // echo "co je";
            /*
            $contents = Storage::disk("local")->get("novy.txt");
                //echo $contents;
            */
            //  echo fgets($file). "<br>";
            $file = fopen(storage_path($content), "r");  ?>


            <form id="postUpdate1" method="POST" >
                @csrf
            <table border='4' class='stats' cellspacing='0'>";





                <?php
                $i=0;
                $x=0;
                while(!feof($file)) {



                    echo "<tr>";

                    $line=fgets($file);
                    if($line !=  "!\r\n" && $line != false){
                    $word_arr = explode(" ", $line); //return word array
                    foreach($word_arr as $word){
                        if($word!=""){

                        echo "<td style=display:inline-block>",$word. "<br>";
                         echo " <input type=checkbox name=boxS[$x] > ";

                         echo "</td>";
                         $x++;

                         }
                    }


                    echo "<td  style=display:block>";


                   echo " <input type=checkbox name=box[$i] > ";
                   echo "</td>";


                    echo   "</tr>";

                    $i++;
                    }

                }
                ?>



            </table>

                <input type=hidden name="size" value="{{$i}}">
                <input type=hidden name="sizeS" value="{{$x}}">
            <button type=submit class=submit> vytvoriť</button>


            <?php
            fclose($file);
            ?>













            <input type="hidden" name="post_id" id="post_id" value="{{$post->id}}">

            <!-- <button type="submit" class="submitBt"> Edit</button> -->




    </form>
@endsection
