<?php
     $bdd=new PDO ('mysql:host=127.0.0.1;dbname=espace-membre','root','');
     if(isset($_POST['forminscription'] ))
     {
        $pseudo=htmlspecialchars($_POST['pseudo']);
        $email=htmlspecialchars($_POST['email']);
        $email1=htmlspecialchars($_POST['email1']);
        $mdp=sha1($_POST['mdp']);
        $mdp1=sha1($_POST['mdp1']);
        
         
          if(!empty($_POST['pseudo']) and  !empty($_POST['email']) and  !empty($_POST['email1']) and  !empty($_POST['mdp']) and !empty($_POST['mdp1']))
         {
            
               $pseudolength=strlen($pseudo);
               if($pseudolength<=255)
               {
                       if($email==$email1)
                       {
                           if(filter_var($email,FILTER_VALIDATE_EMAIL))
                           {
                               $reqmail=$bdd->prepare("SELECT * FROM membre WHERE email=?");
                               $reqmail->execute(array($email));
                               $mailexist=$reqmail->rowcount();
                               if($mailexist==0)
                               {
                                  if($mdp==$mdp1)
                                   {
                              
                                       $insertmbr=$bdd->prepare("INSERT INTO membre (pseudo,email,motdepasse) VALUES(?,?,?)");
                                        $insertmbr->execute(array($pseudo,$email,$mdp));
                                       $erreur="votre compte a bien été créé ! ";
                                   }
                                 else
                                  {
                                    $erreur="vos mots de passe ne correspondent pas !";
                                  }
                                }
                                else
                                {
                                    $erreur="Adresse email  deja utilisée !";

                                }   
                            }
                            else
                            {
                                $erreur="votre adresse email est invalide !";
                            }
                        }
                       else
                       {
                           $erreur="vos adresses ne correspondent pas !";
                       }

               }
               else
               {
                   $erreur="votre pseudo ne doit pas depasser 255 caracteres !";
               }
         }
         else
         {
             $erreur="Tous les champs doivent etre complétés!";
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
         <h3>Inscription</h3>
         <br> <br> 
         <form method="POST" action="">
         <table>
                         <tr>
                               <td align="right">
                             <label for="pseudo">Pseudo:</label>
                               </td>
                      
                             <td>
                             <input type="text" placeholder="Votre pseudo" name="pseudo" id="pseudo" value="<?php if(isset($pseudo)) echo"$pseudo"?> "/>

                             </td>
                         </tr>    

                          <tr>
                               <td align="right">
                             <label for="email">Email:</label>
                               </td>
                      
                             <td>
                             <input type="email" placeholder="Votre email" name="email" id="email" value="<?php if(isset($email)) echo"$email"?> "/>

                             </td>
                         </tr>
                         <tr>
                               <td align="right">
                             <label for="email1">Confirmation du mail:</label>
                               </td>
                      
                             <td>
                             <input type="email" placeholder="Confirmer votre email" name="email1" id="email1" value="<?php if(isset($email1)) echo"$email1"?> "/>

                             </td>
                         </tr>  
                         <tr>
                               <td align="right">
                             <label for="mdp">Mot de passe:</label>
                               </td>
                      
                             <td>
                             <input type="password" placeholder="Votre mot de passe" name="mdp" id="mdp"/>

                             </td>
                         </tr>    
                         <tr>
                               <td align="right">
                             <label for="mdp1"> Confirmation du mot de passe:</label>
                               </td>
                      
                             <td>
                             <input type="password" placeholder=" Confirmer votre mot de passe" name="mdp1" id="mdp1"/>

                             </td>
                         </tr>   
                         <tr>
                         <td></td>
                         <td align="center">
                         </br>
                         <input type="submit" value="je m'inscris" name="forminscription" />
                         </td>
                         </tr> 
           <table>
          


         </form>
         <?php

          if(isset($erreur))
          {
              echo '<font color="red">'.$erreur."</font>";
          }
         ?>


         </div>
    
</body>
</html>