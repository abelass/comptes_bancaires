<?php
/**
 * Fonctions utiles au plugin Comptes bancaires
 *
 * @plugin     Comptes bancaires
 * @copyright  2017 - 2022
 * @author     Rainer
 * @licence    GNU/GPL
 * @package    SPIP\Comptes_bancaires\Fonctions
 */

if (!defined('_ECRIRE_INC_VERSION')) return;

/**
 * Filtre pour déterminer un compte par défaut
 *
 * @param  integer $objet Objet dont on cherche le compte.
 * @param  integer $id_objet l'id de l'objet.
 *
 * @return array       Données du compte par défaut
 */
function compte_bancaire_defaut($objet, $id_objet) {
	// On appele la fonction génñerique
	$fonction_compte_defaut = charger_fonction('objet', 'compte_defaut');

	return $fonction_compte_defaut($objet, $id_objet, $objet_parent, $id_objet_parent);

}

?>