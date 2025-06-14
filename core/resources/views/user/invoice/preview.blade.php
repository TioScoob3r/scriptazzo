@extends('paymentlayout')

@section('content')
<div class="main-content">
    <!-- Header -->
    <div class="header py-7 py-lg-6 pt-lg-1">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
            </div>
          </div>
        </div>
      </div>
    </div>
  <div class="container mt--8 pb-5 mb-0">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <!-- Card body -->
          <div class="card-body">
            <div class="row justify-content-between align-items-center">
              <div class="col-auto">
                <span class="text-muted text-uppercase">{{$lang["invoice_no"]}} #{{$invoice->invoice_no}}</span>
              </div>
            </div>
            <div class="row justify-content-between align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle">{{$lang["invoice_from"]}} {{$invoice->user->email}}</span><br>
                  <span class="surtitle ">{{$lang["invoice_to"]}} {{$invoice->email}}</span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle ">{{$lang["invoice_due_date"]}} {{$invoice->due_date}}</span>
                </div>
              </div>
            </div>
            <div class="row justify-content-between align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle ">{{$lang["invoice_item"]}}</span><br>
                  <span class="surtitle ">{{$lang["invoice_quantity"]}}</span><br>
                  <span class="surtitle ">{{$lang["invoice_amount"]}}</span><br>
                  @if($invoice->notes!=null)
                  <span class="surtitle ">{{$lang["invoice_notes"]}}</span>
                  @endif
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle ">{{$invoice->item}}</span><br>
                  <span class="surtitle ">{{$invoice->quantity}}</span><br>
                  <span class="surtitle ">{{$currency->symbol.$invoice->amount}}</span><br>
                  @if($invoice->notes!=null)
                  <span class="surtitle ">{{$invoice->notes}}</span>
                  @endif
                </div>
              </div>
            </div>
            <hr>
            <div class="row justify-content-between align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle ">{{$lang["invoice_subtotal"]}}</span><br>
                  <span class="surtitle ">{{$lang["invoice_discount"]}}</span></br>
                  <span class="surtitle ">{{$lang["invoice_tax"]}}</span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle ">{{$currency->symbol.number_format($invoice->amount*$invoice->quantity)}}</span><br>
                  <span class="surtitle ">- {{$currency->symbol.number_format($invoice->amount*$invoice->quantity*$invoice->discount/100)}} ({{$invoice->discount}}%)</span><br>
                  <span class="surtitle ">+ {{$currency->symbol}}{{($invoice->amount*$invoice->quantity*$invoice->tax/100)}} ({{$invoice->tax}}%)</span>
                </div>
              </div>
            </div>
            <hr>
            <div class="row justify-content-between align-items-center">
              <div class="col">
                <div class="my-4">
                  <span class="surtitle">{{$lang["invoice_total"]}}</span>
                </div>
              </div>
              <div class="col-auto">
                <div class="my-4">
                  <span class="surtitle ">{{$currency->symbol.number_format($invoice->total)}}</span>
                </div>
              </div>
            </div>
            <form action="{{route('submit.preview')}}" method="post">
              @csrf
              <input type="hidden" name="id" value="{{$invoice->id}}">                                                         
              <div class="text-left">
                <button type="submit" class="btn btn-neutral btn-sm">{{$lang["invoice_send_invoice"]}}</a>
              </div>         
            </form>
          </div>
        </div>
      </div>
    </div>
@stop