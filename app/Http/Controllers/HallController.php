<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Hall;
use Auth;
use Session;

class HallController extends Controller
{
    
    public function __construct() {
        $this->middleware(['auth', 'isAdmin'])->except('index', 'show');
    }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $halls = Hall::orderbydesc('id')->paginate(10); //show only 5 items at a time in descending order
        
        return view('halls.index', compact('halls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('halls.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validating title and body field
        $this->validate($request, [
            'name'=>'required|max:100',
         
        ]);
        $hall = new Hall;
        
        $hall->name = $request['name'];
        $hall->active = ($request['active'] == 'on') ? 1 : 0;
        $hall->save();
        
        //Display a successful message upon save
        return redirect()->route('halls.index')
        ->with('flash_message', 'Cinema Hall,
             '. $hall->name.' created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hall = Hall::findOrFail($id); //Find post of id = $id
        
        return view ('halls.show', compact('hall'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $hall = Hall::findOrFail($id);
        
        return view('halls.edit', compact('hall'));
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
            'name'=>'required|max:100',
        ]);
        
        $hall = Hall::findOrFail($id);
        $hall->name = $request->input('name');
        $hall->active = ($request['active'] == 'on') ? 1 : 0;
      
        
        $hall->save();
        
        return redirect()->route('halls.index',
            $hall->id)->with('flash_message',
                'Cinema hall , '. $hall->name.' updated');
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hall = Hall::findOrFail($id);
        $hall->delete();
        
        return redirect()->route('halls.index')
        ->with('flash_message',
            'Cinema hall successfully deleted');
    }
}
