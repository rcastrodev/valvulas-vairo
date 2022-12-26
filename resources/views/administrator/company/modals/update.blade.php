<div class="modal fade" id="modal-update-element">
    <form action="{{ route('company.content.updateSlider') }}" method="post" id="form-update-slider" class="modal-dialog" data-info="reset" data-sync="no" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Actualizar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
        <div class="modal-body">
            <input type="hidden" name="id">
            <div class="form-group">
                <input type="text" name="order" class="form-control" placeholder="Orden">
            </div>  
            <div class="form-group">
                <input type="text" name="content_1" class="form-control" placeholder="Título">
            </div> 
            <div class="form-group">
                <textarea name="content_2" id="content_22" cols="30" rows="10" class="ckeditor"></textarea>
            </div> 
            <div class="form-group">
                <input type="file" name="image" class="form-control-file">
                <small>la imagen debe ser menor a 66x66px</small>
            </div>    
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </form>
    <!-- /.modal-dialog -->
</div>