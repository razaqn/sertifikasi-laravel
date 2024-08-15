@extends('layouts.frontend')
@section('title')
    
@endsection

@section('css')
@endsection

@section('content')
<section class="resume-section" id="about">
    <div class="resume-section-content">
        <h1 class="mb-0">
            <canvas id="myChart"></canvas>
        </h1>
    </div>
</section>
@endsection

@section('js')
<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
@endsection
