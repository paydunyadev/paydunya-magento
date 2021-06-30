<?php

namespace Database\Seeders;

use App\Models\CanalCommunication;
use App\Models\CaracteristiqueTechnique;
use App\Models\IdentityPiece;
use App\Models\OfferType;
use App\Models\Region;
use App\Models\TypeCanal;
use App\Models\TypeConter;
use App\Models\User;
use App\Models\Profile;
use App\Models\MaritalOption;
use App\Models\MaritalRegime;
use App\Models\MaritalStatus;
use Illuminate\Database\Seeder;
use App\Models\TypeInscription;
use App\Models\TypeAdministrative;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Profile::create([
            'name'=>'admin',
            'description'=>'Administrateur du site'
        ]);
        Profile::create([
            'name'=>'AC',
            'description'=>'Agent de collecte (AC) Ou agent de communication digitale',
        ]);
        Profile::create([
            'name'=>'AD',
            'description'=>'Agent de dépôt /livraison',
        ]);
        Profile::create([
            'name'=>'client',
            'description'=>'un utilisateur du site'
        ]);

        User::create([
            'email' => 'abdoulayekeita438@gmail.com',
            'password' =>  Hash::make('passer'),
            'profile_id' => 1,
        ]);

        MaritalOption::create([
            'name'=>'Monogamie',
        ]);

        MaritalOption::create([
            'name'=>'Polygamie',
        ]);

        MaritalStatus::create([
            'name'=>'Marié(e)',
        ]);

        MaritalStatus::create([
            'name'=>'Célibataire',
        ]);

        MaritalStatus::create([
            'name'=>'Divorcé(e)',
        ]);
        MaritalStatus::create([
            'name'=>'Veuf(ve)',
        ]);

        MaritalRegime::create([
            'name'=>'Séparation des biens'
        ]);

         MaritalRegime::create([
             'name'=>'  Communauté des biens'
         ]);

         TypeAdministrative::create([
             'name'=>'type administrative 1'
         ]);
        TypeAdministrative::create([
            'name'=>'type administrative 2'
        ]);

        TypeInscription::create([
            'name'=>'personne morale'
        ]);

        TypeInscription::create([
            'name'=>'Registre de commerce'
        ]);
        TypeInscription::create([
            'name'=>'Inscription chambre des métiers'
        ]);
        TypeInscription::create([
            'name'=>'Décret ONG ou organisme'
        ]);
        IdentityPiece::create([
            'name'=>'Carte Nationale d’identité'
        ]);
        IdentityPiece::create([
            'name'=>'permis de conduire'
        ]);
        IdentityPiece::create([
            'name'=>'passeport'
        ]);
        IdentityPiece::create([
            'name'=>'livret militaire'
        ]);
        IdentityPiece::create([
            'name'=>'Permis de séjour'
        ]);
        IdentityPiece::create([
            'name'=>'autre à préciser'
        ]);
        TypeCanal::create([
            'name'=>'ACCESS',
            'price'=>'5 000 FCFA/mois',
            'description'=>'150 chaînes, radios et services',
        ]);
        TypeCanal::create([
            'name'=>'ÉVASION',
            'price'=>'10 000 FCFA/mois',
            'description'=>'184 chaînes, radios et services',
        ]);
        TypeCanal::create([
            'name'=>'ESSENTIEL+',
            'price'=>'12 000 FCFA/mois',
            'description'=>'130 chaînes, radios et services',
        ]);
        TypeCanal::create([
            'name'=>'ACCESS+',
            'price'=>'15 000 FCFA/mois',
            'description'=>'169 chaînes, radios et services',
        ]);
        TypeCanal::create([
            'name'=>'EVASION +',
            'price'=>'20 000 FCFA/mois',
            'description'=>'207 chaînes, radios et services',
        ]);
        TypeCanal::create([
            'name'=>'TOUT CANAL+',
            'price'=>'40 000 FCFA/mois',
            'description'=>'224 chaînes, radios et services',
        ]);
        CaracteristiqueTechnique::create([
            'name'=>'MMEUBLE'
        ]);
        CaracteristiqueTechnique::create([
            'name'=>'VILLA'
        ]);
        CaracteristiqueTechnique::create([
            'name'=>'PROTECTION INCENDIE'
        ]);
        CaracteristiqueTechnique::create([
            'name'=>'CHANTIER AUTRES'
        ]);
        CaracteristiqueTechnique::create([
            'name'=>'USAGE : DOMESTIQUE PROFESSIONNEL MARAICHER'
        ]);

        TypeConter::create(['name'=>'Offre WOYOFAL Pour compteurs monophasés 4 689 FCFA']);
        TypeConter::create(['name'=>'Offre WOYOFAL Pour compteurs triphasés : 5 950FCFA']);
        TypeConter::create(['name'=>'Offre POST-PAYE (avec facture) : A partir de 18 460 FCFA suivant l’usage du client']);
        OfferType::create([
            'name'=>'Fibre Bi',
            'price'=>'19 900 F',
            'description'=>'Ligne fixe + forfait bloqué, Fibre 15 Méga Max, Modem Wifi inclus, 19 900 F pendant les 12 premiers mois puis 24 900 F/mois',
        ]);
        OfferType::create([
            'name'=>'Fibre Max',
            'price'=>'29900 F',
            'description'=>'Fibre 30 Méga Max, Illimité voix vers fixe, Modem wifi inclus ; 29900 F par mois.',
        ]);
        OfferType::create([
            'name'=>'Fibre Méga',
            'price'=>'29900 F',
            'description'=>'Fibre 60 Méga Max, Illimité voix vers fixe, Modem Wifi inclus ; 29 900 F pendant les 12 premiers mois puis 34 900 F /mois',
        ]);
        OfferType::create([
            'name'=>'Keurgui',
            'price'=>'12 900 F',
            'description'=>'Haut Débit - 2 Méga Max, Forfait Appel: 6 195F TTC, 1 Numéro fixe Sonatel illimité hors N° spéciaux ; 12 900 F par mois',
        ]);
        OfferType::create([
            'name'=>'Keurgui Max',
            'price'=>'19 900 F',
            'description'=>'Haut Débit - 8 Méga Max, Appels illimités vers les Fixes Soir et Week End ; Bouquet TV Orange inclus, 19 900 F par mois',
        ]);
        OfferType::create([
            'name'=>'Keurgui Intense',
            'price'=>'29 900 F',
            'description'=>'Haut Débit - 15 Méga Max, Appels illimités vers les Fixes 24/7 + 2 Mobiles, Bouquet TV Orange inclus 29 900 F par mois',
        ]);

        OfferType::create([
            'name'=>'Box Bi',
            'price'=>'25 000 F',
            'description'=>'Welcome Pass de 30Go ; Pass Internet dés 1000F 25 000 F par mois',
        ]);

        CanalCommunication::create(['name'=>'email']);
        CanalCommunication::create(['name'=>'téléphone']);
        CanalCommunication::create(['name'=>'whatsapp']);
        Region::create(['name'=>'Dakar']);
        Region::create(['name'=>'Sain luis']);
        Region::create(['name'=>'touba']);
    }
}
