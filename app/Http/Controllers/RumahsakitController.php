<?php

namespace App\Http\Controllers;

use App\Models\Rumahsakit;
use Illuminate\Http\Request;

class RumahsakitController extends Controller
{
    public function index(){

        $rumahsakits = Rumahsakit::get();
        return view('rumahsakit.index', compact(['rumahsakits']));
     }
 
     public function create(){
         return view('rumahsakit.create');
     }
 
     public function store(Request $request){
 
         $validatedRumahsakit = $request->validate([
             'nama' => 'required|string',
             'alamat' => 'required|string',
             'email' => 'required|string|email|unique:rumahsakits,email',
             'telepon' => 'required|string',
         ]);
 
         try{
            Rumahsakit::create($validatedRumahsakit);
            return redirect()->route('rumahsakit.index')->with('success','Data berhasil ditambahkan');
         } catch(\Exception $e){
            return redirect()->route('rumahsakit.index')->with('success','Data gagal ditambahkan'.$e->getMessage());
         }
         
     }
 
     public function destroy($id){
        $rumahsakit = Rumahsakit::find($id);
        if ($rumahsakit) {
            try {
                $rumahsakit->delete();
                return response()->json(['message' => 'Data berhasil dihapus']);
            } catch(\Exception $e){
                return response()->json(['message' => 'Data gagal dihapus: '.$e->getMessage()], 500);
            }
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }
    
 
     public function edit($id){
         $rumahsakit = Rumahsakit::findOrFail($id);
         return view('rumahsakit.edit', compact(['rumahsakit']));
 
     }
 
     public function update(Request $request, $id){
        $validatedRumahsakit = $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'email' => 'required|string|email|unique:rumahsakits,email,'. $id,
            'telepon' => 'required|string',
        ]);
         
         $rumahsakit = Rumahsakit::findOrFail($id);
 
         try {
             $rumahsakit->update($validatedRumahsakit);
             return redirect()->route('rumahsakit.index')->with('success','Data berhasil diupdate');
         } catch(\Exception $e) {
             return redirect()->route('rumahsakit.index')->with('success','Data gagal diupdate'.$e->getMessage());
         }
    }
}
