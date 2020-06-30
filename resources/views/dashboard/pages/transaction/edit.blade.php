<section class="content-header">
    <h1>
        Edit Data Kategori
        <small>Edit Data Kategori</small>
    </h1>
</section>

<section class="content">
    <div class="box">

        <div class="box-header with-border">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="box-title">Saldo : {{number_format($saldo)}}</h3>
                </div>

                <div class="col-sm-6">
                </div>

            </div>

        </div>

        <form class="form-horizontal" method="POST">
            <div class="box-body">
                {{csrf_field()}}
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="status_martial">ID</label>
                    <div class="col-sm-5">
                        <input class="form-control" type="text" name="id" value="{{$transaction->id}}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="type">Jenis</label>
                    <div class="col-sm-5">
                        <select id="type" name="type" class="form-control">
                            <option value="Pemasukan" @if($transaction->type == 'Pemasukan') selected @endif >Pemasukan</option>
                            <option value="Pengeluaran" @if($transaction->type == 'Pengeluaran') selected @endif >Pengeluaran</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="category_id">Kategori</label>
                    <div class="col-sm-5">
                        <select id="category" name="category_id" class="form-control">
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="name">Nominal</label>
                    <div class="col-sm-5">
                        <input id="value" name="value" class="form-control" type="text" value="{{number_format($transaction->value)}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="description">Deskripsi</label>
                    <div class="col-sm-5">
                        <textarea name="description" class="form-control">{{$transaction->description}}</textarea>
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
    var category_id = "{{$transaction->category_id}}"

    function cancel() {
        event.preventDefault();
        routeMenu('get', thisPath.replace("/edit", ""));
    }

    function getCategory() {
        var typeTransaction

        typeTransaction = $('#type').val()
        $.ajax({
            url : thisPath.replace("/edit", "/category") + '?type=' + typeTransaction,
            method : 'GET',
            success: function(result) {
                $('#category').empty()
                result.forEach(function(el) {
                    $('#category').append(`<option value="${el.id}" ${(el.id == category_id) ? 'selected':''}>${el.name}</option>`)
                })
            },
            error: function(error) {
                loader('hide')
                if (error.status == 422) notification(error.responseText, 'error');
                else notification(error.statusText, 'error');
            }
        });
    }

    $(function() {

        getCategory()

        $('#type').change(function(e) {
            getCategory()
        })

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

        $('#value').keyup(function(e) {
            if ( $.inArray( e.keyCode, [38,40,37,39] ) !== -1 ) {
                return
            }

            var input = $(this).val()
            input = input.replace(/[\D\s\._\-]+/g, "")
            input = input ? parseInt( input, 10 ) : 0

            $(this).val((input === 0) ? "0" : input.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,'))

        })

    })

</script>