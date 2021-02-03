<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function index() {

        $prispevky = Post::all();
        return view('posts.index',compact('prispevky'));
    }

    public function indexUser() {
        $prispevky = Auth::user()->posts;
        return view('posts.indexUser',compact('prispevky'));
    }

    public function show(Post $post){               //vrati obj z vlozeneho id
        return view('posts.show',compact('post'));  //vlozeny $post
    }

    public function showUser(Post $post){               //vrati obj z vlozeneho id
        if(Auth::user()->id == $post->user_id) {
            return view('posts.showUser',compact('post'));  //vlozeny $post
        }
        echo "Forbidden";
    }


    public function create() {
        $kategorie = Category::all();
        return view('posts.create', compact('kategorie'));
    }

    public function store(){                //$request je globalne, nemusi sa pisat
        //dd(request());

        request()->validate([                   //po validaci vrati objekt
            'kategoria'=>'required|numeric',
        ]);

        $user = Auth::user();
        $post = $user->posts()->create(request()->validate([                   //po validaci vrati objekt
            'nazov'=>'required|string',
            'uvod'=>'required|string',
            'text'=>'required|string',
            'obrazok'=>'required|file|image',
            ])
        );
        $post->update(['category_id' => request()->kategoria]);

        //obrazok musime skopirovat na storage
        $this->saveObrazok($post);
        return "Uspesne si vytvoril prispevok";
    }

    public function edit(Post $post)  {
        if(Auth::user()->id == $post->user_id) {
            $kategorie = Category::all();
            return view('posts.edit', compact('post', 'kategorie'));
        }
        echo "Forbidden";
    }

    public function update(Post $post) {

        if(Auth::user()->id == $post->user_id) {
            //return request()->nazov;
            request()->validate([                   //po validaci vrati objekt
                'nazov' => 'required|string',
                'uvod' => 'required|string',
                'text' => 'required|string',
                'obrazok' => 'sometimes|file|image',
                'kategoria' => 'required|numeric'
            ]);
            $post->update([                   //po validaci vrati objekt
                'nazov' => request()->nazov,
                'uvod' => request()->uvod,
                'text' => request()->text,
                'category_id' => request()->kategoria,
            ]);
            if (request()->has('obrazok')) {
                $stary = $post->obrazok;
                // obrazok musime skopirovat na storage

                $this->saveObrazok($post);
                $this->deleteObrazok($stary);

            }
            return "Uspesne update";
        }
        return "Forbidden";
    }

    public function delete(Post $post) {
        if(Auth::user()->id == $post->user_id) {
            $obrazok = $post->obrazok;
            $post->delete();
            $this->deleteObrazok($obrazok);
            return "Uspesne si vymazal";
        }
        echo "Forbidden";
    }

    protected function saveObrazok($post) {
        $dest = public_path('/storage/postImages/');
        $img = request()->file('obrazok');
        $image_name = Str::random(16) .'.'.$img->extension();
        $image = Image::make($img->path());
        $image->resize(1000, 600)->save($dest . $image_name);

        // aktualizacia cesty pre obrazok
        $post->update([
            'obrazok' => ('postImages/' . $image_name)
        ]);
    }

    protected function deleteObrazok($obrazok) {
        Storage::disk('public')->delete($obrazok);
    }

}
