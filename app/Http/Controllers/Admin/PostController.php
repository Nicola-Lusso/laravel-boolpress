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

        return view('admin.post.index', $data);
    }
     
    
    public function show($id)
    {

         $posts = Post::find($id);

         $data = [
             'item' => $posts
         ];

        return view('admin.post.show', $data);
    }


    public function create()
    {

        $tags = Tag::all();

        $data =[
          'tags' => $tags
        ];

        return view('admin.post.create', $data);
    }


    public function store(Request $request)
    {
        $data = $request->all();
        $idUser = Auth::id();
        $newPost = new Post();
        $newPost->user_id = $idUser;
        $newPost->slug = Str::slug($data['title']);
        $newPost->title = $data['title'];
        $newPost->content = $data['content'];
        $cover_path = Storage::put('post_covers', $data['image']);
        $data['cover'] = $cover_path;
        $newPost->cover = $data['cover'];
        $newPost->save();

        if (array_key_exists('tags', $data)) {
          $newPost->tags()->sync($data['tags']);
        }
        return redirect()->route('post.index');

    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
      $tags = Tag::all();
      $data = [
        'post' => $post,
        'tags' => $tags
      ];
      return view('admin.post.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Post $post)
    {
        $data = $request->all();
        $cover_path = Storage::put('post_covers', $data['image']);
        $data['cover'] = $cover_path;
        $post->update($data);
        if (array_key_exists('tags', $data)) {
          $post->tags()->sync($data['tags']);
        }
        return redirect()->route('post.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Post $post)
    {
        $post->tags()->sync([]);
        $post->delete();
        return redirect()->route('post.index');
    }


}