<?php
require_once '../../controllers/userController.php';
require_once '../../controllers/courseController.php';
require_once '../../controllers/sectionController.php';
require_once '../../controllers/classController.php';
require_once '../../controllers/questionController.php';
require_once '../../controllers/answerController.php';
require_once '../../controllers/resourceController.php';

$userController = new UserController();
$userController->headPages('Clase');

$courseController = new CourseController();
$sectionController = new SectionController();
$classController = new ClassController();
$questionController = new QuestionController();
$answerController = new AnswerController();
$resourceController = new ResourceController();

// $classes = $classController->getClassesSection($_GET['section']);
$class = $classController->getClass($_GET['class']);
$course = $courseController->getCourseData($class->course_id);
$teacherData = $userController->getUserData($course->user_id);
$userData = $userController->getUserData($_SESSION['user_id']);
?>

<style>
    .class-head {
        margin: 1rem 0;
    }

    .class-title {
        margin: 0;
    }

    .class-course-link {
        color: var(--color-text-secondary);
    }

    .class-asesor {
        display: flex;
        margin-bottom: 1rem;
        color: var(--color-icon);
    }

    .profile-img {
        margin-right: 1rem;
        width: 3rem;
    }

    .class-notes {
        margin-top: 0rem;
        margin-bottom: 2rem;
        border-top: 1px solid var(--color-text-tertiary);
        border-bottom: 1px solid var(--color-text-tertiary);
        padding: 1rem 0;
        color: var(--color-icon);
    }
</style>

<!-- Seccion de comentarios -->
<style>
    .questions-form-container {
        background-color: var(--color-bg-dark);
        border-radius: var(--border-radius);
        margin-bottom: 0.5rem;
    }

    .questions-container {
        background-color: var(--color-bg-secondary);
        border-radius: var(--border-radius);
        margin-bottom: 0.5rem;
    }

    .question-title-container,
    .answer-title-container {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
    }

    .answer-container {
        background-color: var(--color-bg-dark);
        margin: 0 2rem 0.5rem;
        padding: 0.5rem;
        border-radius: var(--border-radius);
    }

    .answer-content {
        margin-bottom: 0.25rem;
        margin-left: 0.5rem;
    }
</style>

<style>
    .resources-title {
        margin-bottom: 0.4rem;
        padding: 0 0.2rem;
    }

    .resources-label {
        font-size: var(--font-size-small);
        color: var(-color-icon);
        margin-bottom: 0.4rem;
        padding: 0 0.2rem;

    }

    .resources-container {
        background-color: var(--color-bg-dark);
        border-radius: var(--border-radius);
    }

    .resource-item {
        font-size: var(--font-size-small);
    }

    .resource-item span {
        margin-left: 0.5rem;
    }

    .resource-item:hover a,
    .resource-item:hover path {
        color: var(--color-primary-light);
        fill: var(--color-primary-light);
    }
</style>

<main class="main " >
    <!-- Obtener la informacion del curso y mostrarla -->
    <section class="s-pt-4">
        <div class="ed-grid s-grid-1 lg-grid-10">
            <!-- Video del lado izquierdo -->
            <div class="lg-cols-7 s-mb-2">
                <div class="ed-video">
                    <iframe src="<?php echo $class->urlVideo ?>"></iframe>
                </div>

                <div class="class-head">
                    <h2 class="class-title"><?php echo $class->name ?></h2>
                    <a class="class-course-link" href="course.php?id=<?php echo $course->id ?>"><?php echo $course->name ?></a>
                </div>

                <!-- Asesor -->
                <div class="class-asesor">
                    <div class="s-center">
                        <div class="profile-img">
                            <div class="circle img-container">
                                <img src="<?php echo $teacherData->picture ?>" alt="Asesor avatar">
                            </div>
                        </div>
                    </div>
                    <div class="s-cols-3 s-cross-center">
                        <span><?php echo $teacherData->name . " " . $teacherData->lastName ?></span>
                    </div>
                </div>

                <!-- Notas de clase -->
                <div class="class-notes">
                    <?php echo $class->notes ?>
                </div>
            </div>

            <!-- Temario en el lado derecho -->
            <div class="from-lg lg-cols-3">
                <section>
                    <article class="ed-grid ">
                        <div class="accordion-container">
                            <div class="accordion-list ">
                                <?php
                                $sections = $sectionController->getAllSection($course->id);
                                foreach ($sections as $item) {
                                    $sectionController->accordionItem($item, $course);
                                }
                                ?>
                            </div>
                        </div>
                    </article>
                </section>
            </div>

            <div class="lg-cols-7 s-mb-2">
                <section id="questionsSections">
                    <!-- Formulario para crear una nueva pregunta -->
                    <div class="questions-form-container">
                        <div class="s-pxy-2">
                            <form id="questionForm" action="">
                                <div class="question-title-container">
                                    <div class="s-center">
                                        <div class="profile-img">
                                            <div class="circle img-container">
                                                <img src="<?php echo $userData->picture ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <input required name="questionTitle" type="text" class="input ed-item" placeholder="Titulo de la pregunta">
                                </div>
                                <textarea required class="input input-text ed-item s-mb-1" name="questionContent" rows="6" placeholder="Detalla tu pregunta"></textarea>
                                <div class="s-right">
                                    <button type="submit" class="button ">Publicar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div id="questions" class="">
                        <?php
                        $questions = $questionController->getQuestionsOfClasses($class->id);
                        foreach ($questions as $question) {
                            $questionController->questionItem($question);
                        }
                        ?>
                    </div>

                </section>
            </div>
            <div class="from-lg lg-cols-3">
                <div class="resources">
                    <h4 class="resources-title">Recursos del curso</h4>
                    <p class="resources-label">Aquí encontrarás archivos, enlaces y descargas del curso que haya dejado el profesor</p>
                    <div class="resources-container s-py-2 s-px-2">
                        <?php
                        $resources = $resourceController->getResourceOfCourse($course->id);
                        foreach ($resources as $resource) {

                            echo "<div class='resource-item'>";
                            echo "<a href='$resource->urlResource' class='s-cross-center'>";
                            echo "    <svg width='32' height'32' viewBox='0 0 32 32' fill='none' xmlns='http://www.w3.org/2000/svg'>";
                            echo "        <path d='M29 13.875H25.625V10.325C25.625 9.77187 25.1781 9.325 24.625 9.325H14.7812L11.1156 5.81875C11.069 5.77509 11.0076 5.75055 10.9438 5.75H3C2.44687 5.75 2 6.19687 2 6.75V25.25C2 25.8031 2.44687 26.25 3 26.25H24.8125C25.2188 26.25 25.5875 26.0031 25.7406 25.625L29.9281 15.25C29.975 15.1313 30 15.0031 30 14.875C30 14.3219 29.5531 13.875 29 13.875ZM4.25 8H10.1406L13.8781 11.575H23.375V13.875H7.4375C7.03125 13.875 6.6625 14.1219 6.50938 14.5L4.25 20.1V8ZM24.1031 24H4.96875L8.19687 16H27.3344L24.1031 24Z' fill='white' />";
                            echo "    </svg>";
                            echo "    <span>$resource->name</span>";
                            echo "</a>";
                            echo "</div>";
                        }
                        ?>
                    </div>
                </div>

                <div class="s-center" style="margin-top: 8rem;">
                    <img width="200" src="../../assets/svg/mapis/Mapi-Cool-ConSuelo.svg" alt="" srcset="">
                </div>
            </div>
        </div>


    </section>

