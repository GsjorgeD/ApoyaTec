<?php
require_once '../../controllers/userController.php';
$user = new UserController();
$user->headPages('Temario');

include("../../database/conect.php");
$idCurso = $_GET['idCurso'];
$sql = 'select*from courses where id =' . $idCurso;
$resultado = $cn->query($sql);
$datosCurso = $resultado->fetch(PDO::FETCH_OBJ);
?>

<main class="main">


    <div class=" s-to-center column">
        <h1 class="s-pt-4 s-center">Temario</h1>

        <div class="temary-header s-center ">
            <p class="s-center">Deja recursos a tus estudiantes para permitirles comprender mejor los temas, o deja links a los ejemplos elaborados por ti en clase o de manera externa.</p>
        </div>

    </div>

    <section class="">
        <div class="ed-grid s-grid-4">
            <div class="s-cols-3">
                <h2 class="s-main-center">Secciones</h2>
                <div class="accordion-list ed-grid">

                    <!-- ------------------------------ -->
                    <?php
                    $sql = "select * from sections where course_id=" . $idCurso . " order by sections.index";
                    $resultado = $cn->query($sql);
                    $secciones = $resultado->fetchAll(PDO::FETCH_OBJ);
                    $numeroSeccion = 1;
                    foreach ($secciones as $seccion) {
                        echo "<div class='accordion-item'>";
                        echo "<div class='accordion-header'>";
                        echo "<h3 class='accordion-title'>" . $seccion->name . "
                                <a class='button button-action blue s-cross-center s-main-center' href='editSection.php?idCurso=" . $idCurso . "&idSeccion=" . $seccion->id . "'>
                                    <span class='fas fa-pen'></span>
                                </a>
                                <a class='button button-action red s-cross-center s-main-center' href='deleteSection.php?idCurso=" . $idCurso . "&idSeccion=" . $seccion->id . "'>
                                    <span class='fas fa-trash'></span>
                                </a>
                            </h3>";

                        echo "<svg viewBox='0 0 16 11' fill='none' xmlns='http://www.w3.org/2000/svg'>
                                    <path d='M14.0547 0.726562L15.9453 2.60938L8 10.5547L0.0546875 2.60938L1.94531 0.726562L8 6.78125L14.0547 0.726562Z' />
                                </svg>";
                        echo "</div>";

                        echo "<div class='accordion-content'>";
                        echo "<p>" . $seccion->description . "</p>";

                        echo "<ul class='accordion-links ed-grid'>";
                        $numeroClase = 1;
                        $sql = "select * from classes where course_id=" . $idCurso . " and section_id=" . $numeroSeccion . " order by classes._index;";
                        $resultado = $cn->query($sql);
                        $clases = $resultado->fetchAll(PDO::FETCH_OBJ);
                        foreach ($clases as $clase) {
                            echo "<li>";
                            echo "<span>" . $numeroSeccion . "." . $numeroClase . " " . $clase->name . "</span>";
                            echo "<span class='accordion-actions'>
                            <a class='button button-action blue icon-action small' href='editClass.php?idCurso=" . $idCurso . "&idSeccion=" . $numeroSeccion . "&idClase=" . $clase->id . "'>" .
                                "<span class='fas fa-pen'></span>
                            </a>
                            <a class='button button-action red icon-action small' href=''>
                                <span class='fas fa-trash'></span>
                            </a>
                        </span>";

                            echo "</li>";
                            $numeroClase++;
                        }
                        echo "</ul>";
                        echo "</div>";
                        echo "</div>";
                        $numeroSeccion++;
                    }
                    ?>
                </div>

            </div>

            <div class="s-to-center column s-center">
                <div>
                    <a href="createSection.php?idCurso=<?php echo $idCurso ?>" class="button green button-icon s-mb-3">
                    <svg class="icon" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.34844 14.8077L14.8074 14.8077L14.8074 6.38353C14.8026 6.23114 14.8287 6.07937 14.884 5.9373C14.9394 5.79524 15.0228 5.66581 15.1294 5.55678C15.3602 5.32597 15.6733 5.19631 15.9997 5.19631C16.3261 5.19631 16.6391 5.32597 16.8699 5.55678C16.9787 5.66145 17.0648 5.78723 17.1232 5.9264C17.1816 6.06558 17.2109 6.21522 17.2093 6.36613L17.1658 14.8338L25.677 14.8338C25.9607 14.8307 26.2349 14.9366 26.4428 15.1297C26.6736 15.3605 26.8033 15.6735 26.8033 15.9999C26.8033 16.3264 26.6736 16.6394 26.4428 16.8702C26.3365 16.9857 26.2073 17.0779 26.0635 17.1408C25.9197 17.2037 25.7644 17.236 25.6074 17.2357L17.1919 17.1922L17.1919 25.6338C17.1943 25.7832 17.1671 25.9317 17.1119 26.0706C17.0566 26.2095 16.9744 26.3361 16.8699 26.4431C16.6391 26.6739 16.3261 26.8036 15.9997 26.8036C15.6733 26.8036 15.3602 26.6739 15.1294 26.4431C15.0207 26.3384 14.9345 26.2127 14.8761 26.0735C14.8178 25.9343 14.7884 25.7847 14.79 25.6338L14.8335 17.1661L6.32233 17.1661C6.03858 17.1692 5.76445 17.0633 5.5565 16.8702C5.32569 16.6394 5.19603 16.3264 5.19603 15.9999C5.19603 15.6735 5.32569 15.3605 5.5565 15.1297C5.76798 14.9234 6.05255 14.8077 6.34844 14.8077Z" fill="black" />
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M16 30C23.732 30 30 23.732 30 16C30 8.26801 23.732 2 16 2C8.26801 2 2 8.26801 2 16C2 23.732 8.26801 30 16 30ZM16 32C24.8366 32 32 24.8366 32 16C32 7.16344 24.8366 0 16 0C7.16344 0 0 7.16344 0 16C0 24.8366 7.16344 32 16 32Z" fill="black" />
                        </svg>Crear sección
                    </a>
                </div>

                <!-- <a href="" class="button green button-icon icon s-mb-3">
                    <svg class="icon" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3.55556 32H28.4444C30.4053 32 32 30.4053 32 28.4444V8.88889C32.0002 8.6554 31.9543 8.42417 31.865 8.20848C31.7756 7.99278 31.6444 7.79687 31.4791 7.632L24.368 0.520891C24.2032 0.355482 24.0073 0.224303 23.7916 0.134907C23.5759 0.0455113 23.3446 -0.000336798 23.1111 1.86253e-06H3.55556C1.59467 1.86253e-06 0 1.59467 0 3.55556V28.4444C0 30.4053 1.59467 32 3.55556 32ZM21.3333 28.4444H10.6667V19.5556H21.3333V28.4444ZM17.7778 7.11111H14.2222V3.55556H17.7778V7.11111ZM3.55556 3.55556H7.11111V10.6667H21.3333V3.55556H22.3751L28.4444 9.62489L28.4462 28.4444H24.8889V19.5556C24.8889 17.5947 23.2942 16 21.3333 16H10.6667C8.70578 16 7.11111 17.5947 7.11111 19.5556V28.4444H3.55556V3.55556Z" fill="white" />
                    </svg>Guardar cambios
                </a> -->

                <a href="updateCourse.php?idCurso=<?php echo $idCurso ?>" class="button red button-icon icon s-mb-3">
                    <svg class="icon" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.0186 8.3323L16 14.3137L21.9568 8.35691C22.0612 8.2458 22.1869 8.15691 22.3265 8.09558C22.4661 8.03425 22.6166 8.00174 22.7691 8C23.0955 8 23.4085 8.12967 23.6393 8.36047C23.8701 8.59128 23.9998 8.90433 23.9998 9.23074C24.0027 9.38163 23.9747 9.53152 23.9175 9.6712C23.8604 9.81088 23.7753 9.93741 23.6675 10.043L17.6492 15.9998L23.6675 22.0181C23.8703 22.2166 23.9893 22.4853 23.9998 22.7689C23.9998 23.0953 23.8701 23.4083 23.6393 23.6391C23.4085 23.8699 23.0955 23.9996 22.7691 23.9996C22.6122 24.0061 22.4557 23.9799 22.3095 23.9227C22.1633 23.8655 22.0306 23.7785 21.9199 23.6673L16 17.6859L10.0309 23.655C9.92693 23.7624 9.8027 23.8482 9.66539 23.9073C9.52809 23.9664 9.38043 23.9978 9.23094 23.9996C8.90453 23.9996 8.59148 23.8699 8.36068 23.6391C8.12987 23.4083 8.0002 23.0953 8.0002 22.7689C7.99733 22.618 8.02533 22.4681 8.08247 22.3284C8.13961 22.1887 8.2247 22.0622 8.3325 21.9566L14.3508 15.9998L8.3325 9.98149C8.12966 9.78304 8.01071 9.51432 8.0002 9.23074C8.0002 8.90433 8.12987 8.59128 8.36068 8.36047C8.59148 8.12967 8.90453 8 9.23094 8C9.52632 8.00369 9.80939 8.12307 10.0186 8.3323Z" fill="white" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16 30C23.732 30 30 23.732 30 16C30 8.26801 23.732 2 16 2C8.26801 2 2 8.26801 2 16C2 23.732 8.26801 30 16 30ZM16 32C24.8366 32 32 24.8366 32 16C32 7.16344 24.8366 0 16 0C7.16344 0 0 7.16344 0 16C0 24.8366 7.16344 32 16 32Z" fill="white" />
                    </svg>Salir
                </a>
            </div>
        </div>

    </section>
</main>

<?php
require_once('../components/footer.php');
require_once('../includes/footPages.php');
?>