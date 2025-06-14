@extends('master')

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">{{$lang["admin_merchant_merchants"]}}</h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead>
                                <tr>
                                    <th>{{$lang["admin_merchant_sn"]}}</th>
                                    <th>{{$lang["admin_merchant_business_name"]}}</th>
                                    <th>{{$lang["admin_merchant_name"]}}</th>
                                    <th>{{$lang["admin_merchant_received_amount_charges"]}}</th>
                                    <th>{{$lang["admin_merchant_merchant_id"]}}</th>
                                    <th>{{$lang["admin_merchant_created"]}}</th>
                                    <th>{{$lang["admin_merchant_updated"]}}</th>
                                    <th class="text-center">{{$lang["admin_merchant_action"]}}</th>    
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($merchant as $k=>$val)
                                @php
                                    $amount=App\Models\Exttransfer::wheremerchant_key($val->merchant_key)->sum('amount');
                                    $charge=App\Models\Exttransfer::wheremerchant_key($val->merchant_key)->sum('charge');
                                @endphp
                                <tr>
                                    <td>{{++$k}}.</td>  
                                    <td><a href="{{url('admin/manage-user')}}/{{$val->user->id}}">{{$val->user->business_name}}</a></td>
                                    <td>{{$val->name}}</td>
                                    <td>{{$currency->symbol.number_format($amount)}} / {{$currency->symbol.number_format($charge)}}</td>
                                    <td>{{$val->merchant_key}}</td> 
                                    <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                                    <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>
                                    <td class="text-center">
                                        <div class="">
                                            <div class="dropdown">
                                                <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="{{route('transfer.log', ['id' => $val->merchant_key])}}">{{$lang["admin_merchant_merchant_logs"]}}</a>
                                                    <a data-toggle="modal" data-target="#image{{$val->id}}" href="" class="dropdown-item">{{$lang["admin_merchant_image"]}}</a>
                                                    <a data-toggle="modal" data-target="#description{{$val->id}}" href="" class="dropdown-item">{{$lang["admin_merchant_description"]}}</a>
                                                    <a data-toggle="modal" data-target="#delete{{$val->id}}" href="" class="dropdown-item">{{$lang["admin_merchant_delete"]}}</a>
                                                </div>
                                            </div>
                                        </div> 
                                    </td>                  
                                </tr>
                                @endforeach               
                            </tbody>                    
                        </table>
                    </div>
                </div>
                @foreach($merchant as $k=>$val)
                <div class="modal fade" id="delete{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card bg-white border-0 mb-0">
                                    <div class="card-header">
                                        <h3 class="mb-0">{{$lang["admin_merchant_are_you_sure_you_want"]}}</h3>
                                    </div>
                                    <div class="card-body px-lg-5 py-lg-5 text-right">
                                        <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{$lang["admin_merchant_close"]}}</button>
                                        <a  href="{{route('merchant.delete', ['id' => $val->id])}}" class="btn btn-danger btn-sm">{{$lang["admin_merchant_proceed"]}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="description{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card bg-white border-0 mb-0">
                                    <div class="card-body">
                                        <p class="mb-0 text-sm">{{$val->description}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                                
                <div class="modal fade" id="image{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card bg-white border-0 mb-0">
                                    <img class="card-img-top" src="{{url('/')}}/asset/profile/{{$val->image}}" alt="Image placeholder">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@stop