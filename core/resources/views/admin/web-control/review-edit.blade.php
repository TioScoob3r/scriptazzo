@extends('master')

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <h3 class="mb-0">{{$lang['admin_web_review_edit_title']}}</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-danger"></p>
                        <form action="{{route('review.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{$lang['admin_web_review_edit_name']}}:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="name" class="form-control" value="{{$val->name}}">
                                    <input type="hidden" name="id" value="{{$val->id}}">
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{$lang['admin_web_review_edit_occupation']}}:</label>
                                <div class="col-lg-10">
                                    <input type="text" name="occupation" class="form-control" value="{{$val->occupation}}">
                                </div>
                            </div>                         
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{$lang['admin_web_review_edit_review']}}:</label>
                                <div class="col-lg-10">
                                    <textarea type="text" name="review" rows="5" class="form-control">{{$val->review}}</textarea>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{$lang['admin_web_review_edit_image']}}:</label>
                                <div class="col-lg-10">
                                    <input type="file" class="custom-file-input" id="customFileLang" name="update" lang="en">
                                    <label class="custom-file-label" for="customFileLang" style="border-color: {{$set->s_c}};">{{$lang['admin_web_review_edit_choose_media']}}</label>
                                </div>
                            </div>           
                            <div class="text-right">
                                <button type="submit" class="btn btn-success btn-sm">{{$lang['admin_web_review_edit_save']}}</button>
                            </div>
                        </form>
                    </div>
                </div> 
            </div>
            <div class="col-md-4">
                <div class="card-body text-center">
                    <div class="card-img-actions d-inline-block mb-3">
                        <img class="img-fluid" src="{{url('/')}}/asset/review/{{$val->image_link}}" alt="">
                    </div>
                </div>
            </div>
        </div>

@stop