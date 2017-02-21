<?php

/**
 *  Fichier généré par la Fabrique de plugin v5
 *   le 2017-02-21 16:08:36
 *
 *  Ce fichier de sauvegarde peut servir à recréer
 *  votre plugin avec le plugin «Fabrique» qui a servi à le créer.
 *
 *  Bien évidemment, les modifications apportées ultérieurement
 *  par vos soins dans le code de ce plugin généré
 *  NE SERONT PAS connues du plugin «Fabrique» et ne pourront pas
 *  être recréées par lui !
 *
 *  La «Fabrique» ne pourra que régénerer le code de base du plugin
 *  avec les informations dont il dispose.
 *
**/

if (!defined("_ECRIRE_INC_VERSION")) return;

$data = array (
  'fabrique' => 
  array (
    'version' => 5,
  ),
  'paquet' => 
  array (
    'nom' => 'Comptes bancaires',
    'slogan' => 'Gérer des cpomptes bancaires',
    'description' => 'Permet de créer des comptes bancaires et de les lier à des objets SPIP',
    'prefixe' => 'comptes_bancaires',
    'version' => '1.0.0',
    'auteur' => 'Rainer',
    'auteur_lien' => 'http://wesbimple.be',
    'licence' => 'GNU/GPL',
    'categorie' => 'communication',
    'etat' => 'dev',
    'compatibilite' => '[3.0.24;3.1.*]',
    'documentation' => '',
    'administrations' => 'on',
    'schema' => '1.0.0',
    'formulaire_config' => 'on',
    'formulaire_config_titre' => 'Configurations',
    'fichiers' => 
    array (
      0 => 'autorisations',
      1 => 'fonctions',
      2 => 'options',
      3 => 'pipelines',
    ),
    'inserer' => 
    array (
      'paquet' => '',
      'administrations' => 
      array (
        'maj' => '',
        'desinstallation' => '',
        'fin' => '',
      ),
      'base' => 
      array (
        'tables' => 
        array (
          'fin' => '',
        ),
      ),
    ),
    'scripts' => 
    array (
      'pre_copie' => '',
      'post_creation' => '',
    ),
    'exemples' => 'on',
  ),
  'objets' => 
  array (
    0 => 
    array (
      'nom' => 'Comptes bancaires',
      'nom_singulier' => 'Compte bancaire',
      'genre' => 'masculin',
      'logo_variantes' => '',
      'table' => 'banciare_comptes',
      'cle_primaire' => 'id_banciare_compte',
      'cle_primaire_sql' => 'bigint(21) NOT NULL',
      'table_type' => 'banciare_compte',
      'champs' => 
      array (
        0 => 
        array (
          'nom' => 'Nom',
          'champ' => 'nom',
          'sql' => 'varchar(255) NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
            2 => 'obligatoire',
          ),
          'recherche' => '10',
          'saisie' => 'input',
          'explication' => '',
          'saisie_options' => '',
        ),
        1 => 
        array (
          'nom' => 'Nom de la banque',
          'champ' => 'nom_banque',
          'sql' => 'varchar(255) NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
          ),
          'recherche' => '8',
          'saisie' => 'input',
          'explication' => '',
          'saisie_options' => '',
        ),
        2 => 
        array (
          'nom' => 'Adresse de la banque',
          'champ' => 'adresse_banque',
          'sql' => 'varchar(255) NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
          ),
          'recherche' => '5',
          'saisie' => 'input',
          'explication' => '',
          'saisie_options' => '',
        ),
        3 => 
        array (
          'nom' => 'IBAN',
          'champ' => 'iban',
          'sql' => 'varchar(255) NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
            2 => 'obligatoire',
          ),
          'recherche' => '5',
          'saisie' => 'input',
          'explication' => '',
          'saisie_options' => '',
        ),
        4 => 
        array (
          'nom' => 'BIC',
          'champ' => 'bic',
          'sql' => 'varchar(255) NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
          ),
          'recherche' => '4',
          'saisie' => 'input',
          'explication' => '',
          'saisie_options' => '',
        ),
        5 => 
        array (
          'nom' => 'Remarques complémentaires',
          'champ' => 'remarques',
          'sql' => 'text NOT NULL DEFAULT \'\'',
          'caracteristiques' => 
          array (
            0 => 'editable',
            1 => 'versionne',
          ),
          'recherche' => '4',
          'saisie' => 'textarea',
          'explication' => '',
          'saisie_options' => 'li_class=haut, class=inserer_barre_edition, rows=4',
        ),
      ),
      'champ_titre' => 'nom',
      'champ_date' => '',
      'statut' => 'on',
      'chaines' => 
      array (
        'titre_objets' => 'Comptes bancaires',
        'titre_objet' => 'Compte bancaire',
        'info_aucun_objet' => 'Aucun compte bancaire',
        'info_1_objet' => 'Un compte bancaire',
        'info_nb_objets' => '@nb@ comptes bancaires',
        'icone_creer_objet' => 'Créer un compte bancaire',
        'icone_modifier_objet' => 'Modifier ce compte bancaire',
        'titre_logo_objet' => 'Logo de ce compte bancaire',
        'titre_langue_objet' => 'Langue de ce compte bancaire',
        'texte_definir_comme_traduction_objet' => 'Ce compte bancaire est une traduction du compte bancaire numéro :',
        'titre_objets_rubrique' => 'Comptes bancaires de la rubrique',
        'info_objets_auteur' => 'Les comptes bancaires de cet auteur',
        'retirer_lien_objet' => 'Retirer ce compte bancaire',
        'retirer_tous_liens_objets' => 'Retirer tous les comptes bancaires',
        'ajouter_lien_objet' => 'Ajouter ce compte bancaire',
        'texte_ajouter_objet' => 'Ajouter un compte bancaire',
        'texte_creer_associer_objet' => 'Créer et associer un compte bancaire',
        'texte_changer_statut_objet' => 'Ce compte bancaire est :',
      ),
      'table_liens' => '',
      'vue_liens' => 
      array (
        0 => 'spip_articles',
        1 => 'spip_evenements',
      ),
      'roles' => '',
      'auteurs_liens' => '',
      'vue_auteurs_liens' => '',
      'echafaudages' => 
      array (
        0 => 'prive/squelettes/contenu/objets.html',
        1 => 'prive/objets/infos/objet.html',
        2 => 'prive/squelettes/contenu/objet.html',
      ),
      'autorisations' => 
      array (
        'objet_creer' => '',
        'objet_voir' => '',
        'objet_modifier' => '',
        'objet_supprimer' => '',
        'associerobjet' => '',
      ),
      'boutons' => 
      array (
        0 => 'menu_edition',
      ),
      'saisies' => 
      array (
        0 => 'objets',
      ),
    ),
  ),
  'images' => 
  array (
    'paquet' => 
    array (
      'logo' => 
      array (
        0 => 
        array (
          'extension' => 'png',
          'contenu' => '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',
        ),
      ),
    ),
    'objets' => 
    array (
      0 => 
      array (
      ),
    ),
  ),
);

?>