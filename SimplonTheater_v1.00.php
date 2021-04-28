<?php
/************************************************************************
 * SIMPLON.CO https://simplon.co/										*
 ************************************************************************
 * Copyright (c) 2021 by DLC ( http://did.lefebvre.conseil.online.fr )  *
 *                                                                      *
 * This file is part of SimplonTheater.                                 *
 *                                                                      *
 * SimplonTheater is free education software; you can redistribute it	*
 * and/or modify it under the terms of the GNU General Public License 	*
 * published by the Free Software Foundation; either version 2, or      *
 * as(at your option) any later version.								*
 *																		*
 * This program is distributed in the hope that it will be useful, but  *
 * WITHOUT ANY WARRANTY; without even the implied warranty of			*
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.					*
 * See the  GNU General Public License for more details.				*
 *																		*
 * You should have received a copy of the GNU General Public License	*
 * along with this program; if not, write to the Free Software			*
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307,*
 * USA.																	*
 ************************************************************************
 * START URL : http://did.lefebvre.conseil.online.fr/SimplonTheater.html *
 ************************************************************************/
 
/************************************************************************
 * Spécifications en français : 										*
 * --------------------------											*
 * Les cinémas SimplonTheater français demandent de mettre au point un	*
 * logiciel simple d'utilisation pour permettre aux utilisateurs de 	*
 * choisir des places de cinéma dans une salle au format fixe : 8		*
 * rangées avec dans chaque rangée 9 sièges. Les utilisateurs doivent	*
 * pouvoir spécifier la rangée dans laquelle ils veulent être placés	*
 * ainsi que le nombre de places à réserver. Une fois la rangée choisie	*
 * et le nombre de places spécifiées, vérifier s'il y a effectivement	*
 * assez de place sur la rangée : Si tel est le cas, afficher la 		*
 * présentation de la salle à l'utilisateur et proposer une nouvelle	*
 * saisie. Sinon, spécifier à l'utilisateur qu'il n'y a plus de place	*
 * sur la rangée ou qu'il n'y en a plus assez.							*
 *																		*
 * Rendu CSS : 															*
 * ---------															*
 * sur fond noir, caractères : blancs, réponse : vert, écran : tirés, 	*
 * absices et ordonnées : chiffres, ligne 0 la plus proche de l'écran	*
 , allée : pipe, siège : entre crochets, dispobible : endescore jaune,	*
 * occupé : croix rouge.												*
 *																		*
 * Ecran : 																*
 * -----																*
 * Titre : Les cinémas SimplonTheater, achat de places					*
 * Client : constante, utilisateur déjà signé							*
 * Film : constante, film déjà choisi									*
 * Séance : constante, heure de la séance déjà choisie					*
 * Salle : constante, salle déjà déduite								*
 * 																		*
 * Affichage : un formulaire de saisie avec affichage de la salle		*
 * 																		*
 * Salle : 		Légende : place libre : [ _ ], place occupée : [ X ].	*
 *																		*
 *							Ecran										*
 *       ---------------------------------------------					*
 *																		*
 *																		*
 *   0 | [ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ]					*
 *   1 | [ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ]					*
 *   2 | [ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ]					*
 *   3 | [ X ][ X ][ X ][ X ][ _ ][ _ ][ _ ][ _ ][ _ ]					*
 *   4 | [ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ]					*
 *   5 | [ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ]					*
 *   6 | [ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ]					*
 *   7 | [ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ]					*
 *         0    1    2    3    4    5    6    7    8					*
 *																		*
 *		bouton [Autre Séance]		bouton	[Achat]						*
 *																		*
 * Date du livrable : 28/04/2021                         Version : 1.00	*
 *																		*
 * Auteur : Didier LEFEBVRE, EIRL Didier LEFEBVRE Conseil (DLC)			*
 *																		*
 * Objectifs et moyens :												*
 * -------------------													*
 * Respect de la charte graphique proposée par le client. Toute liberté	*
 * étant sujet à interprétation ayant pour effet de rallonger le temps	*
 * de développement en l'absence de charte graphique pré-existante.		*
 * Mise de l'accent sur la simplicité d'utilisation : un seul			*
 * formulaire auto-documenté amenant l'utilisateur à acheter des places.*
 * Stockage de l'état de remplissage de la salle dans un enregistrement *
 * en base de données, permettant de suivre le remplissage et d'avoir	*
 * les données statistiques sur le taux de remplissage.					*
 * Choix d'un enregistrement en base par salle et séance avec mise à 	*
 * jour de l'enregistrement lors de l'achat de places.					*
 * Etape suivante : traitement de la saisie et règlement de l'achat		*
 * Bac à sable : http://votre.informaticien.online.fr					*
 * Langage : Formulaire Html, Php, Mysql.								*
 * Pour des raisons de simplicité et de lisibilité lors de l'entretien	*
 * l'ensemble de l'application est contenue dans un seul fichier, même	*
 * si dans la pratique dans le cadre de la réutilisation de fonctions 	*
 * serait utilisé la notion d'include réutilisant ou utilisant des		*
 * des fonctions existantes, les includes étant commentés et le code	*
 * présent à la suite dans le fichier.									*
 * Mise de l'accent sur l'auto-documentation du code pour facilité sa 	*
 * compréhension dans le temps.											*
 * Ce logiciel ne prend pas en compte des consignes sanitaires dûes à la*
 * Covid, ce qui impliquerait d'espacer les places à une sur deux en 	*
 * quinconce. Mais un pré-remplissage de la salle lors de la création de*
 * d'enregistrement pourrait prendre en compte cette contrainte.		*
 * L'objectif de ce logiciel est que le client achète des places. S'il  *
 * ne trouve pas son bonheur dans la séance choisie, lui offrir la 		*
 * possibilité de sélectionner une autre séance, car quand on tient un	*
 * un client, il ne faut pas le lacher, sinon il va voir ailleurs :		*
 * amélioration par une vue holistique du développement inclu dans un	*
 * ensemble pour le bien du consommateur du service. (Itil 4)			*
 * Ce qui va suivre coule de source ...									*
 ************************************************************************/
 
/* include "config.php"; Bac à sable sur online.fr */
$StDBHost = "localhost"; /* MySql database server */
$StDBLogin = "votre.informaticien"; /* MySql database login */
$StDBPasswd = "*********"; /* MySql database password */
$StDBName = "votre_informaticien"; /* MySql database name */
$StInstallPath = "/"; /* relatif path to SimplonTheater distribution */
$StSiteName = "Simplon Theater"; /* your site name */
$StTabRempl = "STTABREMPL"; /* table de remplissage */
// $Url = "http://yourdomain/"; /* url to access to your site */
$StVersion = "1.00"; /* current version */
$FileNameTranslation = array('\\' => '_', '/' => '_', ':' => '_', '*' => '_', '?' => '_', '<' => '_', '>' => '_', '|' => '_', "&" => "_","\"" => "_","'" => "_",";"=>"_","~"=>"-","+"=>""); /* translation characters for files names.*/
$debug = 1;

/* connectdb() */
/*    $conn=mysqli_connect($StDBHost,$StDBLogin,$StDBPasswd,$StDBName);
    if(mysqli_connect_errno())
    {
        die("Connecttion Failed!! Check Whether mysql is turned ON!!" . mysqli_connect_error());
    }
    {
       //echo "connected";
    } */
	
/* include $StInstallPath."css/charte.css"; */
/* Rendu CSS non implémenté, déclaration de variables seulement : 															*
 * sur fond noir, caractères : blancs, réponse : vert, écran : tirés, 	*
 * absices et ordonnées : chiffres, ligne 0 la plus proche de l'écran	*
 , allée : pipe, siège : entre crochets, dispobible : endescore jaune,	*
 * occupé : croix rouge.												*/
 $StFond = "#000000";
 $StCara = "#FFFFFF";
 $StRepo = "#00FF00";
 $StEcra = "----------------------------------------------------";
 $StAlle = "|";
 $StSeSt = "[ ";
 $StSeEn = " ]";
 $StViCa = "_";
 $StViCo = "#FFFF00";
 $StOcCa = "X";
 $StOcCo = "#FF0000";
 
