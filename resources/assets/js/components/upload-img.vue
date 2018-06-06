<template>
    <form id="cheques-form" action="/cheques/" method="POST" enctype="multipart/form-data" accept-charset="UTF-8" @submit.prevent="enviar">
        <div class="row justify-content-md-between">
            <div class="form-group col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="ti-layers-alt"></span></div>
                    </div>
                    <input type="text" class="form-control" v-model="data.num" placeholder="#########">
                </div>
                <small id="numHelp" class="form-text text-muted">Número de Cheque.</small>
            </div>
            <div class="form-group col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="fa fa-user-circle-o"></span></div>
                    </div>
                    <input type="text" class="form-control" v-model="data.beneficiary" placeholder="Beneficiario">
                </div>
                <small id="beneficiaryHelp" class="form-text text-muted">Nombre del beneficiario.</small>
            </div>
            <div class="form-group col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="ti-world"></span></div>
                    </div>
                    <select class="form-control" v-model="data.bank_id">
                        <option value="">Seleccione un banco</option>
                        <option v-for="(bank, index) in banks" :value="index">{{ bank }}</option>
                    </select>
                </div>
                <small id="bank_idHelp" class="form-text text-muted">Banco al que se remite.</small>
            </div>
            <div class="form-group col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="ti-harddrives"></span></div>
                    </div>
                    <select class="form-control" v-model="data.shelf_id" @change="updateBox" :disabled="!data.state">
                        <option value="">Seleccione un Archivo</option>
                        <option v-for="(shelve, index) in shelves" :value="index">{{ shelve }}</option>
                    </select>
                </div>
                <small id="shelf_idHelp" class="form-text text-muted">Archivo donde se encuentra.</small>
            </div>
            <div class="form-group col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="ti-dropbox"></span></div>
                    </div>
                    <select class="form-control" v-model="data.box_id" @change="updateFolder" :disabled="!data.state">
                        <option value="">Seleccione una Estante</option>
                        <option v-for="(box, index) in boxes" :value="index">{{ box }}</option>
                    </select>
                </div>
                <small id="box_idHelp" class="form-text text-muted">Estante donde se encuentra.</small>
            </div>
            <div class="form-group col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="ti-folder"></span></div>
                    </div>
                    <select class="form-control" v-model="data.folder_id" :disabled="!data.state">
                        <option value="">Seleccione una Peldaño</option>
                        <option v-for="(folder, index) in folders" :value="index">{{ folder }}</option>
                    </select>
                </div>
                <small id="folder_idHelp" class="form-text text-muted">Peldaño donde se encuentra.</small>
            </div>
            <div class="form-group col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="ti-folder"></span></div>
                    </div>
                    <input type="text" class="form-control" v-model="data.num_box" :disabled="!data.state" placeholder="Número de caja">
                </div>
                <small id="num_boxHelp" class="form-text text-muted">Número de caja donde se encuentra.</small>
            </div>
            <div class="form-group col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="ti-calendar"></span></div>
                    </div>
                    <input type="text" class="form-control datepicker" placeholder="Fecha">
                </div>
                <small id="dated_atHelp" class="form-text text-muted">Fecha en la que se remite el cheque.</small>
            </div>
            <div class="form-group col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="ti-money"></span></div>
                    </div>
                    <input type="text" class="form-control" v-model="data.total" placeholder="########">
                </div>
                <small id="totalHelp" class="form-text text-muted">Valor total.</small>
            </div>
            <div class="form-group col-md-5">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="check" v-model="data.state">
                    <label class="custom-control-label" for="check" v-if="data.state">Físico</label>
                    <label class="custom-control-label" for="check" v-else>Digital</label>
                </div>
                <small id="stateHelp" class="form-text text-muted">Estado actual del cheque.</small>
            </div>
            <div class="form-group col-md-5">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text"><span class="ti-image"></span></div>
                    </div>
                    <input type="file" v-on:change="onFileChange" class="form-control" multiple="">
                </div>
                <small id="totalHelp" class="form-text text-muted">Seleccione las fotos del cheque.</small>
            </div>
            <div class="col-md-12" style="min-height: 150px">
                <img v-for="image in images" :src="image" class="img-responsive img-circle img-thumbnail">
            </div>
        </div>
        <div class="row justify-content-md-end">
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary"><span class="ti-check"></span> Registrar</button>
            </div>
        </div>
    </form>
</template>

<style scoped>
img {
    max-height: 150px;
    margin: 0 5vw;
}
</style>

<script>
    export default{
        data(){
            return {
                images: [],
                img: [],
                banks: [],
                shelves: [],
                boxes: [],
                folders: [],
                data: {
                    num: '',
                    beneficiary: '',
                    bank_id: '',
                    shelf_id: '',
                    box_id: '',
                    folder_id: '',
                    dated_at: '',
                    total: '',
                    num_box: '',
                    state: false,
                }
            }
        },
        mounted() {
            axios.post(location.origin + '/data-cheques')
            .then(response => {
                this.banks = response.data.banks;
                this.shelves = response.data.shelves;
            });
            $('.datepicker').datepicker({
                language:  'es',
                format: 'yyyy-mm-dd'
            });
            let vm = this;
            $('.datepicker').change(function () {
                vm.data.dated_at = $(this).val();
            });
        },
        methods: {
            digital() {
                this.data.shelf_id = '';
                this.data.box_id = '';
                this.data.folder_id = '';
            },
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files);
            },
            createImage(file) {
                this.images = [];
                this.img = file;
                for(let i in file) {
                    if (i === 'length') return;
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        this.images.push(e.target.result);
                    };
                    reader.readAsDataURL(file[i]);
                }
            },
            uploadImg(id) {
                for(let i in this.img) {
                    if (i === 'length') return;
                    let formData = new FormData();
                    formData.append('image', this.img[i]);
                    formData.append('id', id);
                    let url = location.origin + '/imagenes';
                    axios.post(url, formData)
                    .then(response => {});
                }
            },
            updateBox() {
                let shelf = this.data.shelf_id;
                if (! shelf) return;
                let data = {shelf: shelf, action: 'shelf'};
                axios.post(location.origin + '/data-cheques', data)
                .then(response => {
                    this.boxes = response.data.boxes;
                });
            },
            updateFolder() {
                let box = this.data.box_id;
                if (! box) return;
                let data = {box: box, action: 'box'};
                axios.post(location.origin + '/data-cheques', data)
                .then(response => {
                    this.folders = response.data.folders;
                });
            },
            enviar() {
                if (!this.images.length) {
                    toastr.warning('Debe agregar imagenes para registrar el cheque.');
                    return;
                }
                axios.post(location.origin + '/cheques', this.data)
                .then(response => {
                    this.uploadImg(response.data.id)
                    toastr.success('Cheque Registrado.');
                })
                .then(() => {
                    $('form#cheques-form')[0].reset();
                    this.images = [];
                    this.img = [];
                    this.data = {
                        num: '',
                        beneficiary: '',
                        bank_id: '',
                        shelf_id: '',
                        box_id: '',
                        folder_id: '',
                        dated_at: '',
                        total: '',
                        state: '',
                    }
                });
            }
        }
    }
</script>
