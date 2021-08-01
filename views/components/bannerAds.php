    <!-- Banner -->
    <section class="banner l-section s-py-4">
        <!-- Separación del contenido en columnas -->
        <div class="banner-content ed-grid lg-grid-2 row-gap s-gap-2 m-gap-4">
            <!-- Contenido de la columna 1 -->
            <div class="s-column s-main-center lg-main-start lg-cross-start s-center lg-left">
                <h1 class="banner-title"><?php echo $title ?></h1>
                <p class="banner-description"><?php echo $description ?></p>
                <!-- Botones -->
                <div class="s-main-center">
                    <a class="button s-mr-2 s-mb-2 m-mb-0" href="<?php echo $buttonUrl ?>"><?php echo $buttonTitle ?></a>
                    <!-- <a class="button s-mb-2 m-mb-0">Botón 2</a> -->
                </div>
            </div>
            <!-- Contenido de la columna 2 -->
            <div>
                <div class="img-container s-ratio-16-9">
                    <img class="s-radius-1" src="<?php echo $imgUrl?>">
                </div>
            </div>
        </div>
    </section>