<?php
/**
 * Détermine le compte par défaut d'un objet
*
* @plugin     Comptes bancaires
* @copyright  2017
* @author     Rainer
* @licence    GNU/GPL
* @package    SPIP\Comptes_bancaires\Compte defaut
*/

if (!defined('_ECRIRE_INC_VERSION')) return;

/**
 * Fonction générique
 *
 * @param  integer $objet Objet dont on cherche le compte.
 * @param  integer $id_objet l'id de l'objet.
 *
 * @return array   Les données du compte par défaut.
 */
function compte_defaut_objet_dist($objet, $id_objet) {
	// On cherche maintenant s'il existe une personnalisation pour les taxes : prix_<objet>() dans prix/<objet>.php
	$compte_defaut = '';

	if ($fonction_compte_defaut = charger_fonction($objet, 'compte_defaut', true)) {
		$compte_defaut = $fonction_compte_defaut($id_objet);
	}
	else {
		$compte_defaut = cb_compte_lie($objet, $id_objet);
	}

	//Valeurs par défaut
	if (!$compte_defaut and test_plugin_actif('bank')) {
		include_spip('inc/config');
		$compte_defaut = lire_config('bank_paiement/config_virement', array());

		foreach ($compte_defaut AS $champ => $valeur) {
			if($champ == 'ordre') {
				$compte_defaut['nom'] = $valeur;
				unset($compte_defaut['ordre']);
			}
			if($champ == 'banque') {
				$compte_defaut['nom_banque'] = $valeur;
				unset($compte_defaut['banque']);
			}
			if($champ == 'notice') {
				$compte_defaut['remarques'] = $valeur;
				unset($compte_defaut['notice']);
			}
		}
	}
	return $compte_defaut;
}


/**
 * Obtient un compte lie à l'objet
 *
 * @param  integer $objet Objet dont on cherche le compte.
 * @param  integer $id_objet l'id de l'objet.
 *
 * @return array   Les données du compte.
 */
function cb_compte_lie($objet, $id_objet) {
	return sql_fetsel(
			'*',
			'spip_bancaire_comptes LEFT JOIN spip_bancaire_comptes_liens
				ON spip_bancaire_comptes.id_bancaire_compte=spip_bancaire_comptes_liens.id_bancaire_compte',
			'objet=' . sql_quote($objet) . ' and id_objet=' . $id_objet);
}