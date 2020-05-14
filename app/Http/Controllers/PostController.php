<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use App\Category;
use App\Tags;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Posts::paginate(10);
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tags::all();
        $category = Category::all();
        return view('admin.post.create', compact('category', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'category_id' => 'required',
            'content' => 'required',
            'gambar' => 'required',
        ]);

        $gambar = $request->gambar;
        $new_gambar = time().$gambar->getClientoriginalName();

        $post = Posts::create([
            'judul' => $request->judul,
            'category_id' => $request->category_id,
            'content' => $request->content,
            'gambar' => 'public/upload/posts/'.$new_gambar,
            'slug' => Str::slug($request->judul)
        ]);

        $post->tags()->attach($request->tags);

        $gambar->move('public/upload/posts/', $new_gambar);
        return redirect()->route('post.index')->with('success', 'Berhasil menyimpan post');
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
        $category = Category::all();
        $tags = Tags::all();
        $post = Posts::findorfail($id);

        return view('admin.post.edit', compact('post', 'category', 'tags'));
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
        $this->validate($request, [
            'judul' => 'required',
            'category_id' => 'required',
            'content' => 'required',
        ]);

        $post = Posts::findorfail($id);

        if($request->has('gambar')) {
            $gambar = $request->gambar;
            $new_gambar = time().$gambar->getClientoriginalName();
            $gambar->move('public/upload/posts/', $new_gambar);

            $post_data = [
                'judul' => $request->judul,
                'category_id' => $request->category_id,
                'content' => $request->content,
                'gambar' => 'public/upload/posts/'.$new_gambar,
                'slug' => Str::slug($request->judul)
            ];

            $post->tags()->sync($request->tags);
        } else {
            $post_data = [
                'judul' => $request->judul,
                'category_id' => $request->category_id,
                'content' => $request->content,
                'slug' => Str::slug($request->judul)
            ];

            $post->tags()->sync($request->tags);
        }


        $post->update($post_data);

        return redirect()->route('post.index')->with('success', 'Berhasil mengupdate post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Posts::findorfail($id);
        $post->delete();

        return redirect()->back()->with('success', 'Post berhasil dihapus (silahkan cek trush post)');
    }

    public function tampil_hapus() {
        $post = Posts::onlyTrashed()->paginate(10); //ini karena menggunakan pagination, jika tidak maka kita bisa gunakan 'get' saja.
        return view('admin.post.hapus', compact('post'));
    }

    public function restore($id) {
        $post = Posts::withTrashed()->where('id', $id)->first();
        $post->restore();

        return redirect()->back()->with('success', 'Data berhasil direstore, silahkan cek list post');
    }

    public function permanent_delete($id) {
        $post = Posts::withTrashed()->where('id', $id)->first();
        $post->forceDelete();

        return redirect()->back()->with('success', 'Data berhasil dihapus secara permanen');
    }
}
