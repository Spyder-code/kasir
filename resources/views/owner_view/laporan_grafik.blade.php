@extends('layouts.owner')

@section('content')
<div class="content-wrapper">
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0 text-dark">Grafik Laporan Bulanan</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="">Home</a></li>
                  <li class="breadcrumb-item active">Grafik Laporan Bulanan</li>
               </ol>
            </div>
         </div>
         <div class="content mt-4 ">
            {{-- Masukan konten disini --}}
            <div class="card">
               <div class="card-body">
                  <canvas id="myChart" max-width="200" height="130"></canvas>
               </div>
            </div>
         </div>
      </div>


   </div>
</div>
@endsection

@section('custom-script')
<script>
   $(document).ready(function() {
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

      $.get( "{{ route('laporan.show') }}", function(response) {
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

