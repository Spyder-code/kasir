@extends('layouts.owner')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-home"></i>
        </span> Dashboard </h3>
        <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
            <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
            <div class="card-body">
            <img src="{{asset('owner/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
            <h4 class="font-weight-normal mb-3">Penghasilan pada minggu ini <i class="mdi mdi-chart-line mdi-24px float-right"></i>
            </h4>
            <h2 class="mb-5" id="tPenghasilan"></h2>
            {{-- <h6 class="card-text">Increased by 60%</h6> --}}
            </div>
        </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-info card-img-holder text-white">
            <div class="card-body">
            <img src="{{asset('owner/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
            <h4 class="font-weight-normal mb-3">Produk terjual minggu ini <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
            </h4>
            <h2 class="mb-5" id="tProdukTerjual"></h2>
            {{-- <h6 class="card-text">Decreased by 10%</h6> --}}
            </div>
        </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
            <div class="card-body">
            <img src="{{asset('owner/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
            <h4 class="font-weight-normal mb-3">Jumlah pelanggan minggu ini <i class="mdi mdi-diamond mdi-24px float-right"></i>
            </h4>
            <h2 class="mb-5" id="tJumlahPelanggan"></h2>
            {{-- <h6 class="card-text">Increased by 5%</h6> --}}
            </div>
        </div>
        </div>
    </div>

     <div class="row">
         <div class="col-md-12 grid-margin stretch-card">
         <div class="card">
             <div class="card-body">
             <div class="clearfix">
                 <h4 class="card-title float-left">Statistik Bulan Ini</h4>
                 <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
             </div>
             <canvas id="myChart" max-width="200" height="130"></canvas>
             </div>
         </div>
         </div>
     </div>
@endsection

