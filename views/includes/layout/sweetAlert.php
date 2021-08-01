<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php
            if(isset($_GET['Error'])){
                echo "<script type='text/javascript'>";
                if($_GET['Error'] == 400){
                    echo "swal('Precaución','Usuario y/o password incorrecto','warning');";
                }else if($_GET['Error'] == 401){
                    echo "swal('Precaución','No ha iniciado sesión','error');";
                }else if($_GET['Error'] == 402){
                    echo "swal('Precaución','Favor de llenar todos los campos','error');";
                }else if($_GET['Error'] == 403){
                    echo "swal('Precaución','Favor de llenar todos los campos','warning');";
                }
                echo "</script>";
            }else if(isset($_GET['Confirmar'])){
                echo "<script type='text/javascript'>";
                if($_GET['Confirmar'] == 400){
                    echo "swal('Creado','Curso creado correctamente','success');";
                }else if($_GET['Confirmar'] == 401){
                    echo "swal('Eliminado','Curso eliminado correctamente','success');";
                }else if($_GET['Confirmar'] == 402){
                    echo "swal('Actualizado','Curso actualizado correctamente','success');";
                }else if($_GET['Confirmar'] == 403){
                    echo "swal('Actualizado','Usuario actualizado correctamente','success');";
                }else if($_GET['Confirmar'] == 404){
                    echo "swal('Creado','Usuario creado correctamente','success');";
                }
                echo "</script>";
            }
        ?>