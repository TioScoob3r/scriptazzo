@extends('userlayout')

@section('content')

<style>
#chart-payment-div {
  margin-left: calc(50% - 100px);
  width: 200px;
  height: 200px;
}
</style>
<div class="container-fluid mt--6">
    <div class="content-wrapper">
      
     <div class="row">
    <div class="col col-lg-12 col-xs-6">
        <center>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Informações da Conta</h4>
                    <ul class="list-group">
                        <li class="list-group-item d-flex align-items-center">
                            <img src="{{ asset('asset/images/icons/card.svg') }}" alt="Ícone de Conta" width="55" height="30" class="mr-2">
                            <span class="mr-2">Número da sua conta <b style="color:#8803ff;">Azzo</b><b style="color:#f07800;">Pay</b></span>
                            <input type="text" id="pixCode" class="form-control w-50" value="{{$user->account_id}}" readonly>
                            <button onclick="toggleVisibility()" class="btn btn-outline-secondary ml-2" title="Ocultar/Exibir Número">
                                <i id="toggleIcon" class="fa fa-eye-slash"></i>
                            </button>
                            <button onclick="copyPixCode()" class="btn btn-outline-secondary ml-2" title="Copiar">
                                <i class="fa fa-copy"></i>
                            </button>
                            <button onclick="sharePixCode()" class="btn btn-outline-secondary ml-2" title="Compartilhar">
                                <i class="fa fa-share-alt"></i>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </center>
    </div>
</div>

<script>
    function copyPixCode() {
        var copyText = document.getElementById("pixCode");
        copyText.select();
        copyText.setSelectionRange(0, 99999); // Para dispositivos móveis
        navigator.clipboard.writeText(copyText.value)
            .then(() => alert("Número da conta AzzoPay copiado: " + copyText.value))
            .catch(err => alert("Falha ao copiar o código: ", err));
    }

    function toggleVisibility() {
        var pixCodeInput = document.getElementById("pixCode");
        var toggleIcon = document.getElementById("toggleIcon");
        
        if (pixCodeInput.type === "password") {
            pixCodeInput.type = "text";
            toggleIcon.classList.remove("fa-eye-slash");
            toggleIcon.classList.add("fa-eye");
        } else {
            pixCodeInput.type = "password";
            toggleIcon.classList.remove("fa-eye");
            toggleIcon.classList.add("fa-eye-slash");
        }
    }

    function sharePixCode() {
        var pixCode = document.getElementById("pixCode").value;
        var message = `Este é o número de minha conta AzzoPay, faça a transferência utilizando este número: ${pixCode}\n\nAcesse: https://azzopay.com`;

        if (navigator.share) {
            navigator.share({
                title: "Compartilhar Conta AzzoPay",
                text: message,
                url: message
            })
            .then(() => console.log("Compartilhamento bem-sucedido!"))
            .catch((error) => console.error("Erro ao compartilhar:", error));
        } else {
            // Copia a mensagem para dispositivos que não suportam Web Share API
            navigator.clipboard.writeText(message)
                .then(() => alert("Mensagem copiada para compartilhar: " + message))
                .catch(err => alert("Falha ao copiar a mensagem: ", err));
        }
    }

    // Inicialmente oculta o número da conta
    document.getElementById("pixCode").type = "password";
</script>


      
        <div class="row">
            <div class="col-lg-9 col-xs-12">

                <div class="row">

                  	<!---- saldo disponivel ---->
					<div class="col col-lg-4 col-xs-6">
                        <div class="card">
                            <div class="card-body">
                                
                                <h4 class="card-title">Saldo Disponível</h4>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h4 class="h4 mb-0 font-weight-bolder" style="color:green;">{{$currency->symbol}} {{number_format($user->balance, 2, ',', '.')}}</h4>
                                      	<svg class="float-right" style="margin-top: -28px;" width="55" height="30"  version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
	 viewBox="0 0 392.533 392.533" xml:space="preserve">
<path style="fill:#FFFFFF;" d="M199.305,43.19c-37.883,10.925-77.059,22.174-116.364,22.174c-21.851,0-41.956-3.426-61.091-10.408
	V245.34c18.941,8.145,39.046,12.154,61.091,12.154l0,0c36.267,0,73.891-10.796,110.287-21.333
	c37.883-10.925,77.059-22.174,116.364-22.174c21.851,0,41.956,3.426,61.091,10.408V33.946
	c-18.941-8.145-39.046-12.154-61.091-12.154C273.39,21.792,235.701,32.718,199.305,43.19z"/>
