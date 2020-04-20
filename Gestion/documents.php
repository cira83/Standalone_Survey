<?php
	include("./security.php");
	include("../Dropbox.php");
	include("../head1.html");

	$nom = $elv;
	$password = $password;
	$classe = $classe;
	$files = "./files/";
	$repertoire_copies =  "./files/$classe/_Copies";

	$doc_elv_1 = $_GET['doc'];
	if($doc_elv_1) {
		$password_OK = $doc_elv_1;
		$nom = $doc_elv_1;
	}



?>
	<title>Documents <?php echo($nom);?></title>
	<script type="text/javascript">
	function login(){
		classe = document.getElementById('classe').value;
		document.cookie = 'laclasse='+classe;
		location.reload() ;
	}
	</script>
	</head>
<!-- fin head -->
	<body>
		<img src="head.png"/>

<?php
	if($password_OK){
		echo("<center><table><tr><td colspan=2><p class=\"titre\">Mes documents - $nom</p></td></tr></table></center>");
		$filename_of_elv = "$repertoire_copies/$nom";

		$FilesDropBox = "./files/$classe/_Documents/$nom.txt";
		if(file_exists($FilesDropBox)) {
			Dropbox("",$FilesDropBox);
		}

		if(!file_exists($filename_of_elv)) echo("<center><table><tr><td>Pas encore de répertoire !!</td></tr></table></center>");
		else {
			$listeD = scandir($filename_of_elv);
			if(count($listeD)>1){
				$rep_nom = "./files/$classe/_Documents/rep_$nom.txt";
				$fp = fopen($rep_nom,"w");//Fichier qui liste le contenu du répertoire élève
				foreach($listeD as $name){
					$part = explode(".", $name);
					if($name=="index.htm") $part=0;
					if($part[1]) {
						if($nb_ligne>0) fprintf($fp,"\n$name,$filename_of_elv/$name");
						else {
							$nb_ligne++;
							fprintf($fp,"$name,$filename_of_elv/$name");
						}
					}
				}
				fclose($fp);
				chmod($rep_nom,0777);
				Dropbox("",$rep_nom);
			}
		}

	}
	else{
		echo("<td colspan=2>Vous n'&ecirc;tes pas connect&eacute;(e) !!</td>$logout</tr></table>");
	}
?>

<?php
	include("../foot2.html");
?>
