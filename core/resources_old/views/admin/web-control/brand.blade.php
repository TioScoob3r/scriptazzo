@extends('master')

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="">
                <div class="card-body">
                <a data-toggle="modal" data-target="#create" href="" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> {{$lang['admin_web_brand_create_brand']}}</a>
                </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">{{$lang['admin_web_brand_title']}}</h3>
                    </div>
                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead>
                                <tr>
                                    <th>{{$lang['admin_web_brand_sn']}}</th>
                                    <th>{{$lang['admin_web_brand_title_2']}}</th>
                                    <th>{{$lang['admin_web_brand_status']}}</th>
                                    <th>{{$lang['admin_web_brand_created']}}</th>
                                    <th>{{$lang['admin_web_brand_updated']}}</th>
                                    <th class="text-center">{{$lang['admin_web_brand_action']}}</th>    
                                </tr>
                            </thead>
                            
                            <tbody>
                            @foreach($brand as $k=>$val)
                                <tr>
                                    <td>{{++$k}}.</td>
                                    <td>{{$val->title}}</td>
                                    <td>
                                        @if($val->status==1)
                                            <span class="badge badge-success">{{$lang['admin_web_brand_published']}}</span>
                                        @else
                                            <span class="badge badge-danger">{{$lang['admin_web_brand_pending']}}</span>
                                        @endif
                                    </td>  
                                    <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                                    <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>
                                    <td class="text-center">
                                        <div class="">
                                            <div class="dropdown">
                                                <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a data-toggle="modal" data-target="#delete{{$val->id}}" href="" class="dropdown-item">{{$lang['admin_web_brand_delete']}}</a>
                                                    @if($val->status==1)
                                                        <a class='dropdown-item' href="{{route('brand.unpublish', ['id' => $val->id])}}">{{$lang['admin_web_brand_unpublish']}}</a>
                                                    @else
                                                        <a class='dropdown-item' href="{{route('brand.publish', ['id' => $val->id])}}">{{$lang['admin_web_brand_publish']}}</a>
                                                    @endif
                                                    <a  href="{{route('brand.edit', ['id' => $val->id])}}" class="dropdown-item">{{$lang['admin_web_brand_edit']}}</a>
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
                                                        <h3 class="mb-0">{{$lang['admin_web_brand_are_you_sure_you_want_to_delete']}}</h3>
                                                    </div>
                                                    <div class="card-body px-lg-5 py-lg-5 text-right">
                                                        <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{$lang['admin_web_brand_close']}}</button>
                                                        <a  href="{{route('brand.delete', ['id' => $val->id])}}" class="btn btn-danger btn-sm">{{$lang['admin_web_brand_proceed']}}</a>
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
    </div>
</div>
    <div id="create" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">   
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="{{url('admin/createbrand')}}" enctype="multipart/form-data" method="post">
                @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <input type="text" name="title" class="form-control" placeholder="{{$lang['admin_web_brand_close_3']}}" required>
                            </div>
                        </div> 
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFileLang2" name="image" lang="en" required>
                                <label class="custom-file-label" for="customFileLang2">{{$lang['admin_web_brand_choose_media']}}</label>
                            </div>
                        </div>                 
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-success">{{$lang['admin_web_brand_save']}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop