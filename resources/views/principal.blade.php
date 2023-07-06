@extends('welcome')
@section('contenido')
<!-- Carrusel -->
<style>
    .slider {
        width: 75vw;
        height: auto;
        margin: auto;
        overflow: hidden;
    }

    .slider .slider-track {
        display: flex;
        animation: scroll 30s linear infinite;
        width: calc(200px * 12);
        /* Ajusta el número de slides según corresponda */
        -webkit-animation: scroll 30s linear infinite;
    }

    .slider .slide {
        width: 200px;
    }

    .slider .slide img {
        width: 100%;
    }

    @keyframes scroll {
        0% {
            -webkit-transform: translateX(0);
            transform: translateX(0);
        }

        100% {
            -webkit-transform: translateX(calc(-200px * 6));
            transform: translateX(calc(-200px * 6));
        }
    }
</style>

<section class="tienda" style="margin-bottom: 20px; position: relative;">
    <div class="header-content container mt-4" style="position: absolute; top: 40%; transform: translateY(-50%); left: 5%; z-index: 2;"> <!-- Añadimos un índice de apilamiento superior al contenedor del texto -->
        <h1 style="color: white; font-size: 50px; margin-right: 50px;">El auto de tus</h1>
        <h1 style="color: white; font-size: 50px; margin-right: 50px;"> sueños espera por ti</h1>
        <p style="color: white; top: 70%; font-size: 20px;">Comprometidos con darte la mejor experiencia</p>
        <a class="btn btn-warning mt-4" href="{{route('productos')}}" style="height: 50px; width: 130px; text-align: center; color: white;">PRODUCTOS</a>
        <div class="slider mt-4" style="margin-top: 20px; padding-top: 20px;">
            <div class="slider-track mt-4">
                <div class="slide">
                    <img src="{{ asset('storage/logo1.jpg') }}" alt="" style="width: 150px; height: 50px;">
                </div>
                <div class="slide">
                    <img src="{{ asset('storage/logo2.jpg') }}" alt="" style="width: 150px; height: 50px;">
                </div>
                <div class="slide">
                    <img src="{{ asset('storage/logo3.jpg') }}" alt="" style="width: 150px; height: 50px;">
                </div>
                <div class="slide">
                    <img src="{{ asset('storage/logo4.jpg') }}" alt="" style="width: 150px; height: 50px;">
                </div>
                <div class="slide">
                    <img src="{{ asset('storage/logo5.jpg') }}" alt="" style="width: 150px; height: 50px;">
                </div>
                <div class="slide">
                    <img src="{{ asset('storage/logo6.jpg') }}" alt="" style="width: 150px; height: 50px;">
                </div>
                <div class="slide">
                    <img src="{{ asset('storage/logo1.jpg') }}" alt="" style="width: 150px; height: 50px;">
                </div>
                <div class="slide">
                    <img src="{{ asset('storage/logo2.jpg') }}" alt="" style="width: 150px; height: 50px;">
                </div>
                <div class="slide">
                    <img src="{{ asset('storage/logo3.jpg') }}" alt="" style="width: 150px; height: 50px;">
                </div>
                <div class="slide">
                    <img src="{{ asset('storage/logo4.jpg') }}" alt="" style="width: 150px; height: 50px;">
                </div>
                <div class="slide">
                    <img src="{{ asset('storage/logo5.jpg') }}" alt="" style="width: 150px; height: 50px;">
                </div>
                <div class="slide">
                    <img src="{{ asset('storage/logo6.jpg') }}" alt="" style="width: 150px; height: 50px;">
                </div>
            </div>
        </div>
    </div>
    <div id="carouselExampleIndicators" class="carousel" data-bs-interval="5000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('storage/principal.jpg') }}" alt="Imagen" class="d-block w-100" style="height: 600px; width: 247px;">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('storage/principal2.jpg') }}" alt="Imagen" class="d-block w-100" style="height: 600px; width: 247px;">
            </div>
        </div>
    </div>
</section>

<script>
    // JavaScript para alternar la visibilidad de las imágenes del carrusel
    var carouselItems = document.querySelectorAll('.carousel-item');

    function toggleCarouselItems() {
        for (var i = 0; i < carouselItems.length; i++) {
            carouselItems[i].classList.toggle('active');
        }
    }

    setInterval(toggleCarouselItems, 7000);
</script>
<!--Estilo -->
<style>
    .us-img {
        flex: 1;
        margin-left: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .us-img .img-img {
        max-width: 100%;
        border-radius: 50%;
    }

    .section_2-title-wrapper {
        display: inline-block;
        background-color: black;
        transform: skewX(-20deg);
        padding: 5px 10px;
    }

    .section_2-title {
        color: white;
        margin: 0;
        transform: skewX(20deg);
    }
</style>
<!-- Sobre nosotros-->
<section class="container section-2" style="margin-bottom: 50px;">
    <div class="section_2-title-wrapper" style="margin-bottom: 20px;">
        <h3 class="section_2-title">SOBRE NOSOTROS</h3>
    </div>
    <div class="us" style="display: flex; flex-direction: row-reverse; align-items: center;">
        <div class="us-imagen" style="flex: 1; margin-left: 100px;">
            <img src="{{ asset('storage/nosotros.jpg') }}" alt="" class="img-img" style="max-width: 100%;">
        </div>
        <div class="us-paragrap" style="flex: 1;">
            <p class="paragraph-text">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                Itaque minima reiciendis incidunt aliquid ipsam veniam
                minus optio earum quae iure modi, atque, suscipit quaerat et voluptates sequi omnis asperiores doloremque.
            </p>
            <p class="paragraph-text">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Quia voluptatibus quas totam sint odit voluptas debitis
                tempora assumenda quae voluptatem. Perferendis voluptatem
                minima dolores quod maxime dignissimos porro eligendi soluta.
            </p>
            <p class="paragraph-text">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                At assumenda sequi quis illum dolor laboriosam, voluptatum,
                cupiditate culpa consectetur omnis velit officiis fugiat accusamus,
                ad distinctio eius! Rem, dicta distinctio?
            </p>
        </div>
    </div>
</section>
<!-- FOTOS -->
<style>
    .collage {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-gap: 10px;
    }

    .collage img {
        width: 100%;
        height: auto;
    }
</style>
<div class="collage" style="margin-bottom: 50px;">
    <div>
        <img src="{{ asset('storage/imagen1.jpg') }}" alt="Imagen 1">
    </div>
    <div>
        <img src="{{ asset('storage/imagen2.jpg') }}" alt="Imagen 2">
        <img src="{{ asset('storage/imagen3.jpg') }}" alt="Imagen 3">
    </div>
    <div>
        <img src="{{ asset('storage/imagen4.jpg') }}" alt="Imagen 3">

    </div>
</div>
<!-- MISION -->
<style>
    .section_3-title-wrapper {
        display: inline-block;
        background-color: black;
        transform: skewX(-20deg);
        padding: 5px 10px;
    }

    .section_3-title {
        color: white;
        margin: 0;
        transform: skewX(20deg);
    }
</style>
<section class="container section_3" style="margin-bottom: 50px;">
    <div class="section_3-title-wrapper" style="margin-bottom: 20px;">
        <h3 class="section_3-title">MISION</h3>
    </div>
    <div class="us" style="display: flex; align-items: center;">
        <div class="us-img" style="flex: 1; margin-right: 30px;">
            <img src="{{ asset('storage/mision.jpg') }}" alt="" class="img-img" style="max-width: 100%;">
        </div>
        <div class="us-paragrap" style="flex: 1;">
            <p class="paragraph-text">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                Itaque minima reiciendis incidunt aliquid ipsam veniam
                minus optio earum quae iure modi, atque, suscipit quaerat et voluptates sequi omnis asperiores doloremque.
            </p>
            <p class="paragraph-text">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Quia voluptatibus quas totam sint odit voluptas debitis
                tempora assumenda quae voluptatem. Perferendis voluptatem
                minima dolores quod maxime dignissimos porro eligendi soluta.
            </p>
            <p class="paragraph-text">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                At assumenda sequi quis illum dolor laboriosam, voluptatum,
                cupiditate culpa consectetur omnis velit officiis fugiat accusamus,
                ad distinctio eius! Rem, dicta distinctio?
            </p>
        </div>
    </div>
</section>

<!-- VISION -->
<style>
    .section_4-title-wrapper {
        display: inline-block;
        background-color: black;
        transform: skewX(-20deg);
        padding: 5px 10px;
    }

    .section_4-title {
        color: white;
        margin: 0;
        transform: skewX(20deg);
    }
</style>
<section class="container section-4" style="margin-bottom: 50px;">
    <div class="section_4-title-wrapper" style="margin-bottom: 20px;">
        <h3 class="section_4-title">VISION</h3>
    </div>
    <div class="us" style="display: flex; flex-direction: row-reverse; align-items: center;">
        <div class="us-img">
            <img src="{{ asset('storage/vision.jpg') }}" alt="" class="img-img">
        </div>
        <div class="us-paragrap" style="flex: 1;">
            <p class="paragraph-text">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                Itaque minima reiciendis incidunt aliquid ipsam veniam
                minus optio earum quae iure modi, atque, suscipit quaerat et voluptates sequi omnis asperiores doloremque.
            </p>
            <p class="paragraph-text">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Quia voluptatibus quas totam sint odit voluptas debitis
                tempora assumenda quae voluptatem. Perferendis voluptatem
                minima dolores quod maxime dignissimos porro eligendi soluta.
            </p>
            <p class="paragraph-text">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                At assumenda sequi quis illum dolor laboriosam, voluptatum,
                cupiditate culpa consectetur omnis velit officiis fugiat accusamus,
                ad distinctio eius! Rem, dicta distinctio?
            </p>
        </div>
    </div>
</section>
<!-- TIENDA -->
<style>
    .section-3 {
        background-color: black;
        color: white;
        width: 100%;
        height: 450px;
        max-width: 1500px;
        /* Ajusta el valor según tus necesidades */
        margin: 0 auto;
        /* Centra el contenido horizontalmente */
        display: flex;
        justify-content: center;
    }

    .us-paragraph {
        flex: 2;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .us-paragraph p {
        margin: 0;
    }

    .us-paragraph h3 {
        margin: 0;
    }

    .us-paragraph iframe {
        width: 100%;
        height: 300px;
        /* Ajusta el valor según tus necesidades */
    }
</style>

<section class="container section-3 mt-4" style="margin-bottom: 20px;" >
    <div class="us mt-4" style="margin-bottom: 20px;">
        <div class="us-paragraph mt-4" style="margin-bottom: 20px;">
            <div>
                <h3 style="margin-bottom: 20px;">SERVICIOS</h3>
                <p class="paragraph-text">
                <p></p>
                <p></p>
                </p>
            </div>
            <div>
                <h3 style="margin-bottom: 20px;">CONTACTANOS</h3>
                <p class="paragraph-text">
                <p>
                    <a href="https://api.whatsapp.com/send?phone=980321736&text=Hola,quierounauto">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                            <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                        </svg>
                        936589429
                    </a>
                </p>

                <p>Mundo</p>
                </p>
            </div>
            <div>
                <h3 style="margin-bottom: 20px;">UBICACION</h3>
                <div class="iframe-container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1964058.352394271!2d-72.93919650000001!3d-15.958688350000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses!2spe!4v1688103833582!5m2!1ses!2spe" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection