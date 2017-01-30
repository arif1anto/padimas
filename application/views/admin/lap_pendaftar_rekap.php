<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Export</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Rekap PMB</h3>
                </div>
                <div class="panel-body">
					<?php echo form_open('',array('class'=>'form-horizontal')) ?>
                        <div class="form-group form-group-sm valid required">
                            <label class="control-label col-sm-3">Jenis Pendaftaran</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="prg">
                                    <option value="0">- Semua Program -</option>
									<?php
									if(count($data1>0)):
										foreach($data1 as $row){
											echo '<option value="'.$row->prg_id.'">'.$row->prg_nama.'</option>';
										}
										endif;
									?>
                                </select>
                                <p class="help-block"></p>
                            </div>
                        </div>
						<div class="form-group form-group-sm">
                            <label class="control-label col-sm-3">Jenis Data</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="jns_data">
									<option value="0">Pendaftaran</option>
									<option value="1">Herregistrasi</option>
                                </select>
                                <p class="help-block"></p>
                            </div>
                        </div>
                        <div class="form-group form-group-sm valid required">
                            <label class="control-label col-sm-3">Tanggal</label>
                            <div class="col-sm-4">
                                <div class='input-group date'>
                                    <input type='text' class="form-control input-sm date" name="tgl_awal" data-date-format="DD-MM-YYYY" value="<?php echo date_format(new datetime(),'d-m-Y'); ?>">
                                    <span class="input-group-addon input-sm">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                                </div>
                                <p class="help-block"></p>
                            </div> 
                            <div class="col-sm-1" ><span>sampai</span>
                            </div>
                            <div class="col-sm-4">
                                <div class='input-group date'>
                                    <input type='text' class="form-control input-sm date" name="tgl_akhir" data-date-format="DD-MM-YYYY" value="<?php echo date_format(new datetime(),'d-m-Y'); ?>">
                                    <span class="input-group-addon input-sm">
                                        <span class="fa fa-calendar"></span>
                                    </span>
                                </div>
                                <p class="help-block"></p>
                            </div>
                        </div>
                        <p class="text-right">
                        <button type="submit" class="btn btn-primary btn-xs">Export</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $('.date').datetimepicker({
			format: "DD-MM-YYYY",
			maxDate: "<?php echo date("d-m-Y") ?>",
			pickTime: false,
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            },
        });
    });
</script>
<script type="text/javascript" src="<?php echo base_url().index_page().'assets/js/validasi.js' ?>"></script>