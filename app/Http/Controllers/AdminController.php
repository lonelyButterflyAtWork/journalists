<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journalists;
use App\Models\Journalists_voter;
use App\Models\Voters;
use DateTime;
use Storage;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
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

    protected $profileImagesDestinationPath = 'public/images/profileImages';

    public function index(Type $var = null)
    {
        $journalists = Journalists::withCount("voters")->get();

        return view('dashboard', compact('journalists'));
    }

    public function showVotesAjax(Request $request){

        $id = $request['id'];

        $voters = Voters::with('journalists')->whereHas('journalists', function($q) use($id) {
            $q->where('journalists.id', $id);
        })->get();

        return response()->json(['data'=>$voters]);
    }
    public function delJournalist(Request $request)
    {
        if( Auth::check() ) {
            $id = $request->get('id');
            Journalists::find($id)->voters()->detach();
            Journalists::where('id', $id)->delete();
        }
        return redirect('/dashboard');
    }
    public function delVoteAjax(Request $request)
    {
        Journalists_voter::find( $request['id'] )->delete();
    }
    public function editJournalistPage($id){
        if (Journalists::where('id', $id)->exists()) {
            $journalistInfo = Journalists::where('id', $id)->get();
            return view('admin.editJournalist', ['journalistInfo' => $journalistInfo[0] ]);
        } else{
            return redirect('/dashboard');
        }
    }
    public function editJournalistEditData(Request $request){
        $id = $request->get('id');
        $oldImage = Journalists::where('id', $id )->get('image');

        if( $id != NULL ){
            $validated = $request->validate([
                'name'        => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'image'       => 'nullable|image|max:1024'
            ]);
            if( $request->hasFile('image') ){
                try {

                    if( $oldImage[0]['image'] != 'testimage.jpg' ){

                        Storage::disk('public')->delete( 'images/profileImages/'.$oldImage[0]['image'] );

                    }

                    $validated['image'] = $this->storeProfileImage(  $request->file('image'), $id );

                } catch ( \Exception $e) {
                    return back()->with('alert-warning', 'Something went wrong: ' . $e);
                }

            } else{
                unset( $validated['image'] );
            }
            Journalists::where('id', $id )->update($validated);
            return redirect('/dashboard/edit-journalist/' . $id);
        } else{
            return redirect('/dashboard');
        }
    }
    public function addJournalistPage(Type $var = null)
    {
        return view('admin.addJournalist');
    }
    public function addJournalistPageAddData(Request $request){

            $validated = $request->validate([
                'name'        => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'image'       => 'required|image|max:1024'
            ]);

        $validated['image']='testimage.jpg' ;
        $id = Journalists::insertGetId($validated);

        $fileName = $this->storeProfileImage(  $request->file('image'), $id );

        Journalists::where('id', $id )->update(['image' => $fileName ]);

        return redirect('/dashboard');

    }
    private function storeProfileImage( $image, $id ){

        $now = new DateTime();
        $now = $now->format('YmdHis');
        $imageName = $id . "_" . $now . "_" . $image->getClientOriginalName();
        $path = $image->storeAs($this->profileImagesDestinationPath, $imageName);
        return $imageName;

    }
}