<path style="fill:#194F82;" d="M386.327,17.073c-23.79-11.442-48.937-17.067-76.8-17.067c-39.305,0-78.416,11.313-116.364,22.174
	c-36.331,10.537-74.02,21.398-110.158,21.398c-24.501,0-46.545-4.848-67.297-14.933C8.145,25.089,0.582,30.39,0,38.471v213.915
	c0,4.202,2.392,8.016,6.206,9.826c23.79,11.507,48.937,17.067,76.8,17.067l0,0c39.305,0,78.416-11.313,116.299-22.174
	c36.396-10.602,74.085-21.398,110.222-21.398c24.501,0,46.545,4.848,67.297,14.933c8.275,3.879,15.709-2.521,15.709-9.826V26.899
	C392.533,22.697,390.141,18.948,386.327,17.073z M370.747,224.33c-19.135-7.046-39.305-10.408-61.091-10.408
	c-39.305,0-78.481,11.313-116.364,22.174c-36.396,10.537-74.02,21.333-110.287,21.333l0,0c-22.109,0-42.214-3.943-61.091-12.154
	V54.956c19.135,7.046,39.305,10.408,61.091,10.408c39.305,0,78.416-11.313,116.364-22.174
	c36.396-10.537,74.02-21.333,110.287-21.333c22.109,0,42.214,3.943,61.091,12.154V224.33L370.747,224.33z"/>
<path style="fill:#FFC10D;" d="M82.877,235.449c-8.857,0-17.455-0.776-25.665-2.263c-0.065-8.016-5.818-14.869-13.705-16.162
	V102.213c9.568,0.905,17.907-6.659,17.842-16.226c7.046,0.711,14.158,1.034,21.463,1.034c42.408,0,83.071-11.766,122.376-23.014
	c36.525-10.537,71.111-20.493,104.21-20.493c8.986,0,17.455,0.776,25.665,2.263c0.129,8.016,5.818,14.804,13.705,16.162V176.75
	c-9.568-0.905-17.907,6.659-17.842,16.226c-7.046-0.711-14.158-1.099-21.463-1.099c-42.408,0-83.071,11.766-122.376,23.014
	C150.626,225.493,116.04,235.449,82.877,235.449L82.877,235.449z"/>
<g>
	<path style="fill:#FFFFFF;" d="M322.974,141.647c-6.012,0-10.925-4.848-10.925-10.925v-25.212c0-6.012,4.848-10.925,10.925-10.925
		c6.012,0,10.925,4.848,10.925,10.925v25.212C333.899,136.798,329.051,141.647,322.974,141.647z"/>
	<path style="fill:#FFFFFF;" d="M69.56,184.314c-6.012,0-10.925-4.848-10.925-10.925v-25.212c0-6.012,4.848-10.925,10.925-10.925
		s10.925,4.848,10.925,10.925v25.212C80.42,179.336,75.572,184.314,69.56,184.314z"/>
</g>
<g>
	<path style="fill:#194F82;" d="M198.659,108.095c2.78-0.776,5.172-0.646,6.723,0.646c1.745,1.293,2.133,3.685,2.133,5.43
		c0,4.784,3.879,8.663,8.663,8.663s8.663-3.879,8.663-8.663c0-7.887-3.297-14.933-9.051-19.265
		c-3.168-2.392-6.853-3.814-10.925-4.331v-2.909c0-4.784-3.879-8.663-8.663-8.663s-8.663,3.879-8.663,8.663v6.4
		c-11.572,6.077-19.911,18.747-19.911,31.354c0,7.887,3.297,14.933,9.051,19.265c5.947,4.461,14.998,5.301,22.949,3.038
		c-0.259,0.065,0,0,0.065,0c2.327-0.453,4.267-0.129,5.624,0.84c1.745,1.293,2.133,3.685,2.133,5.43
		c0,7.111-6.4,15.192-13.77,17.325c-2.78,0.776-5.172,0.646-6.723-0.646c-1.745-1.293-2.133-3.685-2.133-5.43
		c0-4.784-3.879-8.663-8.663-8.663c-4.784,0-8.663,3.879-8.663,8.663c0,7.887,3.297,14.933,9.051,19.265
		c3.168,2.392,6.853,3.814,10.925,4.267v2.844c0,4.784,3.879,8.663,8.663,8.663c4.784,0,8.663-3.879,8.663-8.663v-6.335
		c11.572-6.077,19.911-18.747,19.911-31.354c0-7.887-3.297-14.933-9.05-19.265c-5.947-4.461-13.899-5.689-21.915-3.426
		c0.259-0.065,0,0-0.065,0c-2.327,0.453-5.301,0.517-6.659-0.453c-1.745-1.293-2.133-3.685-2.133-5.43
		C184.954,118.309,191.418,110.164,198.659,108.095z"/>
	<path style="fill:#194F82;" d="M386.327,289.558c-65.552-31.677-130.457-12.994-193.099,5.107
		c-61.479,17.713-119.531,34.457-177.584,6.4c-5.43-2.65-11.96-0.388-14.545,5.107c-2.651,5.43-0.323,11.96,5.107,14.545
		c52.558,26.053,110.933,20.816,193.099-5.107c61.479-17.713,119.531-34.457,177.584-6.4c5.43,2.65,11.96,0.323,14.545-5.107
		C394.085,298.673,391.758,292.144,386.327,289.558z"/>
	<path style="fill:#194F82;" d="M386.327,344.314c-65.552-31.677-130.457-12.994-193.099,5.107
		c-61.479,17.713-119.531,34.457-177.584,6.4c-5.43-2.65-11.96-0.323-14.545,5.107c-2.651,5.43-0.323,11.96,5.107,14.545
		c58.053,28.768,122.311,17.067,193.099-5.107c61.479-17.713,119.531-34.457,177.584-6.4c5.43,2.65,11.96,0.323,14.545-5.107
		C394.085,353.429,391.758,346.964,386.327,344.314z"/>
