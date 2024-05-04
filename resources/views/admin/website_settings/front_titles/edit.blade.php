<div class="modal" id="edit_model_{{$title['id']}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title"> تعديل   </h6>
                <button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{url('admin/front_titles/edit/'.$title['id'])}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label> العنوان </label>
                        <input required type="text" name="title" class="form-control" value="{{$title['title']}}">
                    </div>
                    <div class="form-group">
                        <label> العنوان باللغة الانجليزية </label>
                        <input required type="text" name="title_en" class="form-control"  value="{{$title['title_en']}}">
                    </div>
                    <div class="form-group">
                        <label> الوصف </label>
                        <textarea class="form-control" name="desc" required>{{$title['desc']}}</textarea>
                    </div>
                    <div class="form-group">
                        <label> الوصف باللغة الانجليزية </label>
                        <textarea class="form-control" name="desc_en" required>{{$title['desc_en']}}</textarea>
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
