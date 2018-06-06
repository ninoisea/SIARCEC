<div id="modal_user_form" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title c-white"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="user_form">
                <div class="modal-body">
                    <div class="row justify-content-md-between">
                        @method('POST')
                        @csrf
                        <div class="form-group col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><span class="fa fa-user-circle"></span></div>
                                </div>
                                <input type="text" class="form-control" name="name" placeholder="Nombre">
                            </div>
                            <small id="nameHelp" class="form-text text-muted">Nombre del usuario.</small>
                        </div>
                        <div class="form-group col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><span class="fa fa-user-circle-o"></span></div>
                                </div>
                                <input type="text" class="form-control" name="last_name" placeholder="Apellido">
                            </div>
                            <small id="last_nameHelp" class="form-text text-muted">Apellido del usuario.</small>
                        </div>
                        <div class="form-group col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><span class="fa fa-id-card"></span></div>
                                </div>
                                <input type="text" class="form-control" name="num_id" placeholder="Cédula">
                            </div>
                            <small id="num_idHelp" class="form-text text-muted">Cédula del usuario.</small>
                        </div>
                        <div class="form-group col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><span class="fa fa-hand-stop-o"></span></div>
                                </div>
                                <select name="role_id" class="form-control">
                                    <option value="" selected>Seleccione un rol</option>
                                    <option value="1">Administrador</option>
                                    <option value="2">Registrador</option>
                                </select>
                            </div>
                            <small id="role_idHelp" class="form-text text-muted">Rol del usuario.</small>
                        </div>
                        <div class="form-group col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><span class="fa fa-envelope"></span></div>
                                </div>
                                <input type="text" class="form-control" name="email" placeholder="Correo">
                            </div>
                            <small id="emailHelp" class="form-text text-muted">Correo del usuario.</small>
                        </div>
                        <div class="form-group col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><span class="fa fa-lock"></span></div>
                                </div>
                                <input type="password" class="form-control" name="password" placeholder="Contraseña">
                            </div>
                            <small id="passwordHelp" class="form-text text-muted">Contraseña del usuario.</small>
                        </div>
                        <div class="form-group col-sm-6">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><span class="fa fa-lock"></span></div>
                                </div>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirmación">
                            </div>
                            <small id="password_confirmationHelp" class="form-text text-muted">Confirmación de contraseña.<a href=""></a> del usuario.</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="fa fa-close"></span> Cerrar</button>
                    <button type="submit" class="btn btn-primary"><span class="fa fa-send"></span> Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