</g>
</svg>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!---- saldo disponivel ---->
                  
                  	<!---- saldo disponivel ---->
					<div class="col col-lg-4 col-xs-6">
                        <div class="card">
                            <div class="card-body">
                                
                                <h4 class="card-title">Receita</h4>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h4>{{$currency->symbol}} {{number_format($revenue, 2, ',', '.')}}</h4>
                                        <svg class="float-right" style="margin-top: -28px;" width="55" height="30" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
	 viewBox="0 0 392.598 392.598" xml:space="preserve">
<circle style="fill:#FFC10D;" cx="196.267" cy="196.234" r="121.471"/>
<g>
	<path style="fill:#194F82;" d="M196.396,207.224c-0.065,0-0.065,0-0.129,0C195.879,207.289,196.267,207.224,196.396,207.224z"/>
	<path style="fill:#194F82;" d="M194.521,185.309c0.065,0,0.065,0,0.065,0C194.974,185.244,194.586,185.244,194.521,185.309z"/>
	<path style="fill:#194F82;" d="M194.586,185.309c-0.129,0-0.129,0-0.065,0c-11.96-0.905-21.398-10.99-21.398-23.079
		c0-12.8,10.408-23.208,23.208-23.208s23.208,10.408,23.208,23.208c0,6.012,4.848,10.925,10.925,10.925
		c6.012,0,10.925-4.848,10.925-10.925c0-21.075-14.545-38.723-34.133-43.636V107.41c0-6.012-4.848-10.925-10.925-10.925
		s-10.925,4.848-10.925,10.925v11.184c-19.523,4.848-34.133,22.562-34.133,43.636c0,24.824,20.17,45.059,45.059,45.059
		c0.129,0,0.129,0,0.129,0c11.96,0.905,23.079,10.796,23.079,23.014c0,12.8-10.408,23.208-23.208,23.208
		s-23.208-10.408-23.208-23.208c0-6.012-4.848-10.925-10.925-10.925c-6.012,0-10.925,4.848-10.925,10.925
		c0,21.075,14.545,38.723,34.133,43.636v11.119c0,6.012,4.848,10.925,10.925,10.925s10.925-4.848,10.925-10.925v-11.119
		c19.523-4.848,34.133-22.562,34.133-43.636C241.325,205.414,219.345,185.309,194.586,185.309z"/>
