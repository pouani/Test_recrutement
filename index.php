<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Test_Recrutement</title>
</head>
<body>
    <div class="container">
        <div class="form">
            <h1>NOUVELLE ENREGISTREMENT</h1>
            <form action="<?php if(isset($_GET['id'])) echo "modifier.php?id=".$_GET['id'].""; else echo "creer.php"?>" method="POST">
                <label for="nom">nom</label><br>
                <input type="text" name="nom" id="nom"  value="<?php if(!empty($_GET['nom'])) echo $_GET['nom'];?>"><br><br>
            
                <label for="description">prenom</label><br>
                <input type="text" name="prenom" id="prenom" value="<?php if(!empty($_GET['prenom'])) echo $_GET['prenom'];?>" ><br><br>
            
                <label for="prix">date_naisance</label><br>
                <input type="date" name="date_naisance" id="date_naisance" value="<?php if(!empty($_GET['date_naisance'])) echo $_GET['date_naisance'];?>" ><br><br>
            
                <select name="sexe" id="">
                   <option value="M">Masculin</option>
                   <option value="F">Feminin</option>
                </select><br><br>
                <input type="submit" name="submit" value="Enregistrer">
                </form>
        </div>

        <?php 
         $clients=json_decode(file_get_contents('http://localhost/test_recrutement/lire.php'));
        
        ?>

        <div class="table">
            <h1>LISTE DES CLIENTS</h1>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Date de Naissance</th>
                        <th>Sexe</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                   <?php
                   foreach($clients->result as $client)
                   {
                       ?>
                     <tr>
                        <td><?=$client->nom?></td>
                        <td><?=$client->prenom?></td>
                        <td><?=$client->date_naisance?></td>
                        <td><?=$client->sexe?></td>
                        <td><?php if($client->status) echo "actif"; else echo "inactif";?></td>
                        <td>
                        <a href="index.php?id=<?=$client->id?>&nom=<?=$client->nom?>&prenom=<?=$client->prenom?>&date_naisance=<?=$client->date_naisance?>&sexe=<?=$client->sexe?>"> <button id="red" style="background-color: dodgerblue;">Modifier</button></a>
                           
                            <a href="supprimer.php?Supid=<?=$client->id?>"><button id="blue" style="background-color: red;">Supprimer</button></a>
                            <a href="changeStatus.php?id=<?=$client->id?>&status=<?php if($client->status) echo "0"; else echo "1";?>"><button id="gris" style="background-color: rgb(248, 218, 218);"><?php if($client->status) echo "Desactivé"; else echo'<b style="color: rgb(4, 207, 139);;">Activé</b>';?></button></a>
                        </td>
                    </tr>
                       <?php
                   }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <style>
        body{
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.container{
    margin: 30px;
    margin-left: 5%;
    margin-right: 5%;
    display: flex;
    justify-content: space-around;
}

.form form{
    padding: 10px;
    padding-left: 110px;
    width: 400px;
    display: block;
    box-shadow: 0px 0px 10px 0 rgba(0, 0, 0, 0.3);
}

input{
    width: 300px;
    height: 50px;
    border: 0.5px solid #aaa;
    border-radius: 3px;
}

input[type=text]{
    outline: dodgerblue;
    border: none;
    border-bottom: 1px solid #aaa;
}

input[type="submit"]{
    width: 302px; 
    border: none;
    background-color: dodgerblue;
    color: rgb(236, 235, 235);
    font-weight: bold;
    cursor: pointer;
}


input[type=text]:focus{
    border-bottom:2px solid dodgerblue;
    transition: .3s;
}

select{
    width: 302px;
    height: 50px;
}

/*Style de la table*/
.table table{
    border-collapse: collapse;
    border-spacing: 10px;
    box-shadow: 0px 0px 10px 0 rgba(0, 0, 0, 0.3);
}

th, td{
    border: 1px solid #aaa;
    padding: 10px;
}

td button{
    width: 80px;
    border: none;
    height: 30px;
    border-radius: 3px;
}

button:hover{
    box-shadow: .5px .5px 1px 1px #aaa;
}

    </style>
</body>
</html>