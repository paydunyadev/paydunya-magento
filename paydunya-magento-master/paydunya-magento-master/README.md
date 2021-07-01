# Installation

## Préalable

- Etape #1 : Créez un compte au niveau du marketplace de Magento via ce lien https://account.magento.com/applications/customer/create
- Etape #2 : Puis connectez-vous sur le marketplace (https://account.magento.com/applications/customer/login/)
- Etape #3 : Accèdez à votre profil (votre nom en haut à droite -> My profile) puis clickez sur `Access Keys` dans la section `My Products`
- Etape #4 : Puis dans la section correspondante à la version de votre Magento (`Magento 2` par exemple), clickez sur `Create A New Access Key`
- Etape #5 : Renseignez un nom (représeantant l'accès) au niveau du champ qui apparaît, puis validez et vous verrez les clés générés    

## Installation proprement dite

- Etape #1 : Faites un `composer require pay_dunya//magento-module dev-master`
- Etape #2 : Donnez comme `Username`, la clé public générée (`Public Key`) lors de la génération des clés d'accès sur votre profil (cf. `Préalable`) et comme mot de passe
     la clé privée (`Public Key`)
- Etape #3 : Puis activez le module avec `php bin/magento module:enable Paydunya_PaydunyaMagento --clear-static-content`
- Etape #4 : Enfin exécutez `bin/magento setup:upgrade` afin de permettre à Magento de prendre en compte les modifs 

Après avoir fais ceci, suivez les instructions ci-dessous pour que tout puisse fonctionner à la perfection

1. Créez un compte marchand (compte professionnel) sur https://www.paydunya.com.
     Après l’enregistrement, vous pourrez créer une application et obtenir vos clés privées et votre jeton.
2. Connectez-vous à votre administrateur Magento et effacez votre cache.
     Allez dans Magasins -> Configuration -> Ventes -> Méthodes de paiement et vous verrez. "PayDunya"
3. Configurer les configurations.
     Définir activé - OUI.
     API de test - NON (si vous définissez cette option sur oui, cela signifie que vous utilisez notre API de test PayDunya)
     Entrez la clé privée et le jeton.
     Nouveau statut de commande - Il s'agit du statut de commande par défaut défini lorsqu'un utilisateur sélectionne PayDunya pour le "traitement".
     Toutes les commandes avec ce statut signifient que l'utilisateur a créé une commande mais attend le paiement.
4. Enregistrer les configurations
  
Paydunya - Au-delà des limites!
