<div class="modal" id="add_model">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title"> اضافة ميزة جديدة </h6>
                <button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{url('admin/website_advantage/add')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label> العنوان </label>
                        <input required type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label> العنوان باللغة الانجليزية </label>
                        <input required type="text" name="title_en" class="form-control">
                    </div>
                    <div class="form-group">
                        <label> الوصف </label>
                        <textarea class="form-control" name="desc" required></textarea>
                    </div>
                    <div class="form-group">
                        <label> الوصف باللغة الانجليزية </label>
                        <textarea class="form-control" name="desc_en" required></textarea>
                    </div>
                    <div class="form-group">
                        <label> الصورة </label>
                        <input required type="file" name="image" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary" type="submit"> إضافة
                    </button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal"
                            type="button">رجوع
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
