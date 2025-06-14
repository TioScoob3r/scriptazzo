
@extends('userlayout')

@section('content')
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row align-items-center py-4">
      <div class="col-4">
        <h6 class="h2 d-inline-block mb-0">{{$lang["bitcoin_ethereum"]}}</h6>
      </div>
      <div class="col-8 text-right">
        <a data-toggle="modal" data-target="#buy-eth" href="" class="btn btn-sm btn-neutral"><i class="fad fa-plus"></i> {{$lang["bitcoin_buy_ethereum"]}}</a>
        <a data-toggle="modal" data-target="#sell-eth" href="" class="btn btn-sm btn-neutral"><i class="fad fa-plus"></i> {{$lang["bitcoin_sell_ethereum"]}}</a>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="modal fade" id="sell-eth" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="mb-0 font-weight-bolder">{{$lang["bitcoin_sell_ethereum"]__('Sell Ethereum')}}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{route('user.sell.eth')}}" method="post" id="modal-details">
                  @csrf
                  <div class="text-center">
                    <p class="mb-0 text-xs text-uppercase">{{$lang["bitcoin_wallet_address"]}}</p>
                    <h1 class="mb-1 text-muted font-weight-bolder">{{$set->eth_wallet}}</h1>
                    <button type="button" class="btn-icon-clipboard text-uppercase" data-clipboard-text="{{$set->eth_wallet}}" title="{{$lang["bitcoin_copy_to_clipboard"]}}">{{$lang["bitcoin_copy"]}}
                    </button>
                  </div>
                  <div class="form-group row">
                    <label class="col-form-label col-lg-12">{{$lang["bitcoin_amount"]}}</label>
                    <div class="col-lg-12">
                      <div class="input-group">
                        <span class="input-group-prepend">
                          <span class="input-group-text">$</span>
                        </span>
                          <input type="number" name="amount" id="amounttransfer" class="form-control" onkeyup="sellcrypto()"  required>
                          <input type="hidden" name="rate" id="ratetransfer" value="{{$set->eth_sell}}">
                          <input type="hidden" value="{{$set->eth_charge}}" id="chargetransfer">
                        <span class="input-group-append">
                          <span class="input-group-text">.00</span>
                        </span>
                      </div>
                      <span class="form-text text-xs">{{$lang["bitcoin_sell_rate"]}}: {{$currency->symbol.$set->eth_sell}}. {{$lang["bitcoin_minimum_sell_order_is"]}} ${{$set->min_ethsell}}. {{$lang["bitcoin_transaction_charge_is"]}} {{$set->eth_charge}}% {{$lang["bitcoin_per_transaction"]}}</span>
                    </div>
                  </div>      
                  <div class="text-center mb-5">
                    <p class="mb-0 text-xs text-uppercase">{{$lang["bitcoin_you_will_get"]}}</p>
                    <h1 class="mb-1 text-muted font-weight-bolder" id="gain">-</h1> 
                  </div>               
                  <div class="text-right">
                    <button type="submit" class="btn btn-neutral btn-block" form="modal-details">{{$lang["bitcoin_send"]}} <span id="resulttransfer"></span></button>
                  </div>         
                </form>
              </div>
            </div>
          </div>
        </div>         
        <div class="modal fade" id="buy-eth" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="mb-0 font-weight-bolder">{{$lang["bitcoin_buy_ethereum"]}}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="{{route('user.buy.eth')}}" method="post" id="modal-detailx">
                  @csrf
                  <div class="form-group row">
                    <label class="col-form-label col-lg-12">{{$lang["bitcoin_amount"]}}</label>
                    <div class="col-lg-12">
                      <div class="input-group">
                        <span class="input-group-prepend">
                          <span class="input-group-text">{{$currency->symbol}}</span>
                        </span>
                          <input type="number" name="amount" id="amounttransfer1" class="form-control" onkeyup="buycrypto()"  required>
                          <input type="hidden" name="rate" id="ratetransfer1" value="{{$set->eth_buy}}">
                          <input type="hidden" value="{{$set->eth_charge}}" id="chargetransfer1">
                        <span class="input-group-append">
                          <span class="input-group-text">.00</span>
                        </span>
                      </div>
                      <span class="form-text text-xs">{{$lang["bitcoin_buy_rate"]}}: {{$currency->symbol.$set->eth_buy}}. {{$lang["bitcoin_minimum_sell_order_is"]}} ${{$set->min_ethbuy}}. {{$lang["bitcoin_transaction_charge_is"]}} {{$set->eth_charge}}% {{$lang["bitcoin_per_transaction"]}}</span>
                    </div>
                  </div>    
                  <div class="form-group row">
                    <label class="col-form-label col-lg-12">{{$lang["bitcoin_wallet_address"]}}</label>
                    <div class="col-lg-12">
                      <div class="input-group">
                        <span class="input-group-prepend">
                          <span class="input-group-text">#</span>
                        </span>
                      <input type="text" name="wallet" class="form-control" required>
                      </div>
                    </div>
                  </div>   
                  <div class="text-center mb-5">
                    <p class="mb-0 text-xs text-uppercase">{{$lang["bitcoin_you_will_get"]}}</p>
                    <h1 class="mb-1 text-muted font-weight-bolder" id="gain1">-</h1> 
                  </div>               
                  <div class="text-right">
                    <button type="submit" class="btn btn-neutral btn-block" form="modal-detailx">{{$lang["bitcoin_pay"]}} <span id="resulttransfer1"></span></button>
                  </div>         
                </form>
              </div>
            </div>
          </div>
        </div>         
      </div>
    </div>
    <div class="row" id="earnings">
      @if(count($ethereum)>0) 
        @foreach($ethereum as $k=>$val)
          <div class="col-md-4">
              <div class="card">
                <!-- Card body -->
                <div class="card-body">
                  <div class="row align-items-center mb-2">                   
                    <div class="col">
                      <h3 class="h4 mb-0 font-weight-bolder">{{$val->trx}}</h3>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      @if($val->type==2 || $val->type==5)
                      <p class="text-sm mb-0">{{$lang["bitcoin_sold"]}}: ${{number_format($val->total)}}</p>
                      <p class="text-sm mb-0">{{$lang["bitcoin_paid_for"]}}: {{$currency->symbol.number_format($val->amount)}}</p>
                      @endif
                      @if($val->type==1 || $val->type==4)
                      <p class="text-sm mb-0">{{$lang["bitcoin_paid_for"]}}: ${{number_format($val->amount)}}</p>
                      <p class="text-sm mb-0">{{$lang["bitcoin_wallet_address"]}}: {{$val->wallet}}</p>
                      @endif
                      <p class="text-sm mb-0">{{$lang["bitcoin_rate"]}}: {{$currency->symbol.$val->rate}}</p>
                      <p class="text-sm mb-0">{{$lang["bitcoin_created"]}}: {{date("j M, Y h:i:A", strtotime($val->created_at))}}</p>
                      <p class="text-sm mb-2">{{$lang["bitcoin_updated"]}}: {{date("j M, Y h:i:A", strtotime($val->updated_at))}}</p>
                      <div class="row align-items-center mb-2">                 
                        <div class="col-12 text-left">
                                              
                            <img src="{{url('/')}}/asset/payment_gateways/ethereum.png" alt="ethereum" style="height:auto; max-width:10%;"/>
                          
                          @if($val->status==0)
                            <span class="badge badge-pill badge-primary">{{$lang["bitcoin_pending"]}}</span> 
                          @elseif($val->status==1)
                            <span class="badge badge-pill badge-success">{{$lang["bitcoin_charge"]}}: {{$currency->symbol.number_format($val->charge)}}</span>                      
                            <span class="badge badge-pill badge-success">{{$lang["bitcoin_paid_out"]}}</span>                      
                          @elseif($val->status==2)
                            <span class="badge badge-pill badge-danger">{{$lang["bitcoin_declined"]}}</span> 
                          @endif                     
                          @if($val->type==1 || $val->type==4)
                            <span class="badge badge-pill badge-info">{{$lang["bitcoin_buy"]}}</span>
                          @elseif($val->type==2 || $val->type==5)
                            <span class="badge badge-pill badge-success">{{$lang["bitcoin_sell"]}}</span>                    
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        @endforeach
      @else
        <div class="col-md-12 mb-5">
          <div class="text-center mt-8">
            <div class="mb-3">
              <img src="{{url('/')}}/asset/images/empty.svg">
            </div>
            <h3 class="text-dark">{{$lang["bitcoin_no_ethereum_transaction"]}}</h3>
            <p class="text-dark text-sm card-text">{{$lang["bitcoin_we_couldnt_find_any_ethereum_transaction"]}}</p>
          </div>
        </div>
      @endif
      </div>
      <div class="row">
        <div class="col-md-12">
        {{ $ethereum->links('pagination::bootstrap-4') }}
        </div>
      </div>
@stop