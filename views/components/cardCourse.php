        <!-- Card curso -->
        <article class="course-card">
            <!--Contenedor de la imagen-->
            <a href="course.php?id=<?php echo $course->id ?>">
                <div class="s-ratio-16-9 img-container s-radius-tl s-radius-tr">
                    <img src="<?php echo $course->picture ?>">
                </div>
            </a>
            <!--Contenido-->
            <div class="course-card-content s-pxy-2">
                <h3><?php echo $course->name ?></h3>
                <p class="s-mb-0 block-ellipsis"><?php echo $course->description ?></p>
            </div>

            <div class="course-card-type-score s-pxy-2">
                <!-- <span class="button green small s-radius-05"> -->
                    <?php
                    if ($course->type==0) {
                        echo '<a href="courses?type=curso" class="button smaller">curso</a>';
                    }elseif ($course->type==1) {
                        echo '<a href="courses?type=taller" class="button green smaller">taller</a>';
                    }
                    ?>
                <!-- </span> -->
                <span class="course-score">
                    <span class="fas fa-star"></span>
                    <?php echo $course->score ?>
                </span>
            </div>

            <footer class="course-card-footer s-cross-center s-pb-2 s-px-2 s-radius-br s-radius-bl">
                <?php
                $userController = new UserController();
                $user = $userController->getUserData($course->user_id);
                ?>
                <!--Define el ancho máximo de la imagen-->
                <div class="s-10 m-15 s-mr-1 lg-mr-2 s-cross-center">
                    <!--Contenedor de la imagen-->
                    <div class="circle img-container">
                        <a href="profile?=<?php echo $user->id; ?> ">
                            <img src="<?php echo $user->picture; ?>">
                        </a>
                    </div>
                    <!--Profesor-->
                </div>
                <p class="s-mb-0">Prof. <?php echo $user->name . " " . $user->lastName; ?></p>
                <!--Boton-->
                <!-- <div class="button s-to-right">$40USD</div> -->
            </footer>
        </article>