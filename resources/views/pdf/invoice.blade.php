<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Empire Auto Garage</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			font-size: 14px;
			margin: 0;
			padding: 0;
		}

		.container {
			max-width: 800px;
			margin: 0 auto;
			padding: 20px;
		}

		.invoice-header {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 20px;
		}

		.invoice-header h1 {
			margin: 0;
		}

		.invoice-header p {
			margin: 0;
			font-size: 12px;
			color: #666;
		}

		.invoice-from {
			margin-bottom: 20px;
		}

		.invoice-to {
			margin-bottom: 20px;
		}

		.invoice-date {
			margin-bottom: 20px;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 20px;
		}

		th {
			text-align: left;
			padding: 10px;
			background-color: #f5f5f5;
			border: 1px solid #ccc;
		}

		td {
			text-align: left;
			padding: 10px;
			border: 1px solid #ccc;
		}

		.total {
			font-weight: bold;
		}

		.footer {
			margin-top: 50px;
			text-align: center;
			color: #999;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="invoice-header">
			<h1>Empire Auto Garage</h1>
            <p>Invoice</p>
		</div>

		<div class="invoice-from">
			<p>Client Name: {{ $total_calculation->owner_name }}</p>
			<p>Parking Number: {{ $total_calculation->parking_number }}</p>
			<p>Vehicle Company: {{ $total_calculation->vehicle_company }}</p>
			<p>Client Phone Number: {{ $total_calculation->owner_company_number }}</p>
		</div>

		<div class="invoice-date">
			<p>Invoice Number: INV-001</p>
			<p>In Time: {{ \Carbon\Carbon::parse($total_calculation->created_at)->format('F d, Y, g:i a') }}</p>
			<p>Out Time: {{ \Carbon\Carbon::parse($total_calculation->deleted_at)->format('F d, Y, g:i a') }}</p>
            <p>Tunned Time: {{ $duration }} in hour</p>
            <p>Total Cost: ${{ $parkingCost }}</p>
		</div>
    </div>
</body>
