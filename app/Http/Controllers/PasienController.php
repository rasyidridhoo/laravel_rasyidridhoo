<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Rumahsakit;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index(){
        $pasienList = Pasien::with('rumahsakit')->get();
        $rumahsakitList = Rumahsakit::pluck('nama', 'id');

        return view('pasien.index', compact('pasienList', 'rumahsakitList'));
        // $pasiens = Pasien::get();
        // return view('pasien.index', compact(['pasiens']));
     }
 
     public function create(){
        $rumahsakitSelectList = Rumahsakit::get(['id', 'nama']);
        return view('pasien.create', compact(['rumahsakitSelectList']));
     }
 
     public function store(Request $request){
 
         $validatedpasien = $request->validate([
             'nama' => 'required|string',
             'alamat' => 'required|string',
             'telepon' => 'required|string',
             'rumahsakit_id' => 'required',
         ]);
 
         try{
            Pasien::create($validatedpasien);
            return redirect()->route('pasien.index')->with('success','Data berhasil ditambahkan');
         } catch(\Exception $e){
            return redirect()->route('pasien.index')->with('success','Data gagal ditambahkan'.$e->getMessage());
         }
         
     }
 
    //  public function destroy($id){
    //      $pasien = Pasien::findOrFail($id);
    //      try{
    //          $pasien->delete();
    //          return redirect()->route('pasien.index')->with('success','Data berhasil dihapus');
    //      } catch(\Exception $e){
    //          return redirect()->route('pasien.index')->with('success','Data gagal dihapus'.$e->getMessage());
    //      }
    //  }

    public function destroy($id){
        $pasien = Pasien::find($id);
        if ($pasien) {
            try {
                $pasien->delete();
                return response()->json(['message' => 'Data berhasil dihapus']);
            } catch(\Exception $e){
                return response()->json(['message' => 'Data gagal dihapus: '.$e->getMessage()], 500);
            }
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }
 
     public function edit($id){
         $pasien = Pasien::findOrFail($id);
         $rumahsakitSelectList = Rumahsakit::get(['id', 'nama']);
         return view('pasien.edit', compact(['pasien', 'rumahsakitSelectList']));
 
     }
 
     public function update(Request $request, $id){
         $validatedpasien = $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'telepon' => 'required|string',
            'rumahsakit_id' => 'required',
         ]);
         
         $pasien = Pasien::findOrFail($id);
 
         try {
             $pasien->update($validatedpasien );
             return redirect()->route('pasien.index')->with('success','Data berhasil diupdate');
         } catch(\Exception $e) {
             return redirect()->route('pasien.index')->with('success','Data gagal diupdate'.$e->getMessage());
         }
    }


    public function filterPasien(Request $request)
    {
        $rumahsakitId = $request->input('rumahsakit');

        $query = Pasien::query();

        if ($rumahsakitId) {
            $query->whereHas('rumahsakit', function ($query) use ($rumahsakitId) {
                $query->where('id', $rumahsakitId);
            });
        }

        $pasienList = $query->with('rumahsakit')->get();
        if ($pasienList->isEmpty()) {
            return response()->json(['message' => 'No matching records found']);
        }
    

        return response()->json(['pasienList' => $pasienList]);
    }
}
