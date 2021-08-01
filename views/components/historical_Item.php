<?php
$user = $_SESSION['user_id'];
include_once('../../controllers/sectionController.php');
$sectionController = new SectionController();

$sectionId = $class->section_id;
$section = $sectionController->getSection($sectionId);
echo "<div class='ed-grid s-px-4'>";
echo "  <div class='s-px-4 s-mb-2 s-py-3 ed-grid s-grid-8' style='background: var(--color-bg-light); border-radius: 10px'>";
echo "      <div class='s-cols-1 s-cross-center'>";
// Hora de cuando abrio la clase
echo "         <label>" . $historical->created_at . "</label>";
echo "      </div>";
echo "      <div class='img-container s-ratio-16-9 s-cols-2'>";
// Imagen del curso al que le pertenece la clase
echo "          <img class='s-radius-1' src='" . $course->picture . "'>";
echo "      </div>";
echo "      <div class='s-cols-5 s-left column'>";
// Nombramiento de la clase
echo "          <a href='../../scripts/createHistorical_ItemBD.php?class=" . $class->id . "&user=" . $user . "'<h3>" . $section->index . "." . $class->index . " " . $class->name . "</h3></a>";
// Nombre del curso
echo "          <div class='s-mb-2'>";
echo "             <label>Curso: " . $course->name . "</label>";
echo "          </div>";

echo "          <div class='ed-container'>";
echo "            <div class='s-center'>";
echo "                <div class='s-mr-2'>";
echo "                    <div class='circle img-container' style='width: 3rem;''>";
echo "                        <img src='$asesor->picture' alt='Asesor avatar'>";
echo "                    </div>";
echo "                </div>";
echo "            </div>";
echo "            <div class='s-cols-3 s-cross-center'>";
echo "                <span>$asesor->name  $asesor->lastName</span>";
echo "            </div>";
echo "          </div>";
echo "      </div>";
echo "  </div>";
echo "</div>";
