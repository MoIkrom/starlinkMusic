<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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

        $prices = (int) preg_replace("/[^0-9]/", "", $request->price);
        $response = Music::create(
            [
                'PackageName' => $request->PackageName,
                'ArtistName' => $request->ArtistName,
                'price' => $prices,
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

            $pricing = (int) preg_replace("/[^0-9]/", "", $request->input('price'));

            $data->price = $request->input('price') !== '' ? $pricing : $previousData['price'];

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

        if (File::exists(public_path('imageArtist/' . $data->ImageURL))) {
            File::delete(public_path('imageArtist/' . $data->ImageURL));
        }
        if (File::exists(public_path('audioArtist/' . $data->SampleURL))) {
            File::delete(public_path('audioArtist/' . $data->SampleURL));
        }
        $data->delete();
        return redirect('/')->with(
            'delete', 'Success Delete Music !'
        );
    }
}