</g>
<g>
	<path style="fill:#194F82;" d="M196.267,21.818c49.972,0,97.228,21.527,130.133,58.44h-42.861c-6.012,0-10.925,4.848-10.925,10.925
		c0,6.012,4.848,10.925,10.925,10.925h65.422c6.012,0,10.925-4.848,10.925-10.925V25.697c0-6.012-4.848-10.925-10.925-10.925
		c-6.077,0-10.925,4.848-10.925,10.925v34.974c-36.784-38.4-87.725-60.638-141.77-60.638C87.984,0.032,0,88.016,0,196.299
		c0,6.012,4.848,10.925,10.925,10.925s10.925-4.848,10.925-10.925C21.786,100.105,100.073,21.818,196.267,21.818z"/>
	<path style="fill:#194F82;" d="M381.673,185.374c-6.012,0-10.925,4.848-10.925,10.925c0,96.194-78.287,174.481-174.481,174.481
		c-58.117,0-111.903-28.897-144.162-76.347h46.028c6.012,0,10.925-4.848,10.925-10.925c0-6.012-4.848-10.925-10.925-10.925H32.711
		c-6.012,0-10.925,4.848-10.925,10.925v65.422c0,6.012,4.848,10.925,10.925,10.925s10.925-4.848,10.925-10.925v-29.414
		c36.848,45.64,92.703,73.051,152.695,73.051c108.283,0,196.267-87.984,196.267-196.267
		C392.533,190.287,387.685,185.374,381.673,185.374z"/>
</g>
</svg>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!---- saldo disponivel ---->
                  
                  	<!---- saldo disponivel ---->
					<div class="col col-lg-4 col-xs-6">
                        <div class="card">
                            <div class="card-body">
                                
                                <h4 class="card-title">Total de Saque</h4>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h4>{{$currency->symbol}} {{number_format($t_payout, 2, ',', '.')}}</h4>
                                      <svg class="float-right" style="margin-top: -28px;" width="55" height="30" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
	 viewBox="0 0 507.901 507.901" xml:space="preserve">
<polygon style="fill:#FFFFFF;" points="116.1,479.8 391.9,479.8 391.9,112 116.1,112 "/>
<path style="fill:#56ACE0;" d="M144.4,320.5H206c7.8,0,14.1,6.3,14.1,14.1c0,7.8-6.3,14.1-14.1,14.1h-61.6v33.4h19.2
	c7.8,0,14.1,6.3,14.1,14.1s-6.3,14.1-14.1,14.1h-19.2v12.9c15.6,0,28.2,12.6,28.2,28.2h162.8c0-15.6,12.6-28.2,28.2-28.2V112H144.4
	V320.5z"/>
<path d="M240,238.6v-0.1C239.9,238,239.9,238.4,240,238.6z"/>
<path d="M268.1,234v0.1C268.2,234.6,268.2,234.1,268.1,234z"/>
<g>
	<path style="fill:#194F82;" d="M340,225.4h-10.5c-4.9-19-22.1-33-42.5-33c-24.2,0-43.8,21.4-43.8,45.6c0,0.2,0,0.2,0,0.1
		c-0.9,11.4-10.4,20.4-22,20.4c-12.2,0-22.1-9.9-22.1-22.1s9.9-22.1,22.1-22.1c6,0,10.9-4.9,10.9-10.9s-4.9-10.9-10.9-10.9
		c-20.5,0-37.6,14.1-42.5,33H168c-6,0-10.9,4.9-10.9,10.9s4.9,10.9,10.9,10.9h10.6c4.9,19,22.1,33,42.5,33
		c24.2,0,43.8-21.4,43.8-45.6c0-0.2,0-0.2,0-0.1c0.9-11.4,10.4-20.4,22-20.4c12.2,0,22.1,9.9,22.1,22.1s-9.9,22.1-22.1,22.1
		c-6,0-10.9,4.9-10.9,10.9s4.9,10.9,10.9,10.9c20.5,0,37.6-14.1,42.5-33H340c6,0,10.9-4.9,10.9-10.9
		C350.9,230.2,346,225.4,340,225.4z"/>
	<path style="fill:#194F82;" d="M479.8,0H28.2C12.7,0,0,12.7,0,28.2v139.4c0,15.6,12.7,28.2,28.2,28.2h59.7v283.9
		c0,15.6,12.7,28.2,28.2,28.2h275.7c15.6,0,28.2-12.7,28.2-28.2V195.8h59.7c15.6,0,28.2-12.7,28.2-28.2V28.2
		C508,12.7,495.3,0,479.8,0z M116.1,479.8V112h275.7v367.7H116.1V479.8z M479.8,167.6h-59.7V112h14.3c7.8,0,14.1-6.3,14.1-14.1
		s-6.3-14.1-14.1-14.1H73.6c-7.8,0-14.1,6.3-14.1,14.1S65.9,112,73.6,112h14.3v55.6H28.2V28.2h451.6L479.8,167.6L479.8,167.6z"/>
