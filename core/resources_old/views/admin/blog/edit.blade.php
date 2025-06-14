@extends('master')

@section('content')
<div class="container-fluid mt--6">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0 h3 font-weight-bolder">{{$lang["admin_blog_edit_compose_article"]}}</h3>
                    </div>
                    <div class="card-body">
                        <p class="text-danger"></p>
                        <form action="{{route('blog.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{$lang["admin_blog_edit_title"]}}</label>
                                <div class="col-lg-10">
                                    <input type="text" name="title" class="form-control" value="{{$post->title}}" reqiured>
                                    <input type="hidden" name="id" value="{{$post->id}}">
                                </div>
                                @if ($errors->has('title'))
                                    <div class="error">{{ $errors->first('title') }}</div>
                                @endif
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{$lang["admin_blog_edit_category"]}}</label>
                                <div class="col-lg-10">
                                    <select class="form-control select" name="cat_id" data-dropdown-css-class="bg-info-800" data-fouc required> 
                                    @foreach($category as $val)
                                        <option value="{{$val->id}}" 
                                        @if($cat->id==$val->id)
                                            selected
                                        @endif
                                        >{{$val->categories}}</option>     
                                    @endforeach             
                                    </select>
                                    @if ($errors->has('cat_id'))
                                        <div class="error">{{ $errors->first('cat_id') }}</div>
                                    @endif
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{$lang["admin_blog_edit_thumbnail"]}}:</label>
                                <div class="col-lg-10">
                                    <input type="file" class="custom-file-input" id="customFileLang" name="image" lang="en">
                                    <label class="custom-file-label" for="customFileLang" style="border-color: {{$set->s_c}};">{{$lang["admin_blog_edit_choose_media"]}}</label>
                                </div>
                            </div>              
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2">{{$lang["admin_blog_edit_content"]}}</label>
                                <div class="col-lg-10">
                                    <textarea type="text" name="details"  class="tinymce form-control">{{$post->details}}</textarea>
                                </div>
                            </div>           
                            <div class="text-right">
                                <button type="submit" class="btn btn-success btn-sm">{{$lang["admin_blog_edit_save"]}}</button>
                            </div>
                        </form>
                    </div>
                </div> 
            </div>
            <div class="col-md-4">
                <div class="card-body text-center">
                    <div class="card-img-actions d-inline-block mb-3">
                        <img class="img-fluid" src="{{url('/')}}/asset/thumbnails/{{$post->image}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop