<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.petugas.index');
    }

    public function data(Request $request)
    {
        $query = Petugas::with('user');

        return datatables($query)
            ->addIndexColumn()
            ->addColumn('foto', function ($query) {
                if (!empty($query->user->path_image)) {
                    return '
                        <img src="' . Storage::url($query->user->path_image) . '">
                    ';
                }
                return '
                    <img src="' . asset('assets/images/not.png') . '" class="thumbnail img-responsive" style="width:40px">
                ';
            })
            ->addColumn('aksi', function ($query) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`' . route('petugas.show', $query->id) . '`)" class="btn btn-sm btn-primary"><i class="fas fa-pencil-alt"></i> Edit</button>
                    <button onclick="deleteData(`' . route('petugas.destroy', $query->id) . '`, `' . $query->name . '`)" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
                </div>
                ';
            })
            ->escapeColumns([])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:users,email',
        ];

        $message = [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah ada sebelumnya.',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'message' => 'Silakan periksa kembali isian Anda dan coba kembali.'], 422);
        }

        DB::beginTransaction();
        try {
            //insert ke tabel user
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make('petugas');
            $user->username = $request->name;
            $user->role_id = 2;
            $user->save();

            //insert ke tabel petugas
            $petugas = new Petugas();
            $petugas->user_id = $user->id;
            $petugas->name = $request->name;
            $petugas->save();

            DB::commit();
            return response()->json(['message' => 'Data berhasil disimpan!']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['errors' => $th, 'message' => 'Silakan periksa kembali isian Anda dan coba kembali.'], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $petugas = Petugas::with('user')->findOrfail($id);
        $petugas->email = $petugas['user']['email'];

        return response()->json(['data' => $petugas]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Petugas $petugas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Petugas $petugas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Petugas $petugas)
    {
        //
    }
}
