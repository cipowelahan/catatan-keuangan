<section class="content-header">
    <h1>
        Data Kategori
        <small>Daftar Kategori</small>
    </h1>
</section>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <div class="row">
                <div class="col-sm-6">
                </div>

                <div class="col-sm-6">
                    <div class="box-tools pull-right">
                        <form id="cari" method="POST">

                            <!-- Modal filter -->
                            <div class="input-group">
                                <div class="modal fade" tabindex="-1" role="dialog" id="boxfilter">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">

                                            <div class="modal-header btn-primary">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Filter Pencarian</h4>
                                            </div>

                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-6">Jenis</div>
                                                    <div class="col-sm-6">
                                                        <select name="type" class="form-control" style="width: 100%">
                                                            <option value="">Semua Jenis</option>
                                                            <option value="Pemasukan">Pemasukan</option>
                                                            <option value="Pengeluaran">Pengeluaran</option>
                                                        </select>
                                                    </div>
                                                    <br>
                                                    <hr>
                                                    <div class="col-sm-6">Urutkan Berdasarkan</div>
                                                    <div class="col-sm-6">
                                                        <select name="order_column" class="form-control" style="width: 100%">
                                                            <option value="id">ID</option>
                                                            <option value="type">Jenis</option>
                                                            <option value="name">Nama</option>
                                                            <option value="description">Deskripsi</option>
                                                            <option value="created_at">Dibuat Pada</option>
                                                            <option value="updated_at">Diubah Pada</option>
                                                        </select>
                                                    </div>
                                                    <br>
                                                    <br>
                                                    <div class="col-sm-6">Urutkan Besar/Abjad</div>
                                                    <div class="col-sm-6">
                                                        <select name="order" class="form-control" style="width: 100%">
                                                            <option value="asc">Kecil - Besar ( A - Z )</option>
                                                            <option value="desc">Besar - Kecil ( Z - A )</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="submitFilter()">Filter</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal filter -->

                            <!-- Box Search -->
                            <div class="input-group" style="width: 250px;">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#boxfilter">Filter</button>
                                </span>
                                <input type="text" class="form-control" name="search" value="{{request()->get('search')}}">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit" id="cari-cari"><span class="fa fa-search"></span> Cari</button>
                                </span>
                            </div>
                            <!-- End Box Search -->

                        </form>
                    </div>
                </div>

            </div>

        </div>

        <div class="box-body table-responsive">
            <table class="table table-bordered" style="width:100%">
                <thead>
                    <tr style="background-color: #3c8dbc; color: #ffffff">
                        <th>ID</th>
                        <th style="width:10%">Jenis</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th style="width:15%">Dibuat Pada</th>
                        <th style="width:15%">Diubah Pada</th>
                        <th style="width:20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($category as $data)
                    <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->type}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->description}}</td>
                        <td>{{$data->created_at}}</td>
                        <td>{{$data->updated_at}}</td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#info{{$loop->index}}">Lihat</button>
                                <button type="button" class="btn btn-warning" data-id="{{$data->id}}">Edit</button>
                                <button type="button" class="btn btn-danger" data-id="{{$data->id}}">Hapus</button>
                            </div>
                        </td>
                    </tr>
                    <tr style="display: none">
                        <div class="modal fade" tabindex="-1" role="dialog" id="info{{$loop->index}}">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">

                                <div class="modal-header btn-primary">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">{{$data->name}}</h4>
                                </div>

                                <div class="modal-body">
                                    <form class="form-horizontal">
                                        <div class="row">
                                            <div class="col-sm-3 text-right">
                                                <label>ID</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" value="{{$data->id}}" readonly>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-3 text-right">
                                                <label>Jenis</label>
                                            </div>
                                            <div class="col-sm-9">
                                                {{$data->type}}
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-3 text-right">
                                                <label>Nama</label>
                                            </div>
                                            <div class="col-sm-9">
                                                {{$data->name}}
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-3 text-right">
                                                <label>Deskripsi</label>
                                            </div>
                                            <div class="col-sm-9">
                                                <textarea style="background-color: #fff0" class="form-control" rows="4" readonly>{{$data->description}}</textarea>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-3 text-right">
                                                <label>Dibuat Pada</label>
                                            </div>
                                            <div class="col-sm-9">
                                                {{$data->created_at}}
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-3 text-right">
                                                <label>Diubah Pada</label>
                                            </div>
                                            <div class="col-sm-9">
                                                {{$data->updated_at}}
                                            </div>
                                        </div>
                                    </form>
                                    <div></div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="box-tools pull-right">{{ $category->appends(['search' => request()->get('search'), 
                                                                    'type' => request()->get('type'),
                                                                    'order_column' => request()->get('order_column'),
                                                                    'order' => request()->get('order')])->links() }}</div>
            
        </div>
    </div>
</section>

<script>
    var thisPath = "{{request()->url()}}";

    $('[name=order_column]').val('{{request()->get('order_column', 'id')}}')
    $('[name=order]').val('{{request()->get('order', 'asc')}}')
    $('[name=type]').val('{{request()->get('type', '')}}')

    function submitFilter() {
        setTimeout(function() {
            $('#cari-cari').trigger('click')
        }, 600)
    }

    $(function() {

        $('ul.pagination li a').click(function() {
            event.preventDefault();
            routeMenu('get', $(this).attr('href'))
        })

        $('table tbody tr td div button.btn-warning').click(function(e) {
            e.preventDefault()
            var id = $(this).attr('data-id')
            bootbox.confirm('Yakin Mengedit ?', function(ok) {
                if(ok) {
                    routeMenu('get', thisPath+'/edit', { id })
                }
            })
        })

        $('table tbody tr td div button.btn-danger').click(function(e) {
            e.preventDefault()
            var id = $(this).attr('data-id')
            bootbox.confirm('Yakin Menghapus ?', function(ok) {
                if(ok) {
                    routeMenu('post', thisPath+'/delete', { 
                        id,
                        _token: "{{csrf_token()}}",
                        lastUrl: "{{request()->fullUrl()}}"
                    }, function(result) {
                        if (result.succes) {
                            routeMenu('get', result.lastUrl);
                            notification('berhasil', 'success');
                        } 
                    })
                }
            })
        })

        $('#cari').submit(function(e) {
            e.preventDefault()
            routeMenu('get', thisPath, $(this).serialize())
        })
    })
</script>