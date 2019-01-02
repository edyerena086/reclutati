<?php

namespace ReclutaTI\Http\Controllers\Back;

use ReclutaTI\Blog;
use Illuminate\Http\Request;
use ReclutaTI\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('back.auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publishedPost = Blog::where('publish_status', 1)->orderBy('published_at', 'DESC')->get();
        $unpublishedPost = Blog::where('publish_status', 0)->orderBy('created_at', 'DESC')->get();

        return view('back.dashboard.blog.index', ['publishedPost' => $publishedPost, 'unpublishedPost' => $unpublishedPost]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