/* Ecran : 																*
 * Titre : Les cinémas SimplonTheater, achat de places					*
 * Client : constante, utilisateur déjà signé							*
 * Film : constante, film déjà choisi									*
 * Séance : constante, heure de la séance déjà choisie					*
 * Salle : constante, salle déjà déduite								*/
 $StTitre = "Les cinémas SimplonTheater, achat de places";
 $StLogo = $StInstallPath."images/logo-footer.svg";
 
 /* login() */
 $StLogin = "Trucmuche";
 
 /* movie() */
 $StMovie = "Interstellar";
 $StMovAf = $StInstallPath."Images/Aff".$StMovie."jpg";
 
 /* seance() */
 $StSeanc = "2021-05-17 14:00";
 
 /* salle() */
 /* Les cinémas SimplonTheater français demandent de mettre au point un	*
  * logiciel simple d'utilisation pour permettre aux utilisateurs de 	*
  * choisir des places de cinéma dans une salle au format fixe : 8		*
  * rangées avec dans chaque rangée 9 sièges. 							*/
 $StSalle = "1";
 $StNbRan = 8; /* Nombre de rangées */
 $StNbSea = 9; /* Nombre de sièges par rangée */
 $StStNum = 0; /* démarrage de la numérotation rangées et sièges */
 
 /* Affichage : un formulaire de saisie avec affichage de la salle		*
 *																		*
 ************************************************************************
 * $StTitre                                            $StLogo			*
 *																		*
 * Vous : $StLogin     						 Le film : $StMovie      	*
 *																		*
 * Combien de place voulez-vous acheter ? [  ] minimun 1 place			*
 * A quelle rangée voulez-vous aller ?    [  ] places contigues			*
 *																		*
 * Salle : $StSalle						   Séance du : $StSeanc			*
 *																		*
 *				Légende : place libre : [ _ ], place occupée : [ X ].	*
 *																		*
 *							Ecran										*
 *       ---------------------------------------------					*
 *																		*
 *																		*
 *   0 | [ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ]					*
 *   1 | [ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ]					*
 *   2 | [ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ]					*
 *   3 | [ X ][ X ][ X ][ X ][ _ ][ _ ][ _ ][ _ ][ _ ]					*
 *   4 | [ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ]					*
 *   5 | [ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ]					*
 *   6 | [ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ]					*
 *   7 | [ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ]					*
 *         0    1    2    3    4    5    6    7    8					*
 *																		*
 *		Choix [Autre Séance \/]		bouton	[Achat]						*
 *																		*
 ************************************************************************/

 /* getseance() */
 /* Structure de l'enregistrement :										*
  * -----------------------------										*
  * STSALLE(VARCHAR) STSEANCE(VARCHAR) STMOVIE(VARCHAR) STREMPL(VARCHAR)*
  * STREMP contient : nbre de places occupées / rangée séparées par "."	*
  * Selection d'un enregistremet par STSALLE, STSEANCE. Si vide alors	*
  * creation de l'enregistrement avec toutes places libres, sinon		*
  * récupération de STREMPL de l'enregistrement existant.				*
  * Exemple de Salle libre : STREMPL = "0.0.0.0.0.0.0.0"				*
  * Récupération PHP des comptages par la fonction substr()				*
  * Le type de champ VARCHAR() peut être optimisée pour économiser des  *
  * octets mais serait moins adaptative. Par défaut VARCHAR a 255 Carat *
  * la Vateur de STMOVIE permet de vérifier que c'est bien la bonne     *
  * séance.																*/
 
 /* le traitement mysql n'est pas traité dans cette version.
    A la place, récupération des informations dans la form html
	L'accent étant mis sur le traiement de l'information 
	dans le cadre de la demande de Simplon.co */
	
