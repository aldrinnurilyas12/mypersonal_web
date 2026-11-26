<?php

namespace App\Http\Controllers;

use App\Models\PodcastModel;
use App\Models\ProjectsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Exception;
use Illuminate\Support\Facades\Log;

class PodcastController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $podcast = DB::table('podcast_view')->orderBy('created_at', 'desc')->get();
        $podcast_category = DB::table('podcast_category')->get();

        $last_eps = PodcastModel::max('podcast_eps_number');

        $next_eps = $last_eps ? $last_eps + 1 : 1;

        return view('backend.podcast.podcast_main', compact('podcast', 'podcast_category', 'next_eps'));
    }


    public function showpodcast()
    {
        $podcast = DB::table('podcast_view')->orderBy('created_at', 'desc')->get();
        $profile = DB::table('profile')->get();
        return view('frontend.podcast.podcast', compact('podcast', 'profile'));
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
         try{

            $request->validate([
                'media_files'        => 'required|mimetypes:audio/mpeg,audio/mp3|max:30000',
                'podcast_banner'     => 'required|image|mimes:jpg,jpeg,png|max:5000',
                'podcast_eps_number' => 'required',
                'podcast_title'      => 'required',
                'podcast_subtitle'   => 'required',
            ]);


            // Upload audio
            $mediaFile = $request->file('media_files');
            $mediaPath = $mediaFile->storeAs(
                'podcast',
                uniqid() . '.' . $mediaFile->getClientOriginalExtension(),
                'public'
            );

            // Upload banner
            $bannerFile = $request->file('podcast_banner');
            $bannerPath = $bannerFile->storeAs(
                'podcast_banner',
                uniqid() . '.' . $bannerFile->getClientOriginalExtension(),
                'public'
            );

            
            PodcastModel::create([
                'podcast_code'       => Uuid::uuid4()->toString(),
                'podcast_eps_number' => $request->podcast_eps_number,
                'podcast_title'      => $request->podcast_title,
                'podcast_subtitle'   => $request->podcast_subtitle,
                'podcast_category'   => $request->podcast_category,
                'media_files'        => $mediaPath,
                'podcast_banner'     => $bannerPath,
                'last_edited_at' => null
            ]);
        }catch(Exception $e){

            Log::error('Gagal upload podcast', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                // 'trace' => $e->getTraceAsString(), // aktifkan jika diperlukan
            ]);
            session()->flash('message_error', 'Gagal menambahkan podcast');
            return redirect()->back();
        }
        
        session()->flash('message_success', 'Berhasil menambahkan podcast');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'media_files' => 'mimetypes:audio/mpeg,audio/mp3|max:20500',
            'podcast_banner' => 'image|mimes:jpg, png, jpeg |max:5000',
            'podcast_title' => 'required',
            'podcast_subtitle' => 'required'
        ]);

        $podcast = PodcastModel::findOrFail($id);

        if ($request->hasFile('media_files')) {
            $mediaFile = $request->file('media_files');
            $imagePath = $mediaFile->storeAs('podcast', uniqid() . '.' . $mediaFile->getClientOriginalExtension(), 'public');

            // Hapus file lama jika ada
            if ($podcast->media_files) {
                $oldPodcast = public_path('storage/' . $podcast->media_files);
                if (file_exists($oldPodcast)) {
                    unlink($oldPodcast);
                }
            }
        } else {
            $imagePath = $podcast->media_files;
        }

        // Handle podcast_banner (image)
        if ($request->hasFile('podcast_banner')) {
            $bannerFile = $request->file('podcast_banner');
            $bannerPath = $bannerFile->storeAs('podcast_banner', uniqid() . '.' . $bannerFile->getClientOriginalExtension(), 'public');

            // Hapus banner lama jika ada
            if ($podcast->podcast_banner) {
                $oldBanner = public_path('storage/' . $podcast->podcast_banner);
                if (file_exists($oldBanner)) {
                    unlink($oldBanner);
                }
            }
        } else {
            $bannerPath = $podcast->podcast_banner;
        }



        PodcastModel::where('id', $request->id)->update([
            'podcast_title' => $request->podcast_title,
            'podcast_subtitle' => $request->podcast_subtitle,
            'podcast_eps_number' => $request->podcast_eps_number,
            'podcast_category' => $request->podcast_category,
            'media_files'   => $imagePath,
            'podcast_banner' => $bannerPath,
            'last_edited_at' => now()
        ]);
        session()->flash('message_success', 'Berhasil mengubah podcast');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $podcastId = PodcastModel::find($id);

        if ($podcastId) {
            if ($podcastId->media_files && $podcastId->podcast_banner) {
                $oldImages = public_path('storage/' . $podcastId->podcast_banner);
                $oldPodcast = public_path('storage/' . $podcastId->media_files);
                if (file_exists($oldImages) && file_exists($oldPodcast)) {
                    unlink($oldImages);
                    unlink($oldPodcast);
                }
            }
            $podcastId->delete();
        } else {
            echo "Data tidak ada";
        }
        session()->flash('message_success', 'Berhasil menghapus podcast');
        return redirect()->back();
    }
}
