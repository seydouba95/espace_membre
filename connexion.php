<?php
     $bdd=new PDO ('mysql:host=127.0.0.1;dbname=espace-membre','root','');
     if( isset($_POST['formconnect']) )
     {
         $mailconnect=htmlspecialchars($_POST['emailconnect']);
         $mdpconnect=sha1($_POST['mdpconnect']);
         if( !empty($emailconnect) and !empty($mdpconnect) )
         {
             $requser=$bdd->prepare("SELECT * FROM membre WHERE email= ? AND motdepasse= ?");
             $requser->execute(array($emailconnect,$mdpconnect));
             $userexist=$requser->rowCount();
             if($userexist == 1)
             {
                
             }
             else
             {
                 $erreur="Mauvais email ou mot de passe !";
             }
         
            
         }
         else
         {
             $erreur="Tous les champs doivent etre completés !";
         }
         
     }

 ?>
<html>
<head>
    <meta charset="utf-8" />
   
    <title>TUTO PHP</title>
   
</head>
<body>
         <div align="center">
         <h3>Connexion</h3>
         <br> <br> 
         <form method="POST" action="">
         <table>
         <tr>
            <td>
         <input type="email" placeholder="email" name="emailconnect"/>
         </td>
         <td>
         <input type="password" placeholder="mot de passe" name="mdpconnect" />
         </td>
         <td>
         <input type="submit"  name="formconnect" value="Se connecter"/>
         </td>
         </tr>
         </table>



         </form>
         <?php

          if(isset($erreur))
          {
              echo '<font color="red">'.$erreur."</font>";
          }
         ?>


       
    
</body>
</html>