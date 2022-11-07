<?php

namespace App\Http\Controllers;

use App\Models\Story;
use App\Http\Requests;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StoryController extends Controller
{

    public function publish_story(Request $request){

        $keyword = $request->get('search');
        $perPage = 25;

        $stories = Story::when($keyword, function ($query) use ($keyword) {
                $query->where('title', 'LIKE', "%$keyword%");
            })
            ->checkStatusActive()
            ->isPublish()
            ->latest()
            ->paginate($perPage);

        return view('welcome', compact('stories'));

    }

    public function story_view(Request $request, $username, $slug){

        $story = Story::
        whereHas('user', function($q) use ($username) {
            $q->where('username', $username);
        })
        ->where('slug', $slug)
        ->checkStatusActive()
        ->isPublish()
        ->firstOrFail();

        return view('stories.story_view', compact('story'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        $stories = Story::where('user_id', Auth::id())
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('title', 'LIKE', "%$keyword%");
            })
            ->latest()->paginate($perPage);

        return view('stories.index', compact('stories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('stories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'publish_date' => 'required',
            'status' => 'required'
        ]);
        $requestData = $request->all();

        $requestData['user_id'] = Auth::id();
        // image save
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/file-manager-image');
            $requestData['image'] = $path;
        }
        // image save end
        Story::create($requestData);

        return redirect('stories')->with('flash_message', 'story added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $story = Story::findOrFail($id);

        return view('stories.show', compact('story'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $story = Story::findOrFail($id);

        return view('stories.edit', compact('story'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'publish_date' => 'required',
            'status' => 'required'
        ]);
        $story = Story::findOrFail($id);

        $requestData = $request->all();
        $requestData['user_id'] = Auth::id();
        // image save
        if ($request->hasFile('image')) {
            $story->file_delete('image');
            $path = $request->file('image')->store('public/file-manager-image');
            $requestData['image'] = $path;
        }
        if($request->image_delete){
            $story->file_delete('image');
        }
        // image save end

        $story->update($requestData);

        return redirect('stories')->with('flash_message', 'story updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Story::where(
            [
                'id' => $id,
                'user_id' => Auth::id()
            ]
        )->delete();

        return redirect('stories')->with('flash_message', 'story deleted!');
    }

    public function ck_editor_image_upload(Request $request)
    {
        if (!$request->hasFile('upload')) {
            return response()->json(['uploaded' => 0]);
        }
        // image save
        $fileName = $request->file('upload')->getClientOriginalName();
        $url = $request->file('upload')->store('public/file-manager-image');
        $url = asset(Storage::url($url));
        // image save end

        return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
    }
}