/* Etat de remplissage de la salle */
if ($strempl == "") {
	$strempl = "0.0.0.0.0.0.0.0";
}
  
/* Nombre de places réservées */
if ($stnbseat == "") {
	$stnbseat = "0";
};
  
/* Rangée sélectionnée */
if ($stline == "") {
	$stline = "0";
}
	  
/* Affichage initial */
/* if ($stnbseat == "0") {
	echo '<p><font color='.$StRepo.'>Bienvenue sur notre site de réservation  en ligne de places de cinéma</p>';
} */

/* test du nombre de place libres restantes dans la rangée apès achat */
if ($stnbli[$stline] = 0) {
	/* Erreur 1 : pas assez de place dans la rangée */
	$sterr = 1;
	$stnbseat = 0;
}
else {
	/* Assez de places dans la rangée */
	$sterr = 0;
}

/* Traitement de la form html après achat */

/* récupération du nombre de places occupées dans la rangée $stline */
$stnboc = explode(".",$strempl);

/* debug Nombre de sièges occupés dans les rangées avant achat $stnboc */
if ($debug == 0) {
	echo '<p><font color='.$StOcCo.'>$strempl = '.$strempl.'</p>';
	echo '<p><font color='.$StOcCo.'>$stnboc = '.$stnboc.'</p>';
	for ($i=$StStNum;$i < $StNbRan; $i++) {
		echo '<p><font color='.$StOcCo.'>$stnboc['.$i.'] = '.$stnboc[$i].'</p>';
	}
}

/* Nombre de sièges libres dans les rangées avant achat $stnbli */
for ($i=$StStNum;$i < $StNbRan; $i++) {
	$stnbli[$i] = $StNbSea - $stnboc[$i];
}

/* debug Nombre de sièges libres dans les rangées avant achat $stnbli */
if ($debug == 0) {
	echo '<p><font color='.$StOcCo.'>$stnbli = '.$stnbli.'</p>';
	for ($i=$StStNum;$i < $StNbRan; $i++) {
		echo '<p><font color='.$StOcCo.'>$stnbli['.$i.'] = '.$stnbli[$i].'</p>';
	}
}

/* Traitement des éléments récupérés dans la form html achetée */
$stnbli[$stline] = $stnbli[$stline] - $stnbseat;
	
/* debug nombre sièges libres $stlili[$stline] dans la rangée après achat */
if ($debug == 0) {
	echo '<p><font color='.$StOcCo.'>$stnbli = '.$stnbli.'</p>';
	for ($i=$StStNum;$i < $StNbRan; $i++) {
		echo '<p><font color='.$StOcCo.'>$stnbli['.$i.'] = '.$stnbli[$i].'</p>';
	}
}

/* Mise à jour du nombre de places occupées dans la rangée */
$stnboc[$stline] = $stnboc[$stline] + $stnbseat;

/* debug nombre sièges occupé $stnboc[$stline] dans la rangée après achat */
if ($debug == 0) {
	echo '<p><font color='.$StOcCo.'>$stnboc = '.$stnboc.'</p>';
		for ($i=$StStNum;$i < $StNbRan; $i++) {
		echo '<p><font color='.$StOcCo.'>$stnboc['.$i.'] = '.$stnboc[$i].'</p>';
	}
}

/* Mise à jour de l'enregistrement $strempl */
$strempl = implode(".",$stnboc);

/* Debug mise à jour du nombre de places occupées dans la rangée $stline */
if ($debug == 0) {
	echo '<p><font color='.$StOcCo.'>$strempl = '.$strempl.'</p>';
}
	