@section('custom-script')
<script>
   $(document).ready(function() {
      let currDate = new Date 
      const thisWeek = [];
            currSallary = [];
            currProductTotal = [];
            currCustomerTotal = [];

      const arraySalary = [];
            monthSalary = [];

      const monthJan = [];
            monthFeb = [];
            monthMar = [];
            monthApr = [];
            monthMay = [];
            monthJun = [];
            monthJul = [];
            monthAug = [];
            monthSep = [];
            monthOct = [];
            monthNov = [];
            monthDec = [];

      for (let i = 1; i <= 7; i++) {
         let first = currDate.getDate() - currDate.getDay() + i;
         let day = new Date(currDate.setDate(first)).toISOString().slice(0, 10);
         thisWeek.push(day);
      }

      $.get( "{{ url('owner/dashboard/show') }}", function(response) {
         const data = JSON.parse(response);
         data.customer.map(data => {
            const dataCreated = data.created_at.split('T');
            thisWeek.map(currDay => {
               if(currDay == dataCreated[0]){
                  currSallary.push(data.total_pembayaran);
                  currCustomerTotal.push(1);
               }
            });
         });

         data.transaksi.map(data => {
            const dataCreated = data.created_at.split('T');
            thisWeek.map(currDay => {
               if(currDay == dataCreated[0]){
                  currProductTotal.push(data.jumlah);
               }
            });
         })

         const sallary =  currSallary.reduce((acc, currVal) => acc + currVal);
         $("#tPenghasilan").text(`Rp ${sallary}`);
         const productTotal =  currProductTotal.reduce((acc, currVal) => acc + currVal);
         $("#tProdukTerjual").text(`${productTotal}`);
         const customerTotal =  currCustomerTotal.reduce((acc, currVal) => acc + currVal);
         $("#tJumlahPelanggan").text(`${customerTotal}`);
      });

      $.get( "{{ url('owner/dashboard/showgrafik') }}", function(response) {
         const data = JSON.parse(response);
         const currentYear = new Date().getFullYear();
         data.map((data) => {
            const jsDate = new Date(data.created_at).toString();
            let splited = jsDate.split(" ");
            if(splited[3] == currentYear){

               if(splited[1] == "Jan") {
                  monthJun.push(data.total_harga);
                  if(monthSalary.includes("Jan") != true){
                     monthSalary.push("Jan");
                  }

               } else if(splited[1] == "Feb") {
                  monthFeb.push(data.total_harga);
                  if(monthSalary.includes("Feb") != true){
                     monthSalary.push("Feb");
                  }

               } else if(splited[1] == "Mar") {
                  monthMar.push(data.total_harga);
                  if(monthSalary.includes("Mar") != true){
                     monthSalary.push("Mar");
                  }

               } else if(splited[1] == "Apr") {
                  monthApr.push(data.total_harga);
                  if(monthSalary.includes("Apr") != true){
                     monthSalary.push("Apr");
                  }

               } else if(splited[1] == "May") {
                  monthMay.push(data.total_harga);
                  if(monthSalary.includes("May") != true){
                     monthSalary.push("May");
                  }

               } else if(splited[1] == "Jun") {
                  monthJun.push(data.total_harga);
                  if(monthSalary.includes("Jun") != true){
                     monthSalary.push("Jun");
                  }

               } else if(splited[1] == "Jul") {
                  monthJul.push(data.total_harga);
                  if(monthSalary.includes("Jul") != true){
                     monthSalary.push("Jul");
                  }

               } else if(splited[1] == "Aug") {
                  monthAug.push(data.total_harga);
                  if(monthSalary.includes("Aug") != true){
                     monthSalary.push("Aug");
                  }

               } else if(splited[1] == "Sep") {
                  monthSep.push(data.total_harga);
                  if(monthSalary.includes("Sep") != true){
                     monthSalary.push("Sep");
                  }

               } else if(splited[1] == "Oct") {
                  monthOct.push(data.total_harga);
                  if(monthSalary.includes("Oct") != true){
                     monthSalary.push("Oct");
                  }

               } else if(splited[1] == "Nov") {
                  monthNov.push(data.total_harga);
                  if(monthSalary.includes("Nov") != true){
                     monthSalary.push("Nov");
                  }

               } else if(splited[1] == "Dec") {
                  monthDec.push(data.total_harga);
                  if(monthSalary.includes("Dec") != true){
                     monthSalary.push("Dec");
                  }
               }
            }

         })


         if(monthJan.length > 0){
            const totalJan =  monthJan.reduce((acc, currentVal) => acc + currentVal);
            arraySalary.push(totalJan);
         }

         if(monthFeb.length > 0){
            const totalFeb =  monthFeb.reduce((acc, currentVal) => acc + currentVal);
            arraySalary.push(totalFeb);
         }
         
         if(monthMar.length > 0){
            const totalMar =  monthMar.reduce((acc, currentVal) => acc + currentVal);
            arraySalary.push(totalMar);
         } 
         
         if(monthApr.length > 0){
            const totalApr =  monthApr.reduce((acc, currentVal) => acc + currentVal);
            arraySalary.push(totalApr);
         }

         if(monthMay.length > 0){
            const totalMay =  monthMay.reduce((acc, currentVal) => acc + currentVal);
            arraySalary.push(totalMay);
         }

         if(monthJun.length > 0){
            const totalJun =  monthJun.reduce((acc, currentVal) => acc + currentVal);
            arraySalary.push(totalJun);
         }

         if(monthJul.length > 0){
            const totalJul =  monthJul.reduce((acc, currentVal) => acc + currentVal);
            arraySalary.push(totalJul);
         }

         if(monthAug.length > 0){
            const totalAug =  monthAug.reduce((acc, currentVal) => acc + currentVal);
            arraySalary.push(totalAug);
         }

         if(monthSep.length > 0){
            const totalSep =  monthSep.reduce((acc, currentVal) => acc + currentVal);
            arraySalary.push(totalSep);
         } 

         if(monthOct.length > 0){
            const totalOct =  monthOct.reduce((acc, currentVal) => acc + currentVal);
            arraySalary.push(totalOct);
         }

         if(monthNov.length > 0){ 
            const totalNov =  monthNov.reduce((acc, currentVal) => acc + currentVal);
            arraySalary.push(totalNov);
         }

         if(monthDec.length > 0){
            const totalDec =  monthDec.reduce((acc, currentVal) => acc + currentVal);
            arraySalary.push(totalDec);
         }

         var ctx = document.getElementById('myChart');
         var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
               labels: monthSalary,
               datasets: [{
                     label: '# of Votes',
                     data: arraySalary,
                     backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                     ],
                     borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                     ],
                     borderWidth: 1
               }]
            },
            options: {
               scales: {
                     yAxes: [{
                        ticks: {
                           beginAtZero: true
                        }
                     }]
               }
            }
         });
      });

   });
</script>
@endsection
