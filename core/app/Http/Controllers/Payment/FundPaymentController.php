<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use App\Models\Settings;
use App\Models\Deposits;
use App\Models\User;
use App\Models\UserGateway;
use App\Models\Currency;
use App\Models\Transactions;
use App\Models\Charges;
use App\Models\History;
use App\Models\CreditcardFeeTable;
use App\Models\CreditcardFeeInstallment;

use App\Lib\Pix\PixGateway;
use App\Lib\Boleto\BoletoGateway;
use App\Lib\CreditCard\CreditCardGateway;
use App\Lib\BillingUtils;
use Session;
use QrCode;

class FundPaymentController extends Controller {
    
    private $successStatus  = 200;

    public function processFund(Request $request) {
        try {

            $set=Settings::first();
            
            $user = BillingUtils::identifyAuthenticatedUser(null);
            if ($user == null) {
                throw new \Exception("Você precisa estar logado para executar essa operação.");
            }

            $currency=Currency::whereStatus(1)->first();

            if (!is_numeric($request->amount) || !($request->amount > 0)) {
                throw new \Exception("O valor da recarga precisa ser maior que zero.");
            }

            $success = null;
            switch(strtolower($request->type)) {
                case "pix" :
                    $success = $this->payFundWithPix($request, $currency, $set, $user);
                    break;

                default:
                    throw new \Exception("Meio de pagamento inválido.");
            } 

            return response()->json($success, 200);
        } catch (\Exception $ex) {
            //exit($ex->getTraceAsString());
            return response()->json(['success' => false, 'message'=> $ex->getMessage()], 200);
        } 
    }
    

    private function payFundWithPix(Request $request, $currency, $settings, $user) {
        
        if (!UserGateway::validatePaymentMethod($user->id, UserGateway::PIX)) {
            throw new \Exception("A forma de pagamento selecionada não está habilitada para o comerciante!");
        }

        $gateway = \App\Models\UserGateway::getDefaultGateway(\App\Models\UserGateway::PIX, $user->id);
    
        $charge= ($request->amount * $gateway->charge / 100);
        $totalAmount = ($request->amount + $charge);

        $IPix = PixGateway::getGateway($gateway);
        
        if (!isset($request->pix_client_name) || !isset($request->pix_client_document) || empty($request->pix_client_name) || empty($request->pix_client_document)) {
            throw new \Exception("É ncessário informar o seu nome e documento.");
        }

        $clientData = Array(
            "document" => $request->pix_client_document,
            "name" => $request->pix_client_name
        );
        
        $deposit = Deposits::createDeposit($user->id, "pix", $gateway->id, $totalAmount, $charge, $currency);

        $pixInfo = $IPix->criarCobrancaQrCode($clientData, $deposit->amount, $gateway->val4, (!empty($request->notes) ? $request->notes : "Fund {$deposit->id}"));
        
        $qrcode = "data:image/png;base64,". base64_encode(QrCode::format('png')->size(300)->generate($pixInfo["qrcode"]));
        $deposit->updatePixInfo($pixInfo["txid"], $qrcode, $pixInfo["copy"]);

        $success = Array(
            "reference" => $deposit->trx,
            "total" => number_format($deposit->amount,  2, ".", ""),
            "txid" => $pixInfo["txid"],
            "copy" => $pixInfo["copy"],
            "qrcode" => $qrcode,
            "success" => true,
            "total" => number_format($deposit->amount,  2, ".", ""),
            "recharge" => number_format($deposit->amount - $deposit->charge, 2, ".", ""),
            "charge" => number_format($deposit->charge, 2, ".", "")
        );
        

        return $success;
    
    }


    public function verifyFund(Request $request) {
        try {
            $success = Array(
                "paid" => false
            );
            if (isset($request->reference) && !empty($request->reference)) {

                $deposit = Deposits::where("trx", $request->reference)->first();

                if ($deposit && $deposit->status == 1) {
                    $success = Array(
                        "paid" => true,
                        "redirect" => route('user.dashboard'),
                        "message" => "Pagamento registrado com sucesso!"
                    );
                } 
            }

            return response()->json($success, 200);
        } catch (\Exception $ex) {
            //exit($ex->getTraceAsString());
            return response()->json(['success' => false, 'message'=> $ex->getMessage()], 200);
        } 
    }


}