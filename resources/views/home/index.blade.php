@extends('layouts.layout')

@section('title', 'Home')

@section('content')
    <section class="content">
        <h3 class="text-center mt-4">Your transactions</h3>
        <a class="btn btn-success" href="{{route('transactions.create')}}">Create</a>
        @if(count($transactions))
            <div class="col-md-10 offset-md-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <canvas id="canvas" height="280" width="600"></canvas>
                    </div>
                </div>
            </div>
            <table class="table mt-4">
                <thead>
                <tr>
                    <th scope="col">Amount</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Activities</th>
                </tr>
                </thead>
                <tbody>

                @foreach($transactions as $transaction)
                    <tr>
                        <td class="{{$transaction->amount > 0 ? "text-success" : "text-danger"}}">
                            {{$transaction->amount}}
                        </td>
                        <td>{{$transaction->name}}</td>
                        <td>{{$transaction->description}}</td>
                        <td><img src="{{$transaction->image}}" alt="img" style="width: 60px"></td>
                        <td>
                            <div class="delete-transaction">
                                <form
                                    action="{{route('transactions.destroy', ['id' => $transaction->id])}}"
                                    method="post"
                                >
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <table id="example" class="display" style="width:100%">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Extn.</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Extn.</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
                </tfoot>
            </table>
        @else
            <p>No transactions yet...</p>
        @endif

    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                "ajax": "data/arrays.txt"
            } );
        } );

        var label = <?php echo json_encode($labels) ?>;
        var data = <?php echo json_encode($amount) ?>;
        var barChartData = {
            labels: label,
            datasets: [{
                label: 'User',
                backgroundColor: "pink",
                data: data,
            }]
        };
        window.onload = function () {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderColor: '#c1c1c1',
                            borderSkipped: 'bottom'
                        }
                    },
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Your transactions'
                    }
                }
            });
        };
    </script>
@endsection
