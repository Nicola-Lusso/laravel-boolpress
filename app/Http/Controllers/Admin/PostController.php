<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;
class PostController extends Controller
{
    public function index()
    {

         $posts = Post::All();

         $data = [
             'posts' => $posts
         ];

        return view('guest.post.index', $data);
    }
     
    
    public function show($id)
    {

         $posts = Post::find($id);

         $data = [
             'item' => $posts
         ];

        return view('guest.post.show', $data);
    }
 }