<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ URL::asset('css/about.css') }}" rel="stylesheet" type="text/css" media="all" />
    <title>BJW</title>
    <link rel="stylesheet" href="/VenoBox-master/dist/venobox.min.css" type="text/css" media="screen" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Web Fonts  -->

    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css">

    
    
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/venobox/1.9.0/venobox.min.css">
    <style>
        .dropbtn {
            background-color: transparent;
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            transition: 0.25s ease-out;
            font-size: 18px;
            margin: 0 15px 0 15px;
            border: none;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: rgba(78,148,79,255);
            min-width: 200px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius:  0 0 20px 20px;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }


        .dropdown:hover .dropdown-content {display: block;}

    </style>
</head>
<body>
    <div id="loading">
        <img id="loading-image" src="{{ URL::asset('user/assets/load.gif') }}" alt="Loading..." />
    </div>
    <section id="about">
        @include('layout.menu')
        
        <h2>About</h2>
        <h1>Bali Journalist Week</h1>
        <div id="content">
            <div class="desc">
                &emsp;&emsp;&emsp;&emsp;Bali Journalist Week (BJW) merupakan sebuah kegiatan yang diselenggarakan oleh Pers Mahasiswa Akademika Universitas Udayana sebagai wadah bagi pelajar dalam mengasah dan mengembangkan kemampuannya dalam bidang jurnalistik. BJW pada tahun ini mengusung tema Jurnalisme Lingkungan Hidup. Lingkungan menjadi hal penting dalam keberlangsungan hidup manusia, namun hingga saat ini berbagai permasalahan mengenai lingkungan masih banyak terjadi dan memberi dampak buruk dalam keberlangsungan hidup manusia itu sendiri. BJW 2022 dengan tema Jurnalisme lingkungan hidup nantinya menjadi sebuah proses pembuatan  informasi mengenai isu lingkungan dengan harapan menumbuhkan kesadaran masyarakat untuk pelestarian lingkungan demi keberlangsungan hidup yang lebih baik lagi. Adapaun tiga jenis kegiatan menarik sebagai rangkaian dari BJW 2022 yakni Seminar Nasional, Pelatihan Jurnalistik Tingkat Lanjut Nasional, Perlombaan Jurnalistik, dan sistem pelaksanaan kegiatan secara hybrid. 
            </div>
            <div class="teaser">
                <div id="video-sambutan"  class="row px-5 py-3 aos-init aos-animate" >
                    <div class="col-sm-12 col-md-6" data-aos="zoom-in-up">
                        <div class="d-flex w-100 justify-content-center card card-video align-items-center" style="background-image:url('../user/assets/Logo BJW 2022/FIX BJW 2K22-01.jpg');background-size:cover; background-position:top center; height:315px;" >
                            <div class="overlay justify-content-center align-items-center">
                                <!-- <h2 style="color:white;" class="title">Teaser</h2> -->
                            </div>
                            <a href="https://www.youtube.com/embed/OaAd7KpRBi4" class="venobox play-btn mb-4 vbox-item" data-vbtype="video" data-autoplay="true">
                            </a>
                        </div>
                    </div>
                
            </div>
        </div>
    </section>
    
    <section id="bg-galeri">
        <section id="galeri">
            <div class="judul">
                <h2>Gallery</h2>
                <h1>Bali Journalist Week</h1>
            </div>

            <div id="img-wrap">
                <div class="gridywrap">
                    <div class="gridy-2 gridyhe-1">
                        <div class="gridimg" style="background-image: url('../user/galeri/WEBPCompressed/1.webp')">&nbsp;</div>
            
                        <div class="gridinfo">
                            <h3></h3>
                            <a class="venobox grid-btn grid-more" href="{{ URL::asset('user/galeri/WEBPCompressed/1.webp') }}" ><span>More</span> <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
            
                    <div class="gridy-1 gridyhe-1">
                        <div class="gridimg" style="background-image: url('../user/galeri/WEBPCompressed/2.webp')">&nbsp;</div>
            
                        <div class="gridinfo">
                            <h3></h3>
                            <a class="venobox grid-btn grid-more" href="{{ URL::asset('user/galeri/WEBPCompressed/2.webp') }}" ><span>More</span> <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
            
                    <div class="gridy-1 gridyhe-2">
                        <div class="gridimg" style="background-image: url('../user/galeri/WEBPCompressed/3.webp')">&nbsp;</div>
            
                        <div class="gridinfo">
                            <h3></h3>
                            <a class="venobox grid-btn grid-more" href="{{ URL::asset('user/galeri/WEBPCompressed/3.webp') }}" ><span>More</span> <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
            
                    <div class="gridy-2 gridyhe-1">
                        <div class="gridimg" style="background-image: url('../user/galeri/WEBPCompressed/4.webp')">&nbsp;</div>
            
                        <div class="gridinfo">
                            <h3></h3>
                            <a class="venobox grid-btn grid-more" href="{{ URL::asset('user/galeri/WEBPCompressed/4.webp') }}" ><span>More</span> <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
            
                    <div class="gridy-1 gridyhe-1">
                        <div class="gridimg" style="background-image: url('../user/galeri/WEBPCompressed/5.webp')">&nbsp;</div>
            
                        <div class="gridinfo">
                            <h3></h3>
                            <a class="venobox grid-btn grid-more" href="{{ URL::asset('user/galeri/WEBPCompressed/5.webp') }}" ><span>More</span> <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
            
                    <div class="gridy-1 gridyhe-1">
                        <div class="gridimg" style="background-image: url('../user/galeri/WEBPCompressed/6.webp')">&nbsp;</div>
            
                        <div class="gridinfo">
                            <h3></h3>
                            <a class="venobox grid-btn grid-more" href="{{ URL::asset('user/galeri/WEBPCompressed/6.webp') }}" ><span>More</span> <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
            
                    <div class="gridy-2 gridyhe-1">
                        <div class="gridimg" style="background-image: url('../user/galeri/WEBPCompressed/7.webp')">&nbsp;</div>
            
                        <div class="gridinfo">
                            <h3></h3>
                            <a class="venobox grid-btn grid-more" href="{{ URL::asset('user/galeri/WEBPCompressed/7.webp') }}" ><span>More</span> <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
            
                    <div class="gridy-1 gridyhe-1">
                        <div class="gridimg" style="background-image: url('../user/galeri/WEBPCompressed/8.webp')">&nbsp;</div>
            
                        <div class="gridinfo">
                            <h3></h3>
                            <a class="venobox grid-btn grid-more" href="{{ URL::asset('user/galeri/WEBPCompressed/8.webp') }}" ><span>More</span> <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
            
                    <div class="gridy-1 gridyhe-2">
                        <div class="gridimg" style="background-image: url('../user/galeri/WEBPCompressed/9.webp')">&nbsp;</div>
            
                        <div class="gridinfo">
                            <h3></h3>
                            <a class="venobox grid-btn grid-more" href="{{ URL::asset('user/galeri/WEBPCompressed/9.webp') }}" ><span>More</span> <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
            
                    <div class="gridy-2 gridyhe-1">
                        <div class="gridimg" style="background-image: url('../user/galeri/WEBPCompressed/10.webp')">&nbsp;</div>
            
                        <div class="gridinfo">
                            <h3></h3>
                            <a class="venobox grid-btn grid-more" href="{{ URL::asset('user/galeri/WEBPCompressed/10.webp') }}" ><span>More</span> <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
            
                    <div class="gridy-1 gridyhe-1">
                        <div class="gridimg" style="background-image: url('../user/galeri/WEBPCompressed/11.webp')">&nbsp;</div>
            
                        <div class="gridinfo">
                            <h3></h3>
                            <a class="venobox grid-btn grid-more" href="{{ URL::asset('user/galeri/WEBPCompressed/11.webp') }}" ><span>More</span> <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
            
                    <div class="gridy-1 gridyhe-1">
                        <div class="gridimg" style="background-image: url('../user/galeri/WEBPCompressed/12.webp')">&nbsp;</div>
            
                        <div class="gridinfo">
                            <h3></h3>
                            <a class="venobox grid-btn grid-more" href="{{ URL::asset('user/galeri/WEBPCompressed/12.webp') }}" ><span>More</span> <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                    <div class="gridy-2 gridyhe-1">
                        <div class="gridimg" style="background-image: url('../user/galeri/WEBPCompressed/13.webp')">&nbsp;</div>
            
                        <div class="gridinfo">
                            <h3></h3>
                            <a class="venobox grid-btn grid-more" href="{{ URL::asset('user/galeri/WEBPCompressed/13.webp') }}" ><span>More</span> <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
            
                    <div class="gridy-1 gridyhe-1">
                        <div class="gridimg" style="background-image: url('../user/galeri/WEBPCompressed/14.webp')">&nbsp;</div>
            
                        <div class="gridinfo">
                            <h3></h3>
                            <a class="venobox grid-btn grid-more" href="{{ URL::asset('user/galeri/WEBPCompressed/14.webp') }}" ><span>More</span> <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
            
                    <div class="gridy-1 gridyhe-2">
                        <div class="gridimg" style="background-image: url('../user/galeri/WEBPCompressed/15.webp')">&nbsp;</div>
            
                        <div class="gridinfo">
                            <h3></h3>
                            <a class="venobox grid-btn grid-more" href="{{ URL::asset('user/galeri/WEBPCompressed/15.webp') }}" ><span>More</span> <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
            
                    <div class="gridy-2 gridyhe-1">
                        <div class="gridimg" style="background-image: url('../user/galeri/WEBPCompressed/16.webp')">&nbsp;</div>
            
                        <div class="gridinfo">
                            <h3></h3>
                            <a class="venobox grid-btn grid-more" href="{{ URL::asset('user/galeri/WEBPCompressed/16.webp') }}" ><span>More</span> <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
            
                    <div class="gridy-1 gridyhe-1">
                        <div class="gridimg" style="background-image: url('../user/galeri/WEBPCompressed/17.webp')">&nbsp;</div>
            
                        <div class="gridinfo">
                            <h3></h3>
                            <a class="venobox grid-btn grid-more" href="{{ URL::asset('user/galeri/WEBPCompressed/17.webp') }}" ><span>More</span> <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
            
                    <div class="gridy-1 gridyhe-1">
                        <div class="gridimg" style="background-image: url('../user/galeri/WEBPCompressed/18.webp')">&nbsp;</div>
            
                        <div class="gridinfo">
                            <h3></h3>
                            <a class="venobox grid-btn grid-more" href="{{ URL::asset('user/galeri/WEBPCompressed/18.webp') }}" ><span>More</span> <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    @include('layout.footer')
        
    
    
</body>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="VenoBox-master/dist/venobox.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/venobox/1.9.0/venobox.min.js"></script>
<script>
    $(window).on('load', function () {
      $('#loading').hide();
    }) 
</script>
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.4.0/lightgallery.umd.min.js"></script>
<script>
    $(document).ready(function(){
        $('.venobox').venobox();});
</script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>

</html>