</g>
<path style="fill:#FFC10D;" d="M434.4,112h-14.3v55.6h59.7V28.2H28.2v139.4h59.7V112H73.6c-7.8,0-14.1-6.3-14.1-14.1
	s6.3-14.1,14.1-14.1h360.7c7.8,0,14.1,6.3,14.1,14.1S442.1,112,434.4,112z"/>
</svg>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!---- saldo disponivel ---->
                  
                    <div class="col col-lg-4 col-xs-6">
                        <div class="card">
                            <div class="card-body">
                                
                                <h4 class="card-title">{{$lang["home_trasactions_number"]}}</h4>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h4>{{$n_transactions}}</h4>
                                        <svg class="float-right" style="margin-top: -28px;" width="55" height="30" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
	 viewBox="0 0 392.598 392.598" xml:space="preserve">
<path style="fill:#FFFFFF;" d="M21.818,359.822c0,6.012,4.848,10.925,10.925,10.925h327.111c6.012,0,10.925-4.848,10.925-10.925
	V110.545H21.818V359.822z"/>
<path style="fill:#FFC10D;" d="M370.78,32.711c0-6.012-4.848-10.925-10.925-10.925H32.743c-6.012,0-10.925,4.848-10.925,10.925
	v56.113H370.78L370.78,32.711L370.78,32.711z"/>
<rect x="43.604" y="132.267" style="fill:#56ACE0;"/>
<g>
	<path style="fill:#194F82;" d="M359.855,0H32.743C14.707,0,0.032,14.675,0.032,32.711v327.111
		c0,18.101,14.675,32.776,32.711,32.776h327.111c18.036,0,32.711-14.675,32.711-32.711V32.711C392.566,14.675,377.891,0,359.855,0z
		 M370.78,359.822c0,6.012-4.848,10.925-10.925,10.925H32.743c-6.012,0-10.925-4.848-10.925-10.925V110.545H370.78L370.78,359.822
		L370.78,359.822z M370.78,88.76H21.818V32.711c0-6.012,4.848-10.925,10.925-10.925h327.111c6.012,0,10.925,4.848,10.925,10.925
		v56.113l0,0V88.76z"/>
	<path style="fill:#194F82;" d="M253.511,45.834H56.081c-6.012,0-10.925,4.848-10.925,10.925c0,6.012,4.848,10.925,10.925,10.925
		h197.43c6.012,0,10.925-4.848,10.925-10.925C264.372,50.683,259.523,45.834,253.511,45.834z"/>
	<path style="fill:#194F82;" d="M336.517,45.834h-26.828c-6.012,0-10.925,4.848-10.925,10.925c0,6.012,4.848,10.925,10.925,10.925
		h26.828c6.012,0,10.925-4.848,10.925-10.925C347.442,50.683,342.594,45.834,336.517,45.834z"/>
	<path style="fill:#194F82;" d="M213.301,201.438h77.123l-5.883,5.883c-3.879,3.879-3.879,10.214,0,14.093
		c4.396,4.331,10.796,3.491,14.093,0l22.885-22.82c1.875-1.875,2.909-4.396,2.909-7.046s-1.099-5.172-2.909-7.046l-22.885-22.885
		c-3.879-3.879-10.214-3.879-14.093,0c-3.879,3.879-3.879,10.214,0,14.093l5.883,5.883h-77.123c-5.495,0-9.956,4.461-9.956,9.956
		S207.741,201.438,213.301,201.438z"/>
	<path style="fill:#194F82;" d="M229.075,315.41c3.879,3.879,10.214,3.879,14.093,0c3.879-3.879,3.879-10.214,0-14.093l-5.883-5.883
		h77.123c5.495,0,9.956-4.461,9.956-9.956c0-5.495-4.461-9.956-9.956-9.956h-77.123l5.883-5.883c3.879-3.879,3.879-10.214,0-14.093
		c-4.396-4.331-10.796-3.491-14.093,0l-22.885,22.885c-1.875,1.875-2.909,4.396-2.909,7.046c0,2.651,1.099,5.172,2.909,7.046
		L229.075,315.41z"/>
