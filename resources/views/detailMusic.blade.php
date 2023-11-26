@extends('master')
@include('css.indexCss')

@section('addMusic')
    <form action="{{ route('update', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container w-50 p-5 bg-white my-5">
            <div class="p-2">
                <div class="mb-5 text-center text-decoration-underline">
                    <h3>Edit Playlist</h3>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Package Name</label>
                    <input required type="text" class="form-control" name="PackageName" placeholder="Package Name"
                        value="{{ $data->PackageName }}">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Artist Image</label>
                    <input type="file" class="form-control" name="ImageURL" placeholder="Artist Image">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Artist Name</label>
                    <input required type="text" class="form-control" name="ArtistName" value="{{ $data->ArtistName }}"
                        placeholder="Artist Name">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Date Release</label>
                    <input required type="date" class="form-control" name="ReleaseDate" value="{{ $data->ReleaseDate }}"
                        placeholder="Date Release">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Audio</label>
                    <input type="file" class="form-control" name="SampleURL" placeholder="Input Audio">
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Price </label>
                    <input required type="text" class="form-control" name="price" id="inputPrice"
                        onkeyup="formatNumber()" value="{{ number_format($data->price, 0, ',', '.') }} "
                        placeholder="Input Price">
                </div>
            </div>
            <div class="mb-4"><button class="btn btn-primary float-end w-25 ">Save</button>
            </div>
        </div>
    </form>
@endsection
