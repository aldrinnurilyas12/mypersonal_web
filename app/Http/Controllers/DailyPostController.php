<?php

namespace App\Http\Controllers;

use App\Models\Daily_posts_images;
use App\Models\DailyPostModel;
use App\Models\ProfilePictureModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DailyPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = DailyPostModel::orderBy('created_at', 'desc')->get();
        $post_id = DailyPostModel::orderBy('id', 'desc')->first();

        $profile = DB::table('profile')->get();
        return view('backend.dailyposts.dailypost_main', compact('posts', 'profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.dailyposts.dailypost_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'post' => 'required'
        ]);



        DailyPostModel::create([
            'post' => $request->post,
            'last_edited_at' => null
        ]);
        


        session()->flash('message_success', 'Berhasil menambahkan postingan anda');
        return redirect()->route('dailyposts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show() {}

    public function showpost(Request $request)
    {
        $posts = DB::table('daily_post')->orderBy('created_at', 'desc')->get();
        $profile = DB::table('profile')->get();
        $profile_img = ProfilePictureModel::select('profile_img')->get();
        return view('frontend.dailypost.dailypost_main', compact('posts', 'profile_img', 'profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $posts = DB::table('daily_post')->where('id', $id)->first();
        return view('Backend.Dailyposts.dailypost_update', compact('posts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        if ($request->has('posts_img')) {
            foreach ($request->file('posts_img') as $img) {
                $folderPath = 'posts_img';
                $imagePath = $img->storeAs($folderPath, uniqid() . '.' . $img->getClientOriginalExtension(), 'public');

                $daily_posts_img = Daily_posts_images::where('posts_id', $id)->get();

                DailyPostModel::where('id', $id)->update([
                    'post' => $request->post,
                    'last_edited_at' => now()
                ]);
            }

            if ($daily_posts_img->posts_img) {
                $oldImages = public_path('storage/' . $daily_posts_img->posts_img);
                if (file_exists($oldImages)) {
                    unlink($oldImages);
                }
            }

            Daily_posts_images::where('posts_id', $id)->update([
                'posts_img' => $folderPath
            ]);
        } else {
            DailyPostModel::where('id', $id)->update([
                'post' => $request->post,
                'last_edited_at' => now()
            ]);
        }


        session()->flash('message_success', 'Berhasil update postingan anda');
        return redirect()->route('dailyposts.index');
    }

    /**
     * Remove the specified resource from storage.
     */


    public function destroy(string $id)
    {
        $post = DailyPostModel::find($id);
        $dailyPostsImage = Daily_posts_images::where('posts_id', $id)->first();

        if ($post) {
            // Hapus gambar jika ada
            if ($dailyPostsImage && $dailyPostsImage->posts_img) {
                $imagePath = public_path('storage/' . $dailyPostsImage->posts_img);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $dailyPostsImage->delete(); // opsional, jika ingin menghapus record-nya juga
            }

            // Hapus postingan
            $post->delete();

            session()->flash('message_success', 'Berhasil menghapus postingan anda');
        } else {
            session()->flash('message_error', 'Postingan tidak ditemukan');
        }

        return redirect()->back();
    }
}
