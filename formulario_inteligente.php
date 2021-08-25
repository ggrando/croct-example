<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulário inteligente</title>

  <script src="https://cdn.croct.io/js/v1/lib/plug.js?appId=00000000-0000-0000-0000-000000000000"></script>
  <script>
  croct.plug();
  croct.tracker.enable();
  </script>

</head>

<body>

<script>
 var i = 0;
window.onload = function() {

 

  Promise.resolve(croct.evaluate('user\'s name is known')).then(function(value) {
    if (value === true){
      document.getElementById("form_nome").style.display = "none";
    } 
  });
  Promise.resolve(croct.evaluate('user\'s phone is known')).then(function(value) {
    if (value === true){
      document.getElementById("form_phone").style.display = "none";
    } 
  });

  Promise.resolve(croct.evaluate('user\'s email is known')).then(function(value) {
    if (value === true){
      document.getElementById("form_email").style.display = "none";
    } 
  });

};

</script>

Bem-vindo ao formulário inteligente!

<form action="" method="post">

  <div><input type="text" name="nome" id="form_nome" placeholder="nome"></div>
  <div><input type="email" name="email" id="form_email" placeholder="email"></div>
  <div><input type="text" name="phone" id="form_phone" placeholder="phone"></div>

  <button type="submit" onclick="click_form()">
  Send
  </button>

</form>

<button onclick="reset()">Reset User Fields</buttoon>
<script>

function click_form(){
  var n = document.getElementById('form_nome').value;
  var e = document.getElementById('form_email').value;
  var p = document.getElementById('form_phone').value;

  if (!!n){
    croct.user.edit()
   .set('firstName', n)
   .save()
  }
  if (!!e){
    croct.user.edit()
   .set('email', e)
   .save()
  }

  if (!!p){
    croct.user.edit()
    .set('phone', p)
    .save()
  }
  
};

function reset(){
  console.log("resetado")
  croct.user.edit()
  .set('firstName', null)
  .set('email', null)
  .set('phone', null)
  .save()
  document.location.reload(true);
};
</script>


</body>
</html>