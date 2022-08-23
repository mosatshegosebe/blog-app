<?php

namespace App\Http\Controllers;

use App\Events\PostPublished;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $posts = Post::published()->get();
        return view('welcome', compact('posts'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = Category::pluck('category_name', 'id');

        return view('posts.create', compact('categories'));
    }

    /**
     * @param PostRequest $request
     * @param Post        $post
     *
     * @return RedirectResponse
     */
    public function store(PostRequest $request, Post $post): RedirectResponse
    {
        $this->persist($request, $post);
        flash('Post added successful.')->success();
        return back();
    }

    /**
     * @param int $postId
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(int $postId)
    {
        $post = Post::findOrFail($postId);

        return view('posts.show', compact('post'));
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(int $id)
    {
        $post = Post::findorFail($id);
        $categories = Category::pluck('category_name', 'id');

        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * @param PostRequest $request
     *
     * @return RedirectResponse
     */
    public function update(PostRequest $request): RedirectResponse
    {
        $post = Post::findorFail($request->id);
        $this->persist($request, $post);
        flash('Post updated successful.')->success();

        return redirect()->route('home');
    }

    /**
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function destroy(int $id)
    {
        Post::findorFail($id)->delete();
        flash('Post removed')->success();

        return redirect()->route('home');
    }

    /**
     * @param $id
     *
     * @return RedirectResponse
     */
    public function togglePublish($id)
    {
        $post = Post::findorFail($id);
        $status = $post->published == 0 ? Post::PUBLISHED : Post::UNPUBLISHED;
        $post->published = $status;
        $post->save();

        if ($status == Post::PUBLISHED){
            event(new PostPublished($post));
            flash('Post published')->success();
        }

        return back();
    }

    /**
     * @param PostRequest $request
     * @param Post        $post
     */
    private function persist(PostRequest $request, Post $post)
    {
        if($request->isMethod('put')) {
            $file = $post->file_location;
            $publishStatus = $post->published;
        }else{
            $file = $this->getImagePath($request);
            $publishStatus = Post::UNPUBLISHED;
        }

        $post->user_id = $request->user()->id;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->category_id = $request->category;
        $post->file_location = $file;
        $post->published = $publishStatus;
        $post->save();
    }

    /**
     * @param PostRequest $request
     *
     * @return false|string|void
     */
    private function getImagePath(PostRequest $request)
    {
        if ($request->hasFile('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();

            return $request->file('image')->storeAs(
                'public/posts', Str::random().'.'.$extension
            );
        }
    }
}
