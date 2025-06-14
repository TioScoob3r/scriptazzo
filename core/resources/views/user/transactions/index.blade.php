
@extends('userlayout')

@section('content')
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-wrapper">
                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 @if(route('user.transactions')==url()->current()) active @endif" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fad fa-link"></i> {{$lang["transaction_single_charge"]}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 @if(route('user.invoicelog')==url()->current()) active @endif" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="fad fa-envelope"></i> {{$lang["transaction_invoice"]}}</a>
                        </li>        
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 @if(route('user.depositlog')==url()->current()) active @endif" id="tabs-icons-text-4-tab" data-toggle="tab" href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-4" aria-selected="false"><i class="fad fa-arrow-up"></i> {{$lang["transaction_deposit"]}}</a>
                        </li>                
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 @if(route('user.banktransfer')==url()->current()) active @endif" id="tabs-icons-text-5-tab" data-toggle="tab" href="#tabs-icons-text-5" role="tab" aria-controls="tabs-icons-text-5" aria-selected="false"><i class="fad fa-share"></i> {{$lang["transaction_bank_transfer_deposit"]}}</a>
                        </li>                     
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 @if(route('user.senderlog')==url()->current()) active @endif" id="tabs-icons-text-6-tab" data-toggle="tab" href="#tabs-icons-text-6" role="tab" aria-controls="tabs-icons-text-6" aria-selected="false"><i class="fad fa-laptop"></i> {{$lang["transaction_website_checkout"]}}</a>
                        </li>   
                        
                        <?php /* 
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 @if(route('user.mysub')==url()->current()) active @endif" id="tabs-icons-text-7-tab" data-toggle="tab" href="#tabs-icons-text-7" role="tab" aria-controls="tabs-icons-text-7" aria-selected="false"><i class="fad fa-user"></i> {{$lang["transaction_your_subscriptions"]}}</a>
                        </li>
                        */ ?>        
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade @if(route('user.transactions')==url()->current())show active @endif" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                <div class="card">
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                        <thead>
                            <tr>
                            <th>{{$lang["transaction_sn"]}}</th>
                            <th>{{$lang["transaction_reference_id"]}}</th>
                            <th>{{$lang["transaction_name"]}}</th>
                            <th>{{$lang["transaction_from"]}}</th>
                            <th>{{$lang["transaction_type"]}}</th>
                            <th>{{$lang["transaction_status"]}}</th>
                            <th>{{$lang["transaction_amount"]}}</th>
                            <th class="text-center">{{$lang["transaction_charge"]}}</th>
                            <th>{{$lang["transaction_charge"]}}</th>
                            <th>{{$lang["transaction_updated"]}}</th>
                            </tr>
                        </thead>
                        <tbody>  
                            @foreach($single as $k=>$val)
                            <tr>
                                <td>{{++$k}}.</td>
                                <td>{{$val->ref_id}}</td>
                                <td>{{$val->ddlink['name']}}</td>
                                <td>@if($val->sender_id!=null) {{$val->sender->first_name.' '.$val->sender->last_name}} [{{$val->sender->email}}] @else {{$val->first_name.' '.$val->last_name}} [{{$val->email}}] @endif</td>
                                <td>@if($val->sender_id==$user->id) {{$lang["transaction_debit"]}} @else {{$lang["transaction_credit"]}} @endif</td>
                                <td>@if($val->status==0) <span class="badge badge-pill badge-danger"><i class="fad fa-ban"></i> {{$lang["transaction_failed"]}} - {{$val->payment_type}}</span> @elseif($val->status==1) <span class="badge badge-pill badge-success"><i class="fad fa-check"></i> {{$lang["transaction_paid"]}}] - {{$val->payment_type}}</span> @elseif($val->status==2) {{$lang["transaction_refunded"]}} @endif</td>
                                <td>@if($val->sender_id==$user->id) {{$currency->symbol.number_format($val->amount+$val->charge, 2, ',', '.')}} @else {{$currency->symbol.number_format($val->amount, 2, ',', '.')}} @endif</td>
                                <td class="text-center">@if($val->sender_id==$user->id || $val->charge==null) - @else {{$currency->symbol.number_format($val->charge, 2, ',', '.')}} @endif</td>
                                <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                                <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>           
            <div class="tab-pane fade @if(route('user.transactionsd')==url()->current())show active @endif" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                <div class="card">
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons1">
                            <thead>
                            <tr>
                                <th>{{$lang["transaction_sn"]}}</th>
                                <th>{{$lang["transaction_reference_id"]}}</th>
                                <th>{{$lang["transaction_name"]}}</th>
                                <th>{{$lang["transaction_from"]}}</th>
                                <th>{{$lang["transaction_type"]}}</th>
                                <th>{{$lang["transaction_status"]}}</th>
                                <th>{{$lang["transaction_amount"]}}</th>
                                <th class="text-center">{{$lang["transaction_amount"]}}</th>
                                <th>{{$lang["transaction_created"]}}</th>
                                <th>{{$lang["transaction_created"]}}</th>
                                </tr>
                            </thead>
                            <tbody>  
                                @foreach($donation as $k=>$val)
                                <tr>
                                    <td>{{++$k}}.</td>
                                    <td>{{$val->ref_id}}</td>
                                    <td>{{$val->ddlink['name']}}</td>
                                    <td>@if($val->sender_id!=null) {{$val->sender->first_name.' '.$val->sender->last_name}} [{{$val->sender->email}}] @else {{$val->first_name.' '.$val->last_name}} [{{$val->email}}] @endif</td>
                                    <td>@if($val->sender_id==$user->id) {{$lang["transaction_debit"]}} @else {{$lang["transaction_credit"]}} @endif</td>
                                    <td>@if($val->status==0) <span class="badge badge-pill badge-danger"><i class="fad fa-ban"></i> {{$lang["transaction_failed"]}} - {{$val->payment_type}}</span> @elseif($val->status==1) <span class="badge badge-pill badge-success"><i class="fad fa-check"></i> {{$lang["transaction_paid"]}} - {{$val->payment_type}}</span> @elseif($val->status==2) {{$lang["transaction_refunded"]}}] @endif</td>
                                    <td>@if($val->sender_id==$user->id) {{$currency->symbol.number_format($val->amount+$val->charge, 2, ',', '.')}} @else {{$currency->symbol.number_format($val->amount, 2, ',', '.')}} @endif</td>
                                    <td class="text-center">@if($val->sender_id==$user->id || $val->charge==null) - @else {{$currency->symbol.number_format($val->charge, 2, ',', '.')}} @endif</td>
                                    <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                                    <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>            
                </div>            
            <div class="tab-pane fade @if(route('user.invoicelog')==url()->current())show active @endif" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                <div class="card">
                    <div class="table-responsive py-4">
                            <table class="table table-flush" id="datatable-buttons2">
                            <thead>
                                <tr>
                                <th>{{$lang["transaction_sn"]}}</th>
                                <th>{{$lang["transaction_sn"]}}</th>
                                <th>{{$lang["transaction_name"]}}</th>
                                <th>{{$lang["transaction_from"]}}</th>
                                <th>{{$lang["transaction_type"]}}</th>
                                <th>{{$lang["transaction_status"]}}</th>
                                <th>{{$lang["transaction_amount"]}}</th>
                                <th class="text-center">{{$lang["transaction_charge"]}}</th>
                                <th>{{$lang["transaction_created"]}}</th>
                                <th>{{$lang["transaction_updated"]}}</th>
                                </tr>
                            </thead>
                            <tbody>  
                                @foreach($invoice as $k=>$val)
                                <tr>
                                    <td>{{++$k}}.</td>
                                    <td>{{$val->ref_id}}</td>
                                    <td>{{$val->inplan['item']}}</td>
                                    <td>@if($val->sender_id!=null) {{$val->sender->first_name.' '.$val->sender->last_name}} [{{$val->sender->email}}] @else {{$val->first_name.' '.$val->last_name}} [{{$val->email}}] @endif</td>
                                    <td>@if($val->sender_id==$user->id) {{$lang["transaction_debit"]}} @else {{$lang["transaction_credit"]}} @endif</td>
                                    <td>@if($val->status==0) <span class="badge badge-pill badge-danger"><i class="fad fa-ban"></i> {{$lang["transaction_failed"]}} - {{$val->payment_type}}</span> @elseif($val->status==1) <span class="badge badge-pill badge-success"><i class="fad fa-check"></i> {{$lang["transaction_paid"]}} - {{$val->payment_type}}</span> @elseif($val->status==2) {{$lang["transaction_refunded"]}} @endif</td>
                                    <td>@if($val->sender_id==$user->id) {{$currency->symbol.number_format($val->amount+$val->charge, 2, ',', '.')}} @else {{$currency->symbol.number_format($val->amount, 2, ',', '.')}} @endif</td>
                                    <td class="text-center">@if($val->sender_id==$user->id || $val->charge==null) - @else {{$currency->symbol.number_format($val->charge, 2, ',', '.')}} @endif</td>
                                    <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                                    <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>            
                </div>            
            <div class="tab-pane fade @if(route('user.depositlog')==url()->current())show active @endif" id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-4-tab">
                <div class="card">
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons3">
                            <thead class="">
                                <tr>
                                <th>{{$lang["transaction_sn"]}}</th>
                                <th>{{$lang["transaction_reference_id"]}}</th>
                                <th>{{$lang["transaction_status"]}}</th>
                                <th>{{$lang["transaction_amount"]}}</th>
                                <th>{{$lang["transaction_charge"]}}</th>
                                <th>{{$lang["transaction_created"]}}</th>
                                <th>{{$lang["transaction_updated"]}}</th>
                                </tr>
                            </thead>
                            <tbody>  
                                @foreach($deposits as $k=>$val)
                                <tr>
                                    <td>{{++$k}}.</td>
                                    <td>{{$val->trx}}</td>
                                    <td>
                                        @if($val->status==0) 
                                            <span class="badge badge-pill badge-danger">
                                                <i class="fad fa-ban"></i>  
                                                {{$lang["transaction_failed"]}} - {{(isset($val->gateway['name']) ? $val->gateway['name'] : "")}}
                                            </span> 
                                        @elseif($val->status==1) 
                                            <span class="badge badge-pill badge-success">
                                                <i class="fad fa-check"></i> 
                                                {{$lang["transaction_successful"]}} - {{(isset($val->gateway['name']) ? $val->gateway['name'] : "")}}
                                            </span> 
                                        @elseif($val->status==2) 
                                            {{$lang["transaction_refunded"]}} - {{(isset($val->gateway['name']) ? $val->gateway['name'] : "")}} @endif
                                    </td>
                                    <td>{{$currency->symbol.number_format($val->amount-$val->charge, 2, ',', '.')}}</td>
                                    <td>{{$currency->symbol.number_format($val->charge, 2, ',', '.')}}</td>
                                    <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                                    <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>            
            <div class="tab-pane fade @if(route('user.banktransfer')==url()->current())show active @endif" id="tabs-icons-text-5" role="tabpanel" aria-labelledby="tabs-icons-text-5-tab">
                <div class="card">
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons4">
                        <thead class="">
                            <tr>
                                <th>{{$lang["transaction_sn"]}}</th>
                                <th>{{$lang["transaction_reference_id"]}}</th>
                                <th>{{$lang["transaction_amount"]}}</th>
                                <th>{{$lang["transaction_status"]}}</th>
                                <th>{{$lang["transaction_status"]}}</th>
                                <th>{{$lang["transaction_updated"]}}</th>
                            </tr>
                            </thead>
                            <tbody>  
                            @foreach($bank_transfer as $k=>$val)
                            <tr>
                                <td>{{++$k}}.</td>
                                <td>#{{$val->trx}}</td>
                                <td>{{$currency->symbol.number_format($val->amount, 2, ',', '.')}}</td>
                                <td>@if($val->status==0) <span class="badge badge-pill badge-danger"><i class="fad fa-spinner"></i> {{$lang["transaction_pending"]}}</span> @elseif($val->status==1) <span class="badge badge-pill badge-success"><i class="fad fa-check"></i> {{$lang["transaction_successful"]}}</span> @elseif($val->status==2) {{$lang["transaction_declined"]}} @endif</td>
                                <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                                <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>            
            <div class="tab-pane fade @if(route('user.senderlog')==url()->current())show active @endif" id="tabs-icons-text-6" role="tabpanel" aria-labelledby="tabs-icons-text-6-tab">
                <div class="card">
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons5">
                        <thead>
                            <tr>
                            <th>{{$lang["transaction_sn"]}}</th>
                            <th>{{$lang["transaction_reference_id"]}}</th>
                            <th>{{$lang["transaction_name"]}}</th>
                            <th>{{$lang["transaction_from"]}}</th>
                            <th>{{$lang["transaction_type"]}}</th>
                            <th>{{$lang["transaction_status"]}}</th>
                            <th>{{$lang["transaction_amount"]}}</th>
                            <th class="text-center">{{$lang["transaction_charge"]}}</th>
                            <th>{{$lang["transaction_created"]}}</th>
                            <th>{{$lang["transaction_updated"]}}</th>
                            </tr>
                        </thead>
                        <tbody>  
                            @foreach($ext as $k=>$val)
                            @php
                                $fff=App\Models\Merchant::wheremerchant_key($val->merchant_key)->first();
                            @endphp
                            <tr>
                                <td>{{++$k}}.</td>
                                <td>{{$val->reference}}</td>
                                <td>{{$fff->name}}</td>
                                <td>@if($val->user_id!=null) {{$val->sender->first_name.' '.$val->sender->last_name}} [{{$val->sender->email}}] @else {{$val->first_name.' '.$val->last_name}} [{{$val->email}}] @endif</td>
                                <td>@if($val->sender_id==$user->id) {{$lang["transaction_debit"]}} @else {{$lang["transaction_credit"]}} @endif</td>
                                <td>@if($val->status==0) <span class="badge badge-pill badge-danger"><i class="fad fa-ban"></i> {{$lang["transaction_failed"]}} - {{$val->payment_type}}</span> @elseif($val->status==1) <span class="badge badge-pill badge-success"><i class="fad fa-check"></i> {{$lang["transaction_paid"]}} - {{$val->payment_type}}</span> @elseif($val->status==2) {{$lang["transaction_refunded"]}} @endif</td>
                                <td>@if($val->sender_id==$user->id) {{$currency->symbol.number_format($val->amount+$val->charge, 2, ',', '.')}} @else {{$currency->symbol.number_format($val->amount, 2, ',', '.')}} @endif</td>
                                <td class="text-center">@if($val->sender_id==$user->id || $val->charge==null) - @else {{$currency->symbol.number_format($val->charge, 2, ',', '.')}} @endif</td>
                                <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                                <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>            
            <div class="tab-pane fade @if(route('user.mysub')==url()->current())show active @endif" id="tabs-icons-text-7" role="tabpanel" aria-labelledby="tabs-icons-text-7-tab">
                <div class="card">
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons6">
                            <thead>
                                <tr>
                                <th>{{$lang["transaction_sn"]}}</th>
                                <th>{{$lang["transaction_name"]}}</th>
                                <th>{{$lang["transaction_amount"]}}</th>
                                <th>{{$lang["transaction_amount"]}}</th>
                                <th>{{$lang["transaction_reference_id"]}}</th>
                                <th>{{$lang["transaction_expiring_date"]}}</th>
                                <th>{{$lang["transaction_renewal"]}}</th>
                                <th>{{$lang["transaction_created"]}}</th>
                                </tr>
                            </thead>
                            <tbody>  
                                @foreach($sub as $k=>$val)
                                <tr>
                                    <td>{{++$k}}.</td>
                                    <td>{{$val->user['first_name']}} {{$val->user['last_name']}}</td>
                                    <td>@if($val->plan['amount']==null){{$currency->symbol.$val->amount}} @else {{$currency->symbol.$val->plan['amount']}} @endif</td>
                                    <td>{{$val->plan['name']}}</td>
                                    <td>#{{$val->ref_id}}</td>
                                    <td>{{date("Y/m/d h:i:A", strtotime($val->expiring_date))}}</td>
                                    <td>@if($val->times>0 && $val->status==1) {{$lang["transaction_yes"]}} @else {{$lang["transaction_no"]}} @endif</td>
                                    <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

@stop