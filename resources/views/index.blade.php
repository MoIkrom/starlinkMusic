@extends('master')
@include('css.indexCss')

@section('index')
    @if (session('update'))
        <script>
            Swal.fire({
                title: "Good job!",
                text: "{{ session('update') }}",
                icon: "success"
            });
        </script>
    @elseif(session('create'))
        <script>
            Swal.fire({
                title: "Good job!",
                text: "{{ session('create') }}",
                icon: "success"
            });
        </script>
    @elseif(session('delete'))
        <script>
            Swal.fire({
                title: "Good job!",
                text: "{{ session('delete') }}",
                icon: "success"
            });
        </script>
    @endif
    <div class="container p-5 bg-white mt-5">
        <div>
            <a href="{{ route('addMusic') }}">
                <button class="btn btn-primary mb-5">Add New + </button>
            </a>
        </div>
        <table class="table">
            <thead class="text-center">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Package Name</th>
                    <th scope="col">Artist Name</th>
                    <th scope="col">Date Release</th>
                    <th scope="col">Audio</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @php $i = 1 @endphp
                @foreach ($data as $item)
                    <tr>
                        <td class="centered">
                            {{ $loop->iteration }}</td>
                        <td class= "d-flex gap-1 justify-content-center align-items-center py-3">
                            <div class="col-6">
                                @if ($item->ImageURL)
                                    <img src="{{ asset('imageArtist/' . $item->ImageURL) }}" alt=""
                                        style="width: 80px; height: 80px;">
                                @else
                                    <img src="{{ asset('no-images.jpeg') }}" alt=""
                                        style="width: 100px; height: 100px;">
                                @endif
                            </div>
                            <div class="col-6">
                                <p class="m-0">
                                    {{ $item->PackageName }}
                                </p>
                            </div>
                        </td>
                        <td class="centered"> {{ $item->ArtistName }}</td>
                        <td class="centered"> {{ \Carbon\Carbon::parse($item->ReleaseDate)->translatedFormat('d M Y') }}
                        </td>
                        <td class="centered">
                            <audio id="audio{{ $loop->iteration }}" controls>
                                <source src="{{ asset('audioArtist/' . $item->SampleURL) }}" type="audio/mp3">
                            </audio>
                            @if ($item->SampleURL == null)
                                <p class="m-0 pt-1 text-danger" style="font-size: 12px;"> *No Audio Available</p>
                            @endif
                        </td>
                        <td class="centered">{{ $item->price }}</td>
                        <td class="centered">
                            <div>
                                <a href="{{ route('show', $item->id) }}">
                                    <button class="btn btn-primary">Edit</button></a>
                                <button class="btn btn-danger delete-music" data-music-id="{{ $item->id }}"
                                    onclick="deleteModal()">Delete</button>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const deleteModal = () => {
        Swal.fire({
            title: "Are you sure want to delete this music?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                const musicId = document.querySelector('.delete-music').getAttribute('data-music-id');
                window.location.href = `/delete-music/${musicId}`;
            }
        });
    }
    document.addEventListener('play', function(e) {
        const allAudios = document.getElementsByTagName('audio');
        for (let i = 0, len = allAudios.length; i < len; i++) {
            if (allAudios[i] !== e.target) {
                allAudios[i].pause();
            }
        }
    }, true);
</script>
