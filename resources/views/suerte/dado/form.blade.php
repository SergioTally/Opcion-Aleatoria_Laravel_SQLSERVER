
<input type="hidden" id="linea" value="0">
<section class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label for="com_persona" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Nombre del Dado</label>
                        <div class="col-sm-12 col-lg-9">
                            <input type="text" name="dd_descripcion" id="dd_descripcion" class="form-control" placeholder="Descripción" minlength="10" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                        </div>
                    <div class="col-sm-12 col-lg-4">
                    </div>
                </div>

                <section class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="tipo_dado" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Tipo</label>
                                    <div class="col-sm-12 col-lg-10">
                                        <select name="tipo_dado" id="tipo_dado" class="form-control select2" style="width:100%;" placeholder="Cliente">
                                            <optgroup label="Seleccionar Tipo">
                                                <option value="0">Libre</option>
                                                <option value="2">Moneda</option>
                                                <option value="6">6 caras</option>
                                            </optgroup>
                                        </select>
                                        <div class="invalid-feedback">
                                            Este campo es obligatorio.
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="cara" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Descripcion de Cara</label>
                                    <div class="col-sm-12 col-lg-9">
                                        <input type="text" name="cara" id="cara" class="form-control" placeholder="Descripción" minlength="10" required onkeyup="javascript:this.value=this.value.toUpperCase();">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button onclick="agregar_insumo()" type="button" id="agregar" class="btn btn-success float-right">Agregar</button>
                                </div>
                            </div>
                        </div>
                </section>

                <div class="form-group row">
                    <label for="act_fechaAlta" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Fecha</label>
                    <div class="input-group col-sm-12 col-lg-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control float-right" id="dd_fecha" name="dd_fecha" value="" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <table class="table table-bordered table-hover" id="detalle">
                            <tbody id="tblCaras">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