/* debug Nombre de sièges libres dans les rangées avant achat $stnbli */
if ($debug == 1) {
	echo '<p><font color='.$StOcCo.'>$stnbli['.$stline.'] = '.$stnbli[$stline].'</p>';
}

/* test du nombre de place libres restantes dans la rangée apès achat */
if ($stnbli[$stline] < 0) {
	/* Erreur 1 : pas assez de place dans la rangée */
	$sterr = 1;
	$stnbseat = 0;
}
else {
	/* Assez de places dans la rangée */
	$sterr = 0;
}
	
 /* formulaire() Formulaire HTML */
 /*
 
 $StTitre                                            $StLogo			
																		
 Vous : $StLogin     						 Le film : $StMovie      	
						
 Salle : $StSalle						   Séance du : $StSeanc			
																		
				Légende : place libre : [ _ ], place occupée : [ X ].	
																		
							Ecran										
       ---------------------------------------------					
																		
														Places libres				
   0 | [ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ]	9				
   1 | [ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ]	9				
   2 | [ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ]	9				
   3 | [ X ][ X ][ X ][ X ][ _ ][ _ ][ _ ][ _ ][ _ ]	5				
   4 | [ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ]	9				
   5 | [ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ]	9				
   6 | [ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ]	9				
   7 | [ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ][ _ ]	9				
         0    1    2    3    4    5    6    7    8					
																		
 Combien de place voulez-vous acheter ? [  ] min 1, maxi $StNbSea places			
 A quelle rangée voulez-vous aller ?    [  ] min 0, maxi $StNbRan-1 rangée				
 
 Traitement des erreurs et validation de l'achat.
 																	
 */

/* Dessin des sièges libres et occupés : place libre [_], place Occupée : [X] */
$siegevide = $StSeSt.'<font color='.$StViCo.'>'.$StViCa.'<font color='.$StCara.'>'.$StSeEn;
$siegeoccu = $StSeSt.'<font color='.$StOcCo.'>'.$StOcCa.'<font color='.$StCara.'>'.$StSeEn;

/* Affichage de la page d'achat de places */

/* bandeau supérieur */
echo '<HTML><HEAD><title>'.$StTitre.'</title><meta charset="UTF8"></head><body bgcolor='.$StFond.'><br>';
echo "<table width=100%><tr><td with=80%><font size=+1.5 color=".$StCara.">".$StTitre."</td><td width=20%><img width=60% src=".$StLogo."></td></tr></table><br>";
echo '<table width=100%><tr><td align=center><table width=420><tr><td with=50%><font color='.$StViCo.'>Client :  '.$StLogin.'</td><td width=50%><font color='.$StViCo.'>Film : '.$StMovie.'</td></tr></table>';
echo '<table width=420><tr><td with=50%><font color='.$StViCo.'>Salle : '.$StSalle.'</td><td width=50%><font color='.$StViCo.'>Séance du : '.$StSeanc.'</td></tr></table></tr></table><br>';

/* Salle */
echo '<table width=100%><tr><td align=center><font color='.$StRepo.'>Représentation graphique de la salle '.$StSalle.'</td></tr></table>';
echo '<table width=100%><tr><td align=center><table><tr><td colspan=3><font color='.$StCara.'>Ecran</td><td align=center colspan='.$StNbSea.'><font color='.$StCara.'>'.$StEcra.'</td></tr>';			
echo '<tr><td width=20> </td><td width=20> </td><td width=20> </td>';
for ($j=$StStNum;$j < $StNbSea; $j++) {
	echo '<td><font color='.$StCara.'> </td>';
}
echo '<td width=120><font color='.$StCara.'>Places libres</td></tr>';

