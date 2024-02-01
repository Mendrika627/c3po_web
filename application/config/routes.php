<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

// $route['default_controller'] = 'welcome';
// $route['default_controller'] = 'BienvenueController/page_presentation';
// $route['404_override'] = '';
// $route['translate_uri_dashes'] = FALSE;
$route = array(
    'default_controller'=>'BienvenueController/page_presentation',
    '404_override'=>'',
    'translate_uri_dashes' => false,
    'connexion' => 'ConnexionController/page_connexion',
    'connexion/verification'=>'ConnexionController/operation_validation_login',
    'deconnexion' => 'ConnexionController/page_deconnexion',
    //table operation
    'operation/gestion-operation' => 'OperationController',
	'operation/datatable' => 'OperationController/operation_datatable',
    'operation/insertion' => 'OperationController/operation_insertion',
    'operation/selectionner/(:num)' => 'OperationController/operation_selection/$1',
    'operation/modification' => 'OperationController/operation_modification',
    'operation/suppression/(:num)' => 'OperationController/operation_suppression/$1',
    //table groupe
    'groupe/gestion-groupe' => 'GroupeController',
    'groupe/datatable' => 'GroupeController/operation_datatable',
    'groupe/insertion' => 'GroupeController/operation_insertion',
    'groupe/selectionner/(:num)' => 'GroupeController/operation_selection/$1',
    'groupe/modification' => 'GroupeController/operation_modification',
    'groupe/suppression/(:num)' => 'GroupeController/operation_suppression/$1',
    // table utilisateur
    'utilisateur/gestion-utilisateur' => 'UtilisateurController',
    'utilisateur/datatable' => 'UtilisateurController/operation_datatable',
    'utilisateur/insertion' => 'UtilisateurController/operation_insertion',
    'utilisateur/selectionner/(:num)' => 'UtilisateurController/operation_selection/$1',
    'utilisateur/modification' => 'UtilisateurController/operation_modification',
    'utilisateur/suppression/(:num)' => 'UtilisateurController/operation_suppression/$1',
    //table historique
    'historique' => 'HistoriqueController',
    'historique/nettoyer' => 'HistoriqueController/operation_nettoyer',

    //table pecheur
    'pecheur/gestion-pecheur' => 'PecheurController',
    'pecheur/datatable' => 'PecheurController/operation_datatable',
    'pecheur/insertion' => 'PecheurController/operation_insertion',
    'pecheur/selectionner/(:num)' => 'PecheurController/operation_selection/$1',
    'pecheur/modification' => 'PecheurController/operation_modification',
    'pecheur/suppression/(:num)' => 'PecheurController/operation_suppression/$1',
    'pecheur/mot_de_passe' => 'PecheurController/operation_mot_de_passe',
    //table technique
    'technique/gestion-technique' => 'TechniqueController',
    'technique/Niveau1/datatable' => 'TechniqueController/operation_datatable_niveau_1',
    'technique/Niveau1/liste' => 'TechniqueController/liste_niveau_1',
    'technique/Niveau2/datatable' => 'TechniqueController/operation_datatable_niveau_2',
    'technique/Niveau1/insertion' => 'TechniqueController/operation_insertion_niveau_1',
    'technique/Niveau2/insertion' => 'TechniqueController/operation_insertion_niveau_2',
    'technique/Niveau1/selectionner/(:num)' => 'TechniqueController/operation_selection_niveau_1/$1',
    'technique/Niveau2/selectionner/(:num)' => 'TechniqueController/operation_selection_niveau_2/$1',
    'technique/Niveau1/modification' => 'TechniqueController/operation_modification_niveau_1',
    'technique/Niveau2/modification' => 'TechniqueController/operation_modification_niveau_2',
    'technique/Niveau1/suppression/(:num)' => 'TechniqueController/operation_suppression_niveau_1/$1',
    'technique/Niveau2/suppression/(:num)' => 'TechniqueController/operation_suppression_niveau_2/$1',


);



// $liste_de_choix = array(
//     'commune'=> 'CommuneController',
//     'type_station' => 'TypeStationController',
//     'masse_eau' => 'MasseEauController',
//     'personnel' => 'PersonnelController',
//     'etude' => 'EtudeController',
//     'compartiment' => 'CompartimentController',
//     'facies_type' => 'FaciesTypeController',
//     'substrat' => 'SubstratController',
//     'appareil_mesure'=> 'AppareilMesureController',
//     'contexte_immediat'=> 'ContexteImmediatController',
//     'pluviosite'=> 'PluviositeController',
//     'hydrologie_apparente'=> 'HydrologieApparenteController',
//     'ensoleillement'=>'EnsoleillementController',
//     'ombrage' => 'OmbrageController',
//     'limpidite'=>'LimpiditeController',
//     'teinte' => 'TeinteController',
//     'odeur' => 'OdeurController',
//     'meteo' => 'MeteoController',
//     'presence_seuil' => 'PresenceSeuilController',
//     'type_prelevement' => 'TypePrelevementController',
//     'coloration_apparente' => 'ColorationApparenteController',
//     'irisation' => 'IrisationController',
//     'feuille' => 'FeuilleController',
//     'mousse_detergent' => 'MousseDetergentController',
//     'autre_corps' => 'AutreCorpsController',

//     'motif_echantillonnage' => 'MotifEchantillonnageController',
//     'motif_non_echantillonnage' => 'MotifNonEchantillonnageController',
//     'methode_type' => 'MethodeTypeController',
//     'materiel_utilise' => 'MaterielUtiliseController',
//     'mode_appareil_peche' => 'ModeAppareilPecheController',

//     'principal_secondaire' =>'PrincipalSecondaireController',
//     'position' =>'PositionController',
//     'berge' =>'BergeController',
//     'colmatage' =>'ColmatageController',
//     'biometrie_lieu' =>'BiometrieLieuController',
//     'stade' =>'StadeController',
//     'sexe' =>'SexeController',

//     'famille_type' => 'FamilleTypeController',
//     'famille' => 'FamilleController',
//     'genre' => 'GenreController',
//     'taxon_rarete' => 'TaxonRareteController',
//     'taxon_repartition' => 'TaxonRepartitionController',

//     'taxon_alimentation' => 'TaxonAlimentationController',
//     'taxon_nourriture' => 'TaxonNourritureController',
//     'taxon_respiration' => 'TaxonRespirationController',
//     'taxon_locomotion' => 'TaxonLocomotionController',
//     'taxon_preference_hydraulique' => 'TaxonPreferenceHydrauliqueController',
//     'taxon_altitude' => 'TaxonAltitudeController',
//     'type_analyse_effectuee'=>'TypeAnalyseEffectueeController',

//     'parametres_methode'=>'ParametresMethodeController'

   



// );

// foreach($liste_de_choix as $lien => $controller){
//     $route["$lien"] = $controller;
//     $route["$lien/datatable"] = $controller.'/operation_datatable';
//     $route["$lien/insertion"] = $controller.'/operation_insertion';
//     $route["$lien/selectionner/(:num)"] = $controller.'/operation_selection/$1';
//     $route["$lien/modification"] = $controller.'/operation_modification';
//     $route["$lien/suppression/(:num)"] = $controller.'/operation_suppression/$1';
// }

