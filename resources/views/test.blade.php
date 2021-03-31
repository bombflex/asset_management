<!DOCTYPE html>
<html>
<head>
 <title>Generate And Download PDF File Using dompdf — websolutionstuff.com</title>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div class="container">
 <div class="row">
 <div class="col-lg-12" style="margin-top: 15px ">
 <div class="pull-left">
 <h2>Generate And Download PDF File Using dompdf — websolutionstuff.com</h2>
 </div>
 <div class="pull-right">
 <a class="btn btn-primary" href="{{route('employees.index',['download'=>'pdf'])}}">Download PDF</a>
 </div>
 </div>
 </div><br>
<table class="table table-bordered">
 <tr>
 <th>Name</th>
 <th>Email</th>
 </tr>
@foreach ($user as $user)
 <tr>
 <td>{{ $user->name }}</td>
 <td>{{ $user->email }}</td>
 </tr>
 @endforeach
 </table>
 </div>
</body>
</html>