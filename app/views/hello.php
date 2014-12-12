<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>豆瓣图书排名工具</title>
	<style>
		@import url(//fonts.googleapis.com/css?family=Lato:700);

		body {
			margin:0;
			font-family:'Lato', sans-serif;
			text-align:center;
			color: #999;
		}

		.welcome {
			width: 300px;
			height: 200px;
			position: absolute;
			left: 50%;
			top: 50%;
			margin-left: -150px;
			margin-top: -100px;
		}

		a, a:visited {
			text-decoration:none;
		}

		h1 {
			font-size: 32px;
			margin: 16px 0 0 0;
		}
	</style>
</head>
<body>
	<div class="welcome">
        @section('form')
        {{Form::model(array(), array('method' => 'post', 'url'=>
        'rank/'))}}
        <div class="form-group">
            {{Form::label('Name')}}
            {{Form::text('name')}}
        </div>
        <div class="form-group">
            {{Form::label('Date of birth')}}
            {{Form::text('date_of_birth')}}
        </div>
        <div class="form-group">
            {{Form::label('Breed')}}
            {{Form::select('breed_id', $breed_options)}}
        </div>
        {{Form::submit("Save", array("class"=>"btn btn-default"))}}
        {{Form::close()}}
        @stop
    </div>
</body>
</html>
