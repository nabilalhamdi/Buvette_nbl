<DOCTYPE html>
<?php 
    require_once("connect.php");
  ?>
<html>
    <head>
   
        <title> N'importe quoi </title>
        <link href="css/bootstrap.css">
        
        <style>
            .nb{
                float: left;
            }
            #hm{
                width: 70px;
                height: 70px;
            }
            .jl{
                color: rebeccapurple;
                margin-left: 100px;
            }
            h5{
                color: aqua;
            }
            ul li{
                float:left;
                margin: 20px;
                
            }
            .list{
                color: white;
                background-color: navy;
                height: 50px;
                text-align: center;
            }
            ul li a{
                text-decoration: none;
                color: white;
            }
            ul{
                margin-left: 200px;
                list-style: none;
                font-size: 20px;
            }
            .list ul li:hover{
                opacity: 0.6;
                color: red;
                background-color: aqua;
                width:200px;
                
            
            }
            .pied{
                width: 100%;
                height: 70px;
                color: orangered;
                background-color: navy;
            }
            .jalila{
                 background-color:grey;
                height: 400px;
            }
            table{
                border: 1px solid black;
                border-style: double;
                width: 80%;
                text-align: center;
                margin-left: 10%;
            }
            th{
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <br>
        <div class="container">
            <div class="row">
                <div class="nb"><img src="material_projet/img/logo.jpg" id="hm"></div>
                <div class="jl"><h1>EUROBuvettes </h1>
                <h5>Le Site de Gestien de Buvette de l'EURO 2016 !!</h5></div>
            
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="list">
                  <ul>
                      <li><a href="#">Accueil.php</a></li>
                      <li><a href="#">Statistiqye.php</a></li>
                      <li><a href="#">Recherchemembrres.php</a></li>
                      <li><a href="#">Affectations.php</a></li>
                      <li><a href="#">Prive.php</a></li>
                    </ul>
                </div>
                <div class="jalila">
                          <?php
            $req="SELECT m.idm 'mid', m.date,a.pays as paysA, b.pays as paysB, a.drapeau as drapeauA, b.drapeau as drapeauB, scoreA, scoreB, COUNT(*) as nb_bo ,m.idM
            from `match` m, `equipe` a, `equipe` b ,`est_ouverte` o
            where a.idE=m.eqA
            AND b.idE=m.eqB
			And m.idM=o.idM
			GROUP BY m.idM
            ";
       
             $result = mysqli_query($idConnexion , $req);
             ?>  
                       <table>
                            <tr>
                                <th>Date du match</th>
                                <th>Equipe A</th>
                                <th>Equipe B </th>
                                <th>Score </th>
                                <th>Buvette </th>
                                <th>Volentaire </th>
                                
                            </tr>
                            <?php
            while ($row = mysqli_fetch_array($result)){
                $req_nbv="SELECT count(*)
                from `match` m, `est_present` ep
                where m.idm= ep.idm
                and m.idm=". $row['mid'] ;
                $res = mysqli_query($idConnexion, $req_nbv);
                $nbv = mysqli_fetch_array($res);

                echo"
                <tr>
                 <td>".
                 $row['date'].
                 "</td>
     
                 <td><img src=\"".$row['drapeauA']."\" alt=\"".$row['paysA']."\" height=\"50px\"/></td>
                 <td><img src=\"".$row['drapeauB']."\" alt=\"".$row['paysB']."\" height=\"50px\"/></td>
                 <td>".$row['scoreA']." - " .$row['scoreB']."</td>
                 <td>".$row['nb_bo']."</td>
                 <td>".$nbv[0]."</td>
                 
                 </tr>
                ";
                ?>
            
                    </table>
                <div class="pied"><br> pied de page</div>
            
                
            
            </div>
            </div></div>

        
        
      
         <script src="bootstrap.js"></script>
        <script src="jquery-3.5.1.min.js"></script>
    </body>
 </html>