echo '<tr>';
for ($i=$StStNum;$i < $StNbRan; $i++) {
	echo 'td> </td><td> </td><td align=center><font courrier color='.$StCara.'>'.$i.'</td><td align=center><font color='.$StCara.'>'.$StAlle.'</td>';
	for ($j=$StStNum;$j < $stnboc[$i]; $j++) {
		echo '<td align=center width=40><font color='.$StCara.'>'.$siegeoccu.'</td>';
	}
	for ($j=$StStNum;$j < $stnbli[$i]; $j++) {
			echo '<td align=center width=40><font color='.$StCara.'>'.$siegevide.'</td>';
	}
	echo '<td align=center><font color='.$StCara.'>'.$stnbli[$i].'</td></tr>';
}

echo '<tr><td> </td><td> </td>td> </td><td> </td>';
for ($j=$StStNum;$j < $StNbSea; $j++) {
	echo '<td align=center><font color='.$StCara.'>'.$j.'</td>';
}
echo '</tr></table></tr><td align=center><font color='.$StRepo.'>Légende : <font color='.$StCara.'>place libre : '.$siegevide.', <font color='.$StCara.'>place occupée : '.$siegeoccu.'</td></tr></table>';

/* saisie de l'achat en mode console ou */
/* 
$place = readline(" Combien de place voulez-vous acheter ? ");
echo ' min 1, maxi '.$StNbSea.' places\n';
$rangee = readline(" A quelle rangée voulez-vous aller ? ");
echo ' min 0, maxi '.soustration($StNbRan,1).' rangée\n\n'; 
*/

/* saisie de l'achat en mode formulaire html*/
echo '<br><form method="get" action="?">';
echo '<table width=100%><tr><td align=center><table width=400><tr><td><font color='.$StCara.'> Combien de place voulez-vous acheter ? </td>';
echo '<td gbcolor='.$StFond.'><font color='.$StRepo.'><input bgcolor='.$StRepo.' type="text" name="stnbseat" size=1 value="1"></td></tr>';
echo '<tr><td><font color='.$StCara.'> A quelle rangée voulez-vous aller ? </td>';
echo '<td gbcolor='.$StFond.'><font color='.$StRepo.'><input bgcolor='.$StRepo.' type="text" name="stline" size=1 value="0"></td></tr>';
if ($sterr == 1) {
	echo '<td><font color='.$StOcCo.'>Désolé, pas assez de place dans la rangée</td>';
}
else {
	/* echo '<td><font color='.$StRepo.'>Achat validé, bonne séance</td>'; */
	echo '<td> </td>';
}
echo '<td><input type="submit" value="Acheter"></td></tr></table></td></tr></table>';
echo '<input type="hidden" name="strempl" value="'.$strempl.'">';
echo '</form>';


/* Traitement de la saisie */
/* en mode console après la saisie (non traité ici)*/

/* Traitement de la saisie en mode formulaire html */
/* au début avec les éléments récupérés dans la form get */
  
 /* putseance() */
 /* par mise à jour du champ STREMPL dans l'enregistrement séléctionné	*
  * après mise en forme PHP par concaténation							*
  * Est pris en compte ici un remplissage contigue de chaque place 		*
  * depuis la gauche vers la droite. Dans cette version respectant le 	*
  * cahier des charges, il n'est pas prévu que le client puisse choisir *
  * sa place dans la rangée ce qui peut rebuter ! Pour la prise en compte *
  * de ce critère supplémentaire, STREMPL serait différent, car il ne	*
  * reflèterai plus un comptage du remplissage par rangée, mais une 	*
  * matrice.  															*
  * Exemple : STREMPL = "1,0,1,0,0,1,1,0;0,0,0,1,1,1,1,0;..."			*
  * où 1 = occupé et 0 libre. les questions posées devraient être 		*
  * adaptées ou utiliser un mode de sélection graphique.				*/


  
  
 
 /* closeconnectdb() */
 /*    mysqli_close($conn); */

echo "</body></html>";
?>
