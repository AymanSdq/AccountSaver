<!-- // This is a speacial page only made for function_exists -->

<?php

    function getTitle(){
        global $pageTitle;

        if(isset($pageTitle)){
            echo $pageTitle;
        } else {
            echo "AccountSaver - Page";
        }
    }

    
//     class Crypter{

//         var $key;

//         /*--------------------------------
//         le constructeur de la classe.
//         --------------------------------*/
//         function __construct($clave){
//             $this->key = $clave;
//         }

//         function setKey($clave){
//             $this->key = $clave;
//         }
        
//         function keyED($txt) { 
//             $encrypt_key = md5($this->key); 
//             $ctr=0; 
//             $tmp = ""; 
//             for ($i=0;$i<strlen($txt);$i++) { 
//                 if ($ctr==strlen($encrypt_key)) $ctr=0; 
//                 $tmp.= substr($txt,$i,1) ^ substr($encrypt_key,$ctr,1); 
//                 $ctr++; 
//             } 
//             return $tmp; 
//         } 
        
//         function encrypt($txt){ 
//             srand((double)microtime()*1000000); 
//             $encrypt_key = md5(rand(0,32000)); 
//             $ctr=0; 
//             $tmp = ""; 
//             for ($i=0;$i<strlen($txt);$i++){ 
//                 if ($ctr==strlen($encrypt_key)) $ctr=0; 
//                 $tmp.= substr($encrypt_key,$ctr,1) . 
//                 (substr($txt,$i,1) ^ substr($encrypt_key,$ctr,1)); 
//             $ctr++; 
//             } 
//             return base64_encode($this->keyED($tmp)); 
//         } 

//         function decrypt($txt) { 
//             $txt = $this->keyED(base64_decode($txt)); 
//             $tmp = ""; 
//             for ($i=0;$i<strlen($txt);$i++){ 
//             $md5 = substr($txt,$i,1); 
//             $i++; 
//             $tmp.= (substr($txt,$i,1) ^ $md5); 
//             } 
//             return $tmp; 
//         } 

//     }









//     $chaine = 'chaine a crypter';

//     $crypter = new Crypter($chaine);
//     $chaine_crypter = $crypter->encrypt($chaine);
//     echo $chaine_crypter;
//     // Affiche une chaine comme:
//     // UjFVPgI3A2kDblhtDy0HZAZ3ATAHfQonUScLdFJnVHQ

//     $chaine_decrypter = $crypter->decrypt($chaine_crypter);
//     echo $chaine_decrypter
//     // Affiche : chaine a crypter
// 