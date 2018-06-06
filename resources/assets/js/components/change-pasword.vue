<template>
  <div id="change-password" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="ti-pencil-alt"></i> Cambiar Contraseña.</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form @submit.prevent="register">
          <div class="modal-body">
            <div class="row justify-content-md-between">
              <div class="form-group col-sm-12">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><span class="fa fa-unlock"></span></div>
                  </div>
                  <input type="password" class="form-control" v-model="pass.passwordold" placeholder="Contraseña actual">
                </div>
                <small id="passwordoldHelp" class="form-text text-muted" v-text="msg.passwordold"></small>
              </div>
              <div class="form-group col-sm-12">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><span class="fa fa-lock"></span></div>
                  </div>
                  <input type="password" class="form-control" v-model="pass.passwordnew" placeholder="Nueva Contraseña.">
                </div>
                <small id="passwordnewHelp" class="form-text text-muted" v-text="msg.passwordnew"></small>
              </div>
              <div class="form-group col-sm-12">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text"><span class="fa fa-lock"></span></div>
                  </div>
                  <input type="password" class="form-control" v-model="pass.passwordnew_confirmation" placeholder="Confirmación de nueva contraseña.">
                </div>
                <small id="passwordnew_confirmationHelp" class="form-text text-muted" v-text="msg.passwordnew_confirmation"></small>
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
</template>

<script>
  export default {
    name: 'modal-changePassword-user',
    data () {
      return {
        pass: {
          passwordold: '',
          passwordnew: '',
          passwordnew_confirmation: ''
        },
        msg: {
          passwordold: 'Contraseña Actual.',
          passwordnew: 'Nueva Contraseña.',
          passwordnew_confirmation: 'Confirmación de nueva contraseña.'
        }
      };
    },
    methods: {
      register: function () {
        axios.post('users/edit-password', this.pass)
        .then(response => {
          toastr.success('Contraseña Cambiada con exito.');
          this.pass = {
            passwordold: '',
            passwordnew: '',
            passwordnew_confirmation: ''
          };
          $('#change-password').modal('toggle');
        });
      }
    }
  }
</script>
