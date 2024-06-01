<div class="modal" id="edit_model_{{$banner['id']}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title"> تعديل البانر  </h6>
                <button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{url('admin/under_banner/edit')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="banner_id" value="{{$banner['id']}}">
                    </div>
                    <div class="form-group">
                        <label>  العنوان   </label>
                        <input required type="text" name="title" class="form-control" value="{{$banner['title']}}">
                    </div>
                    <div class="form-group">
                        <label> العنوان باللغة الانجليزية   </label>
                        <input required type="text" name="title_en" class="form-control" value="{{$banner['title_en']}}">
                    </div>
                    <div class="form-group">
                        <label>  الوصف  </label>
                        <textarea name="sub_title" class="form-control">{{$banner['sub_title']}}</textarea>

                    </div>
                    <div class="form-group">
                        <label>   الوصف  باللغة الانجليزية  </label>
                        <textarea name="sub_title_en" class="form-control">{{$banner['sub_title_en']}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>  الرابط  </label>
                        <input required type="text" name="link" class="form-control" value="{{$banner['link']}}">
                    </div>
                    <div class="form-group">
                        <label>  عنوان الزر   </label>
                        <input required type="text" name="button_text" class="form-control" value="{{$banner['button_text']}}">
                    </div>
                    <div class="form-group">
                        <label> عنوان الزر باللغة الانجليزية   </label>
                        <input required type="text" name="button_text_en" class="form-control" value="{{$banner['button_text_en']}}">
                    </div>
                    <div class="form-group">
                        <label> الصوره  </label>
                        <input type="file" name="image" class="form-control">
                        <img width="80px" height="80px" src="{{asset('assets/images/under_banner/'.$banner['image'])}}" alt="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary" type="submit">  تعديل
                    </button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal"
                            type="button">رجوع
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
