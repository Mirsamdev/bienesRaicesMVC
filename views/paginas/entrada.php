<main class="contenedor seccion contenido-centrado">

<h1>Guía para la decoración de tu hogar</h1>



<article class="entrada-blog">

<div class="imagen">

<picture>

<!-- <source srcset="build/img/blog1.webp" type="image/webp">

<source srcset="build/img/blog1.jpg" type="image/jpeg"> -->

<img loading="lazy" src="/imagenes/<?php echo $blog->imagen; ?>" alt="Texto Entrada Blog">

</picture>

</div>



<div class="texto-entrada">

<a href="blog?id=<?php echo $blog->id; ?>">

<h4><?php echo $blog->titulo; ?></h4>

<p>Escrito el: <span><?php echo $blog->fecha; ?></span> por: <span><?php echo $blog->autor; ?></span> </p>



<p>

<p><?php echo $blog->detalles; ?></p>

</p>

</a>

</div>

</article>



</main>