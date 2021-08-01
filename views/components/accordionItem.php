    <div class="accordion-item">
        <div class="accordion-header">
            <h3 class="accordion-title s-cross-center"><?php echo $section->name ?>

                <?php
                if ($_SESSION['rol_id'] == 3 || $_SESSION['user_id'] == $course->user_id) {
                    echo '<span class="accordion-actions">';
                    echo '    <a class="button button-action blue s-cross-center s-main-center" href="">';
                    echo '        <span class="fas fa-pen"></span>';
                    echo '    </a>';
                    echo '    <a class="button button-action red s-cross-center s-main-center" href="">';
                    echo '        <span class="fas fa-trash"></span>';
                    echo '    </a>';
                    echo '</span>';
                }
                ?>

            </h3>
            <svg viewBox="0 0 16 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.0547 0.726562L15.9453 2.60938L8 10.5547L0.0546875 2.60938L1.94531 0.726562L8 6.78125L14.0547 0.726562Z" />
            </svg>
        </div>
        <div class="accordion-content">
            <p>
                <?php echo $section->description ?>
            </p>
            <ol class="accordion-links">
                <?php
                $classController = new ClassController();
                $classes = $classController->getClassesSection($section->id);
                $user = $_SESSION['user_id'];

                foreach ($classes as $class) {
                    echo '<li class="s-cross-center s-mb-05"><a href="../../scripts/createHistorical_ItemBD.php?class=' . $class->id . '&user=' . $user . '">' . $class->index . ' - ' . $class->name . '</a>';

                    if ($_SESSION['rol_id'] == 3 || $_SESSION['user_id'] == $course->user_id) {
                        echo '<span class="accordion-actions">';
                        echo '    <a class="button button-action blue icon-action small" href="">';
                        echo '        <span class="fas fa-pen"></span>';
                        echo '    </a>';
                        echo '    <a class="button button-action red icon-action small" href="">';
                        echo '        <span class="fas fa-trash"></span>';
                        echo '    </a>';
                        echo '</span>';
                    }
                    echo '</li>';
                }
                ?>
            </ol>
        </div>
    </div>