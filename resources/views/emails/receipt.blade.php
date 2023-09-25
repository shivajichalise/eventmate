<!DOCTYPE html>
<html>
    <head>
        <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .title {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .subtitle {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .info {
            margin-bottom: 20px;
        }

        .info p {
            margin: 5px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .table th, .table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .total {
            margin-top: 20px;
            text-align: right;
        }

        .total p {
            margin: 5px 0;
        }

        .slogan {
            text-align: center;
            margin-top: 30px;
        }

        .logo {
            max-width: 100px;
            height: auto;
        }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <img src="images/logo/png/eventmate_blue-nav-withBackground.png" alt="Event Mate Logo" class="logo" />
                <h1 class="title">Receipt</h1>
                <h2 class="subtitle">Invoice: {{ $invoice->number }}</h2>
            </div>
            <div class="info">
                <p>Date: {{ $date }}</p>
                <p>{{ config('app.name') }}</p>
                <p>Attendee: {{ $user->name }}</p>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 50%;">Ticket</th>
                        <th style="width: 50%;">Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width: 50%;">{{ $subEvent->name }}</td>
                        <td style="width: 50%;">{{ $ticket->currency }} {{ $ticket->price }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td style="text-align: left;"><strong>Total:</strong></td>
                        <td>{{ $ticket->currency }} {{ $ticket->price }}</td>
                    </tr>
                    <tr>
                        <td style="text-align: left;"><strong>Tax:</strong></td>
                        <td>{{ $ticket->currency }} {{ ( $ticket->tax / 100 ) * $ticket->price }}</td>
                    </tr>
                </tfoot>
            </table>
            <div class="total">
                <p><strong>Grand Total: {{ $ticket->currency }} {{ ( ( $ticket->tax / 100 ) * $ticket->price ) + $ticket->price }}</strong></p>
            </div>
            <!-- <div class="slogan"> -->
            <!--     <p>Run for health, Run for fun</p> -->
            <!-- </div> -->
        </div>
    </body>
</html>
