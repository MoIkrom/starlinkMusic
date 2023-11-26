<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Music | Starlink</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body style="background-color: rgb(106, 255, 235)">
    <div class="mt-4 text-center fw-bold fs-4"> Welcome to Starlink Palylist Music</div>

    @yield('index')
    @yield('addMusic')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const formatNumber = () => {
            var bilangan = document.getElementById('inputPrice').value;

            // Hapus semua karakter non-digit (kecuali angka)
            bilangan = bilangan.replace(/\D/g, '');

            // Format angka dengan menambahkan titik setiap 3 digit
            bilangan = bilangan.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");

            // Tampilkan angka yang telah diformat kembali di input field
            document.getElementById('inputPrice').value = bilangan;
        }
    </script>


</body>

</html>
