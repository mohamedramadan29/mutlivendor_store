<div class="modal" id="edit_model_{{$user['id']}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title"> تعديل حاله المستخدم  </h6>
                <button aria-label="Close" class="close" data-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{url('admin/update_user')}}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" name="user_id" value="{{$user['id']}}">
                        <label> اسم  المستخدم  </label>
                        <input required readonly type="text" name="name" class="form-control"
                               value="{{$user['name']}}">
                    </div>
                    <div class="form-group">
                        <label> حالة المستخدم  </label>
                        <select required class="form-control" name="status">
                            <option> -- حدد حالة المستخدم  --</option>
                            <option @if($user['status'] ==1) selected @endif value="1">  نشط </option>
                            <option @if($user['status'] ==0) selected @endif value="0">غير نشط </option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary" type="submit"> تعديل المستخدم
                    </button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal"
                            type="button">رجوع
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
