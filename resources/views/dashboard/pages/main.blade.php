<section class="content-header">
    <h1>
        Home
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-sm-4">
            <div class="info-box">
                <span class="info-box-icon bg-blue"><i class="fa fa-money"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Saldo</span>
                    <span class="info-box-number">{{$saldo}}</span>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Pengeluaran</span>
                    <span class="info-box-number">{{$money_out}}</span>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Pemasukan</span>
                    <span class="info-box-number">{{$money_in}}</span>
                </div>
            </div>
        </div>
    </div>
</section>