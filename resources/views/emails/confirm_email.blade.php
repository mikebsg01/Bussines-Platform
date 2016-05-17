<html>
<body style="background-color: #F5F5F5;">  
<div style="display:block;width:80%;margin:auto;margin-top:50px;margin-bottom:15px;background-color:white;padding:15px;border-radius:3px;box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);">
  <div style="display:block;margin:auto;">
    <div>
      <img src="{{ asset('assets/img/aem-logo.png') }}" title="AEM - Logo" style="display:inline-block;" />
    </div>
    <div style="margin-bottom:15px;text-align:center;font-family: helvetica, arial, sans-serif;">
      <h1>Bienvenido a AEM Platform</h1>
    </div>
  </div>
  <div style="display:block;margin:auto;margin-bottom:25px;">
    <div style="font-family:helvetica,arial,sans-serif;">
      <p> 
        Ya podemos activar su cuenta. Lo único que nos falta es confirmar que esta es su dirección de correo electrónico. 
      </p>
    </div>
  </div>
  <div style="display:block;margin:auto;">
    <div style="margin-bottom:15px;text-align:center;font-family: helvetica, arial, sans-serif;">
      <a href="{{ url('register/confirm/email/token/'.$user['confirmation_code']) }}" style="border-radius:2px;background-color:#EE3224;box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);padding:8px 22px;color:#F1F1F1;text-decoration:none;"> 
        Confirmar correo electrónico
      </a>
    </div>
  </div>
</div>
</body>
</html>