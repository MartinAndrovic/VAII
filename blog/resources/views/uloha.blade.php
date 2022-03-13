@extends('layouts.app')

@section('content')
    <form id="postUpdate"  method="POST" enctype='multipart/form-data'>
        @csrf
        @method('PATCH')
        <div class="input-wrapper">
            <label for="nazov"> názov </label>
            <input id="nazov" type="text" name="nazov" placeholder="Názov" value="{{$post->nazov}}">
            <div class="alert-danger" id="nazovvError"></div>

        </div>





        <file src="/storage/{{$post->obrazok}}" alt="">
        <div class="input-wrapper ">
            <label for="obrazok"> obrázok </label>
            <input id="obrazok" type="file" name="obrazok" >
            <div class="alert-danger" id="obrazokError"></div>
        </div>


            <?php

            use Illuminate\Support\Facades\Storage;






           // echo "co je";
            /*
            $contents = Storage::disk("local")->get("novy.txt");
                //echo $contents;
            */
            //  echo fgets($file). "<br>";
            $file = fopen(storage_path($content), "r");

            echo "<table border='4' class='stats' cellspacing='0'>";




            while(!feof($file)) {




                echo" <form  method=POST> ";

                echo "<tr>";

                echo "<td>",fgets($file). "<br>", "</td>";
                echo "<td  style=width:100px>";
                echo " <input type=checkbox name=terms>";
                echo "</td>";
                echo "</form>";

                echo   "</tr>";

            }

            echo "</table>";
            fclose($file);









            ?>



            <input type="hidden" name="post_id" id="post_id" value="{{$post->id}}">

        <button type="submit" class="submitBt"> Edit</button>




    </form>
@endsection
