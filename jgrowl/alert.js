function pesan_sukses(){
    var pesan = '<div class="ui-pnotify-icon"><span class="glyphicon glyphicon-ok-sign"></span></div>'+
                '<h4 class="ui-pnotify-title">Berhasil</h4>'+
                '<div class="ui-pnotify-text"><strong>Data sudah berhasil disimpan!</strong></div>';

    $.jGrowl(pesan, { header: '', life:3000 });
}

function pesan_hapus(){
    var pesan = '<div class="ui-pnotify-icon"><span class="glyphicon glyphicon-ok-sign"></span></div>'+
                '<h4 class="ui-pnotify-title">Berhasil</h4>'+
                '<div class="ui-pnotify-text"><strong>Data berhasil dihapus!</strong></div>';

    $.jGrowl(pesan, { header: '', life:3000 });
}

function pesan_tanggal(){
    var pesan = '<div class="ui-pnotify-icon"><span class="glyphicon glyphicon-ok-sign" style="background:red;"></span></div>'+
                '<h4 class="ui-pnotify-title" style="background:red;">Gagal</h4>'+
                '<div class="ui-pnotify-text" style="background:red;"><strong>Data Gagal dihapus , tanggal Purchase Order belum memenuhi !</strong></div>';

    $.jGrowl(pesan, { header: '', life:3000 });
}

function pesan_simpan_no_keu(){
    var pesan = '<div class="ui-pnotify-icon"><span class="glyphicon glyphicon-ok-sign"></span></div>'+
                '<h4 class="ui-pnotify-title">Berhasil</h4>'+
                '<div class="ui-pnotify-text"><strong>No. KEU sudah diantrikan!</strong></div>';

    $.jGrowl(pesan, { header: '', life:3000 });
}