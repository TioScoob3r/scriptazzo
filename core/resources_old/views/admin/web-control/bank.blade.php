@extends('master')

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
    <a data-toggle="modal" data-target="#create" href="" class="btn btn-sm btn-neutral mb-5"><i class="fa fa-plus"></i> {{__('Add Bank')}}</a>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h3 class="card-title">{{$lang['admin_web_bank_bank_supported']}}</h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-basic">
                            <thead>
                                <tr>
                                    <th>{{$lang['admin_web_bank_sn']}}</th>
                                    <th>{{$lang['admin_web_bank_name']}}</th>
                                    <th>{{$lang['admin_web_bank_code']}}</th>
                                    <th>{{$lang['admin_web_bank_country']}}</th>
                                    <th>{{$lang['admin_web_bank_created']}}</th>
                                    <th>{{$lang['admin_web_bank_updated']}}</th>
                                    <th class="scope"></th>    
                                </tr>
                            </thead>
                            
                            <tbody>
                            @foreach($bank as $k=>$val)
                                <tr>
                                    <td>{{++$k}}.</td>
                                    <td>{{$val->name}}</td>
                                    <td>{{$val->code}}</td>
                                    <td>{{$val->creal['name']}}</td>
                                    <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                                    <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>
                                    <td class="text-center">
                                        <div class="text-right">
                                            <div class="dropdown">
                                                <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a data-toggle="modal" data-target="#delete{{$val->id}}" href="" class="dropdown-item">{{$lang['admin_web_bank_delete']}}</a>
                                                    <a data-toggle="modal" data-target="#update{{$val->id}}" href="" class="dropdown-item">{{$lang['admin_web_bank_edit']}}</a>
                                                </div>
                                            </div>
                                        </div> 
                                    </td>                     
                                </tr>
                                <div class="modal fade" id="delete{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                    <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body p-0">
                                                <div class="card bg-white border-0 mb-0">
                                                    <div class="card-header">
                                                        <h3 class="mb-0">{{$lang['admin_web_bank_are_you_sure_you_wanto_to_delete']}}</h3>
                                                    </div>
                                                    <div class="card-body px-lg-5 py-lg-5 text-right">
                                                        <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{$lang['admin_web_bank_close']}}</button>
                                                        <a  href="{{route('lbank.delete', ['id' => $val->id])}}" class="btn btn-danger btn-sm">{{$lang['admin_web_bank_proceed']}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 

                                @endforeach               
                            </tbody>                    
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @foreach($bank as $k=>$val)
        <div class="modal fade" id="update{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">   
                        <h3 class="mb-0 h3 font-weight-bolder">{{$lang['admin_web_bank_edit_bank']}}</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('lbank.update')}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <div class="col-lg-12">
                                <select class="form-control select" name="country" required>
                                    <option value="">{{$lang['admin_web_bank_select_country']}}</option>
                                    @if(count($country)>0) 
                                        @foreach($country as $xval)
                                        <option value="{{$xval->real['id']}}" @if($val->country_id==$xval->real['id']) selected @endif>{{$xval->real['name']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <input type="text" name="name" class="form-control" placeholder="{{$lang['admin_web_bank_name']}}" value="{{$val->name}}" required>
                                </div>
                            </div>                            
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <input type="text" name="code" class="form-control" maxlength="5" value="{{$val->code}}" placeholder="{{$lang['admin_web_bank_code']}}" required>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{$val->id}}">
                            <div class="text-right">
                                <button type="submit" class="btn btn-success btn-block">{{$lang['admin_web_bank_save']}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">   
                        <h3 class="mb-0 h3 font-weight-bolder">{{$lang['admin_web_bank_add_bank']}}</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{url('admin/createlbank')}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <input type="text" name="name" class="form-control" placeholder="{{$lang['admin_web_bank_name_2']}}" required>
                                </div>
                            </div>                            
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <input type="text" name="code" class="form-control" maxlength="5" placeholder="{{$lang['admin_web_bank_code_2']}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                <select class="form-control select" name="id" required>
                                    <option value="">{{$lang['admin_web_bank_select_country']}}</option>
                                    @if(count($country)>0) 
                                        @foreach($country as $val)
                                        <option value="{{$val->real['id']}}">{{$val->real['name']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                </div>
                            </div>
                            <div class="text-left">
                                <button type="submit" class="btn btn-success btn-block">{{$lang['admin_web_bank_save']}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@stop