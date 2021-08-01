<?php
$tagController = new TagController();
$tags = $tagController->getAllTags();
?>

<div class="ed-grid s-grid-4 s-mb-2">
    <form action="courses.php" method="GET">
        <label class="label-input">
            <select onchange="this.form.submit()" class="input ghost s-px-05" name="tag">
                <option value="">Categorías</option>
                <optgroup label="Programación y software">
                    <?php
                    foreach ($tags as $tag) {
                        if ($tag->mainTag_id == 1) {
                            echo "<option value='$tag->id'>$tag->name</option>";
                        }
                    }
                    ?>
                </optgroup>
                <optgroup label="Hardware y electronica">
                    <?php
                    foreach ($tags as $tag) {
                        if ($tag->mainTag_id == 2) {
                            echo "<option value='$tag->id'>$tag->name</option>";
                        }
                    }
                    ?>
                </optgroup>
                <optgroup label="Negocios y emprendimiento">
                    <?php
                    foreach ($tags as $tag) {
                        if ($tag->mainTag_id == 3) {
                            echo "<option value='$tag->id'>$tag->name</option>";
                        }
                    }
                    ?>
                </optgroup>
                <optgroup label="Desarrollo personal">
                    <?php
                    foreach ($tags as $tag) {
                        if ($tag->mainTag_id == 4) {
                            echo "<option value='$tag->id'>$tag->name</option>";
                        }
                    }
                    ?>
                </optgroup>
                <optgroup label="Otros">
                    <?php
                    foreach ($tags as $tag) {
                        if ($tag->mainTag_id == 5) {
                            echo "<option value='$tag->id'>$tag->name</option>";
                        }
                    }
                    ?>
                </optgroup>
            </select>
        </label>
    </form>
    <div></div>
    <form action="courses.php" method="GET">
        <label class="label-input">
            <select onchange="this.form.submit()" class="input ghost s-px-05" name="type" id="">
                <option value="-1" selected>Tipo</option>
                <option value="0">Curso</option>
                <option value="1">Taller</option>
            </select>
        </label>
    </form>

    <form action="courses.php" method="GET">
        <label class="label-input">
            <select onchange="this.form.submit()" class="input ghost s-px-05" name="level">
                <option value="0" selected>Nivel</option>
                <option value="1">Principiante</option>
                <option value="2">Medio</option>
                <option value="3">Avanzado</option>
            </select>
        </label>
    </form>
</div>