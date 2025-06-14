@extends('master')
    @section('content')
        <div class="container-fluid mt--6">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="">
                        <div class="card-body">
                        <a href="{{route('blog.create')}}" class="btn btn-sm btn-neutral"><i class="fa fa-plus"></i> {{$lang["admin_blog_index_create_article"]}}</a>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="mb-0 h3 font-weight-bolder">{{$lang["admin_blog_index_posts"]}}</h3>
                            </div>
                            <div class="table-responsive py-4">
                                <table class="table table-flush" id="datatable-buttons">
                                    <thead>
                                        <tr>
                                            <th>{{$lang["admin_blog_index_sn"]}}</th>
                                            <th>{{$lang["admin_blog_index_title"]}}</th>
                                            <th>{{$lang["admin_blog_index_category"]}}</th>
                                            <th>{{$lang["admin_blog_index_views"]}}</th>
                                            <th>{{$lang["admin_blog_index_status"]}}</th>
                                            <th>{{$lang["admin_blog_index_created"]}}</th>
                                            <th>{{$lang["admin_blog_index_updated"]}}</th>
                                            <th class="text-center">{{$lang["admin_blog_index_action"]}}</th>    
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($blog as $k=>$val)
                                        <tr>
                                            <td>{{++$k}}.</td>                                   
                                            <td>{{$val->title}}</td>
                                            <td>{{$val->category['categories']}}</td>
                                            <td>{{$val->views}}</td>
                                            <td>
                                                @if($val->status==1)
                                                    <span class="badge badge-success">{{$lang["admin_blog_index_published"]}}</span>
                                                @else
                                                    <span class="badge badge-danger">{{$lang["admin_blog_index_pending"]}}</span>
                                                @endif
                                            </td>   
                                            <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                                            <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>
                                            <td class="text-center">
                                                <div class="text-right">
                                                    <div class="dropdown">
                                                        <a class="text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                            <a data-toggle="modal" data-target="#delete{{$val->id}}" href="" class="dropdown-item">{{$lang["admin_blog_index_delete"]}}</a>
                                                            @if($val->status==1)
                                                                <a class='dropdown-item' href="{{route('blog.unpublish', ['id' => $val->id])}}">{{$lang["admin_blog_index_unpublish"]}}</a>
                                                            @else
                                                                <a class='dropdown-item' href="{{route('blog.publish', ['id' => $val->id])}}">{{$lang["admin_blog_index_publish"]}}</a>
                                                            @endif
                                                            <a href="{{route('blog.edit', ['id' => $val->id])}}" class="dropdown-item">{{$lang["admin_blog_index_edit"]}}</a>
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
                        @foreach($blog as $k=>$val)
                            <div class="modal fade" id="delete{{$val->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <div class="card bg-white border-0 mb-0">
                                                <div class="card-header">
                                                    <h3 class="mb-0">{{$lang["admin_blog_index_are_you_sure"]}}</h3>
                                                </div>
                                                <div class="card-body px-lg-5 py-lg-5 text-right">
                                                    <button type="button" class="btn btn-neutral btn-sm" data-dismiss="modal">{{$lang["admin_blog_index_close"]}}</button>
                                                    <a  href="{{route('blog.delete', ['id' => $val->id])}}" class="btn btn-danger btn-sm">{{$lang["admin_blog_index_proceed"]}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
@stop