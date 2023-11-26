<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;

class musicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Music::all();
        return view('index', compact('data'));
    }
    public function addMusic()
    {
        return view('addMusic');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    public function store(Request $request)
    {
        if ($request->hasFile('ImageURL')) {
            $image = $request->file('ImageURL');
            $imageExt = $image->getClientOriginalExtension();
            $imageName = 'imageArtist' . '-' . time() . '.' . $imageExt;
            $image->move(public_path('imageArtist'), $imageName);
        } else {
            $imageName = null;
        }
        if ($request->hasFile('SampleURL')) {
            $audio = $request->file('SampleURL');
            $audioExt = $audio->getClientOriginalExtension();
            $audioName = 'audioArtist' . '-' . time() . '.' . $audioExt;
            $audio->move(public_path('audioArtist'), $audioName);
        } else {
            $audioName = null;
        }

        $response = Music::create(
            [
                'PackageName' => $request->PackageName,
                'ArtistName' => $request->ArtistName,
                'price' => $request->price,
                'ReleaseDate' => $request->ReleaseDate,
                'SampleURL' => $audioName,
                'ImageURL' => $imageName,
            ]);

        return redirect('/')->with(
            'create', 'Success add New Music !'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Music::find($id);
        return view('detailMusic', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $data = Music::find($id);

        if ($data) {
            $previousData = $data->toArray();

            $image = $request->file('ImageURL');

            if ($image) {
                $imageExt = $image->getClientOriginalExtension();
                $imageName = 'imageArtist' . '-' . time() . '.' . $imageExt;
                $image->move(public_path('imageArtist'), $imageName);

                // Simpan nama file gambar baru ke field ImageURL
                $data->ImageURL = $imageName;
            } else {
                $data->ImageURL = $previousData['ImageURL'];
            };

            $audio = $request->file('SampleURL');
            if ($audio) {
                $audioExt = $audio->getClientOriginalExtension();
                $audioName = 'audioArtist' . '-' . time() . '.' . $audioExt;
                $audio->move(public_path('audioArtist'), $audioName);
                $data->SampleURL = $audioName;
            } else {
                $data->SampleURL = $previousData['SampleURL'];
            };

            $data->PackageName = $request->input('PackageName') !== '' ? $request->input('PackageName') : $previousData['PackageName'];

            $data->ArtistName = $request->input('ArtistName') !== '' ? $request->input('ArtistName') : $previousData['ArtistName'];

            $data->ReleaseDate = $request->input('ReleaseDate') !== '' ? $request->input('ReleaseDate') : $previousData['ReleaseDate'];

            $data->price = $request->input('price') !== '' ? $request->input('price') : $previousData['price'];

            $data->save();
            return redirect('/')->with(
                'update', 'Success updated Data !'
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $data = Music::find($id);
        $data->delete();
        return redirect('/')->with(
            'delete', 'Success Delete Music !'
        );
    }
}
