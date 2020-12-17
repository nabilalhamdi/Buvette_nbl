<DOCTYPE html>
<?php 
    require_once("connect.php");
  ?>    
<html>
    <head>
   
        <title>  </title>
        <link href="css/bootstrap.css">
        
        <style>
            .a{
                float: left;
            }
            #si{
                width: 70px;
                height: 70px;
            }
            .b{
                color: rebeccapurple;
                margin-left: 100px;
            }
            h5{
                color: red;
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
            .list ul li:{
                opacity: 0.6;
                color: red;
                background-color: aqua;
                width:10px;
                
            
            }
            .pl{
                width: 100%;
                height: 70px;
                color: orangered;
                background-color: navy;
            }
            .s{
                 background-color:bisque;
                height: 700px;
            }
        </style>
             <script src="bootstrap.js"></script>
        <script src="jquery-3.5.1.min.js"></script>
    </head>
    <body>
        <br>
        <div class="container">
            <div class="row">
                <div class="a"><img src="material_projet/img/logo.jpg" id="si"></div>
                <div class="b"><h1>EUROBuvettes </h1>
                <h5>Le Site de Gestien de Buvette de l'EURO 2016 !!</h5></div>
            
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="list">
                  <ul>
                      <li><a href="#">nouveautés</a></li>
                      <li><a href="#">Statistiqye</a></li>
                      <li><a href="#">Recherchemembrres</a></li>
                      <li><a href="#">Affectations</a></li>
                      <li><a href="#">administrateur</a></li>
                    </ul>
                </div>
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
               <div class="s">
                <table border="1" width="80%" align="center">
            <tbody>
                <tr>
              <th>date de match</th>
              <th>equipe A</th>
              <th>equipe B</th>
              <th>score </th>
              <th>buvettes ouvertes</th>
              <th>volantaires</th>
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
            }
            ?>
            

        </tbody>
        </table>
       

                </div>

                <div class="pl"><br> pied de page</div>
                
            
            </div>
        </div>
   
        
        
        
      
    </body>
    </html>