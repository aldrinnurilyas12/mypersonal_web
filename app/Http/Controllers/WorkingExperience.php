<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkingExperienceModel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Symfony\Component\Console\Input\Input;

class WorkingExperience extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $working = DB::table('work_view')->orderBy('created_at', 'desc')->get();
        $work_category = DB::table('industry')->get();

        $software_tools = DB::table('software_tools')->get();
        if ($working->isNotEmpty()) {
            $start_date  = Carbon::parse($working->first()->start_date);
            $end_date  = Carbon::parse($working->first()->end_date);
        } else {
            $start_date = null;
            $end_date = null;
        }
        return view('backend.work.work_main', compact('working', 'work_category', 'software_tools', 'start_date', 'end_date'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $work_category = DB::table('industry')->get();
        return view('Backend.Work.work_create', compact('work_category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required',
            'position' => 'required',
            'industry' => 'required',
            'start_date' => 'required',
            'job_description' => 'required'
        ]);

        if ($request->input('software_tools') == null) {
            WorkingExperienceModel::create([
                'company_name' => $request->company_name,
                'position' => $request->position,
                'industry'  => $request->industry,
                'job_description' => $request->job_description,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'last_edited_at' => null
            ]);
        } else {
            WorkingExperienceModel::create([
                'company_name' => $request->company_name,
                'position' => $request->position,
                'industry'  => $request->industry,
                'job_description' => $request->job_description,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'last_edited_at' => null
            ]);
        }


        session()->flash('message_success', 'Berhasil menambahkan pengalaman kerja anda');
        return redirect()->route('workingexperiences.index');
    }

    public function mywork()
    {
        $working = DB::table('work_view')->orderBy('end_date', 'asc')->get();
        $profile = DB::table('profile')->get();
        return view('frontend.workingexperience.working', compact('working', 'profile'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit_layout(string $id)
    {
        $working = DB::table('work_view')
        ->where('id', $id)
        ->orderBy('end_date', 'asc')->first();
         $work_category = DB::table('industry')->get();
        $start_date = Carbon::parse($working->start_date);
        $end_date = Carbon::parse($working->end_date);
        return view('backend.work.work_edit', compact('working','work_category', 'start_date', 'end_date'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'company_name' => 'required',
            'position' => 'required',
            'industry' => 'required',
            'start_date' => 'required',
            'job_description' => 'required'
        ]);

        WorkingExperienceModel::where('id', $id)->update([
            'company_name' => $request->company_name,
            'position' => $request->position,
            'industry'  => $request->industry,
            'job_description' => $request->job_description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'updated_at' => now(),
            'last_edited_at' => now()
        ]);

        session()->flash('message_success', 'Berhasil update pengalaman kerja anda');
        return redirect()->route('workingexperiences.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $work = WorkingExperienceModel::find($id);
        if ($work) {
            $work->delete();
            session()->flash('message_success', 'Berhasil menghapus pengalaman kerja anda');
            return redirect()->back();
        } else {
            session()->flash('failed_message', 'Gagal menghapus pengalaman kerja anda, silahkan coba lagi');
            return redirect()->back();
        }
    }
}
