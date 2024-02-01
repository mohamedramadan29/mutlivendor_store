<div class="modal" id="add_model">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">  اضافه بانر جديد </h6>
                <button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{url('admin/banners/add')}}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>  العنوان الفرعي  </label>
                        <input required type="text" name="sub_title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>  العنوان الاساسي   </label>
                        <input required type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>  رابط الزر  </label>
                        <input required type="text" name="link" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>  الحاله  </label>
                        <select required class="form-control" name="status">
                            <option> -- حدد حالة    --  </option>
                            <option value="1"> فعال </option>
                            <option value="0">غير فعال </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label> الصوره  </label>
                        <input required type="file" name="image" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary" type="submit">  إضافة
                    </button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal"
                            type="button">رجوع
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
