  
    <section id="footer" class="row">
        <div class="alamat col-lg-6 col-md-12 col-sm-12">
            <div class="text">
                <img src="{{ URL::asset('user/assets/pers.png') }}" alt="" width="85px">
                <img src="{{ URL::asset('user/assets/Logo BJW 2022/FIX BJW 2K22-01.png') }}" alt="" width="200px">
                <h4>Sekretariat</h4>
                <h5>Panitia Bali Journalist Week 2022</h5>
                <p>Jl. DR. Goris No.7, Dangin Puri Klod, Kec. Denpasar Tim., Kota Denpasar, Bali 80234</p>
                
                <h4>Akun Resmi</h4>
                <div class="social">
                    <a href="https://www.instagram.com/" target="blank">
                        <i class="fab fa-instagram fa-2x text-color-primary"></i>
                    </a><br>
                    <a href="" target="blank">
                        <i class="fab fa-youtube fa-2x text-color-primary"></i>
                    </a><br>
                    <a href="mailto:studentday2020@bemudayana.id?
                            subject=MessageTitle&amp;
                            body=Message Content">
                        <i class="fa fa-envelope fa-2x text-color-primary"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="kontak col-lg-6 col-md-12 col-sm-12">
            <div class="form">
                <h4>Contact Us</h4>
                <form action="">
                    <label for="name">Name*</label>
                    <input type="text" name="name" id="name" placeholder="Enter your name">
                    <br>
                    <label for="email">Email*</label>
                    <input type="text" name="email" id="email" placeholder="Enter your email">
                    <br>
                    <label for="subject">Subject*</label>
                    <input type="text" name="subject" id="subject" placeholder="Enter your subject">
                    <br>
                    <label for="message">Message*</label>
                    <textarea name="message" id="message" cols="10" rows="3"></textarea>
                    <br>
                    <input type="submit" name="submit" id="submit" value="Submit">
                </form>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(window).on('load', function () {
        $('#loading').hide();
        }) 
    </script>
    