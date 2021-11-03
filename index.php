<html>
    <head>
        <title>Trabalho Faculdade</title>
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"  integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php require_once 'process.php'; ?>

        <?php 
            if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?=$_SESSION['msg_type']?>">

            <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
            </div>
            <?php endif ?>

        <div class="container">
        <?php
            $user = 'root';
            $pass = '';
            $db = 'crudphpp';
            
            $db = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect");
            $result = $db->query("SELECT * FROM produto") or die("No data");
            ?>

            <div class="row justify-content-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Quantidade</th>
                            <th>Preço unitário</th>
                            <th>Unidade de medida</th>
                            <!-- <th colspan="2">Action</th> -->
                        </tr>
                    </thead>
                    <?php
                        while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['nome']; ?></td>
                            <td><?php echo $row['descricao']; ?></td>
                            <td><?php echo $row['quantidade']; ?></td>
                            <td><?php echo $row['pu']; ?></td>
                            <td><?php echo $row['um']; ?></td>
                            <td>
                                <a href="index.php?edit=<?php echo $row['id']; ?>"
                                    class="btn btn-info">Editar</a>
                                <a href="process.php?delete=<?php echo $row['id']; ?>"
                                    class="btn btn-danger">Deletar</a>
                            </td>
                        </tr>
                        <?php endwhile;
                    ?>
                </table>
            </div>

            <?php

            function pre_r($array){
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }
        ?>

        <div class="row justify-content-center">
        <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo$id; ?>">
            <div class="form-group">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control"
             value="<?php echo $nome; ?>" placeholder="Digite seu nome">
            </div>
            <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="descricao" class="form-control"
            value="<?php echo $descricao; ?>" placeholder="Descreva o produto">
            </div>
            <div class="form-group">
            <label>Quantidade</label>
            <input type="text" name="quantidade" class="form-control"
            value="<?php echo $quantidade; ?>" placeholder="Quantidade do produto">
            </div>
            <div class="form-group">
            <label>Preço unitário</label>
            <input type="text" name="pu" class="form-control" 
            value="<?php echo $pu; ?>" placeholder="Preço unitário do produto">
            </div>
            <div class="form-group">
            <label>Unidade de medida</label>
            <input type="text" name="um" class="form-control"
            value="<?php echo $um; ?>" placeholder="Unidade de medida do produto">
            </div>
            <div class="form-group">
            <?php
            if ($update == true): 
            ?>
            <button type="submit" class="btn btn-info" name="update">Editar</button>
            <?php else: ?>
            <button type="submit" class="btn btn-primary" name="registrar">Registrar</button>
            <?php endif; ?>
            </div>
        </form>
    </div>
    </div>
    </body>
</html>