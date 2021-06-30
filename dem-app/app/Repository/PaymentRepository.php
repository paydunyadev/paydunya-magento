<?php

namespace  App\Repository;

class PaymentRepository
{
    public function configPayment(){

        \Paydunya\Setup::setMasterKey("RuD3LUEr-3yUG-YY0c-NsW2-8YaOVSNfLmFK");
        \Paydunya\Setup::setPrivateKey("live_private_ezIMkWgVyzx6Jxx6ZrGwguwJyXb");
        \Paydunya\Setup::setToken("d6WbHk209kKuFgNr9qXK");
        \Paydunya\Setup::setMode("live"); // Optionnel. Utilisez cette option pour les paiements tests.
        //Configuration des informations de votre service/entreprise
        \Paydunya\Checkout\Store::setName("Dem votre assistant personnel"); // Seul le nom est requis
        \Paydunya\Checkout\Store::setTagline("Qui réalise vos démarches administrative s'occupe de vos abonnements eau, électricité et internet lors de vos déménagements vous met en relation avec des médecins spécialistes pour des soins de santé de qualité");
        \Paydunya\Checkout\Store::setPhoneNumber("336530583");
        \Paydunya\Checkout\Store::setPostalAddress("Dakar Plateau - Etablissement kheweul");
        \Paydunya\Checkout\Store::setWebsiteUrl("https://dem2021.herokuapp.com/");
        \Paydunya\Checkout\Store::setLogoUrl("https://dem2021.herokuapp.com/assets/images/lg0.svg");
        \Paydunya\Checkout\Store::setCallbackUrl("https://dem2021.herokuapp.com/payment/callback_url");
        \Paydunya\Checkout\Store::setCancelUrl("https://dem2021.herokuapp.com/payment/cancel_url");
        \Paydunya\Checkout\Store::setReturnUrl("https://dem2021.herokuapp.com/payment/return_url");

    }

    /**
     * @param $mount
     * @return mixed
     */
    public function initPayment($mount){
        $this->configPayment();
        $invoice = new \Paydunya\Checkout\CheckoutInvoice();
        $invoice->setDescription("Facture de votre demande ");
        $invoice->setTotalAmount($mount);

        if($invoice->create()) {
            return $invoice->getInvoiceUrl();
        }else{
            echo $invoice->response_text;
        }
    }

    public function backAfterPayment($token){
        $this->configPayment();

        $invoice = new \Paydunya\Checkout\CheckoutInvoice();
        if ($invoice->confirm($token)) {

        }else{

        }
    }
}
