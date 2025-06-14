@extends('userlayout')

@section('content')
<div class="container-fluid mt--6">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-white">
                    <!-- Card body -->
                    <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                        <!-- Title -->
                        <h5 class="h4 mb-0 font-weight-bolder">{{$val->ref_id}}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                          @if($val->receiver['id']==$user->id)
                          <p class="text-sm mb-0">{{$lang["transfer_received"]}}: {{$currency->symbol.number_format($val->amount)}}</p>
                          <p class="text-sm mb-0">{{$lang["transfer_from"]}}: {{$val->sender['email']}}</p>
                          @elseif($val->sender['id']==$user->id)
                          <p class="text-sm mb-0">{{$lang["transfer_sent"]}}: {{$currency->symbol.number_format($val->amount)}}</p>
                            @if($val->receiver['id']==null)
                            <p class="text-sm mb-0">{{$lang["transfer_to"]}}: {{$val->temp}}</p>
                            @else
                            <p class="text-sm mb-0">{{$lang["transfer_to"]}}: {{$val->receiver['email']}}</p>
                            @endif
                          @endif
                          <p class="text-sm mb-2">{{$lang["transfer_date"]}}: {{date("Y/m/d h:i:A", strtotime($val->created_at))}}</p>
                          @if($val->sender['id']==$user->id) 
                          <span class="badge badge-pill badge-primary">{{$lang["transfer_charge"]}}: {{$currency->symbol.number_format($val->charge)}} </span>
                          @endif
                          @if($val->status==1)
                            <span class="badge badge-pill badge-success"><i class="fa fa-check"></i> {{$lang["transfer_confirmed"]}}</span>
                          @elseif($val->status==0)
                            <span class="badge badge-pill badge-danger"><i class="fa fa-spinner"></i> {{$lang["transfer_pending"]}}</span>                        
                          @elseif($val->status==2)
                            <span class="badge badge-pill badge-info"><i class="fa fa-check"></i> {{$lang["transfer_returned"]}}</span>
                          @endif
                        </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div> 
      </div> 
    </div>
@stop