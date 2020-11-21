<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\ProjectCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = DB::table('posts')
            ->join('users', 'posts.author_id', '=', 'users.id')
            ->leftJoin('project_categories', 'posts.category_id', '=', 'project_categories.id')
            ->select([
                'posts.id',
                'posts.title',
                'posts.content',
                'posts.is_published',
                'posts.updated_at',
                'users.name AS author_name',
                'project_categories.name AS category_name'
            ])
            ->orderByDesc('posts.updated_at')
            ->paginate(20);

        return view('admin.posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        $users = User::all();
        $categories = ProjectCategory::where('is_active', '=', 1)
            ->orderBy('name')
            ->get();

        return view('admin.posts.create', ['posts' => $post, 'users' => $users, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->link = $request->input('link');
        $post->category_id = $request->input('category_id');
        $post->author_id = $request->input('author_id')==""?Auth::user()->id:$request->input('author_id');
        $post->is_published = $request->input('is_published')=='on'?1:0;
        $post->created_by = Auth::user()->id;
        $post->updated_by = Auth::user()->id;

        $post->save();

        return redirect('/admin/posts')->with('success', 'Post saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = DB::table('posts')
            ->join('users', 'posts.author_id', '=', 'users.id')
            ->join('project_categories', 'posts.category_id', '=', 'project_categories.id')
            ->select([
                'posts.*',
                'users.name AS author_name',
                'project_categories.name AS category_name'
            ])
            ->where('posts.id', '=', $id)
            ->get();

        return view('admin.posts.show', ['post' => $post[0]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $users = User::all();
        $categories = ProjectCategory::where('is_active', '=', 1)
            ->orderBy('name')
            ->get();

        return view('admin.posts.edit', ['post' => $post, 'users' => $users, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->link = $request->input('link');
        $post->category_id = $request->input('category_id');
        $post->author_id = $request->input('author_id')==""?Auth::user()->id:$request->input('author_id');
        $post->is_published = $request->input('is_published')=='on'?1:0;
        $post->updated_by = Auth::user()->id;

        $post->save();

        return redirect('/admin/posts')->with('success', 'Post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
