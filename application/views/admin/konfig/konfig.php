<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Konfigurasi Umum</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th class="text-center" width="100">Aksi</th>
                    <th class="text-center" width="30">No</th>
                    <th>Jenis Konfigurasi</th>
					<th>Set</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                        if (count($data1)>0) {
                    		$i=0;
                            foreach ($data1 as $row) {
                            	$i++;
                    ?>
                        <tr>
                        <td class="text-center">
                        	<div id ="callsimpan<?php echo $row->set_name ?>" class="btn-group btn-group-sm" role="group">
							  <button type="button" class="btn btn-warning" title="Edit" value="0" onclick="edit('<?php echo $row->set_name ?>',$(this))"><i class="fa fa-pencil"></i></button>
							</div>
                        </td>
                        <td class="text-center"><?php echo $i ?></td>
                        <td><?php echo $row->set_name ?></td>
						<td id="set<?php echo $row->set_name ?>"><?php echo htmlentities($row->set_value) ?></td>
                        </tr>
                    <?php
                            }
                        } else {
                    ?>
                        <tr>
                            <td colspan="4" class="danger text-center"><strong>Tidak ditemukan jenis beasiswa</strong></td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th class="text-center" width="100">Aksi</th>
                    <th class="text-center" width="30">No</th>
                    <th>Jenis Konfigurasi</th>
					<th>Set</th>
                  </tr>
                </tfoot>
              </table>
            </div>
        </div>
        <div class="col-sm-12 text-center">
        <ul class="pagination pagination-sm">
          <?php  echo $this->pagination->create_links(); ?>
        </ul>
        </div>
    </div>
</div>



<script type="text/javascript">

	function edit(jns,btn){
		kondisi = $(btn).val();
		if (kondisi=='0') {
			var jenis = $("#set"+jns).html();
			var isi = '<form id="formset" method="post" action="<?php echo base_url().index_page()?>admin/konfigurasi/umum/edit">';
			isi += '<input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>">';
			isi += '<div class="form-group jarak_bawah valid required"><div class="input-group input-group-sm">';
			isi += '<textarea class="form-control" name="setkonfig" row=3>'+jenis+'</textarea></div></div></form>';
			$('#set'+jns).html(isi);
			$('#callsimpan'+jns).html('<button form="formset" type="submit" class="btn btn-primary" name="id" value="'+jns+'"><i class="fa fa-save"></i></button>');
			$(btn).val('1');
		} else {
			var jenis = $(btn).closest("tr").find("input[name='jenis']").val();
			$('#jenis'+jns).html(jenis);
			$(btn).val('0');
		}
	};

</script>

<script type="text/javascript" src="<?php echo base_url().index_page().'assets/js/validasi.js' ?>"></script>