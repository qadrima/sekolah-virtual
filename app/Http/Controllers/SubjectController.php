<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Subject;
use App\SubjectFollow;
use App\SubjectComment;

class SubjectController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return 'hh';
    }

    public function showCreate()
    {
        if(Auth::user()->type == 1)
            return redirect('/home');

        return view('pelajaran.create');
    }

    public function create(Request $request)
    {
        $request->validate([
            'title'         => ['required', 'min:3'],
            'description'   => ['required', 'min:5'],
        ]);

        $subject = Subject::create($request->all());

        return redirect('pelajaran/details/'. $subject->id);
    }

    public function details($id)
    {
        $subject            = Subject::find($id);
        $subjectFollowers   = SubjectFollow::where('subject_id', $id)
                                ->with(['user'])
                                ->get();

        $subjectComments    = SubjectComment::where('subject_id', $id)
                                ->with(['user'])
                                ->orderBy('id', 'desc')
                                ->get();

        $isAuthFollow   = SubjectFollow::where('subject_id', $id)
                            ->where('user_id', Auth::user()->id)
                            ->count();

        if($subject)
            return view('pelajaran.details', compact('subject', 'subjectFollowers', 'isAuthFollow', 'subjectComments'));
        else
            return redirect('/home');
    }

    public function showEdit($id)
    {
        if(Auth::user()->type == 1)
            return redirect('/home');

        // ----
        $subject = Subject::find($id);

        if($subject)
            return view('pelajaran.edit', compact('subject'));
        else
            return redirect('/home');
    }

    public function edit(Request $request)
    {
        $request->validate([
            'title'         => ['required', 'min:3'],
            'description'   => ['required', 'min:5'],
        ]);

        Subject::where('id', $request->id)->update([
            'title'         => $request->title,
            'description'   => $request->description
        ]);

        return redirect('pelajaran/details/'. $request->id);
    }

    public function delete(Request $request)
    {
        Subject::where('id', $request->id)->delete();

        return redirect('/home');
    }

    public function follow(Request $request)
    {
        SubjectFollow::create([
            'user_id'    => Auth::user()->id,
            'subject_id' => $request->id
        ]);

        return redirect('pelajaran/details/'. $request->id);
    }

    public function unfollow(Request $request)
    {
        SubjectFollow::where('subject_id', $request->id)
                        ->where('user_id', Auth::user()->id)
                        ->delete();

        return redirect('pelajaran/details/'. $request->id);
    }

    public function createComment(Request $request)
    {
        SubjectComment::create($request->all());

        return redirect('pelajaran/details/'. $request->subject_id);
    }
}
