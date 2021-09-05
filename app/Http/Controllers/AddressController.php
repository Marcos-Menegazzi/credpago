<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('address.index');
    }

    public function refresh() {
        return response()->json(Address::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('address.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = auth()->user()->id;

        $data = $request->validate([
            'url'=> "required|url|unique:addresses,description,null,id,user_id,${user_id}|max:255"
        ]);
        
        Address::create([
            'description' => $data['url'],
            'user_id'     => $user_id
        ]);

        return redirect()->action([AddressController::class, 'index'])->with('success', 'URL Incluída.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        return view('address.show', ['address' => $address]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        return view('address.edit', ['address' => $address]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        $user_id = auth()->user()->id;
        $url     = $request->url;

        $data = $request->validate([
            'url'=> "required|url|unique:addresses,description,${url},id,user_id,${user_id}|max:255"
        ]);
        
        $address->update([
            'description' => $data['url']
        ]);

        return redirect()->action([AddressController::class, 'index'])->with('success', 'URL Atualizada.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        try {
            $address->delete();
        } catch (\Throwable $th) {
            return redirect()->action([AddressController::class, 'index'])->with('error', 'Não foi possível excluir a url.');
        }

        return redirect()->action([AddressController::class, 'index'])->with('success', 'URL Excluída.');
    }

    /**
     * Return one list of details.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details(Address $address) {
        return response()->json($address->details()->orderBy('created_at', 'desc')->get());
    }
}
