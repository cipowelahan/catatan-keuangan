<section class="content-header">
    <h1>
        Edit Data Kategori
        <small>Edit Data Kategori</small>
    </h1>
</section>

<section class="content">
    <div class="box">

        <form class="form-horizontal" method="POST">
            <div class="box-body">
                {{csrf_field()}}
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="status_martial">ID</label>
                    <div class="col-sm-5">
                        <input class="form-control" type="text" name="id" value="{{$category->id}}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="type">Jenis</label>
                    <div class="col-sm-5">
                        <select name="type" class="form-control">
                            <option value="Pemasukan" @if($category->type == 'Pemasukan') selected @endif >Pemasukan</option>
                            <option value="Pengeluaran" @if($category->type == 'Pengeluaran') selected @endif >Pengeluaran</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">Nama</label>
                    <div class="col-sm-5">
                        <input name="name" class="form-control" type="text" value="{{$category->name}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="description">Deskripsi</label>
                    <div class="col-sm-5">
                        <textarea name="description" class="form-control">{{$category->description}}</textarea>
                    </div>
                </div>
            </div>
    
            <div class="box-footer">
                <div class="form-group">
                    <label class="col-sm-3 control-label" for=""></label>
                    <div class="col-sm-5">
                        <button class="btn btn-warning" type="button" onclick="cancel()">Batalkan</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<script>
    var thisPath = "{{request()->url()}}";


    function cancel() {
        event.preventDefault();
        routeMenu('get', thisPath.replace("/edit", ""));
    }

    $(function() {

        $('form').submit(function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            var id = $('[name=id]').val();
            bootbox.confirm('Anda yakin ?', function(ok) {
                if (ok) {
                    routeMenu('post', thisPath, data, function(result) {
                        if (result == "1") {
                            routeMenu('get', thisPath.replace("/edit", ""));
                            notification('berhasil', 'success');
                        }
                    });

                }
            })
        })

    })

</script>