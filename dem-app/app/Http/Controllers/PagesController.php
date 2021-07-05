<?php

namespace App\Http\Controllers;
// Don't forget the Intertia Package ;)
use Inertia\Inertia;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;

class PagesController extends Controller
{
    // HOME PAGES

    function administrative(){
        return Inertia::render('Public/Dem/Adm');
    }

    function demenagement(){
        return Inertia::render('Public/Dem/Dem');
    }

    function marketplace(){
        return Inertia::render('Public/Dem/Market');
    }

    // DASHBOARD

    function adm(){
        return Inertia::render('adm_board');
    }

    function Dem(){
        return Inertia::render('dem_board');
    }

    function market(){
        return Inertia::render('marc_board');
    }

    // DEM ADMINISTRATIVES

    function individuelle(){

        return Inertia::render('Public/administrative/individuelle');
    }

    public function test(){
        $phpWord = new PhpWord();
        $section1 = $phpWord->addSection();
        $sectionStyle = $section1->getStyle();
        $sectionStyle->setMarginLeft(200);
        $section1->addText("DEM ENTREPRISE",array('name' => 'Tahoma', 'size' => 16, 'color' => '77B5FE', 'bold' => true));
        $section = $phpWord->addSection();
//        $text = $section->addText("DEM ENTREPRISE",array('name' => 'Tahoma', 'size' => 16, 'color' => '77B5FE', 'bold' => true));
        $text = $section->addText("FORMULAIRE UNIQUE ",array('name'=>'Arial','size' => 18,'bold' => true,'marginLeft'=>200,'marginBottom'=>200));
        $text = $section->addText("D’IMMATRICULATION DES ENTREPRISES INDIVIDUELLES",array('name'=>'Arial','size' => 16,'bold' => true,'color'=>'red'));
        $text = $section->addText("I.	IDENTIFICATION  DE L’ENTREPRISE",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("Dénomination sociale : ",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("Sigle  ",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("Activités ",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("Adresse de l’établissement  ",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("Avez-vous déjà eu un Registre de Commerce ?    ",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("II.	IDENTIFICATION DU REPRESENTANT LEGAL ",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("Nom ",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("Prénoms  ",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("Nationalité  ",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("Sénégalaise ou ",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("Autres  ",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("Situation matrimoniale  ",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("Célibataire   ",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("Marié(e) ",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("Divorcé(e)",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("Veuf (ve)",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("Adresse du domicile ",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("Téléphone ",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("Email ",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("III.	IDENTIFICATION DU CONJOINT ",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("Nom ",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("Prénoms ",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("Date et lieu du mariage  ",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("Option matrimoniale  ",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("Monogamie ",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("Polygamie ",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("Régime matrimonial  ",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("Communauté des biens ",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("Séparation des biens ",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("Date de dépôt  ",array('name'=>'Arial','size' => 12,'bold' => true));
        $text = $section->addText("Signature ",array('name'=>'Arial','size' => 12,'bold' => true));
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('Appdividend.docx');
        return response()->download(public_path('Appdividend.docx'));
    }
}