</g>
<path d="M98.618,227.62h0.065C99.071,227.62,98.812,227.62,98.618,227.62z"/>
<path style="fill:#194F82;" d="M108.703,289.552c-11.378,0-20.558-9.18-20.558-20.558c0-5.495-4.461-9.956-9.956-9.956
	c-5.495,0-9.956,4.461-9.956,9.956c0,18.877,12.994,34.715,30.513,39.176v9.826c0,5.495,4.461,9.956,9.956,9.956
	s9.956-4.461,9.956-9.956v-9.826c17.519-4.461,30.513-20.299,30.513-39.176c0-22.303-19.717-40.339-42.02-40.339
	c-0.129,0-0.129,0-0.065,0c-10.602-0.84-18.941-9.632-18.941-20.493c0-11.378,9.18-20.558,20.558-20.558s20.558,9.18,20.558,20.558
	c0,5.495,4.461,9.956,9.956,9.956s9.956-4.461,9.956-9.956c0-18.877-12.994-34.715-30.513-39.176v-9.891
	c0-5.495-4.461-9.956-9.956-9.956s-9.956,4.461-9.956,9.956v9.891c-17.519,4.461-30.513,20.299-30.513,39.176
	c0,22.303,18.166,40.469,40.469,40.469c-0.323,0.065,0,0,0.065,0c10.602,0.84,20.428,9.568,20.428,20.299
	C129.196,280.242,119.952,289.552,108.703,289.552z"/>
</svg>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col col-lg-4 col-xs-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{$lang["home_avg_ticket"]}}</h4>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h4>R$ {{number_format($n_avgticket, 2, ",", ".")}}</h4>
                                      	<svg class="float-right" style="margin-top: -28px;" width="55" height="30"  version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
	 viewBox="0 0 392.709 392.709" xml:space="preserve">
<rect x="88.501" y="287.861" style="fill:#FFC10D;" width="27.345" height="82.747"/>
<rect x="201.568" y="247.005" style="fill:#56ACE0;" width="27.345" height="123.669"/>
<rect x="314.634" y="192.896" style="fill:#FFC10D;" width="27.345" height="177.713"/>
<g>
	<path style="fill:#194F82;" d="M99.103,137.946c-9.18,0-16.679-7.499-16.679-16.679c0-6.012-4.848-10.925-10.925-10.925
		s-10.925,4.848-10.925,10.925c0,17.455,11.636,32.129,27.604,36.913v7.434c0,6.012,4.848,10.925,10.925,10.925
		c6.077,0,10.925-4.848,10.925-10.925v-7.37c15.903-4.719,27.604-19.459,27.604-36.913c0-21.269-17.261-38.465-38.465-38.465
		c0.323-0.065,0,0-0.065,0c-8.469-0.776-16.614-7.822-16.614-16.549c0-9.18,7.499-16.679,16.679-16.679s16.679,7.499,16.679,16.679
		c0,6.012,4.848,10.925,10.925,10.925s10.925-4.848,10.925-10.925c0-17.455-11.636-32.129-27.604-36.913v-7.564
		c0-6.012-4.848-10.925-10.925-10.925c-6.077,0-10.925,4.848-10.925,10.925v7.499c-15.968,4.784-27.604,19.523-27.604,36.913
		c0,21.269,17.261,38.465,38.465,38.465c-0.323,0.065,0,0,0.065,0c8.469,0.776,16.614,7.822,16.614,16.549
		C115.846,130.447,108.347,137.946,99.103,137.946z"/>
	<path style="fill:#194F82;" d="M381.673,370.868H363.83V182.164c0-6.012-4.849-10.925-10.925-10.925h-49.131
		c-6.012,0-10.925,4.848-10.925,10.925v188.703h-42.214V236.274c0-6.012-4.848-10.925-10.925-10.925h-49.131
		c-6.012,0-10.925,4.848-10.925,10.925v134.529h-42.214V277.13c0-6.012-4.848-10.925-10.925-10.925H77.382
		c-6.012,0-10.925,4.848-10.925,10.925v93.673H21.786v-94.836l66.327-60.186h55.337c3.814,0,7.37-2.004,9.374-5.236l30.707-50.877
		l57.018,7.822c3.879,0.517,7.822-1.099,10.214-4.267l61.673-82.23l73.115-26.958c5.624-2.069,8.598-8.339,6.465-13.964
		c-2.069-5.624-8.339-8.469-13.964-6.465l-76.089,28.057c-2.004,0.711-3.685,2.004-4.913,3.685l-59.798,79.644l-57.794-7.952
		c-4.331-0.646-8.598,1.487-10.796,5.172l-31.16,51.782H84.105c-2.715,0-5.301,1.034-7.37,2.844L21.98,246.552V10.981
		c0-6.012-4.848-10.925-10.925-10.925S0,4.969,0,10.981v370.747c0,6.012,4.848,10.925,10.925,10.925h370.747
		c6.012,0,10.925-4.848,10.925-10.925C392.533,375.716,387.685,370.868,381.673,370.868z M115.846,370.868H88.501v-82.812h27.345
		V370.868z M228.848,370.868h-27.345V247.263h27.345V370.868z M341.98,370.868h-27.345V193.154h27.345V370.868z"/>
