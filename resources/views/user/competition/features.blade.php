<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ URL::asset('css/features.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link rel="shortcut icon" type="image/png" href="{{ URL::asset('user/assets/Logo BJW 2022/FIX BJW 2K22-01.png') }}">
    <title>BJW</title>
    <link rel="stylesheet" href="/VenoBox-master/dist/venobox.min.css" type="text/css" media="screen" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Web Fonts  -->

    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css">

    
    
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/venobox/1.9.0/venobox.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/themes/splide-sea-green.min.css">
</head>
<body>
    <div id="loading">
        <img id="loading-image" src="{{ URL::asset('user/assets/load.gif') }}" alt="Loading..." />
    </div>
    <section id="about">
        @include('layout.menu')

        <h2>Competition</h2>
        <h1>Features</h1>
        <div id="content">
            <div class="teaser">
                <form action="{{ route('user.guidebook') }}" method="POST">
                    @csrf
                    <button class="btn btn-success" type="submit" name="submit" value="Download Guide Book" id="submit">Download Guide Book</button>
                </form>
                <br>
                <p>Click the image to download.</p>
                <section id="image-carousel" class="splide" aria-label="Beautiful Images">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <li class="splide__slide">
                                <form action="{{ route('user.pamflet') }}" method="POST">
                                    @csrf
                                    <div class="thumbnail">
                                        <input type="image" name="submit" src="{{ URL::asset('pamflet/pamflet.png') }}"/>
                                    </div>
                                </form>
                            </li>
                            <li class="splide__slide">
                                <form action="{{ route('user.pamflet.features') }}" method="POST">
                                    @csrf
                                    <div class="thumbnail">
                                        <input type="image" name="submit" src="{{ URL::asset('pamflet/features.png') }}"/>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>
                </section>
            </div>
            <div class="desc">
                <h3 style="text-align: center">Register Here</h3>
                <form action="{{ route('user.features.submit') }}" method="post" enctype="multipart/form-data" enctype="multipart/form-data">
                    @csrf
                    <label for="name">Name*</label>
                    <input type="text" name="name" id="name" placeholder="Name" value="{{ old('name') }}" required><br>
                    @error('name')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label for="email">Email*</label>
                    <input type="text" name="email" id="email" placeholder="Email" value="{{ old('email') }}" required><br>
                    @error('email')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label for="email">Phone*</label>
                    <input type="number" name="phone" id="phone" placeholder="Phone" value="{{ old('phone') }}" required><br>
                    @error('phone')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label for="institution">Institution*</label>
                    <input type="text" name="institution" id="institution" value="{{ old('institution') }}" placeholder="Institution" required><br>
                    @error('institution')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label for="proof_of_payment">Proof of Payment*</label>
                    <input type="file" name="proof_of_payment" id="proof_of_payment" placeholder="Proof of Payment" value="{{ old('proof_of_payment') }}" required><br>
                    @error('proof_of_payment')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label for="line">ID Line*</label>
                    <input type="text" name="line" id="line" value="{{ old('line') }}" placeholder="line" required><br>
                    @error('line')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <label for="ktm">KTM / KTP*</label>
                    <input type="file" name="ktm" id="ktm" value="{{ old('ktm') }}" placeholder="Proof of Payment" required><br>
                    @error('ktm')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input type="submit" name="submit" value="Submit">
                </form>
            </div>
        </div>
    </section>

    @include('layout.footer')
    <script type="text/javascript" src="VenoBox-master/dist/venobox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lightgallery@2.4.0/lightgallery.umd.min.js"></script>
    <script>
        new VenoBox({
            selector: '.venobox',
        });
    </script>
    <script>
        window.addEventListener('swal',function(e) {
            Swal.fire({
                title:  e.detail.title,
                type: "success",
                timer: 3000,
                toast: true,
                position: 'top-right',
                toast:  true,
                showConfirmButton:  false,
            });
        });
    </script>
    {{-- Sweetalert --}}
    @include('sweetalert::alert')      
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>    
</body>
</html>