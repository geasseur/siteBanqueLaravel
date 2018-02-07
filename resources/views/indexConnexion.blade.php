@extends('master')
@section('content')
<section class='col-6 d-flex flex-nowrap align-items-center'>
  <form class="d-flex flex-column col-5" action="http://localhost:8888/siteBanqueLaravel/public/testConnexion" method="post">
    {{csrf_field()}}
    <input type="text" name="pseudoConnexion" placeholder="entrez votre nom" value="">
    <input type="password" name="passwordConnexion" placeholder="entrez votre mot de passe" value="">
    <input type="submit" name="" value="connexion">
  </form>
  <form class="mt-2 d-flex flex-column col-6" action="http://localhost:8888/siteBanqueLaravel/public/creationUser" method="post">
    {{csrf_field()}}
    <input type="text" name="pseudoCreation" placeholder="donnez un nom" value="">
    <input type="text" name="passwordCreation" placeholder="rentrez un mot de passe" value="">
    <input type="text" name="passwordCreationVerification" placeholder="rentrez le même mot de passe" value="">
    <input type="text" name="mailCreation" placeholder="rentrez votre adresse mail" value="">
    <input type="submit" name="" value="creer compte">
  </form>
</section>
@stop
