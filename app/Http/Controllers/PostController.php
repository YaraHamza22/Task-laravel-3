<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use Illuminate\Http\Request;
use App\Services\PostServices;
use App\Models\Post;

class PostController extends Controller
{
  protected PostServices $post_services;

    public function __construct(PostServices $post_services){
    $this->post_services = $post_services;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = $this->post_services->getAll();
        return $this->success($post);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(PostStoreRequest $request)
    {

       $created = $this->post_services->addPost($request->validated());
      if($created){
        return $this->success($created,'Post Created Successfully',201);
      }
      return $this->error('Failed to create post');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $post = $this->post_services->getById($id);
        if($post){
            return $this->success($post);
        }
       return $this->error('Post not found',404);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostUpdateRequest $request, string $id)
    {
     $updated = $this->post_services->updatePost($request->validated(),$id);

    if ($updated){
        return $this->success($updated,'post updated successfully');
    }
    return $this->error('Post not fond ',404);
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $deleted = $this->post_services->deletePost($id);

    if($deleted){
        return $this->success(null,'post deleted successfully');
    }
    return $this->error('Post not found or delete failed');
}
}