</g>
</svg>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col col-lg-4 col-xs-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{$lang["home_transactions_volume"]}}</h4>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h4>R$ {{number_format($n_transactions_total, 2, ",", ".")}}</h4>
                                      	<svg class="float-right" style="margin-top: -28px;" width="55" height="30" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
	 viewBox="0 0 508.065 508.065" xml:space="preserve">
<g>
	<polygon style="fill:#FFFFFF;" points="365.609,147.483 463.109,97.183 333.109,30.183 235.609,80.483 	"/>
	<polygon style="fill:#FFFFFF;" points="258.609,202.683 128.609,135.683 45.009,178.783 175.009,245.883 	"/>
</g>
<path style="fill:#194F82;" d="M500.409,264.583c6.9-3.6,9.6-12.1,6.1-19c-3.6-6.9-12.1-9.6-19-6.1l-107.8,55.6v-45.6l120.7-62.3
	c6.9-3.6,9.6-12.1,6.1-19c-3.6-6.9-12.1-9.6-19-6.1l-107.8,55.6v-45.7l120.7-62.3c9.6-5.1,10.8-18.6,0-25.1l-160.8-82.9
	c-4.1-2.1-8.9-2.1-12.9,0l-318.9,164.6c-9.7,5.3-11.1,18.6,0,25.1l160.8,82.9c4.7,2.2,9,2,12.9,0l93.8-48.4v45.7l-100.3,51.7
	l-154.3-79.6c-6.9-3.6-15.4-0.9-19,6.1c-3.6,6.9-0.9,15.4,6.1,19l160.8,82.9c4.4,2.1,8.7,2.1,12.9,0l93.8-48.4v45.6l-100.3,51.7
	l-154.3-79.6c-6.9-3.6-15.4-0.9-19,6.1c-3.6,6.9-0.9,15.4,6.1,19l160.7,83c4.1,2,8.4,2.1,12.9,0l93.8-48.4v45.7l-100.2,51.6
	l-154.3-79.6c-6.9-3.6-15.4-0.9-19,6.1c-3.6,6.9-0.9,15.4,6.1,19l160.8,82.9c4.4,2.1,8.7,2.1,12.9,0l318.9-164.5
	c6.9-3.6,9.6-12.1,6.1-19c-3.6-6.9-12.1-9.6-19-6.1l-107.8,55.6v-45.7L500.409,264.583z M175.009,245.883l-130-67.1l83.6-43.1
	l130,67.1L175.009,245.883z M159.409,119.783l45.4-23.4l129.9,67l-45.4,23.4L159.409,119.783z M351.409,386.983l-45.8,23.6l-2.2,1.1
	v-200.4l48-24.8V386.983z M365.609,147.483l-130-67.1l97.5-50.3l130,67.1L365.609,147.483z"/>
<g>
	<path style="fill:#56ACE0;" d="M389.309,90.783l-53.1-27.4c-2,1-4.4,1-6.5,0l-63.6,32.8l68.5,35.3l54.7-28.2
		C384.209,100.683,384.209,93.383,389.309,90.783z"/>
	<path style="fill:#56ACE0;" d="M118.609,184.883l53.1,27.4c2-1,4.4-1,6.5,0l49.5-25.5l-68.5-35.3l-40.6,20.9
		C123.709,174.983,123.709,182.183,118.609,184.883z"/>
</g>
<g>
	<polygon style="fill:#FFC10D;" points="289.309,186.783 334.809,163.383 204.809,96.283 159.409,119.783 	"/>
	<polygon style="fill:#FFC10D;" points="303.509,411.783 305.609,410.683 351.409,386.983 351.409,186.583 303.509,211.283 	"/>
