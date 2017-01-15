<?php
namespace App\Http\Controllers;
use App\Note;
use Illuminate\Http\Request;
use App\Http\Requests;
class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = \Auth::user();    // 1
      $notes = Note::where('user_id', $user->id)->get();    // 2
      return view('note.list')->with('notes', $notes);    // 3
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('note.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $note = new note([
            'fqdn' => $request->get('fqdn'),
            'port' => $request->get('port'),
            'memo' => $request->get('memo'),
        ]);
        $user = \Auth::user();
        $note->user()->associate($user->id);
        $note->save();
        \Log::info('Note 등록 성공',
            ['user-id'=> $user->id, 'note-id'=>$note->id]
        );
        return redirect('/note')
            ->with('message', $note->name . ' 이 생성되었습니다.');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = note::find($id);    //1
          if($note == null) {
            abort(404, $id . ' 모델을 찾을 수가 없습니다.');    // 2
        }
        return view('note.show')->with('note', $note);    //3
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $note = Note::findOrFail($id);
      return view('note.edit')->with('note', $note);
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
      $note = Note::findOrFail($id);
      $note->update([    //1
        'fqdn' => $request->get('fqdn'),
        'port' => $request->get('port'),
        'memo' => $request->get('memo'),
      ]);
      return redirect('/note')->with('message', $note->name . 'Note가 수정되었습니다.');    //2
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $note = Note::findOrFail($id);
      // Update Later
      // foreach($note->x509()->get() as $x509) {    //자식 레코드 먼저 삭제
      //  $x509->delete();
      // }
      $note->delete();   // 삭제
        return redirect('/note')->with('message', $note->name . 'Note가 삭제되었습니다.');
    }
}
