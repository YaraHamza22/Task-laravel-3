<?php

namespace App\Services;
use App\Models\Post;
use Exception;


class PostServices
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
       //
    }
    public function addPost(array $data)
    {
      try{
        return Post::create($data);
      }
      catch (Exception $e){
        return false;
      }
    }

    public function getAll(){
        return Post::all();
    }

    public function getById($id){
        return Post::findOrFail($id);
    }

    public function updatePost(array $data,$id){

        $post = Post::findOrFail($id);
        if (! $post){
            return false;
        }
        try{
            $post->update($data);
            return $post;

        }
        catch(Exception $e){
            return false;
        }
    }
    public function deletePost($id){
        $post = Post::findOrFail($id);
        if (! $post){
            return false;
        }
        try{
            $post->delete();
        return true;
        }
        catch(Exception $e){
            return false;
        }
    }

}
