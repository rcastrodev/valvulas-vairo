<div class="modal fade" id="modal-create-image">
    <form action="{{ route('clients.images.store') }}" method="post" class="modal-dialog" data-info="reset">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Crear</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
        <div class="modal-body">
            <input type="hidden" name="content_id" value="{{ $content->id }}">
            <input type="hidden" name="name" value="image">
            <div class="form-group">
                <input type="text" name="order" class="form-control" placeholder="Orden">
            </div>  
            <div class="form-group">
                <input type="text" name="description" class="form-control" placeholder="Nombre">
            </div>   
            <div class="form-group">
                <input type="file" name="image" class="form-control-file">
                <br>
                <small>tamaño de imagen recomendada 671x580px</small>
            </div>  
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </form>
    <!-- /.modal-dialog -->
</div>