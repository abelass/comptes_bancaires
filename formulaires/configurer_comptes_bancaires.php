<?php

// Sécurité
if (!defined('_ECRIRE_INC_VERSION'))
	return;

function formulaires_configurer_comptes_bancaires_saisies_dist() {
	include_spip('inc/config');

	$config = lire_config('comptes_bancaires', array());

	return array(
		array(
			'saisie' => 'fieldset',
			'options' => array(
				'nom' => 'fieldset_parametres',
				'label' => _T('comptes_bancaires:cfg_titre_parametrages')
			),

			'saisies' => array(
				array(
					'saisie' => 'choisir_objets',
					'options' => array(
						'nom' => 'objets',
						'defaut' => $config['objets'] ,
						'label' => _T('comptes_bancaires:label_lier_objets'),
					)
				),

		),
		)
	);
}
?>
