<div class="modal" id="edit_model_{{$adv['id']}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title"> اضافة ميزة جديدة </h6>
                <button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{url('admin/website_advantage/edit/'.$adv['id'])}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label> العنوان </label>
                        <input required type="text" name="title" class="form-control" value="{{$adv['title']}}">
                    </div>
                    <div class="form-group">
                        <label> العنوان باللغة الانجليزية </label>
                        <input required type="text" name="title_en" class="form-control"  value="{{$adv['title_en']}}">
                    </div>
                    <div class="form-group">
                        <label> الوصف </label>
                        <textarea class="form-control" name="desc" required>{{$adv['desc']}}</textarea>
                    </div>
                    <div class="form-group">
                        <label> الوصف باللغة الانجليزية </label>
                        <textarea class="form-control" name="desc_en" required>{{$adv['desc_en']}}</textarea>
                    </div>
                    <div class="form-group">
                        <label> تعديل الصورة   </label>
                        <input type="file" name="image" class="form-control">
                        <img width="50px" class="img-thumbnail img-fluid" src="{{asset('assets/images/advantage_images/'.$adv['image'])}}">
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
