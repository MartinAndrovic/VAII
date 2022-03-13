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
                while(!feof($file)) {



                    echo "<tr>";

                    echo "<td>",fgets($file). "<br>", "</td>";
                    echo "<td  style=width:40px>";


                    echo " <input type=checkbox name=box[] > ";
                    echo "</td>";


                    echo   "</tr>";



                }
                ?>


            </table>

            <button type=submit class=submit> vytvoriť</button>


            <?php
            fclose($file);
            ?>













            <input type="hidden" name="post_id" id="post_id" value="{{$post->id}}">

            <!-- <button type="submit" class="submitBt"> Edit</button> -->




    </form>
@endsection
