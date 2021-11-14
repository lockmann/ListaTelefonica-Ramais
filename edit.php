<?php 
include('header.php');

    if($_GET['id']) {
    $id = $_GET['id'];
 
    $sql = "SELECT * FROM members WHERE id = {$id}";
    $result = $connect->query($sql);
 
    $data = $result->fetch_assoc();
    }else{
        header('Location: index.php');
    };

   

    if($_POST) {
    $fname = $_POST['fname'];
    $framal = $_POST['framal'];
        
    $id = $_POST['id'];
 
    $sql = "UPDATE members SET fname = '$fname', framal = '$framal' WHERE id = {$id}";
    if($connect->query($sql) === TRUE) {
        $_SESSION['update'] = "<div class='alert alert-success m-0 text-center mt-2'role='alert'>
                                        Dados alterados
                                    </div>";
    $id = $_GET['id'];
 
    $sql = "SELECT * FROM members WHERE id = {$id}";
    $result = $connect->query($sql);
 
    $data = $result->fetch_assoc();
    } else {
        echo "Erro ao atualizar registro : ". $connect->error;
    }
 
}

?>
<div class="container p-0 bd">
        <div class="container mb-3">
            <div class="shadow rounded-bottom">
                <div class="Mtitle bg-white border rounded-top border-bottom-1 mt-2 pt-2 text-center "><b><h4>Editar Ramal</h4></b></div>
                <div class="bg-white Mbodybox border-top-0 border border-bottom-0">
                    <div class="container add">
                            <?php 
                                if(isset($_SESSION['update'])){
                                    echo $_SESSION['update'];
                                    unset($_SESSION['update']);
                                }
                            ?>
                        <form action="" method="post" class="text-center mt-2">
                            <input type="text" value="<?php echo $data['fname'] ?>" class="form-control" name="fname" placeholder="Setor" required="required" maxlength="255">
                            <input type="text" value="<?php echo $data['framal'] ?>" class="form-control mt-2 mb-2" name="framal" placeholder="Ramal" required="required" maxlength="4">
                             <input type="hidden" name="id" value="<?php echo $data['id']?>" />
                            <?php include ("ramal_action/button.php") ?>
                        </form>
                    </div>
                </div>
                <div class="Mtitle bg-white border rounded-bottom border-bottom-0 mt-0 p-2 text-center ">Copyright © 2020 - Hospital Santa Marcelina</div>
            </div>
        </div>
    </div>
</body>
</html>