</main>


<script>
    const questionForm = document.getElementById('questionForm');
    const questionsSections = document.getElementById('questions');
    questionForm.addEventListener('submit', e => {
        e.preventDefault();
        // let idNewQuestion = 0;
        const target = event.target;

        const xhr = new XMLHttpRequest();
        // ¿De donde obtener la infromación?, el tercer es indicar si es async o no
        xhr.open("GET", `../php/createQuestion.php?
                            title=${target.questionTitle.value}&content=${target.questionContent.value}&likes=0&dislike=0&class_id=<?php echo $class->id ?>&user_id=<?php echo $_SESSION['user_id'] ?>
                            `, true);
        // ¿Qué hacer con la información?
        xhr.addEventListener("load", result => {
            // idNewQuestion = result.target.responseText;
            // questionsSections.innerHTML = result.target.responseText
            // questionsSections.insertAdjacentHTML('beforeend', result.target.responseText);
        });
        // Realizar la petición
        xhr.send();

        const question = `
        <div class="questions-container">
            <div class="s-pxy-2">
                <form id="questionForm" action="">
                    <h3 class="s-mb-1 ellipsis">${target.questionTitle.value}</h3>
                    <div class="question-title-container">
                        <div class="s-center">
                            <div class="profile-img">
                                <div class="circle img-container">
                                    <img src="<?php echo $userData->picture ?>" alt="">
                                </div>
                            </div>
                        </div>
                        <p class="s-mb-0 ellipsis"><?php echo $userData->name . " " . $userData->lastName ?></p>
                    </div>
                    <p>${target.questionContent.value}</p>
                    <hr>
                </form>
            </div>
        </div>
        `;
        questionsSections.insertAdjacentHTML('afterbegin', question);
    })
</script>

<script>
    const answerForms = document.querySelectorAll('[id^=answerForm_]');
    if (answerForms) {
        answerForms.forEach(form => {
            const questionId = form.id.substring(11)
            const s = document.getElementById(`sectionAnswer_${questionId}`);
            form.addEventListener('submit', e => {
                e.preventDefault();
                const target = event.target

                const xhr = new XMLHttpRequest();
                xhr.open("GET", `../php/createAnswer.php?content=${target.answerContent.value}&likes=0&dislike=0&question_id=${questionId}&user_id=<?php echo $_SESSION['user_id'] ?>`, true);
                xhr.addEventListener("load", result => {
                    console.log(result.target.responseText)
                });
                xhr.send();

                answer = `
                <div class="answer-container">
                    <div class="question-title-container">
                        <div class="s-center">
                            <div class="profile-img">
                                <div class="circle img-container">
                                    <img src="<?php echo $userData->picture ?>" alt="">
                                </div>
                            </div>
                        </div>
                        <p class="s-mb-0 ellipsis"><?php echo $userData->name . " " . $userData->lastName ?></p>
                    </div>

                    <div>
                        <p class="answer-content">
                            ${target.answerContent.value}
                        </p>
                    </div>
                </div>
                `;
                // sectionAnswer.append(bob);
                s.insertAdjacentHTML('beforeend', answer);
            });
        })
    }
</script>

<?php
$userController->footPages();
?>