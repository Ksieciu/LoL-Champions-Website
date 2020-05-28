<?php

namespace App\Http\Controllers;

use App\Champion;
use Illuminate\Http\Request;


class ChampionController extends Controller
{
    //bierzemy wszystkie rekordy championów z db
    public function showAllChampions(){
        return response()->json(Champion::all());
    }

    //bierzemy informacje o jednym, wybranym na bazie id, championie
    public function showChampion($id){
        return response()->json(Champion::find($id));
    }

    //tworzymy nowego championa i zapisujemy do db
    public function create(Request $request){
        
        $this->validate($request, [
            'id' => 'required|unique:champions',
            'name' => 'required|unique:champions',
            'title' => 'required',
            'icon' => 'required'
        ]);
        
        $champion = Champion::create($request->all());

        return response()->json($champion, 201);
    }

    //modyfikujemy wybranego championa
    public function update($id, Request $request){
        $champion = Champion::findOrFail($id);
        $champion->update($request->all());

        return response()->json($champion, 200);
    }

    //usuwamy wybranego championa
    public function delete($id){
        Champion::findOrFail($id)->delete();
        return response('Champion deleted from database', 200);
    }
   
}