</g>
</svg>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    
                    <div class="col col-lg-12 col-xs-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{$lang["home_payment_methods"]}}</h4>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <svg width="16" height="16" viewBox="0 0 16 16"><g fill="none" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" stroke="#7052c8"><path d="M5.469 11.836l2.398-2.402s.012-.008.031-.008c.024 0 .032.008.036.008l2.406 2.41c.41.41.93.676 1.488.765l-2.39 2.395a2.035 2.035 0 01-2.875 0l-2.43-2.43c.5-.113.96-.367 1.336-.738zm0 0M10.34 4.156l-2.406 2.41c-.02.016-.051.016-.067 0L5.47 4.164a2.768 2.768 0 00-1.336-.738l2.43-2.43a2.035 2.035 0 012.875 0l2.39 2.395a2.713 2.713 0 00-1.488.765zm0 0M.996 6.563l1.695-1.696h.832c.325 0 .649.133.88.363L6.8 7.63c.176.176.383.3.605.375-.222.07-.433.195-.605.367L4.402 10.77c-.23.23-.554.363-.879.363h-.832L.996 9.438a2.035 2.035 0 010-2.875zm8 1.808a1.484 1.484 0 00-.601-.367c.218-.074.425-.2.601-.375l2.41-2.406c.23-.23.551-.368.88-.368h1.01l1.708 1.708a2.035 2.035 0 010 2.875l-1.707 1.707h-1.012c-.328 0-.648-.137-.879-.368zm0 0" stroke-width="0.8000039999999999"></path></g></svg>
                                        <span >{{$lang["home_pix"]}}</span>
                                        <span class="float-right"><strong>R$ {{number_format($n_transactions_pix, 2, ",", ".")}}</strong></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
          
            <div class="col-lg-3 col-xs-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$lang["home_transactions_by_status"]}}</h4>
						<br>
                        <div class="row">
                            <div class="col col-xs-12 text-center">
                                <div id="chart-payment-div">

                                </div>
                            </div>
                        </div>
                        <br>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <small class="text-success">{{$lang["home_paid"]}}</small>
                                <small class="text-success float-right">{{$n_paid}}</small>
                            </li>
                            <li class="list-group-item">
                                <small class="text-yellow">{{$lang["home_waiting_payment"]}}</small>
                                <small class="text-yellow float-right">{{$n_pending}}</small>
                            </li>
                            <li class="list-group-item">
                                <small class="text-danger">{{$lang["home_defaulter"]}}</small>
                                <small class="text-danger float-right">{{$n_defaulter}}</small>
                            </li>
                        </ul>
                        
                        
                    </div>
                </div>
            </div>
        </div>
      
    <div class="row"> 
      <div class="col-lg-12">
        <div class="row"> 
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h4 class="font-weight-bolder text-gray"><i class="fad fa-undo-alt"></i> {{$lang["earning_log"]}}</h5>
                @if(count($history)>0)
                <canvas id="myChart" width="80%" height="50%"></canvas>
                @else
                  <div class="text-center mb-5 mt-8">
                    <div class="mb-3">
                      <img src="{{url('/')}}/asset/images/empty.svg">
                    </div>
                    <h3 class="text-dark">{{$lang["no_earning_history"]}}</h3>
                    <p class="text-dark text-sm card-text">{{$lang["we_couldnt_find_any_log_to_this_account"]}}</p>
                  </div>
                @endif
              </div>     
            </div>     
          </div>                  
          
          </div>



        </div> 
      </div>  
      

      </div>
    </div>
        
        
  <script src="{{url('/')}}/asset/js/amcharts/index.js"></script>
  <script src="{{url('/')}}/asset/js/amcharts/xy.js"></script>
  <script src="{{url('/')}}/asset/js/amcharts/Animated.js"></script>
  <script src="{{url('/')}}/asset/js/amcharts/pt_BR.js"></script>
  <script src="{{url('/')}}/asset/js/amcharts/percent.js"></script>
  
  <script>
am5.ready(function() {

    var root = am5.Root.new("chart-payment-div");

    root.setThemes([
      am5themes_Animated.new(root)
    ]);

    var chart = root.container.children.push(am5percent.PieChart.new(root, {
      innerRadius: 100,
      layout: root.verticalLayout
    }));

    var series = chart.series.push(am5percent.PieSeries.new(root, {
      valueField: "size",
      categoryField: "sector"
    }));

    series.data.setAll([
      { sector: "Paga", size: 75.8 },
      { sector: "Aguardando pagamento", size: 15.8 },
      { sector: "Inadimplente", size: 8.4 }
    ]);

    series.appear(1000, 100);
    
    
    series.get("colors").set("colors", [
        am5.color("#058d27"),
        am5.color("#058d27"),
        am5.color("#058d27"),
        am5.color("#058d27"),
        am5.color("#058d27")
    ]);

    // Add label
    var label = root.tooltipContainer.children.push(am5.Label.new(root, {
      x: am5.p50,
      y: am5.p50,
      centerX: am5.p50,
      centerY: am5.p50,
      fill: am5.color(0x000000),
      fontSize: 50
    }));


}); // end am5.ready()
</script>



@stop