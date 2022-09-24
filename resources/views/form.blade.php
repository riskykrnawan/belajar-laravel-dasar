<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <form action="/form" method="post">
    <label for="name">
      <input type="text" name="name"/>
    </label>
    <input type="hidden" name="_token" value={{ csrf_token() }}>
    <button type="submit" value="Say Hello">Submit</button>
  </form>
</body>
</html>